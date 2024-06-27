<?php

namespace App\Services\Research;

use App\Models\Research;
use App\Models\ResearchResult;

use App\Services\CommonServices;
use App\Services\AppServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

/**
 * Class AuthServices
 * @package App\Services
 */
class ResearchServices extends AppServices
{

    public function indexService(Request $request)
    {
        $this->data['research'] = Research::findOrFail($request->sid);
        return $this->data;
    }

    public function listService(Request $request)
    {
//        $query = Research::where('user_sid', thisPk())->orderByDesc('sid');

        $this->data['user'] = thisUser();
        $this->data['reviewer'] = 'N';
        $query = Research::orderByDesc('sid');

        if(!isAdmin()){
            $query->where('hide', '=', 'N');
            $query->where('del', '=', 'N');
        }

        $query->where(function($q) {
            $q->orWhere('user_sid', thisPk());

            //심사자 data
            $reviewer = ResearchResult::where('reviewer_sid', '=', thisPk())->pluck('research_sid');
            $this->data['reviewer'] = 'Y';
            if (!$reviewer->isEmpty()) {
                $q->orWhereIn('sid',  $reviewer);
            }
        });

        $cnt = clone $query;
        $list = $query->paginate(10);

        $this->data['total'] = $cnt->count();
        $this->data['list'] = setListSeq($list);

        return $this->data;
    }

    public function previewService(Request $request)
    {
        $this->data['research'] = Research::findOrFail($request->sid);
        $this->data['result'] = ResearchResult::where([ 'research_sid'=>$request->sid, 'state'=>'Y' ])->get();

        return $this->data;
    }
    public function dataAction(Request $request)
    {
        switch ($request->case) {
            case 'research-create':
                return $this->researchCreateServices($request);

            case 'research-update':
                return $this->researchUpdateServices($request);

            case 'research-result-create':
                return $this->researchResultCreateServices($request);

            case 'research-report-file':
                return $this->researchReportFileServices($request);

            default:
                return notFoundRedirect();
        }
    }

    private function researchCreateServices(Request $request)
    {
        $this->transaction();

        try {
            $research = new Research();

            $research->setBydata($request);
            $research->save();

            $this->dbCommit('연구비신청 생성');

            return $this->returnJsonData('alert', [
                'case' => true,
                'msg' => '연구비신청이 등록 되었습니다.',
                'location' => $this->ajaxActionLocation('replace', $this->listUrl()),
            ]);
        } catch (\Exception $e) {
            return $this->dbRollback($e);
//            return $this->dbRollback($e,true);
        }
    }

    private function researchUpdateServices(Request $request)
    {
        $this->transaction();

        try {
            $research = Research::findOrFail($request->sid);

            // 회원사진 바로 삭제할수 있지만 DB update 실패시 사진 사라지면 안되서 변수로 임시 저장
            if ($request->file_del === 'Y') {
                $delete_file_path = $research->image_path;
            }

            $research->setBydata($request);
            $research->update();

            $this->dbCommit('연구비신청 수정');

            return $this->returnJsonData('alert', [
                'case' => true,
                'msg' => '연구비신청이 수정 되었습니다.',
                'location' => $this->ajaxActionLocation('replace', $this->listUrl()),
            ]);
        } catch (\Exception $e) {
            return $this->dbRollback($e);
        }
    }

    //TODO : research_result 결과값, research 결과값 갱신
    private function researchResultCreateServices(Request $request)
    {
        $this->transaction();

        try {

            $result = ResearchResult::findOrFail($request->sid);

            $result->setBydata($request);

            if($request->state == 'Y'){
                $msg = "연구비 심사가 완료 되었습니다.";
            }else{
                $msg = "연구비 심사가 등록 되었습니다.";
            }
            $result->update();

            //해당 research 심사 총 갯수
            $tot_cnt = ResearchResult::where(['del'=>'N', 'research_sid'=> $result->research_sid])->count();
            //해당 research에 심사 완료 갯수
            $y_cnt = ResearchResult::where(['del'=>'N', 'research_sid'=> $result->research_sid, 'state'=>'Y'])->count();

            if($tot_cnt<= $y_cnt+1 ){
                //배정된 심사 전부 완료시
                $research = Research::findOrFail($result->research_sid);
                $research->result = 'S';
                $research->update();
            }else{
                //배정된 심사 진행중
                $research = Research::findOrFail($result->research_sid);
                $research->result = 'I';
                $research->update();
            }

            $this->dbCommit('연구비심사 등록');

            return $this->returnJsonData('alert', [
                'case' => true,
                'msg' => $msg,
                'winClose' => $this->ajaxActionWinClose(true),
            ]);
        } catch (\Exception $e) {
            return $this->dbRollback($e,true);
        }
    }

    private function researchReportFileServices(Request $request)
    {
        $this->transaction();

        try {
            $research = Research::findOrFail($request->sid);

            $research->setBydata($request);
            $research->update();

            $this->dbCommit('연구비신청 결과보고');

            return $this->returnJsonData('alert', [
                'case' => true,
                'msg' => '연구비신청 결과보고가 등록 되었습니다.',
                'winClose' => $this->ajaxActionWinClose(true),
            ]);
        } catch (\Exception $e) {
            return $this->dbRollback($e,true);
        }
    }
    private function listUrl()
    {
        return route('research.info');
    }

}
