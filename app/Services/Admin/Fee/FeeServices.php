<?php

namespace App\Services\Admin\Fee;

use App\Exports\Fee\FeeExcel;
use App\Models\Fee;
use App\Models\User;
use App\Services\Admin\Member\MemberServices;
use App\Services\AppServices;
use App\Services\CommonServices;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

/**
 * Class FeeServices
 * @package App\Services
 */
class FeeServices extends AppServices
{
    public function findFee(int $sid = 0)
    {
        return Fee::where('sid',$sid)->first();
//        return Fee::findOrFail($sid);
    }

    public function indexService(Request $request)
    {
        $query = Fee::orderByDesc('created_at')->with(['user']);
        $query->where('del', 'N');

        if($request->level) {
            $query->whereIn('user_sid', User::where('level', 'like', ('%' . $request->level . '%'))->get() );
        }

        if($request->uid) {
            $query->whereIn('user_sid', User::where('uid', 'like', ('%' . $request->uid . '%'))->get() );
        }

        if($request->name_kr) {
            $query->whereIn('user_sid', User::where('name_kr', 'like', ('%' . $request->name_kr . '%'))->get() );
        }

        if($request->pay_status) {
            $query->where('pay_status', $request->pay_status);
        }

        if($request->search && $request->keyword) {
            $query->whereIn('user_sid', User::where($request->search, 'like', ('%' . $request->keyword . '%'))->get());
        }

        // 엑셀 다운로드 일경우
        if ($request->excel) {
            $this->data['collection']= setSeq($query->get());
            $fileName = '회비관리'.date('Y-m-d');
            return (new CommonServices())->excelDownload(new FeeExcel($this->data), $fileName);
        }

        $fee = $query->paginate(20)->appends(request()->except(['page']));

        $this->data['list'] = setListSeq($fee);

        return $this->data;
    }

    public function memoService(Request $request)
    {
        $this->data['memo'] = $this->findFee($request->sid)->memo;
        return $this->data;
    }

    public function receiptService(Request $request)
    {
        $this->data['fee'] = $this->findFee($request->sid);
        $this->data['user'] = $this->data['fee']->user();

        return $this->data;
    }

    public function historyService(Request $request)
    {
        $this->data['user'] = (new MemberServices())->findUser($request->user_sid);
        $this->data['fee'] = $this->data['user']->fee()->orderByDesc('created_at')->paginate(20)->appends(request()->except(['page']));

        return $this->data;
    }

    public function registrationService(Request $request)
    {
        $sid = $request->sid;
        $this->data['fee'] = empty($sid) ? [] : $this->findFee($sid);

        if(empty($sid)) {
            $this->data['user'] = empty($request->user_sid) ? [] : (new MemberServices())->findUser($request->user_sid);
        }else {
            $this->data['user'] = (new MemberServices())->findUser($this->data['fee']->user_sid);
        }

        return $this->data;
    }

    // 평생회비 생성
    public function createLifetimeMembershipFee(int $user_sid)
    {
        $this->transaction();

        try {
            $memberShipFee = Fee::where(['user_sid' => $user_sid, 'detail' => 'A'])->first();

            if(empty($memberShipFee->sid)) {
                $feeData = [
                    'user_sid' => $user_sid,
                    'detail' => 'A',
                    'year' => date('Y'),
                    'price' => getConfig('fee')['price']['A'],
                    'pay_status' => 'A',
                ];

                $fee = (new Fee());
                $fee->setByData((object)$feeData);
                $fee->save();

                $this->dbCommit("회비관리 - 평생회비등록");

                return $this->returnJsonData('alert', [
                    'case' => true,
                    'msg' => '회비가 등록되었습니다.',
                    'winClose' => $this->ajaxActionWinClose(true),
                ]);
            }else {
                return $this->returnJsonData('alert', [
                    'case' => true,
                    'msg' => '이미 등록된 평생회비가 있습니다.',
                ]);
            }
        } catch (\Exception $e) {
            return $this->dbRollback($e);
        }
    }

    public function dataAction(Request $request)
    {
        switch ($request->case) {
            case 'fee-create':
                return $this->feeCreateService($request);

            case 'fee-update':
                return $this->feeUpdateService($request);

            case 'fee-delete':
                return $this->feeDeleteService($request);

            case 'change-pay_status':
                return $this->feeChangePayStatusService($request);

            case 'change-pay_date':
                return $this->feeChangePayDateService($request);

            case 'fee-memo':
                return $this->feeMemoService($request);

            case 'uid-check':
                return $this->feeUidService($request);

            default:
                return NotFoundRedirect();
        }
    }

    private function feeCreateService(Request $request)
    {
//        if($request->detail === 'A') {
//            return $this->createLifetimeMembershipFee($request->user_sid);
//        }

        $this->transaction();

        try {
            $fee = (new Fee());
            $fee->setByData($request);
            $fee->save();

            $this->dbCommit("회비관리 - 회비등록");
            return $this->returnJsonData('alert', [
                'case' => true,
                'msg' => '회비가 등록되었습니다.',
                'winClose' => $this->ajaxActionWinClose(true),
            ]);
        } catch (\Exception $e) {
            return $this->dbRollback($e);
        }
    }

    private function feeUpdateService(Request $request)
    {
        $sid = $request->sid;

//        if($request->detail === 'A') {
//            $memberShipFee = Fee::where([
//                ['sid', '!=',  $sid],
//                'user_sid' => $request->user_sid,
//                'detail' => 'A'
//            ])->first();
//
//            if(!empty($memberShipFee)) {
//                return $this->returnJsonData('alert', [
//                    'case' => true,
//                    'msg' => '이미 등록된 평생회비가 있습니다.',
//                ]);
//            }
//        }

        $this->transaction();

        try {
            $fee = $this->findFee($sid);
            $fee->setByData($request);
            $fee->save();

            $this->dbCommit("회비관리 - 회비수정");
            return $this->returnJsonData('alert', [
                'case' => true,
                'msg' => '회비가 수정되었습니다.',
                'winClose' => $this->ajaxActionWinClose(true),
            ]);
        } catch (\Exception $e) {
            return $this->dbRollback($e);
        }
    }

    private function feeDeleteService(Request $request)
    {
        $this->transaction();

        try {
            $fee = $this->findFee($request->sid);
            $fee->del ='Y';
            $fee->update();
//            $fee->delete();

            $this->dbCommit("회비관리 - 회비내역 삭제");
            return $this->returnJsonData('alert', [
                'case' => true,
                'msg' => '회비내역이 삭제되었습니다.',
                'parentsReload' => true,
                'location' => $this->ajaxActionLocation('reload')
            ]);
        } catch (\Exception $e) {
            return $this->dbRollback($e);
        }
    }

    private function feeChangePayStatusService(Request $request)
    {
        $this->transaction();

        try {
            $pay_status = $request->pay_status;

            $fee = $this->findFee($request->sid);
            $fee->pay_status = $pay_status;

            if(($pay_status === 'C' || $pay_status === 'D') && empty($fee->pay_date)) {
                $fee->pay_date = date('Y-m-d');
            }else {
                $fee->pay_date = null;
            }

            $fee->update();

            $this->dbCommit("회비관리 - 입금상태 수정");
            return $this->returnJsonData('alert', [
                'case' => true,
                'msg' => '입금상태가 변경되었습니다.',
                'location' => $this->ajaxActionLocation('reload'),
            ]);
        } catch (\Exception $e) {
            return $this->dbRollback($e);
        }
    }

    private function feeChangePayDateService(Request $request)
    {
        $this->transaction();

        try {
            $fee = $this->findFee($request->sid);
            $fee->pay_date = $request->pay_date;
            $fee->update();

            $this->dbCommit("회비관리 - 결제일 변경");

            return $this->returnJsonData('alert', [
                'case' => true,
                'msg' => '결제일이 변경되었습니다.',
                'parentsReload' => true,
                'location' => $this->ajaxActionLocation('reload')
            ]);
        } catch (\Exception $e) {
            return $this->dbRollback($e);
        }
    }

    private function feeMemoService(Request $request)
    {
        $this->transaction();

        try {
            $fee = $this->findFee($request->sid);
            $fee->memo = $request->memo ?? null;
            $fee->update();

            $this->dbCommit("회비관리 - 관리자 메모 등록");
            return $this->returnJsonData('alert', [
                'case' => true,
                'msg' => '관리자 메모가 등록되었습니다.',
                'winClose' => $this->ajaxActionWinClose(true),
            ]);
        } catch (\Exception $e) {
            return $this->dbRollback($e);
        }
    }

    private function feeUidService(Request $request)
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
}
