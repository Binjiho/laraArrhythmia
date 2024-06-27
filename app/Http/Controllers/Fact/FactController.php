<?php

namespace App\Http\Controllers\Fact;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FactController extends Controller
{

    public function __construct()
    {
        view()->share([
            'main_menu'=>'M3',
            'sub_menu'=>'SM2',
        ]);
    }

    public function part1(Request $request)
    {
        view()->share([
            'low_menu'=>'SL1',
        ]);
        return view('fact.part1');
    }
    public function part2(Request $request)
    {
        view()->share([
            'low_menu'=>'SL2',
        ]);
        return view('fact.part2');
    }
    public function part3(Request $request)
    {
        view()->share([
            'low_menu'=>'SL3',
        ]);
        return view('fact.part3');
    }
}
