<?php

namespace App\Services\Auth;


use App\Models\User;
use App\Models\Affiliation;

//use App\Services\Admin\Fee\FeeServices;
use App\Services\Admin\Mail\MailServices;
use App\Services\Admin\Member\MemberServices;
use App\Services\CommonServices;
use App\Services\AppServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

/**
 * Class AuthServices
 * @package App\Services
 */
class AuthServices extends AppServices
{

    public function findUser(int $sid = 0)
    {
        return User::findOrFail($sid);
    }
    public function registerService(Request $request)
    {
        $step = $request->step;

        switch ($step) {
            case 'step1':
                $nextStep = 'step2';
                break;

            case 'step2':
                $nextStep = 'step3';
                break;

            case 'step3':
                if (!$this->userCreateServices($request)) {
                    return errorRedirect('back', 'db');
                }
                break;

            default:
                break;
        }

        $this->data['step'] = $step;
        $this->data['nextStep'] = $nextStep ?? null;
        $this->data['name_kr'] = $request->name_kr ?? null;

        return $this->data;
    }

    public function dataAction(Request $request)
    {
//        customDump($request);
        switch ($request->case) {
            case 'user-create':
                return $this->userCreateServices($request);

            case 'user-update':
                return $this->userUpdateServices($request);

            case 'uid-check':
                return $this->uidCheckServices($request);

            case 'forgot-uid':
                return $this->forgotUidServices($request);

            case 'forgot-password':
                return $this->forgotPassowrdServices($request);

            case 'sosok-check':
                return $this->sosokCheckServices($request);

            default:
                return notFoundRedirect();
        }
    }

    private function userCreateServices(Request $request)
    {
        $this->transaction();

//        dd($request->all());

        try {
            $user = new User();
//            $user->setBydata($request, $this->userFileUploadService($request));
            $user->setBydata($request);
            $user->save();

            // 정회원 가입시 평생회비 등록정보 생성
//            if($user->level === 'B') {
//                (new FeeServices())->createLifetimeMembershipFee($user->sid);
//            }
//
            // 회원가입 메일 발송
            $sendMail = (new MailServices())->mailSendService($user, '[대한부정맥학회] 회원가입이 정상적으로 완료되었습니다.', 'user-create', 0);

            if($sendMail !== true) {
                return $sendMail;
            }

            $this->dbCommit('회원가입');

            return true;
        } catch (\Exception $e) {
            $this->dbRollback($e,true);
            return false;
        }
    }

    private function userUpdateServices(Request $request)
    {
        $this->transaction();

        try {
            $sid = thisPk();
            $user = $this->findUser($sid);
//            $user = (new MemberServices())->findUser(thisPk());

            // 회원사진 바로 삭제할수 있지만 DB update 실패시 사진 사라지면 안되서 변수로 임시 저장
            if ($request->file_del === 'Y') {
                $delete_file_path = $user->image_path;
            }

            $user->setBydata($request);
            $user->password_at = date('Y-m-d H:i:s');
            $user->update();

            $this->dbCommit('회원정보수정', '회원정보가 수정 되었습니다.');
            
            $request->session()->forget('modify');
            return $this->returnJsonData('location', $this->ajaxActionLocation('reload'));
        } catch (\Exception $e) {
            return $this->dbRollback($e);
//            return $this->dbRollback($e,true);
        }
    }

    private function uidCheckServices(Request $request)
    {
        $user = User::withTrashed()->where(['uid' => $request->uid])->first();

        if (empty($user)) {
            $this->setJsonData('data', [
                $this->ajaxActionData('#uid', 'chk', 'Y'),
            ]);

            return $this->returnJsonData('alert', [
                'msg' => '사용가능한 아이디 입니다.',
            ]);
        } else {
            $this->setJsonData('focus', '#uid');

            return $this->returnJsonData('alert', [
                'msg' => '이미 존재하는 아이디입니다. 다른 아이디를 입력해주세요.',
            ]);
        }
    }


    private function forgotUidServices(Request $request)
    {
        $isCheck = FALSE;
        $user = User::where(['name_kr' => $request->name_kr])->first();
        if(empty($user)){

        }else{
            $phone_str = '';
            foreach($user->phone as $item){
                $phone_str.= $item;
            }

            if($phone_str == $request->phone){
                $isCheck = TRUE;
            }

        }

        if (!$isCheck) {
            $this->setJsonData('addCss', [
                $this->ajaxActionCss('.find-form-wrap:eq(0) .result', 'display', 'none'),
                $this->ajaxActionCss('.find-form-wrap:eq(0) .noResult', 'display', 'block'),
            ]);

            return $this->returnJsonData('html', [
                $this->ajaxActionHtml('.find-form-wrap:eq(0) .noResult', '일치하는 정보가 없습니다. 가입 정보를 다시 확인해 주세요.'),
            ]);
        } else {
            $this->setJsonData('input', [
                $this->ajaxActionInput('#forgot-uid-frm input[name=name_kr]', ''),
                $this->ajaxActionInput('#forgot-uid-frm input[name=license_number]', ''),
            ]);

            $this->setJsonData('addCss', [
                $this->ajaxActionCss('.find-form-wrap:eq(0) .noResult', 'display', 'none'),
                $this->ajaxActionCss('.find-form-wrap:eq(0) .result', 'display', 'block'),
            ]);

            return $this->returnJsonData('html', [
                $this->ajaxActionHtml('.find-form-wrap:eq(0) .result', "{$user->name_kr}님의 아이디는 <strong class=\"text-red\">{$user->uid}</strong> 입니다."),
            ]);
        }
    }

    private function forgotPassowrdServices(Request $request)
    {
        $user = User::where(['uid' => $request->uid, 'name_kr' => $request->name_kr])->first();

        if (empty($user)) {
            $this->setJsonData('addCss', [
                $this->ajaxActionCss('.find-form-wrap:eq(0) .result', 'display', 'none'),
                $this->ajaxActionCss('.find-form-wrap:eq(0) .noResult', 'display', 'block'),
            ]);

            return $this->returnJsonData('html', [
                $this->ajaxActionHtml('.find-form-wrap:eq(0) .noResult', '일치하는 정보가 없습니다. 가입 정보를 다시 확인해 주세요.'),
            ]);
        } else {
            $this->transaction();

            try {
                $tempPassword = $this->tempPassword();

                $user->password = Hash::make($tempPassword);
                $user->password_at = date('Y-m-d H:i:s');
                $user->update();

                $user->tempPassword = $tempPassword;

                // 임시비밀번호 메일 발송
                $sendMail = (new MailServices())->mailSendService($user, '[대한부정맥학회] 임시 비밀번호 안내 드립니다.', 'forgot-pw', 0);

                if ($sendMail !== true) {
                    return $sendMail;
                }

                $this->dbCommit('임시비밀번호 변경');

                $this->setJsonData('input', [
                    $this->ajaxActionInput('#forgot-password-frm input[name=uid]', ''),
                    $this->ajaxActionInput('#forgot-password-frm input[name=name_kr]', ''),
//                    $this->ajaxActionInput('#forgot-password-frm input[name=email]', ''),
                ]);

                $this->setJsonData('addCss', [
                    $this->ajaxActionCss('.find-form-wrap:eq(0) .noResult', 'display', 'none'),
                    $this->ajaxActionCss('.find-form-wrap:eq(0) .result', 'display', 'block'),
                ]);

                return $this->returnJsonData('html', [
                    $this->ajaxActionHtml('.find-form-wrap:eq(0) .result', '가입한 이메일로 임시 비밀번호가 발급되었습니다.'),
                ]);
            } catch (\Exception $e) {
                return $this->dbRollback($e);
            }
        }
    }

    private function sosokCheckServices(Request $request)
    {
        $affi = Affiliation::where(['sid' => $request->affi_sid])->first();

        if($affi->sid == '999'){
            $this->setJsonData('prop', [
                $this->ajaxActionProp('#sosok_kr', "readonly", FALSE ),
                $this->ajaxActionProp('#sosok_en', "readonly", FALSE ),

                $this->ajaxActionProp('#school_kr', "readonly", FALSE ),
                $this->ajaxActionProp('#school_en', "readonly", FALSE ),
            ]);
            return $this->returnJsonData('input', [
                $this->ajaxActionInput('#sosok_kr', '' ),
                $this->ajaxActionInput('#sosok_en', '' ),

                $this->ajaxActionInput('#school_kr', '' ),
                $this->ajaxActionInput('#school_en', '' ),
            ]);
        }else{
            $this->setJsonData('prop', [
                $this->ajaxActionProp('#sosok_kr', "readonly", TRUE ),
                $this->ajaxActionProp('#sosok_en', "readonly", TRUE ),

                $this->ajaxActionProp('#school_kr', "readonly", TRUE ),
                $this->ajaxActionProp('#school_en', "readonly", TRUE ),
            ]);

            return $this->returnJsonData('input', [
                $this->ajaxActionInput('#sosok_kr', $affi->office_k ?? '' ),
                $this->ajaxActionInput('#sosok_en', $affi->office_e ?? '' ),

                $this->ajaxActionInput('#school_kr', $affi->school_k ?? '' ),
                $this->ajaxActionInput('#school_en', $affi->school_e ?? '' ),
            ]);
        }

    }


    private function tempPassword()
    {
        $feed1 = "0123456789";
        $feed2 = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $tempPassword = '';

        for ($i = 0; $i < 3; $i++) {
            $tempPassword .= substr($feed1, rand(0, strlen($feed1) - 1), 1);
        }

        for ($i = 0; $i < 3; $i++) {
            $tempPassword .= substr($feed2, rand(0, strlen($feed2) - 1), 1);
        }

        return str_shuffle($tempPassword);
    }

    public function userFileUploadService(Request $request)
    {
        $file = $request->file('user_image');
        $file_path = 'member/' . $request->code;

        return empty($file)
            ? []
            : (new CommonServices())->fileUploadService($file, $file_path);
    }
}
