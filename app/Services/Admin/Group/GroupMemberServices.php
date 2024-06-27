<?php

namespace App\Services\Admin\Group;

use App\Models\User;
use App\Services\AppServices;
use Illuminate\Http\Request;
use App\Models\Group;
use App\Models\GroupMember;

/**
 * Class GroupMemberServices
 * @package App\Services
 */
class GroupMemberServices extends AppServices
{
    public function indexService(Request $request)
    {
        $group = Group::findOrFail($request->g_sid);
        $member = $group->members()->orderBy('sort')->orderByDesc('sid');
//        $member = $group->members()->orderByDesc('sid');

        $this->data['group'] = $group;
        $this->data['members'] = setSeq($member->get());

        return $this->data;
    }

    public function upsertService(Request $request)
    {
        $sid = $request->sid ?? null;
        $this->data['member'] = empty($sid) ? null : GroupMember::where([
            'g_sid' => $request->g_sid,
            'sid' => $sid,
        ])->firstOrFail();

        return $this->data;
    }

    public function dataAction(Request $request)
    {
        switch ($request->case) {
            case 'collective-create':
                return $this->collectiveCreate($request);

            case 'member-create':
                return $this->memberCreate($request);

            case 'member-update':
                return $this->memberUpdate($request);

            case 'member-delete':
                return $this->memberDelete($request);

            case 'search-layer':
                return $this->searchLayer($request);

            case 'member-search':
                return $this->memberSearch($request);

            case 'select-member':
                return $this->selectMember($request);

            case 'db-change':
                return $this->dbChange($request);

            case 'sort-change':
                return $this->sortChange($request);

            default:
                return notFoundRedirect();
        }
    }

    private function collectiveCreate(Request $request)
    {
        $this->transaction();

        try {
            $data = json_decode($request->data ?? [], true);


            foreach ($data as $index => $item) {
                $item['g_sid'] = $request->g_sid;

                $member = (new GroupMember());
                $member->setByData($item);
                $member->save();

            }

            $this->dbCommit('연구회 멤버 다중 등록');

            return $this->returnJsonData('alert', [
                'case' => true,
                'msg' => '등록 되었습니다.',
                'winClose' => $this->ajaxActionWinClose(true),
            ]);
        } catch (\Exception $e) {
            return $this->dbRollback($e);
        }
    }

    private function memberCreate(Request $request)
    {
        $this->transaction();

        try {
            $member = (new GroupMember());
            $member->setByData($request);
            $member->save();

            $this->dbCommit('연구회 멤버 단건 등록');

            return $this->returnJsonData('alert', [
                'case' => true,
                'msg' => '등록 되었습니다.',
                'winClose' => $this->ajaxActionWinClose(true),
            ]);
        } catch (\Exception $e) {
            return $this->dbRollback($e);
        }
    }

    private function memberUpdate(Request $request)
    {
        $this->transaction();

        try {
            $member = GroupMember::where([
                'g_sid' => $request->g_sid,
                'sid' => $request->sid,
            ])->firstOrFail();

            $member->setByData($request);
            $member->update();

            $this->dbCommit('연구회 멤버 수정');

            return $this->returnJsonData('alert', [
                'case' => true,
                'msg' => '수정 되었습니다.',
                'winClose' => $this->ajaxActionWinClose(true),
            ]);
        } catch (\Exception $e) {
            return $this->dbRollback($e, true);
        }
    }

    private function memberDelete(Request $request)
    {
        $this->transaction();

        try {
            $member = GroupMember::where([
                'g_sid' => $request->g_sid,
                'sid' => $request->sid,
            ])->firstOrFail();

            $member->delete();

            $this->dbCommit('연구회 멤버 삭제');

            return $this->returnJsonData('alert', [
                'case' => true,
                'msg' => '삭제 되었습니다.',
                'location' => $this->ajaxActionLocation('reload'),
            ]);
        } catch (\Exception $e) {
            return $this->dbRollback($e);
        }
    }

    private function searchLayer(Request $request)
    {
        return $this->returnJsonData('append', [
            $this->ajaxActionHtml('body', view('admin.group.member.layer.member-search')->render()),
        ]);
    }

    private function memberSearch(Request $request)
    {
        $keyfield = $request->keyfield;
        $keyword = $request->keyword;

        $query = User::orderBy('name_kr');

        switch ($keyfield) {
            default:
                $query->where($keyfield, 'like', "%{$keyword}%");
                break;
        }

        $this->data['member'] = $query->get();

        return $this->returnJsonData('html', [
            $this->ajaxActionHtml('#member-result', view('admin.group.member.layer.member-result', $this->data)->render()),
        ]);
    }

    private function selectMember(Request $request)
    {
        $member = User::findOrFail($request->sid);

        $this->setJsonData('remove', [
            $this->ajaxActionRemove('#member-search'),
        ]);

        $this->setJsonData('input', [
            $this->ajaxActionInput('#member-frm input[name=uid]', $member->uid),
            $this->ajaxActionInput('#member-frm input[name=name_kr]', $member->name_kr),
            $this->ajaxActionInput('#member-frm input[name=sosok]', $member->sosok_kr),
        ]);

        return $this->returnJson();
    }

    private function dbChange(Request $request)
    {
        $this->transaction();

        try {
            $member = GroupMember::where([
                'g_sid' => $request->g_sid,
                'sid' => $request->sid,
            ])->firstOrFail();

            $member->{$request->field} = $request->value;
            $member->update();

            $this->dbCommit('연구회 멤버 부분업데이트');

            return $this->returnJsonData('alert', [
                'msg' => '수정 되었습니다.',
            ]);
        } catch (\Exception $e) {
            return $this->dbRollback($e, true);
        }
    }

    private function sortChange(Request $request)
    {
        $this->transaction();
        try {
            $sid_arr = explode(',',$request->array_sid);
            foreach ($sid_arr as $idx => $item){
                $group = GroupMember::findOrFail($item);
                $group->sort = $idx+1;
                $group->update();
            }

            $this->dbCommit('연구회 멤버 순서 업데이트');

            return $this->returnJsonData('alert', [
                'case' => true,
                'msg' => '순서가 수정되었습니다',
                'location' => $this->ajaxActionLocation('reload'),
            ]);
        } catch (\Exception $e) {
            return $this->dbRollback($e, true);
        }
    }
}
