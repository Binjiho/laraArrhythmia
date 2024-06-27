<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\Auth\AuthServices;
use App\Services\Auth\LoginServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    private $authServices;
    private $webLoginServices;

    public function __construct()
    {
        $this->authServices = (new AuthServices());
        $this->webLoginServices = (new LoginServices());
        view()->share([
            'main_menu'=>'M1',
            'low_menu'=>'SL1',
        ]);
    }

    public function info(Request $request)
    {
        view()->share('sub_menu', 'SM1');

        return view('auth.info');
    }

    public function register(Request $request)
    {
        view()->share([
            'sub_menu' => 'SM2',
            'isAdminPage' => (CheckUrl() === 'admin'),
            'userConfig' => config('site.user'),
            'infoConfig' => config('site.default.info'),
        ]);

        return view('auth/register', $this->authServices->registerService($request));
    }

    public function login(Request $request)
    {
        view()->share('sub_menu', 'SM3');
        return ($request->isMethod('post') && $request->ajax())
            ? $this->webLoginServices->loginAction($request)
            : view('auth.login');
    }

    public function logout(Request $request)
    {
        return $this->webLoginServices->logoutAction($request);
    }

    public function forgot(Request $request)
    {
        view()->share('sub_menu', 'SM4');
        return view('auth.forgot',$request);
    }

    public function forgot_pw(Request $request)
    {
        view()->share('sub_menu', 'SM4');
        return view('auth.forgot_pw',$request);
    }

    public function privacy(Request $request)
    {
        $siteType = Session::get('siteType', 'main');

        $extends_str = 'layouts.web-layout';
        if($siteType == 'pro') {
            $extends_str = 'pro.layouts.pro-layout';
            view()->share([
                'main_menu' => 'M2',
                'sub_menu' => 'SM1',
            ]);
        }
        view()->share([
            'extends_str' => $extends_str,
        ]);

        view()->share('sub_menu', 'SM5');
        return view('auth.privacy');
    }

    public function email(Request $request)
    {
        view()->share('sub_menu', 'SM6');
        return view('auth.email');
    }

    public function data(Request $request)
    {
//        return view('auth.register', $this->data);
        return $this->authServices->dataAction($request);
    }
}
