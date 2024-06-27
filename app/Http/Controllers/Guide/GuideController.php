<?php

namespace App\Http\Controllers\Guide;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GuideController extends Controller
{

    public function __construct()
    {
        view()->share([
            'main_menu'=>'M3',
            'sub_menu'=>'SM1',
        ]);
    }

    public function atrial(Request $request)
    {
        view()->share([
            'low_menu'=>'SL1',
        ]);
        return view('guide.atrial');
    }

    public function ventricular(Request $request)
    {
        view()->share([
            'low_menu'=>'SL2',
        ]);
        return view('guide.ventricular');
    }

    public function sudden(Request $request)
    {
        view()->share([
            'low_menu'=>'SL3',
        ]);
        return view('guide.sudden');
    }

    public function sangseong(Request $request)
    {
        view()->share([
            'low_menu'=>'SL4',
        ]);
        return view('guide.sangseong');
    }

    public function cied(Request $request)
    {
        view()->share([
            'low_menu'=>'SL5',
        ]);
        return view('guide.cied');
    }

    public function faint(Request $request)
    {
        view()->share([
            'low_menu'=>'SL6',
        ]);
        return view('guide.faint');
    }
}
