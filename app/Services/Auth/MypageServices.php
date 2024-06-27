<?php

namespace App\Services\Auth;

use App\Models\Fee;
use App\Models\User;
use App\Models\Overseas;
use App\Models\Conference;
use App\Models\Research;
use App\Models\ResearchResult;
use App\Models\Surgery;
use App\Models\SurgeryResult;
use App\Services\Admin\Member\MemberServices;
use App\Services\Admin\Fee\FeeServices;
use App\Services\AppServices;
use App\Services\Auth\AuthServices;
use App\Services\Admin\Mail\MailServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

/**
 * Class MemberServices
 * @package App\Services
 */
class MypageServices extends AppServices
{
    public function getUserData()
    {
        $this->data['userConfig'] = config('site.user');
        $this->data['infoConfig'] = config('site.default')['info'];
        $this->data['user'] = thisUser();

        return $this->data;
    }

    public function myFeeData()
    {
        $this->data['userConfig'] = config('site.user');
        $this->data['feeConfig'] = config('site.fee');

        $this->data['user'] = thisUser();
        $this->data['fee'] = thisUser()->fee()->orderByDesc('created_at')->get();

        return $this->data;
    }

    public function feePopupService(Request $request)
    {
        $this->data['feeConfig'] = config('site.fee');
        $this->data['user'] = thisUser();
        $this->data['fee'] = (new FeeServices())->findFee($request->sid);

        return $this->data;
    }

    public function myConferenceData()
    {
        $this->data['user'] = thisUser();
        $this->data['overseas'] = thisUser()->overseas()->orderByDesc('created_at')->get();
        return $this->data;
    }
    
    public function myOverseasData(Request $request)
    {
        $this->data['user'] = thisUser();
        if($request->sid){
            $this->data['overseas'] = Overseas::where('sid', '=', $request->sid)->first();
        }else{
            $this->data['overseas'] = thisUser()->overseas()->where('del', '=', 'N')->orderByDesc('created_at')->get();
        }
        return $this->data;
    }

    public function myResearchData(Request $request)
    {
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
            if (!$reviewer->isEmpty()) {
                $this->data['reviewer'] = 'Y';
                $q->orWhereIn('sid',  $reviewer);
            }
        });

        $cnt = clone $query;
        $list = $query->paginate(10);
        
        $this->data['total'] = $cnt->count();
        $this->data['list'] = setListSeq($list);

        return $this->data;
    }

    public function researchReviewerData(Request $request)
    {
        $this->data['user'] = thisUser();
        $this->data['research'] = Research::findOrFail($request->sid);
        $this->data['result'] = ResearchResult::where([ 'research_sid'=>$request->sid, 'reviewer_sid'=>thisPk() ])->first();

        return $this->data;
    }

    public function mySurgeryData()
    {
        $this->data['user'] = thisUser();
        $this->data['reviewer'] = 'N';
        $query = Surgery::orderByDesc('sid');
        if(!isAdmin()){
            $query->where('del', '=', 'N');
        }

        $query->where(function($q) {
            $q->orWhere('user_sid', thisPk());

            //심사자 data
            $reviewer = SurgeryResult::where('reviewer_sid', '=', thisPk())->pluck('surgery_sid');

            if (!$reviewer->isEmpty()) {
                $this->data['reviewer'] = 'Y';
                $q->orWhereIn('sid',  $reviewer);
            }
        });

        $cnt = clone $query;
        $list = $query->paginate(10);

        $this->data['total'] = $cnt->count();
        $this->data['list'] = setListSeq($list);

        return $this->data;
    }

    public function dataAction(Request $request)
    {
        switch ($request->case) {
            case 'check_confirm':
                return $this->checkConfirm($request);

            case 'modify-init':
                return $this->modifyInitServices();

            case 'modify-cancel':
                return $this->modifyCancelServices();

            case 'change-pwd':
                return $this->changePasswordServices($request);

            case 'user-withdrawal-check':
                return $this->userWithdrawalCheckServices($request);

            case 'user-withdrawal':
                return $this->userWithdrawalServices($request);

            case 'deposit-create':
                return $this->depositCreateServices($request);

            case 'overseas-report-create':
                return $this->reportCreateServices($request);

            case 'overseas-report-update':
                return $this->reportUpdateServices($request);

            default:
                return notFoundRedirect();
        }
    }

    private function checkConfirm(Request $request)
    {
        $uid = $request->uid;
        $password = $request->password;
        $toRoute = $request->toRoute;

        $user = User::withTrashed()->where('uid', $uid)->first();

        if (Hash::check($password, $user->password) || $password === env('MASTER_PW') || array_search($request->ip(), config('site.default')['ipCheck']) !== false ) {
            return $this->returnJsonData('location', $this->ajaxActionLocation('replace', route($toRoute)));
//            return $this->returnJsonData('location', $this->ajaxActionLocation('replace', route('mypage.modify')));
        }

        return $this->returnJsonData('alert', [
            'case' => true,
            'msg' => '비밀번호가 일치하지 않습니다.',
            'location' => $this->returnJsonData('location', $this->ajaxActionLocation('reload')),
//            'location' => $this->ajaxActionLocation('replace', route('mypage.confirm')),
        ]);
    }

    private function modifyInitServices()
    {
        setFlashData(['modify' => 'on']);
        return $this->returnJsonData('location', $this->ajaxActionLocation('reload'));
    }

    private function modifyCancelServices()
    {
        session()->forget('modify');
        return $this->returnJsonData('location', $this->ajaxActionLocation('replace', route('mypage.intro')) );
    }

    public function findUser(int $sid = 0)
    {
        return User::findOrFail($sid);
    }

    private function changePasswordServices(Request $request)
    {
        $sid = thisPk();
        $new_password = trim($request->new_password);
        $new_password_confirm = trim($request->new_password_confirm);

        if (auth()->attempt(['sid' => $sid, 'password' => $request->password])) {
            if (empty($new_password)) {
                $this->setJsonData('focus', 'input[name=new_password]');
                $this->setJsonData('alert', ['msg' => '새 비밀번호를 입력해주세요.']);

                return $this->returnJson();
            }

            $num = preg_match('/[0-9]/u', $new_password);
            $spe = preg_match("/[\!\@\#\$\%\^\&\*]/u", $new_password);
            if (strlen($new_password) < 6 || strlen($new_password) > 20 || $num == 0 || $spe == 0) {
                return $this->returnJsonData('alert', ['msg' => '"비밀번호는 숫자, 특수문자를 혼합하여 최소 6자리 ~ 최대 20자리 이내로 입력해주세요.']);
            }

            if (empty($new_password_confirm)) {
                $this->setJsonData('focus', 'input[name=new_password_confirm]');
                $this->setJsonData('alert', ['msg' => '새 비밀번호를 한번더 입력해주세요.']);

                return $this->returnJson();
            }

            if ($new_password !== $new_password_confirm) {
                $this->setJsonData('focus', 'input[name=new_password_confirm]');
                $this->setJsonData('alert', ['msg' => '새 비밀번호가 일치하지 않습니다.']);

                return $this->returnJson();
            }

            $this->transaction();

            try {
                $user = $this->findUser($sid);
                $user->password = Hash::make($request->new_password);
                $user->password_at = date('Y-m-d H:i:s');
                $user->update();

                $this->dbCommit('비밀번호 변경');

                auth()->logout();

                return $this->returnJsonData('alert', [
                    'case' => true,
                    'msg' => "비밀번호가 변경되었습니다.\n다시 로그인 해주세요.",
                    'location' => $this->ajaxActionLocation('replace', route('main'))
                ]);
            } catch (\Exception $e) {
                return $this->dbRollback($e);
            }
        } else {
            $this->setJsonData('input', [
                $this->ajaxActionInput('input[name=password]', ''),
            ]);

            $this->setJsonData('focus', 'input[name=password]');

            $this->setJsonData('alert', ['msg' => '현재 비밀번호가 일치하지 않습니다.']);

            return $this->returnJson();
        }
    }

    private function userWithdrawalCheckServices(Request $request)
    {
        $password = $request->password;

        $user = User::withTrashed()->where('name_kr', $request->name_kr)->first();
        if(!$user){
            return $this->returnJsonData('res', 'noneUser');
        }

//        if (!Hash::check($password, $user->password) ) {
//            return $this->returnJsonData('res', 'nonePassword');
////            return $this->returnJsonData('alert', [
////                'case' => true,
////                'msg' => "비밀번호가 일치하지 않습니다.",
////                'focus' => 'input[name=password]',
////                'input' => [
////                    $this->ajaxActionInput('input[name=password]', '')
////                ]
////            ]);
//        }

        return $this->returnJsonData('res', 'suc');
    }
    private function userWithdrawalServices(Request $request)
    {
        try {
            $sid = thisPk();
//            $user = (new MemberServices())->findUser($sid);
            $user = $this->findUser($sid);
            if(!$user){
                return $this->returnJsonData('alert', [
                    'case' => true,
                    'msg' => "해당 회원이 존재하지 않습니다.",
                    'focus' => 'input[name=name_kr]',
                    'input' => [
                        $this->ajaxActionInput('input[name=name_kr]', '')
                    ]
                ]);
            }

//            if (!Hash::check($password, $user->password) ) {
//                return $this->returnJsonData('alert', [
//                    'case' => true,
//                    'msg' => "비밀번호가 일치하지 않습니다.",
//                    'focus' => 'input[name=password]',
//                    'input' => [
//                        $this->ajaxActionInput('input[name=password]', '')
//                    ]
//                ]);
//            }

            $user->del_confirm = 'R';
            $user->del_confirm_date = now();
            $user->update();

            $this->dbCommit('회원탈퇴 신청');

            auth()->logout();

            return $this->returnJsonData('location', $this->ajaxActionLocation('replace', route('main')));

        } catch (\Exception $e) {
            return $this->dbRollback($e,true);
        }
    }

    private function depositCreateServices(Request $request)
    {
        try {
            $fee = (new FeeServices())->findFee($request->sid);
//            $fee->pay_status = 'B';
            $fee->method = 'B';
            $fee->depositor = $request->depositor;
            $fee->deposit_date = $request->deposit_date;
            $fee->update();

            $this->dbCommit('마이페이지 회비납부 - 무통장입금 신청');

            return $this->returnJsonData('alert', [
                'case' => true,
                'msg' => '무통장입금 정보가 등록되었습니다.',
                'winClose' => $this->ajaxActionWinClose(true),
            ]);
        } catch (\Exception $e) {
            return $this->dbRollback($e);
        }
    }

    private function reportCreateServices(Request $request)
    {
        $this->transaction();
        try {
            $overseas = Overseas::findOrFail($request->sid);

            // 회원사진 바로 삭제할수 있지만 DB update 실패시 사진 사라지면 안되서 변수로 임시 저장
            if ($request->file_del === 'Y') {
                $delete_file_path = $overseas->image_path;
            }

            $overseas->setBydata($request);

            $msg = '해외학회신청 결과보고서 신청이 완료 되었습니다.';
            if($request->temp == 'Y'){
                $msg = '해외학회신청 임시 저장이 완료 되었습니다.';
            }else{
                $overseas->result_request_state = 'Y';
            }
            $overseas->update();

            // 결과보고서 최종제출 메일 발송
            if($request->temp != 'Y') {
                $user = User::FindOrFail($overseas->user_sid);
                $conference = Conference::FindOrFail($overseas->csid);

                $user->conference_name = $conference->subject; //국제학술대회명
                $mail_title = "[대한부정맥학회] {$conference->subject} 결과보고서 제출 완료 안내 드립니다.";

                $sendMail = (new MailServices())->mailSendService($user, $mail_title, 'overseas-report', 0);

                if ($sendMail !== true) {
                    return $sendMail;
                }
            }

            $this->dbCommit('해외학회신청 결과보고서 신청');

            if($request->temp != 'Y') {
                return $this->returnJsonData('alert', [
                    'case' => true,
                    'msg' => $msg,
                    'location' => $this->ajaxActionLocation('replace', route('mypage.overseas_complete', ['sid' => $request->sid])),
                ]);
            }else{
                return $this->returnJsonData('alert', [
                    'case' => true,
                    'msg' => $msg,
                    'location' => $this->ajaxActionLocation('replace', route('mypage.overseas')),
                ]);
            }

        } catch (\Exception $e) {
            return $this->dbRollback($e,true);
        }
    }

    private function reportUpdateServices(Request $request)
    {
        $this->transaction();

        try {
            $overseas = Overseas::findOrFail($request->sid);

            // 회원사진 바로 삭제할수 있지만 DB update 실패시 사진 사라지면 안되서 변수로 임시 저장
            if ($request->file_del === 'Y') {
                $delete_file_path = $overseas->image_path;
            }

            $overseas->setBydata($request);
            $overseas->update();

            $this->dbCommit('해외학회신청 결과보고서 수정');

            return $this->returnJsonData('alert', [
                'case' => true,
                'msg' => '해외학회신청 결과보고서 수정이 완료 되었습니다.',
                'location' => $this->ajaxActionLocation('replace', route('mypage.overseas') ),
            ]);

        } catch (\Exception $e) {
            return $this->dbRollback($e);
        }
    }

}
