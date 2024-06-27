<?php

namespace App\Http\Controllers\Surgery;

use App\Http\Controllers\Controller;
use App\Services\Surgery\SurgeryServices;
use Illuminate\Http\Request;

class SurgeryController extends Controller
{
    private $surgeryServices;
    public function __construct()
    {
        $this->surgeryServices = (new SurgeryServices());
        view()->share([
            'main_menu'=>'M8',
            'low_menu'=>'SL1',
            'isAdminPage' => (CheckUrl() === 'admin'),
            'userConfig' => config('site.user'),
            'surgeryConfig' => config('site.surgery'),
            'country' => getCountry(),
            'affi' => getAffi(),
        ]);
    }

    public function info(Request $request)
    {
        view()->share([
            'sub_menu'=>'SM3',
        ]);
        return view('surgery.info');
    }

    public function guide(Request $request)
    {
        view()->share([
            'sub_menu'=>'SM1',
        ]);
        return view('surgery.guide');
    }

    public function register(Request $request)
    {
        view()->share([
            'sub_menu'=>'SM3',
        ]);

        $surgeryChk = $this->surgeryServices->checkRegisterService($request);

        if(!empty($surgeryChk['surgery'])){
            return errorRedirect('back', 'surgery');
        }else{
            return view('surgery.register', $this->surgeryServices->registerService($request));
        }
    }

    public function judge(Request $request)
    {
        view()->share([
            'sub_menu' => 'SM1',
        ]);
        return view('surgery.popup.judge',$this->surgeryServices->judgeService($request));
    }

//    public function career_register(Request $request)
//    {
//        return view('surgery.popup.career', $this->surgeryServices->careerRegisterService($request));
////        return view('surgery.popup.career', $this->surgeryServices->careerRegisterService($request));
//    }
//
//    public function case_register(Request $request)
//    {
//        return view('surgery.popup.case', $this->surgeryServices->caseRegisterService($request));
//    }

    

    public function data(Request $request)
    {
        return $this->surgeryServices->dataAction($request);
    }
}
