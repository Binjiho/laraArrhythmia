<?php

namespace App\Services\Library;

use App\Models\Sessions;
use App\Models\Board;
use App\Models\SessionPrograms;
use App\Services\AppServices;
use App\Services\CommonServices;


use Illuminate\Http\Request;

/**
 * Class ConferenceServices
 * @package App\Services
 */
class LibraryServices extends AppServices
{
    public function listService(Request $request)
    {
        $this->data['board'] = Board::findOrFail($request->bsid);

        $query = Sessions::where(['bsid'=>$request->bsid])->orderBy('sort');
        $query->where('del', '=', 'N');

        $cnt = clone $query;
        $list = $query->paginate(10);

        $this->data['total'] = $cnt->count();
        $this->data['list'] = setListSeq($list);
        return $this->data;
    }

    public function upsertService(Request $request)
    {
        $this->data['board'] = Board::findOrFail($request->bsid);
        $this->data['session_list'] = Sessions::where(['bsid'=>$request->bsid, 'del'=>'N'])->get();

        $this->data['session_items'] = SessionPrograms::where(['bsid'=>$request->bsid, 'del'=>'N'])->orderBy('sort')->get();
        $query = SessionPrograms::where(['bsid'=>$request->bsid, 'ssid'=>$request->sid])->orderBy('sort');
        $query->where('del', '=', 'N');

        $cnt = clone $query;
        $list = $query->paginate(10);

        $this->data['total'] = $cnt->count();
        $this->data['list'] = setListSeq($list);
        return $this->data;
    }

    public function dataAction(Request $request)
    {
        switch ($request->case) {
            case 'program-create':
                return $this->programCreate($request);

            case 'program-update':
                return $this->programUpdate($request);

            case 'program-delete':
                return $this->programDelete($request);


            case 'insert-program':
                return $this->insertProgramServices($request);
            case 'sort-change':
                return $this->sortChange($request);
            case 'file-delete':
                return $this->fileDelete($request);
            default:
                return notFoundRedirect();
        }
    }

    private function programCreate(Request $request)
    {
        $this->transaction();
        
        try {
            for($i=0; $i<$request->session_cnt; $i++){
                $program = new SessionPrograms();

                $program->bsid = $request->sid;
                $program->ssid = $request->ssid[$i];
                $program->time = $request->time[$i];
                $program->title = $request->title[$i];
                $program->speaker = $request->speaker[$i];
                $program->link_url = $request->link_url[$i];
//                $program->sort = $i+1;

                // 파일 업로드 경로
                $directory = "programs";

                $file = $request->file("file{$i}") ?? null;

                // 첨부파일 있을경우 업로드후 경로 저장
                if ($file) {
                    $uploadFile = (new CommonServices())->fileUploadService($file, $directory);
                    $program->thumb_realfile = $uploadFile['realfile'];
                    $program->thumb_file = $uploadFile['filename'];
                }

                $program->save();
            }

            $this->dbCommit('세션 프로그램 생성');

            return $this->returnJsonData('alert', [
                'case' => true,
                'msg' => '세션 프로그램이 생성 되었습니다.',
                'location' => $this->ajaxActionLocation('replace', route('library.sessions',['bsid'=>$program->bsid ] )),
            ]);
        } catch (\Exception $e) {
            return $this->dbRollback($e,true);
        }
    }

    private function programUpdate(Request $request)
    {
        $this->transaction();

        try {
            $programs_cnt = count($request->program_sid);
//            $programs_cnt = $request->session_cnt;
            for($i=0; $i<$programs_cnt; $i++) {
                if(!empty($request->program_sid[$i])){
                    $program = SessionPrograms::findOrFail($request->program_sid[$i]);
                }else{
                    $program = new SessionPrograms();
                    $program->bsid = $request->sid;
                }

                $program->ssid = $request->ssid[$i];
                $program->time = $request->time[$i];
                $program->title = $request->title[$i];
                $program->speaker = $request->speaker[$i];
                $program->link_url = $request->link_url[$i];

                // 파일 업로드 경로
                $directory = "programs";

                $file = $request->file("file{$i}") ?? null;

                // 첨부파일 있을경우 업로드후 경로 저장
                if ($file) {
                    $uploadFile = (new CommonServices())->fileUploadService($file, $directory);
                    $program->thumb_realfile = $uploadFile['realfile'];
                    $program->thumb_file = $uploadFile['filename'];
                }
                
                if(!empty($request->program_sid[$i])){
                    $program->update();
                }else{
                    $program->save();
                }

            }

            $this->dbCommit('세션 프로그램 수정');

            return $this->returnJsonData('alert', [
                'case' => true,
                'msg' => '세션 프로그램이 수정 되었습니다.',
                'location' => $this->ajaxActionLocation('replace', route('library.sessions',['bsid'=>$program->bsid ] )),
            ]);
        } catch (\Exception $e) {
            return $this->dbRollback($e,true);
        }
    }

    private function programDelete(Request $request)
    {
        $this->transaction();

        try {
            $program = SessionPrograms::findOrFail($request->sid);
            $program->delete();

            $this->dbCommit('세션 프로그램 삭제');

            return $this->returnJsonData('alert', [
                'case' => true,
                'msg' => '세션 프로그램이 삭제 되었습니다.',
                'location' => $this->ajaxActionLocation('replace', route('library.sessions',['bsid'=>$program->bsid ] )),
            ]);
        } catch (\Exception $e) {
            return $this->dbRollback($e,true);
        }
    }

    private function insertProgramServices(Request $request)
    {
        $this->data['session_list'] = Sessions::where(['bsid'=>$request->bsid, 'del'=>'N'])->get();

        $session_cnt = $request->session_cnt; // 추가하는 세션 갯수
        $table_cnt = $request->table_cnt;     // 기존에 존재하는 갯수

        $target_arr = array();
//        if($session_cnt > $table_cnt){
//            for($i=$table_cnt; $i < $session_cnt; $i++) {
//                $this->data['i'] = $i;
//                $target_arr[] = $this->ajaxActionHtml('#fee_tbl', view('board.library.form.program', $this->data)->render());
//            }
//            $this->setJsonData('append', $target_arr);
//            return $this->returnJson();
//        }else{
//            for($f=$table_cnt; $f > $session_cnt; $f--){
//                $target_arr[] = $this->ajaxActionHtml('.programs_tbl', '일치하는 정보가 없습니다. 가입 정보를 다시 확인해 주세요.');
//            }
//            $this->setJsonData('lastRemove', $target_arr);
//            return $this->returnJson();
//        }

        for($i=$table_cnt; $i < $table_cnt+$session_cnt; $i++) {
            $this->data['i'] = $i;
            $target_arr[] = $this->ajaxActionHtml('#fee_tbl', view('board.library.form.program', $this->data)->render());
        }
        $this->setJsonData('append', $target_arr);
        return $this->returnJson();
    }

    private function sortChange(Request $request)
    {
        $this->transaction();
        try {
            $sid_arr = explode(',',$request->array_sid);
            foreach ($sid_arr as $idx => $item){
                $programs = SessionPrograms::findOrFail($item);
                $programs->sort = $idx+1;
                $programs->update();
            }

            $this->dbCommit('세션 프로그램 순서 업데이트');

            return $this->returnJsonData('alert', [
                'case' => true,
                'msg' => '순서가 수정되었습니다',
                'location' => $this->ajaxActionLocation('reload'),
            ]);
        } catch (\Exception $e) {
            return $this->dbRollback($e, true);
        }
    }

    private function fileDelete(Request $request)
    {
        $this->transaction();
        
        try {
            $board = SessionPrograms::where('thumb_realfile','=',$request->filePath)->first();
            (new CommonServices())->fileDeleteService($board->thumb_realfile);
            $board->thumb_file = '';
            $board->thumb_realfile = '';
            $board->update();

            $this->dbCommit('학술행사자료 파일만 삭제');

            return $this->returnJsonData('alert', [
                'case' => true,
                'msg' => '파일이 삭제 되었습니다.',
                'location' => $this->ajaxActionLocation('reload'),
            ]);
        } catch (\Exception $e) {
            return $this->dbRollback($e, true);
        }
    }

}
