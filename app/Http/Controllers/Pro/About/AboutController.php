<?php

namespace App\Http\Controllers\Pro\About;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AboutController extends Controller
{

    public function __construct()
    {
        $extends_str = 'pro.layouts.pro-layout';
        view()->share([
            'main_menu'=>'M1',
            'extends_str' => $extends_str,
        ]);
    }

    public function index(Request $request)
    {
        view()->share([
            'sub_menu'=>'SM1',
            'low_menu'=>'SL1',
        ]);
        return view('pro.about.index');
    }

    public function history(Request $request)
    {
        view()->share([
            'sub_menu'=>'SM2',
            'low_menu'=>'SL1',
        ]);
        return view('pro.about.history');
    }

    public function committee(Request $request)
    {
        view()->share([
            'sub_menu'=>'SM3',
            'low_menu'=>'SL1',
        ]);
        return view('pro.about.committee');
    }

    public function register(Request $request)
    {
        view()->share([
            'sub_menu'=>'SM4',
            'low_menu'=>'SL1',
        ]);;
        return view('pro.about.register');
    }

    public function mission(Request $request)
    {
        view()->share([
            'sub_menu'=>'SM5',
            'low_menu'=>'SL1',
        ]);
        return view('pro.about.mission');
    }

    public function guide(Request $request)
    {
        view()->share('sub_menu', 'SM6');
        return view('pro.about.guide');
    }

    
}
