<?php

namespace App\Http\Controllers\Admin\Research;

use App\Http\Controllers\Controller;
use App\Services\Admin\Research\ResearchReviewerServices;
use Illuminate\Http\Request;

class ResearchReviewerController extends Controller
{
    private $researchReviewerServices;

//    public function __construct()
//    {
//        $this->researchReviewerServices = (new ResearchReviewerServices());
//
//        view()->share([
//            'researchConfig' => config('site.research'),
//            'userConfig' => config('site.user'),
//            'main_menu' => 'M5',
//        ]);
//    }
//
//    public function index(Request $request) //심사자 리스트
//    {
//        view()->share(['sub_menu' => 'SM2']);
//        return view('admin.research_reviewer.index', $this->researchReviewerServices->indexService($request));
//    }
//
//    public function register(Request $request) //심사자 등록
//    {
//        $this->data = $this->researchReviewerServices->registrationService($request);
//        return view('admin.research_reviewer.register', $this->data);
//    }
//
//
//    public function data(Request $request)
//    {
//        return $this->researchReviewerServices->dataAction($request);
//    }
}
