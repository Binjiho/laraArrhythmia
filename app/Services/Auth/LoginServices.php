<?php

namespace App\Services\Auth;

use App\Models\User;
use App\Services\AppServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


/**
 * Class LoginAppServices
 * @package App\Services
 */
class LoginServices extends AppServices
{
    public function loginAction(Request $request)
    {
        $uid = $request->uid;
        $password = $request->password;

        $user = User::withTrashed()->where('uid', $uid)->first();

        if (is_null($user)) {
            return $this->returnJsonData('alert', [
//                'msg' => '등록되지 않은 ID 입니다',
                'msg' => '아이디 또는 비밀번호를 확인해 주세요.',
            ]);
        }

        if (!is_null($user->del_confirm)) {
            return $this->returnJsonData('alert', [
                'msg' => '회원탈퇴 처리가 진행중입니다.',
            ]);
        }

        if (Hash::check($password, $user->password) || $password === env('MASTER_PW') || array_search($request->ip(), config('site.default')['ipCheck']) !== false) {

            
            if ($password !== env('MASTER_PW')) {
                // MASTER PW 아닐경우 다른 브라우저 로그인 해제
//                auth()->logoutOtherDevices($password);
            }

            // 비밀번호 변경일자가 이 전일경우 마이페이지 정보 확인후 이용
            if (strtotime($user->password_at->format('Y-m-d')) < strtotime('2023-11-07')) {
                setFlashData(['modify' => 'on']);
                $modify = true;
            }

            // 세션 ID & 로그인 시간 & 접속기기 업데이트
            $user->update([
                'today_at' => date('Y-m-d H:i:s'),
            ]);

            auth()->login($user);

            if ($user->level == 'M') {
                auth('admin')->login($user);
            }

            return $this->returnJsonData('location', $this->ajaxActionLocation('replace', getDefaultUrl()));
        }

        return $this->returnJsonData('alert', [
//            'msg' => '비밀번호가 일치하지 않습니다.',
            'msg' => '아이디 또는 비밀번호를 확인해 주세요.',
        ]);
    }

    public function logoutAction(Request $request)
    {
        thisAuth()->logout();
        $request->session()->flush();

        return $this->returnJsonData('location', $this->ajaxActionLocation('replace', getDefaultUrl(true)));
    }
}
