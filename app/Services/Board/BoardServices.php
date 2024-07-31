<?php

namespace App\Services\Board;

use App\Models\Board;
use App\Models\BoardFile;
use App\Models\BoardCounter;
use App\Models\BoardReply;
use App\Models\Sessions;
use App\Services\AppServices;
use App\Services\CommonServices;
use Illuminate\Http\Request;

/**
 * Class BoardServices
 * @package App\Services
 */
class BoardServices extends AppServices
{
    public function listService(Request $request)
    {
        $search = $request->search ?? null;
        $keyword = $request->keyword ?? null;
        $category = $request->category ?? null;
        $category2 = $request->category2 ?? null;
        $abyear = $request->abyear ?? null;
        
    //    20240711 이광식 아래로 수정 (공지 항상 상위에 나오게 변경)

        $code = $request->code;

        $notice_query = Board::where('bbs_code', $code)->where(function($q) use($code) {
            if (!isAdmin()) {
                $q->orWhere('hide', 'N');

            }
        })
            ->where('notice', 'Y')
            ->withCount('files')->orderByDesc('sid');

        $notice_query2  = clone $notice_query;
        $this->data['notice'] = $notice_query->get();

        $query = Board::where('bbs_code', $request->code)
        ->where('notice', 'N')
        ->withCount('files')->orderByDesc('sid');

        if (!empty($search) && !empty($keyword)) {
            switch ($search) {
                default:
                    $query->where($search, 'like', "%{$keyword}%");
                    break;
            }
        }

        if (!empty($category) ) {
            $query->where('category', '=', $category);
        }
        if (!empty($category2) ) {
            $query->where('category2', '=', $category2);
        }
        if (!empty($abyear) ) {
            $query->where('abyear', '=', $abyear);
        }
        if(!isAdmin()){
            $query->where('hide', '=', 'N');
        }

        $cnt = clone $query;
        $list = $query->paginate(10);
//        $list = $query->paginate(1)->append($request->except('page'));

        $this->data['total'] = $cnt->count();
        $this->data['list'] = setListSeq($list);

   
        return $this->data;
    }

    public function upsertService(Request $request)
    {
        $sid = $request->sid ?? null;
        $this->data['board'] = empty($sid) ? null : Board::withCount('files')->findOrFail($sid);

        return $this->data;
    }

    public function viewService(Request $request)
    {
        $this->data['board'] = Board::withCount('files')->findOrFail($request->sid);
//        $this->data['prev'] = Post::where('sid', '<', $request->sid)->orderBy('id', 'desc')->first();
//        $this->data['next'] = Post::where('sid', '>', $request->sid)->orderBy('id', 'asc')->first();

        $this->refCounter($request); // 조회수 업데이트

        return $this->data;
    }

    public function replyUpsertService(Request $request)
    {
        $sid = $request->sid ?? null;
        $this->data['bsid']  = $request->bsid;
        $this->data['board'] = Board::findOrFail($request->bsid);
        $this->data['reply'] = empty($sid) ? null : BoardReply::withCount('files')->findOrFail($sid);

        return $this->data;
    }

    public function replyViewService(Request $request)
    {
        $this->data['bsid'] = $request->bsid;
        $this->data['board'] = Board::findOrFail($request->bsid);
        $this->data['reply'] = BoardReply::withCount('files')->findOrFail($request->sid);
        $this->refReplyCounter($request); // 조회수 업데이트

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

            case 'board-hide':
                return $this->boardHide($request);

            case 'popup-preview':
                return $this->boardPopupPreview($request);

            case 'reply-create':
                return $this->replyCreate($request);

            case 'reply-update':
                return $this->replyUpdate($request);

            case 'reply-delete':
                return $this->replyDelete($request);

            case 'file-delete':
                return $this->fileDelete($request);

            default:
                return notFoundRedirect();
        }
    }

    private function listUrl()
    {
        if(request()->category2){
            return route('board', ['code' => request()->code, 'category' => request()->category, 'category2' => request()->category2]);
        }else{
            return route('board', ['code' => request()->code, 'category' => request()->category, 'abyear' => request()->requestYear ?? request()->abyear]);
        }
    }

    private function boardCreate(Request $request)
    {
        $this->transaction();

        try {
            $board = new Board();
            $board->setByData($request);

            if ($board->save()) {
                // 첨부파일 (plupload) 등록
                foreach (json_decode($request->plupload_file ?? [], true) as $row) {
                    $row['bsid'] = $board->sid;
                    $row['bbs_code'] = $board->bbs_code;

                    $file = new BoardFile();
                    $file->setByData($row);
                    $file->save();
                }

                // 세션등록 (borad/library)
                if($board->bbs_code == 'library' && !empty($request->title[0])){
                    foreach ($request->session_sid as $idx => $sid) {
                        $object = new \stdClass();
//                        $object->bsid = $board->sid;
                        $object->bsid = request()->bsid;
                        $object->title = $request->title[$idx];
                        $object->chair_person = $request->chair_person[$idx];
                        $object->room = $request->room[$idx];
                        $object->sort = $idx+1;

                        $session = new Sessions();
                        $session->setByData($object);
                        $session->save();
                    }
                }
            }

            $this->dbCommit("게시글 등록");

            return $this->returnJsonData('alert', [
                'case' => true,
                'msg' => '게시글이 등록 되었습니다.',
                'location' => $this->ajaxActionLocation('replace', $this->listUrl()),
            ]);
        } catch (\Exception $e) {
            return $this->dbRollback($e, true);
        }
    }

    private function boardUpdate(Request $request)
    {
        $this->transaction();

        try {
            $board = Board::findOrFail($request->sid);
            $board->setByData($request);

            if ($board->update()) {
                /* 첨부파일 (plupload) */
                foreach (json_decode($request->plupload_file ?? [], true) as $row) { // 첨부파일 (plupload) 등록
                    $row['bsid'] = $board->sid;
                    $row['bbs_code'] = $board->bbs_code;

                    $file = new BoardFile();
                    $file->setByData($row);
                    $file->save();
                }

                // 첨부파일 (plupload) 삭제
                foreach ($board->files()->whereIn('sid', $request->plupload_file_del ?? [])->get() as $plFile) {
                    $plFile->delete();
                }

                //세션 저장
                if($board->bbs_code == 'library') { //이 조건 없으면 문제 있을거같아서 일단 추가함 (240709 이광식) 

                    $session_pre = Sessions::where(['bsid'=>$board->sid, 'del'=>'N'])->pluck('sid')->toArray(); //기존 session sid
                    if(!empty($session_pre) && empty($request->session_sid)){
                        $session_del = $session_pre;
                    }else{
                        // $session_del = array_diff($session_pre,$request->session_sid); 
                        // 오류로 일단주석 후 아래로 수정 (240709 이광식) 
                        $session_del = array_diff($session_pre, [$request->session_sid]);
                    }

                    if(!empty($session_del)){
                        foreach ($session_del as $del_item){
                            $session = Sessions::where(['sid'=>$del_item])->first();
                            $session->del = 'Y';
                            $session->update();
                        }
                    }

                }

                if($board->bbs_code == 'library' && !empty($request->title[0])){
                    foreach ($request->session_sid as $idx => $sid) {
                        $object = new \stdClass();
                        $object->bsid = $board->sid;
                        $object->title = $request->title[$idx];
                        $object->chair_person = $request->chair_person[$idx];
                        $object->room = $request->room[$idx];
                        $object->sort = $idx+1;

                        if(!empty($sid)){
                            $session = Sessions::where(['sid'=>$sid])->first();
                            $session->setByData($object);
                            $session->update();
                        }else{
                            $session = new Sessions();
                            $session->setByData($object);
                            $session->save();
                        }
                    }
                }
            }
            $this->dbCommit('게시글 수정');

            return $this->returnJsonData('alert', [
                'case' => true,
                'msg' => '게시글이 수정 되었습니다.',
                'location' => $this->ajaxActionLocation('replace', $this->listUrl()),
            ]);
        } catch (\Exception $e) {
            return $this->dbRollback($e, true);
        }
    }

    private function boardDelete(Request $request)
    {
        $this->transaction();

        try {
            $board = Board::findOrFail($request->sid);
            $board->delete();

            $this->dbCommit('게시글 삭제');

            return $this->returnJsonData('alert', [
                'case' => true,
                'msg' => '게시글이 삭제 되었습니다.',
                'location' => $this->ajaxActionLocation('replace', $this->listUrl()),
            ]);
        } catch (\Exception $e) {
            return $this->dbRollback($e, true);
        }
    }

    private function boardHide(Request $request)
    {
        $this->transaction();

        try {
            $board = Board::findOrFail($request->sid);
            $board->hide = $request->hide ?? 'N';
            $board->update();


            $this->dbCommit('게시글 공개여부 수정');

            return $this->returnJsonData('alert', [
                'case' => true,
                'msg' => '게시글의 공개여부가 수정 되었습니다.',
                'location' => $this->ajaxActionLocation('replace', $this->listUrl()),
            ]);
        } catch (\Exception $e) {
            return $this->dbRollback($e);
        }
    }

    private function boardPopupPreview(Request $request)
    {
        $request->merge(['sid' => 0]);
        $this->data['popup'] = [(object)$request->all()];

        return $this->returnJsonData('append', [
            $this->ajaxActionHtml('body', view('common.popup.index', $this->data)->render()),
        ]);
    }

    private function fileDelete(Request $request)
    {
        $this->transaction();

        try {
            if($request->fileType == 'thumb'){
                $board = Board::where('thumb_realfile','=',$request->filePath)->first();
                (new CommonServices())->fileDeleteService($board->thumb_realfile);
                $board->thumb_file = '';
                $board->thumb_realfile = '';
                $board->update();

            }else{
                $boardfile = BoardFile::where('realfile','=',$request->filePath)->first();

                $boardfile->delete();
            }

            $this->dbCommit('파일 삭제');

            return $this->returnJsonData('alert', [
                'case' => true,
                'msg' => '파일이 삭제 되었습니다.',
                'location' => $this->ajaxActionLocation('reload'),
            ]);
        } catch (\Exception $e) {
            return $this->dbRollback($e, true);
        }
    }

    private function refCounter(Request $request)
    {
        // ip 기준으로 조회수 하루에 한번씩
        $check = BoardCounter::whereRaw("DATE_FORMAT(created_at, '%Y%m%d') = ?", [now()->format('Ymd')])
            ->where([
                'bbs_code' => $request->code,
                'bsid' => $request->sid,
                'ip' => $request->ip()
            ])->exists();


        if (!$check) {
            $boardCounter = new BoardCounter();
            $boardCounter->setByData($request);
            $boardCounter->save();

            $this->data['board']->increment('ref');
        }
    }

    private function replyCreate(Request $request)
    {
        $this->transaction();

        try {
            $reply = new BoardReply();
            $reply->setByData($request);

            if ($reply->save()) {
                // 첨부파일 (plupload) 등록
                foreach (json_decode($request->plupload_file ?? [], true) as $row) {
                    $row['bsid'] = $reply->bsid;
                    $row['rsid'] = $reply->sid;
                    $row['bbs_code'] = $request->bbs_code;

                    $file = new BoardFile();
                    $file->setByData($row);
                    $file->save();
                }
            }

            $this->dbCommit('게시글 답글 등록');

            return $this->returnJsonData('alert', [
                'case' => true,
                'msg' => '답글이 등록 되었습니다.',
                'location' => $this->ajaxActionLocation('replace', $this->listUrl()),
            ]);
        } catch (\Exception $e) {
            return $this->dbRollback($e, true);
        }
    }

    private function replyUpdate(Request $request)
    {
        $this->transaction();

        try {
            $reply = BoardReply::findOrFail($request->sid);
            $reply->setByData($request);

            if ($reply->update()) {
                /* 첨부파일 (plupload) */
                foreach (json_decode($request->plupload_file ?? [], true) as $row) { // 첨부파일 (plupload) 등록
                    $row['br_sid'] = $reply->sid;

                    $file = new BoardReplyFile();
                    $file->setByData($row);
                    $file->save();
                }

                // 첨부파일 (plupload) 삭제
                foreach ($reply->files()->whereIn('sid', $request->plupload_file_del ?? [])->get() as $plFile) {
                    $plFile->delte();
                }
            }

            $this->dbCommit('게시글 답글 수정');

            return $this->returnJsonData('alert', [
                'case' => true,
                'msg' => '답글이 수정 되었습니다.',
                'location' => $this->ajaxActionLocation('replace', $this->listUrl()),
            ]);
        } catch (\Exception $e) {
            return $this->dbRollback($e, true);
        }
    }

    private function replyDelete(Request $request)
    {
        $this->transaction();

        try {
            $reply = BoardReply::findOrFail($request->sid);
            $reply->delete();

            $this->dbCommit('답글 삭제');

            return $this->returnJsonData('alert', [
                'case' => true,
                'msg' => '답글이 삭제 되었습니다.',
                'location' => $this->ajaxActionLocation('replace', $this->listUrl()),
            ]);
        } catch (\Exception $e) {
            return $this->dbRollback($e);
        }
    }

    private function refReplyCounter(Request $request)
    {
        // ip 기준으로 조회수 하루에 한번씩
        $check = BoardCounter::whereRaw("DATE_FORMAT(created_at, '%Y%m%d') = ?", [now()->format('Ymd')])
            ->where([
                'bsid' => $request->bsid,
                'rsid' => $request->sid,
                'ip' => $request->ip()
            ])->exists();

        if (!$check) {
            $replyCounter = new BoardCounter();
            $replyCounter->setByData($request);
            $replyCounter->save();

            $this->data['reply']->increment('ref');
        }
    }
}
