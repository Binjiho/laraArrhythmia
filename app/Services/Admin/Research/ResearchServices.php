<?php

namespace App\Services\Admin\Research;

use App\Models\Research;
use App\Models\User;
use App\Models\Reviewer;
use App\Models\ResearchResult;
use App\Exports\Research\ResearchExcel;

use App\Services\CommonServices;
use App\Services\AppServices;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class AuthServices
 * @package App\Services
 */
class ResearchServices extends AppServices
{
    public function indexService(Request $request)
    {
        $query = Research::orderByDesc('created_at')->with(['user']);
        $query->where('del', '=', 'N');


        if ($request->name_kr || $request->email) { // 이름
            $query->whereHas('user', function (Builder $querySub) use ($request) {
                if($request->name_kr) $querySub->where('name_kr', 'like', '%' . $request->name_kr . '%');
                if($request->email) $querySub->where('uid', 'like', '%' . $request->email . '%');
            });
        }

        if ($request->result) { // 심사현황
            $query->where('result', '=', $request->result);
        }

        // 엑셀 다운로드 일경우
        if ($request->excel) {
            $this->data['collection']= setSeq($query->get());
            $fileName = '연구지원관리'.date('Y-m-d');
            return (new CommonServices())->excelDownload(new ResearchExcel($this->data), $fileName);
        }

        $cnt = clone $query;
        $list = $query->paginate(10);

        $this->data['total'] = $cnt->count();
        $this->data['list'] = setListSeq($list);

        return $this->data;
    }

    public function listService(Request $request)
    {
//        $query = Reviewer::orderByDesc('created_at')->with(['user']);
        $query = Reviewer::where(['code'=>'research', 'del'=>'N'])->orderByDesc('created_at')->with(['user']);
        $query->where('del', '=', 'N');

        $cnt = clone $query;
        $list = $query->paginate(10);

        //배정된 심사위원
        $this->data['reviewer_users'] = ResearchResult::where(['research_sid'=>$request->research_sid])->pluck('reviewer_sid')->toArray();
//        $reviewer_users = $research->research_users->pluck('user_sid')->toArray();

        $this->data['total'] = $cnt->count();
        $this->data['list'] = setListSeq($list);

        return $this->data;
    }

    public function registerService(Request $request)
    {
        $this->data['research'] = Research::findOrFail($request->sid);

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
            case 'research-update':
                return $this->researchUpdateServices($request);

            case 'reviewer-regist':
                return $this->reviewerRegistService($request);

            case 'result-delete':
                return $this->resultDeleteService($request);

            case 'change-result':
                return $this->changeResultServices($request);

            default:
                return notFoundRedirect();
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
                'winClose' => $this->ajaxActionWinClose(false),
            ]);
        } catch (\Exception $e) {
            return $this->dbRollback($e);
        }
    }

    private function reviewerRegistService(Request $request)
    {
        $this->transaction();
        
        try {
            $research = Research::find($request->sid);
            $research->research_reviewer()->sync(json_decode($request->research_reviewer_sid, true));

            $this->dbCommit("연구지원 - 심사자 배정");
            return $this->returnJsonData('alert', [
                'case' => true,
                'msg' => '심사자가 배정되었습니다.',
                'winClose' => $this->ajaxActionWinClose(false),
            ]);

        } catch (\Exception $e) {
            return $this->dbRollback($e,true);
        }
    }

    private function resultDeleteService(Request $request)
    {
        $this->transaction();

        try {
            $result=ResearchResult::find($request->sid);
            $result->delete();

            $this->dbCommit("연구지원 - 심사자 삭제");
            return $this->returnJsonData('alert', [
                'case' => true,
                'msg' => '심사 결과가 삭제 되었습니다.',
                'location' => $this->ajaxActionLocation('reload'),
            ]);

        } catch (\Exception $e) {
            return $this->dbRollback($e);
        }
    }

    private function changeResultServices(Request $request)
    {
        $this->transaction();

        try {
            $research = Research::findOrFail($request->sid);
            $research->result = $request->target;
            $research->update();

            $this->dbCommit('연구지원 - 심사현황상태 변경');

            return $this->returnJsonData('alert', [
                'case' => true,
                'msg' => '심사상태가 변경 되었습니다.',
                'location' => $this->ajaxActionLocation('reload'),
            ]);
        } catch (\Exception $e) {
            return $this->dbRollback($e);
        }
    }

}
