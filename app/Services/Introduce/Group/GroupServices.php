<?php

namespace App\Services\Introduce\Group;

use App\Services\AppServices;
use Illuminate\Http\Request;
use App\Models\Group;
use App\Models\GroupConference;

/**
 * Class GroupServices
 * @package App\Services
 */
class GroupServices extends AppServices
{
    public function listService(Request $request)
    {
        $query = Group::where(['hide'=>'N'])->orderBy('sort');
//        $query = Group::where(['hide'=>'N'])->orderByDesc('sid');

//        if (!isAdmin()) { // 관리자 아니면 공개만
//            $query->where('hide', 'N');
//        }


        $list = $query->paginate(12)->appends(request()->except(['page']));
        $this->data['list'] = setListSeq($list);
        $this->data['category'] = 'list';

        return $this->data;
    }
    public function branchService(Request $request)
    {
        $this->data['category'] = 'branch';

        return $this->data;
    }

    public function guideService(Request $request)
    {
        $this->data['category'] = 'guide';

        return $this->data;
    }

    public function joinService(Request $request)
    {
        $this->data['category'] = 'join';

        return $this->data;
    }

    public function detailService(Request $request)
    {
        $this->data['group'] = Group::findOrFail($request->sid);

        return $this->data;
    }

    public function conferenceUpsertService(Request $request)
    {
        $this->data['group'] = Group::findOrFail($request->g_sid);
        $this->data['group_conference'] = GroupConference::where([ 'sid' => $request->sid])->first();

        return $this->data;
    }

    public function conferenceViewService(Request $request)
    {
        $this->data['group_conference'] = GroupConference::where([ 'sid' => $request->sid])->first();

        return $this->data;
    }



    public function dataAction(Request $request)
    {
        switch ($request->case) {

            case 'board-create':
                return $this->boardCreate($request);

            case 'board-update':
                return $this->boardUpdate($request);

            case 'board-delete':
                return $this->boardDelete($request);

            default:
                return notFoundRedirect();
        }
    }
    
    private function boardCreate(Request $request)
    {
        $this->transaction();
        try {
            $gc = new GroupConference();
            $gc->setByData($request);
            $gc->save();

//            if ($gc->save()) {
//                // 첨부파일 (plupload) 등록
//                foreach (json_decode($request->plupload_file ?? [], true) as $row) {
//                    $row['bsid'] = $gc->sid;
//                    $row['bbs_code'] = $gc->bbs_code;
//
//                    $file = new BoardFile();
//                    $file->setByData($row);
//                    $file->save();
//                }
//            }

            $this->dbCommit("연구회/지회 학술대회 등록");

            return $this->returnJsonData('alert', [
                'case' => true,
                'msg' => '연구회/지회 학술대회가 등록 되었습니다.',
                'location' => $this->ajaxActionLocation('replace', route('introduce.group.detail',['sid'=> $request->g_sid ] )),
            ]);
        } catch (\Exception $e) {
            return $this->dbRollback($e, true);
        }
    }

    private function boardUpdate(Request $request)
    {
        $this->transaction();

        try {
            $gc = GroupConference::findOrFail($request->sid);
            $gc->setByData($request);
            $gc->update();

//            if ($board->update()) {
//                /* 첨부파일 (plupload) */
//                foreach (json_decode($request->plupload_file ?? [], true) as $row) { // 첨부파일 (plupload) 등록
//                    $row['bsid'] = $board->sid;
//                    $row['bbs_code'] = $board->bbs_code;
//
//                    $file = new BoardFile();
//                    $file->setByData($row);
//                    $file->save();
//                }
//
//                // 첨부파일 (plupload) 삭제
//                foreach ($board->files()->whereIn('sid', $request->plupload_file_del ?? [])->get() as $plFile) {
//                    $plFile->delete();
//                }
//            }

            $this->dbCommit('연구회/지회 학술대회 수정');

            return $this->returnJsonData('alert', [
                'case' => true,
                'msg' => '연구회/지회 학술대회가 수정 되었습니다.',
                'location' => $this->ajaxActionLocation('replace', route('introduce.group.detail',['sid'=> $request->g_sid ] )),
            ]);
        } catch (\Exception $e) {
            return $this->dbRollback($e, true);
        }
    }

    private function boardDelete(Request $request)
    {
        $this->transaction();

        try {
            $gc = GroupConference::findOrFail($request->sid);
            $gc->delete();

            $this->dbCommit('연구회/지회 학술대회 삭제');

            return $this->returnJsonData('alert', [
                'case' => true,
                'msg' => '연구회/지회 학술대회가 삭제 되었습니다.',
                'location' => $this->ajaxActionLocation('replace', route('introduce.group.detail',['sid'=> $request->g_sid ] )),
            ]);
        } catch (\Exception $e) {
            return $this->dbRollback($e, true);
        }
    }
}
