<?php

namespace App\Http\Controllers\Overseas;

use App\Http\Controllers\Controller;
use App\Services\Overseas\OverseasServices;
use Illuminate\Http\Request;

class OverseasController extends Controller
{
    private $overseasServices;
    public function __construct()
    {
        $this->overseasServices = (new OverseasServices());
        view()->share([
            'main_menu'=>'M11',
            'sub_menu'=>'SM1',
            'low_menu'=>'SL1',
        ]);
    }

    public function info(Request $request)
    {
        return view('overseas.info');
    }

    public function list(Request $request)
    {
        return view("overseas.list", $this->overseasServices->listService($request));
    }

    public function register(Request $request)
    {
        view()->share([
            'isAdminPage' => (CheckUrl() === 'admin'),
            'userConfig' => config('site.user'),
            'overseasConfig' => config('site.overseas'),
            'country' => getCountry(),
            'affi' => getAffi(),
        ]);

        if(empty($request->sid)){
            //신청유무 여부
            $checkRegist = $this->overseasServices->registCheckService($request);
            if(!empty($checkRegist)){
                setFlashData($checkRegist);
                return callRedirect();
            }
        }

        return view('overseas.register', $this->overseasServices->registerService($request));
    }

    public function preview(Request $request)
    {
        view()->share([
            'isAdminPage' => (CheckUrl() === 'admin'),
            'userConfig' => config('site.user'),
            'overseasConfig' => config('site.overseas'),
            'country' => getCountry(),
            'affi' => getAffi(),
        ]);

        return view('overseas.preview', $this->overseasServices->registerService($request));
    }

    public function complete(Request $request)
    {
        return view('overseas.complete', $this->overseasServices->registerService($request));
    }

    public function data(Request $request)
    {
        return $this->overseasServices->dataAction($request);
    }
}
