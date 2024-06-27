<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Services\Main\MainServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class MainController extends Controller
{
    private $mainServices;

    public function __construct()
    {
        $this->mainServices = (new MainServices());
        view()->share('main_menu', 'main');
    }

    //인트로 페이지
    public function index(Request $request)
    {
        return view('index', $this->mainServices->indexService($request));
    }

    //전문가 페이지
    public function main(Request $request)
    {
        return view('main', $this->mainServices->indexService($request));
    }

    //일반인 페이지
    public function general(Request $request)
    {
        return view('general.main', $this->mainServices->generalService($request));
    }

    //영문 페이지
    public function eng(Request $request)
    {
        return view('eng.main');
    }

    //전문기술인 페이지
    public function pro(Request $request)
    {
        return view('pro.main', $this->mainServices->proService($request));
    }

    public function data(Request $request)
    {
        return $this->mainServices->dataAction($request);
    }
}
