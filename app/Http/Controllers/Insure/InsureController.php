<?php

namespace App\Http\Controllers\Insure;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class InsureController extends Controller
{

    public function __construct()
    {
        $siteType = request()->siteType;

        view()->share([
            'main_menu'=>'M3',
            'sub_menu'=>'SM4',
            'low_menu'=>'SL1',
        ]);
    }

    public function standard(Request $request)
    {
        $siteType = Session::get('siteType', 'main');
        $extends_str = 'layouts.web-layout';
        if($siteType == 'pro') {
            $extends_str = 'pro.layouts.pro-layout';
            view()->share([
                'main_menu' => 'M3',
                'sub_menu' => 'SM1',
                'low_menu'=>'SL1',
            ]);
        }
        view()->share([
            'extends_str' => $extends_str,
        ]);
        view()->share([
            'small_menu'=>'SS1',
        ]);
        return view('insure.standard');
    }

    public function s2(Request $request)
    {
        $siteType = Session::get('siteType', 'main');
        $extends_str = 'layouts.web-layout';
        if($siteType == 'pro') {
            $extends_str = 'pro.layouts.pro-layout';
            view()->share([
                'main_menu' => 'M3',
                'sub_menu' => 'SM1',
                'low_menu'=>'SL2',
            ]);
        }
        view()->share([
            'extends_str' => $extends_str,
        ]);
        view()->share([
            'small_menu'=>'SS2',
        ]);
        return view('insure.s2');
    }

    public function s3(Request $request)
    {
        $siteType = Session::get('siteType', 'main');
        $extends_str = 'layouts.web-layout';
        if($siteType == 'pro') {
            $extends_str = 'pro.layouts.pro-layout';
            view()->share([
                'main_menu' => 'M3',
                'sub_menu' => 'SM1',
                'low_menu'=>'SL3',
            ]);
        }
        view()->share([
            'extends_str' => $extends_str,
        ]);
        view()->share([
            'small_menu'=>'SS3',
        ]);
        return view('insure.s3');
    }

    public function s4(Request $request)
    {
        $siteType = Session::get('siteType', 'main');
        $extends_str = 'layouts.web-layout';
        if($siteType == 'pro') {
            $extends_str = 'pro.layouts.pro-layout';
            view()->share([
                'main_menu' => 'M3',
                'sub_menu' => 'SM1',
                'low_menu'=>'SL4',
            ]);
        }
        view()->share([
            'extends_str' => $extends_str,
        ]);
        view()->share([
            'small_menu'=>'SS4',
        ]);
        return view('insure.s4');
    }
    
}
