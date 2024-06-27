<?php

namespace App\Http\Controllers\General\Info;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class InfoController extends Controller
{
    public function __construct()
    {
        view()->share([
            'main_menu'=>'M5',
        ]);
    }

    public function greeting(Request $request)
    {
        view()->share([
            'sub_menu'=>'SM1',
        ]);
        return view('general.info.greeting');
    }

    public function mission(Request $request)
    {
        view()->share([
            'sub_menu'=>'SM2',
        ]);
        return view('general.info.mission');
    }

    public function committee(Request $request)
    {
        view()->share([
            'sub_menu'=>'SM3',
        ]);
        return view('general.info.committee');
    }

    public function contact(Request $request)
    {
        view()->share([
            'sub_menu'=>'SM4',
        ]);
        return view('general.info.contact');
    }

}
