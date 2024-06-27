<?php

namespace App\Http\Controllers\Research;

use App\Http\Controllers\Controller;
use App\Services\Research\ResearchServices;
use Illuminate\Http\Request;

class ResearchController extends Controller
{
    private $researchServices;
    public function __construct()
    {
        $this->researchServices = (new ResearchServices());
        view()->share([
            'main_menu'=>'M9',
            'low_menu'=>'SL1',
        ]);

    }

    public function program(Request $request)
    {
        view()->share('sub_menu', 'SM1');
        return view('research.program');
    }

    public function info(Request $request)
    {
        view()->share('sub_menu', 'SM2');
        return view('research.info');
    }

    public function result(Request $request)
    {
        view()->share([
            'sub_menu'=>'SM3',
            'researchConfig' => config('site.research'),
        ]);
        return view('research.result', $this->researchServices->listService($request));
    }

    public function register(Request $request)
    {
        view()->share([
            'sub_menu'=>'SM2',
            'isAdminPage' => (CheckUrl() === 'admin'),
            'researchConfig' => config('site.research'),
        ]);

        return view('research.register');
    }

    public function preview(Request $request)
    {
        view()->share([
            'sub_menu' => 'SM3',
            'researchConfig' => config('site.research'),
        ]);
        return view('admin.research.popup.preview',$this->researchServices->previewService($request));
    }

    public function report(Request $request)
    {
        view()->share([
            'sub_menu'=>'SM3',
            'researchConfig' => config('site.research'),
        ]);

        return view('mypage.research.popup.report', $this->researchServices->indexService($request));
    }

    public function data(Request $request)
    {
        return $this->researchServices->dataAction($request);
    }
}
