<?php

namespace App\Http\Controllers\Admin\Overseas;

use App\Models\Country;

use App\Http\Controllers\Controller;
use App\Services\Admin\Overseas\OverseasServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class OverseasController extends Controller
{
    private $overseasServices;
    public function __construct()
    {
        view()->share([
            'overseasConfig' => config('site.overseas'),
            'userConfig' => config('site.user'),
            'main_menu' => 'M4',
            'affi' => getAffiNm(),
            'isAdminPage' => (CheckUrl() === 'admin'),
        ]);
        $this->overseasServices = (new OverseasServices());
    }

    public function index(Request $request)
    {
        view()->share(['sub_menu' => 'SM1']);
        return view('admin.overseas.index', $this->overseasServices->indexService($request));
    }

    public function register(Request $request)
    {
        view()->share([ 'country_list' => Country::whereNotNull('ci')->get() ]);
        return view('admin.overseas.register', $this->overseasServices->upsertService($request));
    }

    public function direct(Request $request)
    {
        view()->share([
            'country' => getCountry(),
            'affi' => getAffi(),
            'country_list' => Country::whereNotNull('ci')->get()
        ]);
        return view('admin.overseas.popup.direct_register', $this->overseasServices->directService($request));
    }

    public function detail(Request $request)
    {
        view()->share([
            'sub_menu' => 'SM1'
        ]);
        return view('admin.overseas.detail.index', $this->overseasServices->listService($request));
    }

    public function assist(Request $request)
    {
        view()->share([
            'sub_menu' => 'SM1'
        ]);
        return view('admin.overseas.popup.assist_register', $this->overseasServices->assistService($request));
    }

    public function memo(Request $request)
    {
        view()->share([
            'sub_menu' => 'SM1'
        ]);
        return view('admin.overseas.popup.memo', $this->overseasServices->memoService($request));
    }

    public function assist_group(Request $request)
    {
        view()->share([
            'sub_menu' => 'SM1'
        ]);
        return view('admin.overseas.popup.assist_group_register', $this->overseasServices->assistGroupService($request));
    }

    public function mail(Request $request)
    {
        view()->share([
            'sub_menu' => 'SM1'
        ]);
        return view('admin.overseas.popup.mail', $this->overseasServices->mailService($request));
    }

    public function detail_register(Request $request)
    {
        view()->share([
            'isAdminPage' => (CheckUrl() === 'admin'),
            'userConfig' => config('site.user'),
            'overseasConfig' => config('site.overseas'),
            'country' => getCountry(),
            'affi' => getAffi(),
        ]);
        return view('admin.overseas.detail.register', $this->overseasServices->detailRegisterService($request));
    }

    public function detail_modify(Request $request)
    {
        view()->share([
            'isAdminPage' => (CheckUrl() === 'admin'),
            'userConfig' => config('site.user'),
            'overseasConfig' => config('site.overseas'),
            'country' => getCountry(),
            'affi' => getAffi(),
        ]);
        return view('admin.overseas.detail.modify', $this->overseasServices->detailModifyService($request));
    }

    public function detail_preview(Request $request)
    {
        view()->share([
            'isAdminPage' => (CheckUrl() === 'admin'),
            'userConfig' => config('site.user'),
            'overseasConfig' => config('site.overseas'),
            'country' => getCountry(),
            'affi' => getAffi(),
        ]);
        return view('admin.overseas.detail.preview', $this->overseasServices->detailModifyService($request));
    }

    public function detail_result_preview(Request $request)
    {
        view()->share([
            'isAdminPage' => (CheckUrl() === 'admin'),
            'userConfig' => config('site.user'),
            'overseasConfig' => config('site.overseas'),
            'country' => getCountry(),
            'affi' => getAffi(),
        ]);
        return view('admin.overseas.detail.result_preview', $this->overseasServices->detailResultPreviewService($request));
    }

    public function excel(Request $request)
    {
        $request->merge(['excel' => true]);
        return $this->overseasServices->listService($request);
    }

    public function data(Request $request)
    {
//        if($request->case == 'change-assist') {
//            if ($request->result == 'S'/*선정*/){
//                //제한인원 여부
//                $checkLimit = $this->overseasServices->limitCheckService($request);
//
//                if (!empty($checkLimit)) {
//                    setFlashData($checkLimit);
//                    return callRedirect();
//                }
//            }
//        }
        return $this->overseasServices->dataAction($request);
    }
}
