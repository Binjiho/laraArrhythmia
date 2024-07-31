<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\Admin\Fee\FeeServices;
//use App\Services\Mypage\MemberServices;
use App\Services\Auth\MypageServices;
use Illuminate\Http\Request;

class MypageController extends Controller
{
    private $mypageServices;

    public function __construct(Request $request)
    {
        $this->mypageServices = (new MypageServices());
        view()->share([
            'main_menu'=>'M2',
            'low_menu'=>'SL1',
        ]);
    }

    public function intro(Request $request)
    {
        view()->share('sub_menu', 'SM0');

//        $request->session()->reflash();
//        $this->data = $this->mypageServices->getUserData();

        return view('mypage.intro');
    }

    public function confirm(Request $request)
    {
        view()->share('sub_menu', 'SM1');

//        $request->session()->reflash();
        $this->data = $this->mypageServices->getUserData();
//        customDump($this->data);

        return view('mypage.confirm',$this->data);
    }

    public function modify(Request $request)
    {
        view()->share([
            'sub_menu' => 'SM1',
            'isAdminPage' => (CheckUrl() === 'admin'),
            'userConfig' => config('site.user'),
            'infoConfig' => config('site.default.info'),
        ]);

//        $request->session()->reflash();
        setFlashData(['modify' => 'on']);
        $this->data = $this->mypageServices->getUserData();

        return view('mypage.modify', $this->data);
    }

    public function confirmPw(Request $request)
    {
        view()->share('sub_menu', 'SM2');
        $this->data = $this->mypageServices->getUserData();
        return view('mypage.confirmPw',$this->data);
    }

    public function changePw(Request $request)
    {
//        customDump($this->data);
        view()->share('sub_menu', 'SM2');
        $this->data = $this->mypageServices->getUserData();
        return view('mypage.change-pwd',$this->data);
    }

    /**
     * 회비납부
     */
    public function fee(Request $request)
    {
        view()->share('sub_menu', 'SM3');
        $this->data = $this->mypageServices->myFeeData();
        return view('mypage.fee.my-fee', $this->data);
    }

    public function feePopup(Request $request)
    {
        view()->share([
            'isAdminPage' => (CheckUrl() === 'admin'),
            'userConfig' => config('site.user'),
            'infoConfig' => config('site.default.info'),
        ]);
        $this->data = $this->mypageServices->feePopupService($request);
        return view('mypage.fee.popup.'.$request->case, $this->data);
    }

    /**
     * 학술행사
     */
    public function conference(Request $request)
    {
        view()->share([
            'sub_menu' => 'SM4',
            'isAdminPage' => (CheckUrl() === 'admin'),
            'userConfig' => config('site.user'),
            'infoConfig' => config('site.default.info'),
        ]);
        $this->data = $this->mypageServices->myConferenceData();
        return view('mypage.conference.index',$this->data);
    }

    public function overseas(Request $request)
    {
        view()->share([
            'sub_menu' => 'SM9',
            'isAdminPage' => (CheckUrl() === 'admin'),
            'userConfig' => config('site.user'),
            'infoConfig' => config('site.default.info'),
            'overseasConfig' => config('site.overseas'),
        ]);
        $this->data = $this->mypageServices->myOverseasData($request);
        return view('mypage.conference.overseas',$this->data);
    }

    public function overseas_report(Request $request)
    {
        view()->share([
            'sub_menu' => 'SM4',
            'isAdminPage' => (CheckUrl() === 'admin'),
            'userConfig' => config('site.user'),
            'overseasConfig' => config('site.overseas'),
            'country' => getCountry(),
            'affi' => getAffi(),
        ]);
        $this->data = $this->mypageServices->myOverseasData($request);
        return view('mypage.conference.overseas_report',$this->data);
    }

    public function overseas_preview(Request $request)
    {
        view()->share([
            'sub_menu' => 'SM4',
            'isAdminPage' => (CheckUrl() === 'admin'),
            'userConfig' => config('site.user'),
            'overseasConfig' => config('site.overseas'),
            'country' => getCountry(),
            'affi' => getAffi(),
        ]);
        $this->data = $this->mypageServices->myOverseasData($request);
        return view('mypage.conference.overseas_preview',$this->data);
    }

    public function overseas_complete(Request $request)
    {
        view()->share([
            'sub_menu' => 'SM4',
            'isAdminPage' => (CheckUrl() === 'admin'),
            'userConfig' => config('site.user'),
            'overseasConfig' => config('site.overseas'),
            'country' => getCountry(),
            'affi' => getAffi(),
        ]);
        $this->data = $this->mypageServices->myOverseasData($request);
        return view('mypage.conference.overseas_complete',$this->data);
    }

    public function withdrawal(Request $request)
    {
        view()->share('sub_menu', 'SM4');
        $this->data = $this->mypageServices->getUserData();
        return view('mypage.withdrawal',$this->data);
    }

    /**
     * 연구회/지회
     */
    public function myGroup(Request $request)
    {
        view()->share([
            'sub_menu' => 'SM5',
            'isAdminPage' => (CheckUrl() === 'admin'),
        ]);
        return view('mypage.group.index');
    }

    /**
     * 연구지원
    */
    public function myResearch(Request $request)
    {
        view()->share([
            'sub_menu' => 'SM6',
            'isAdminPage' => (CheckUrl() === 'admin'),
            'researchConfig' => config('site.research'),
        ]);
        $this->data = $this->mypageServices->myResearchData($request);
        return view('mypage.research.index',$this->data);
    }

    public function researchReviewRegist(Request $request)
    {
        view()->share([
            'sub_menu' => 'SM6',
            'isAdminPage' => (CheckUrl() === 'admin'),
            'researchConfig' => config('site.research'),
        ]);
        return view('mypage.research.popup.reviewer-regist',$this->mypageServices->researchReviewerData($request));
    }

    /**
     * 중재시술인증
     */
    public function mySurgery(Request $request)
    {
        view()->share([
            'sub_menu' => 'SM7',
            'isAdminPage' => (CheckUrl() === 'admin'),
            'surgeryConfig' => config('site.surgery'),
        ]);
        $this->data = $this->mypageServices->mySurgeryData($request);
        return view('mypage.surgery.index',$this->data);
    }


    public function data(Request $request)
    {
        return $this->mypageServices->dataAction($request);
    }
}
