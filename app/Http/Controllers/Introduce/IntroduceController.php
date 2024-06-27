<?php

namespace App\Http\Controllers\Introduce;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
class IntroduceController extends Controller
{

    public function __construct()
    {
        view()->share([
            'main_menu'=>'M10',
            'low_menu'=>'SL1',
        ]);
    }

    public function index(Request $request)
    {
        view()->share('sub_menu', 'SM1');

        $siteType = Session::get('siteType', 'main');

        $extends_str = 'layouts.web-layout';
        if($siteType == 'pro') {
            $extends_str = 'pro.layouts.pro-layout';
        }
        view()->share([
            'extends_str' => $extends_str,
        ]);
        return view('introduce.index');
    }

    public function vision(Request $request)
    {
        view()->share('sub_menu', 'SM2');

        $siteType = Session::get('siteType', 'main');
        $extends_str = 'layouts.web-layout';
        if($siteType == 'pro') {
            $extends_str = 'pro.layouts.pro-layout';
        }
        view()->share([
            'extends_str' => $extends_str,
        ]);
        return view('introduce.vision');
    }

    public function committee(Request $request)
    {
        view()->share('sub_menu', 'SM3');

        $siteType = Session::get('siteType', 'main');
        $extends_str = 'layouts.web-layout';
        if($siteType == 'pro') {
            $extends_str = 'pro.layouts.pro-layout';
        }
        view()->share([
            'extends_str' => $extends_str,
        ]);
        return view('introduce.committee');
    }

    public function info(Request $request)
    {
        view()->share('sub_menu', 'SM4');

        $siteType = Session::get('siteType', 'main');
        $extends_str = 'layouts.web-layout';
        if($siteType == 'pro') {
            $extends_str = 'pro.layouts.pro-layout';
        }
        view()->share([
            'extends_str' => $extends_str,
        ]);
        return view('introduce.info');
    }

    public function logo(Request $request)
    {
        view()->share('sub_menu', 'SM5');

        $siteType = Session::get('siteType', 'main');
        $extends_str = 'layouts.web-layout';
        if($siteType == 'pro') {
            $extends_str = 'pro.layouts.pro-layout';
        }
        view()->share([
            'extends_str' => $extends_str,
        ]);
        return view('introduce.logo');
    }
    
}
