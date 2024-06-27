<?php

namespace App\Http\Controllers\Academy;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AcademyController extends Controller
{

    public function __construct()
    {
        view()->share([
            'main_menu'=>'M7',
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
            view()->share([
                'main_menu' => 'M7',
                'sub_menu' => 'SM1',
                'low_menu' => 'SL1',
            ]);
        }
        view()->share([
            'extends_str' => $extends_str,
        ]);
        return view('academy.index');
    }

    public function paperSubmission(Request $request)
    {
        view()->share('sub_menu', 'SM2');

        $siteType = Session::get('siteType', 'main');
        $extends_str = 'layouts.web-layout';
        if($siteType == 'pro') {
            $extends_str = 'pro.layouts.pro-layout';
            view()->share([
                'main_menu' => 'M7',
                'sub_menu' => 'SM2',
                'low_menu' => 'SL2',
            ]);
        }
        view()->share([
            'extends_str' => $extends_str,
        ]);

        return view('academy.paperSubmission');
    }

    public function paperRule(Request $request)
    {
        view()->share('sub_menu', 'SM3');

        $siteType = Session::get('siteType', 'main');
        $extends_str = 'layouts.web-layout';
        if($siteType == 'pro') {
            $extends_str = 'pro.layouts.pro-layout';
            view()->share([
                'main_menu' => 'M7',
                'sub_menu' => 'SM3',
                'low_menu' => 'SL3',
            ]);
        }
        view()->share([
            'extends_str' => $extends_str,
        ]);

        return view('academy.paperRule');
    }

    public function editSubmission(Request $request)
    {
        view()->share('sub_menu', 'SM4');

        $siteType = Session::get('siteType', 'main');
        $extends_str = 'layouts.web-layout';
        if($siteType == 'pro') {
            $extends_str = 'pro.layouts.pro-layout';
            view()->share([
                'main_menu' => 'M7',
                'sub_menu' => 'SM4',
                'low_menu' => 'SL4',
            ]);
        }
        view()->share([
            'extends_str' => $extends_str,
        ]);
        return view('academy.editSubmission');
    }

    public function editRule(Request $request)
    {
        view()->share('sub_menu', 'SM5');

        $siteType = Session::get('siteType', 'main');
        $extends_str = 'layouts.web-layout';
        if($siteType == 'pro') {
            $extends_str = 'pro.layouts.pro-layout';
            view()->share([
                'main_menu' => 'M7',
                'sub_menu' => 'SM5',
                'low_menu' => 'SL5',
            ]);
        }
        view()->share([
            'extends_str' => $extends_str,
        ]);
        return view('academy.editRule');
    }


}
