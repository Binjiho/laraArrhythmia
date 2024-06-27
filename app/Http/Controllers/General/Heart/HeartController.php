<?php

namespace App\Http\Controllers\General\Heart;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class HeartController extends Controller
{
    public function __construct()
    {
        view()->share([
            'main_menu'=>'M4',
            'sub_menu'=>'SM1',
        ]);
    }

    public function index(Request $request)
    {
        return view('general.heart.index');
    }

}
