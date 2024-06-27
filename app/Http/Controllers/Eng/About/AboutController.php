<?php

namespace App\Http\Controllers\Eng\About;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AboutController extends Controller
{

    public function __construct()
    {
        view()->share([
            'main_menu'=>'M1',
        ]);
    }

    public function index(Request $request)
    {
        view()->share('sub_menu', 'SM1');
        return view('eng.about.index');
    }

    public function history(Request $request)
    {
        view()->share('sub_menu', 'SM2');
        return view('eng.about.history');
    }

    public function committees(Request $request)
    {
        view()->share('sub_menu', 'SM3');
        return view('eng.about.committees');
    }

    public function info(Request $request)
    {
        view()->share('sub_menu', 'SM4');
        return view('eng.about.info');
    }

    
}
