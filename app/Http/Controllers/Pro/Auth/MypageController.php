<?php

namespace App\Http\Controllers\Pro\Auth;

use App\Http\Controllers\Controller;
//use App\Services\Pro\Auth\MypageServices;
use Illuminate\Http\Request;

class MypageController extends Controller
{
//    private $mypageServices;

    public function __construct(Request $request)
    {
//        $this->mypageServices = (new MypageServices());
        view()->share([
            'main_menu'=>'M8',
        ]);
    }

    public function index(Request $request)
    {
        view()->share('sub_menu', 'SM3');

        return view('pro.mypage.index');
    }

    public function data(Request $request)
    {
        return $this->mypageServices->dataAction($request);
    }
}
