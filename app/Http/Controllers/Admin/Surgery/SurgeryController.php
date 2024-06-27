<?php

namespace App\Http\Controllers\Admin\Surgery;

use App\Http\Controllers\Controller;
use App\Services\Admin\Surgery\SurgeryServices;
use Illuminate\Http\Request;

class SurgeryController extends Controller
{
    private $surgeryServices;

    public function __construct()
    {
        $this->surgeryServices = (new SurgeryServices());

        view()->share([
            'isAdminPage' => (CheckUrl() === 'admin'),
            'userConfig' => config('site.user'),
            'surgeryConfig' => config('site.surgery'),
            'country' => getCountry(),
            'affi' => getAffi(),
            'main_menu' => 'M6',
        ]);
    }

    public function index(Request $request)
    {
        view()->share(['sub_menu' => 'SM1']);
        return view('admin.surgery.index', $this->surgeryServices->indexService($request));
    }

    public function modify(Request $request)
    {
        view()->share(['sub_menu' => 'SM1']);
        return view('admin.surgery.popup.register', $this->surgeryServices->modifyService($request));
    }

    public function register_reviewer(Request $request)
    {
        return view('admin.surgery.reviewer_register', $this->surgeryServices->listService($request));
    }

    public function result(Request $request)
    {
        view()->share([
            'sub_menu' => 'SM1',
            'surgeryConfig' => config('site.surgery'),
        ]);
        return view('admin.surgery.popup.result_preview',$this->surgeryServices->previewService($request));
    }

//    public function career_register(Request $request)
//    {
//        return view('surgery.popup.career', $this->surgeryServices->careerRegisterService($request));
//    }
//
//    public function case_register(Request $request)
//    {
//        return view('surgery.popup.case', $this->surgeryServices->caseRegisterService($request));
//    }

    public function excel(Request $request)
    {
        $request->merge(['excel' => true]);
        return $this->surgeryServices->indexService($request);
    }

    public function data(Request $request)
    {
        return $this->surgeryServices->dataAction($request);
    }
}
