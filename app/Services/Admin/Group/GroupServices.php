<?php

namespace App\Services\Admin\Group;

use App\Services\AppServices;
use App\Models\Group;
use Illuminate\Http\Request;

/**
 * Class GroupServices
 * @package App\Services
 */
class GroupServices extends AppServices
{
    public function indexService(Request $request)
    {
        $query = Group::orderBy('sort');

        $list = $query->get();
        $this->data['list'] = setSeq($list);

        return $this->data;
    }

    public function memberService(Request $request)
    {
        return $this->data;
    }

    public function upsertService(Request $request)
    {
        $sid = $request->sid;
        $this->data['group'] = empty($sid) ? null : Group::findOrFail($sid);

        return $this->data;
    }

    public function dataAction(Request $request)
    {
        switch ($request->case) {
            case 'group-create':
                return $this->groupCreate($request);

            case 'group-update':
                return $this->groupupdate($request);

            case 'group-delete':
                return $this->groupDelete($request);

            case 'db-change':
                return $this->dbChange($request);

            case 'sort-change':
                return $this->sortChange($request);


            default:
                return notFoundRedirect();
        }
    }

    private function groupCreate(Request $request)
    {
        $this->transaction();

        try {
            $group = (new Group());
            $group->setByData($request);
            $group->save();

            $this->dbCommit('연구회/지회 생성');

            return $this->returnJsonData('alert', [
                'case' => true,
                'msg' => '생성 되었습니다',
                'winClose' => $this->ajaxActionWinClose(true),
            ]);
        } catch (\Exception $e) {
            return $this->dbRollback($e);
        }
    }

    private function groupUpdate(Request $request)
    {
        $this->transaction();

        try {
            $group = Group::findOrFail($request->sid);
            $group->setByData($request);
            $group->update();

            $this->dbCommit('연구회/지회 수정');

            return $this->returnJsonData('alert', [
                'case' => true,
                'msg' => '수정 되었습니다',
                'winClose' => $this->ajaxActionWinClose(true),
            ]);
        } catch (\Exception $e) {
            return $this->dbRollback($e);
        }
    }

    private function groupDelete(Request $request)
    {
        $this->transaction();

        try {
            $group = Group::findOrFail($request->sid);
            $group->delete();

            $this->dbCommit('연구회/지회 삭제');

            return $this->returnJsonData('alert', [
                'case' => true,
                'msg' => '삭제 되었습니다',
                'location' => $this->ajaxActionLocation('reload'),
            ]);
        } catch (\Exception $e) {
            return $this->dbRollback($e,true);
        }
    }

    private function dbChange(Request $request)
    {
        $this->transaction();

        try {
            $group = Group::findOrFail($request->sid);
            $group->{$request->field} = $request->value;
            $group->update();

            $this->dbCommit('연구회/지회 부분 업데이트');

            return $this->returnJsonData('alert', [
                'msg' => '수정 되었습니다',
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
                $group = Group::findOrFail($item);
                $group->sort = $idx+1;
                $group->update();
            }

            $this->dbCommit('연구회/지회 순서 업데이트');

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
