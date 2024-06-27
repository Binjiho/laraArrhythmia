<?php

namespace App\Services\Admin\Research;

use App\Models\ResearchReviewer;
use App\Models\User;

use App\Services\CommonServices;
use App\Services\Admin\Member\MemberServices;
use App\Services\AppServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class AuthServices
 * @package App\Services
 */
class ResearchReviewerServices extends AppServices
{

    public function findReveiwer(int $sid = 0)
    {
        return ResearchReviewer::find($sid)->first();
    }

    public function indexService(Request $request)
    {
        $query = ResearchReviewer::orderByDesc('created_at')->with(['user']);
        $query->where('del', '=', 'N');

        if ($request->name_kr || $request->email) { // 이름
            $query->whereHas('user', function (Builder $querySub) use ($request) {
                if($request->name_kr) $querySub->where('name_kr', 'like', '%' . $request->name_kr . '%');
                if($request->email) $querySub->where('uid', 'like', '%' . $request->email . '%');
            });
        }

        if ($request->all == 'Y') {
            return $query->get();
        }

        $cnt = clone $query;
        $list = $query->paginate(10);

        $this->data['total'] = $cnt->count();
        $this->data['list'] = setListSeq($list);

        return $this->data;
    }



    public function registrationService(Request $request)
    {
        $sid = $request->sid;
        $this->data['research_reviewer'] = empty($sid) ? [] : $this->findReveiwer($sid);

        if(empty($sid)) {
            $this->data['user'] = empty($request->user_sid) ? [] : (new MemberServices())->findUser($request->user_sid);
        }else {
            $this->data['user'] = (new MemberServices())->findUser($this->data['research_reviewer']->user_sid);
        }

        return $this->data;
    }


    public function dataAction(Request $request)
    {
        switch ($request->case) {
            case 'uid-check':
                return $this->uidService($request);

            case 'research_reviewer-create':
                return $this->researchReviewerCreateService($request);

            case 'research_reviewer-update':
                return $this->researchReviewerUpdateService($request);

            case 'research_reviewer-delete':
                return $this->researchReviewerDeleteService($request);

            case 'research_reviewer_user-regist':
                return $this->researchReviewerUserRegist($request);

            default:
                return notFoundRedirect();
        }
    }

    private function uidService(Request $request)
    {
        $user = User::withTrashed()->where(['uid' => $request->uid])->first();

        if (empty($user)) {
            return $this->returnJsonData('alert', [
                'msg' => '해당 회원을 찾을 수 없습니다. 다른 아이디를 입력해주세요.',
            ]);
        } else {
            return $this->returnJsonData('input', [
                $this->ajaxActionInput('#name_kr', $user->name_kr ),
                $this->ajaxActionInput('#user_sid', $user->sid ),
            ]);
        }
    }

    private function researchReviewerCreateService(Request $request)
    {
        try {
            $reviewer = (new ResearchReviewer());
            $reviewer->setByData($request);
            $reviewer->save();

            $this->dbCommit("연구지원 - 심사자등록");
            return $this->returnJsonData('alert', [
                'case' => true,
                'msg' => '심사자가 등록되었습니다.',
                'winClose' => $this->ajaxActionWinClose(true),
            ]);
        } catch (\Exception $e) {
            return $this->dbRollback($e);
        }
    }

    private function researchReviewerUpdateService(Request $request)
    {
        $sid = $request->sid;


        $this->transaction();

        try {
            $reviewer = $this->findReveiwer($sid);
            $reviewer->setByData($request);
            $reviewer->save();

            $this->dbCommit("연구지원 - 심사자수정");
            return $this->returnJsonData('alert', [
                'case' => true,
                'msg' => '심사자가 수정되었습니다.',
                'winClose' => $this->ajaxActionWinClose(true),
            ]);
        } catch (\Exception $e) {
            return $this->dbRollback($e);
        }
    }

    private function researchReviewerDeleteService(Request $request)
    {
        $this->transaction();

        try {
            $reviewer = $this->findReveiwer($request->sid);
            $reviewer->del ='Y';
            $reviewer->deleted_at = date('Y-m-d H:i:s');
            $reviewer->update();

            $this->dbCommit("연구지원 - 심사자수정 삭제");
            return $this->returnJsonData('alert', [
                'case' => true,
                'msg' => '심사자가 삭제되었습니다.',
                'parentsReload' => true,
                'location' => $this->ajaxActionLocation('reload')
            ]);
        } catch (\Exception $e) {
            return $this->dbRollback($e);
        }
    }


    private function researchReviewerUserRegist(Request $request)
    {
        $this->transaction();

        try {
            $research = \App\Models\Research::find($request->research);
            $research->research_users()->sync(json_decode($request->research_reviewer_sid, true));

            $this->dbCommit("연구지원 - 심사자 등록");
            return $this->returnJsonData('alert', [
                'case' => true,
                // 'msg' => gettype(json_decode($request->research_reviewer_sid, true)),
                'msg' => '심사자가 등록되었습니다.',
                'parentsReload' => true,
                'location' => $this->ajaxActionLocation('reload')
            ]);
        } catch (\Exception $e) {
            return $this->dbRollback($e);
        }

    }

    

    private function listUrl()
    {
        return route('research_reviewer');
    }

}
