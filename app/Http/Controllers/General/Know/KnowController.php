<?php

namespace App\Http\Controllers\General\Know;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class KnowController extends Controller
{
    public function __construct()
    {
        view()->share([
            'main_menu'=>'M1',
        ]);
    }

    public function index(Request $request)
    {
        view()->share([
            'sub_menu'=>'SM1',
        ]);
        return view('general.know.index');
    }

    public function kind(Request $request)
    {
        view()->share([
            'sub_menu'=>'SM2',
            'category'=>$request->category ?? '1',
            'category2'=>$request->category2 ?? '1',
        ]);

        if($request->category2){
            return view('general.know.kind.index_'.$request->category.'_'.$request->category2);
        }else{
            return view('general.know.kind.index_'.$request->category);
        }
    }

    public function diagnosis(Request $request)
    {
        view()->share([
            'sub_menu'=>'SM3',
        ]);
        return view('general.know.diagnosis.index');
    }

    public function therapy(Request $request)
    {
        view()->share([
            'sub_menu'=>'SM4',
            'category'=>$request->category ?? '1',
        ]);
        return view('general.know.therapy.index_'.$request->category);
    }

}
