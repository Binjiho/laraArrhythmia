<?php

namespace App\Http\Controllers\Conference;

use App\Http\Controllers\Controller;
use App\Services\Conference\ConferenceServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ConferenceController extends Controller
{
    private $conferenceServices;

    public function __construct()
    {
        $this->conferenceServices = (new ConferenceServices());
        view()->share([
            'main_menu'=>'M6',
            'sub_menu'=>'SM1',
            'low_menu'=>'SL1',
            'userConfig' => config('site.user'),
            'conferenceConfig' => config('site.conference'),
            'code' => 'test',
        ]);


    }

    public function index(Request $request)
    {
        $siteType = Session::get('siteType', 'main');
        $extends_str = 'layouts.web-layout';
        if($siteType == 'pro') {
            $extends_str = 'pro.layouts.pro-layout';
            view()->share([
                'main_menu' => 'M6',
                'sub_menu' => 'SM1',
            ]);
        }
        view()->share([
            'extends_str' => $extends_str,
        ]);

        return view('conference.index', $this->conferenceServices->listService($request));
    }

    public function upsert(Request $request)
    {
        $siteType = Session::get('siteType', 'main');
        $extends_str = 'layouts.web-layout';
        if($siteType == 'pro') {
            $extends_str = 'pro.layouts.pro-layout';
            view()->share([
                'main_menu' => 'M6',
                'sub_menu' => 'SM1',
            ]);
        }
        view()->share([
            'extends_str' => $extends_str,
        ]);

        return view('conference.upsert', $this->conferenceServices->upsertService($request));
    }

    public function detail(Request $request)
    {
        $siteType = Session::get('siteType', 'main');
        $extends_str = 'layouts.web-layout';
        if($siteType == 'pro') {
            $extends_str = 'pro.layouts.pro-layout';
            view()->share([
                'main_menu' => 'M6',
                'sub_menu' => 'SM1',
            ]);
        }
        view()->share([
            'extends_str' => $extends_str,
        ]);

        $tab = request()->tab ?? '1';
        view()->share([
            'tab'=>$tab,
        ]);
        return view('conference.detail.index_'.$tab, $this->conferenceServices->detailService($request));
    }

    public function confirm(Request $request)
    {
        $siteType = Session::get('siteType', 'main');
        $extends_str = 'layouts.web-layout';
        if($siteType == 'pro') {
            $extends_str = 'pro.layouts.pro-layout';
            view()->share([
                'main_menu' => 'M6',
                'sub_menu' => 'SM1',
            ]);
        }
        view()->share([
            'extends_str' => $extends_str,
        ]);

        $tab = $request->tab ?? '3';
        $sub = '2';
        view()->share([
            'tab'=>$tab,
            'sub'=>$sub,
        ]);

        return view('conference.detail.confirm', $this->conferenceServices->confirmService($request));
    }

    public function registration_upsert(Request $request)
    {
        $siteType = Session::get('siteType', 'main');
        $extends_str = 'layouts.web-layout';
        if($siteType == 'pro') {
            $extends_str = 'pro.layouts.pro-layout';
            view()->share([
                'main_menu' => 'M6',
                'sub_menu' => 'SM1',
            ]);
        }
        view()->share([
            'extends_str' => $extends_str,
        ]);

        $tab = '3';
        view()->share([
            'tab'=>$tab,
        ]);

        if(empty($request->sid)){
            //사전등록 신청여부
            $checkRegistration = $this->conferenceServices->registrationCheckService($request);
            if(!empty($checkRegistration)){
                setFlashData($checkRegistration);
                return callRedirect();
            }
            //선착순 등록여부
            //신청권한 여부
        }

        return view('conference.detail.registration.upsert', $this->conferenceServices->registrationUpsertService($request));
    }

    public function registration_preview(Request $request)
    {
        $siteType = Session::get('siteType', 'main');
        $extends_str = 'layouts.web-layout';
        if($siteType == 'pro') {
            $extends_str = 'pro.layouts.pro-layout';
            view()->share([
                'main_menu' => 'M6',
                'sub_menu' => 'SM1',
            ]);
        }
        view()->share([
            'extends_str' => $extends_str,
        ]);

        $tab = '3';
        if($request->step){
            $sub = '1';
        }else{
            $sub = '2';
        }

        view()->share([
            'tab'=>$tab,
            'sub'=>$sub,
        ]);

        return view('conference.detail.registration.preview', $this->conferenceServices->registrationUpsertService($request));
    }
    public function registration_complete(Request $request)
    {
        $siteType = Session::get('siteType', 'main');
        $extends_str = 'layouts.web-layout';
        if($siteType == 'pro') {
            $extends_str = 'pro.layouts.pro-layout';
            view()->share([
                'main_menu' => 'M6',
                'sub_menu' => 'SM1',
            ]);
        }
        view()->share([
            'extends_str' => $extends_str,
        ]);

        $tab = '3';
        $sub = '1';
        view()->share([
            'tab'=>$tab,
            'sub'=>$sub,
        ]);

        return view('conference.detail.registration.complete', $this->conferenceServices->registrationUpsertService($request));
    }

    public function abstract_upsert(Request $request)
    {
        $siteType = Session::get('siteType', 'main');
        $extends_str = 'layouts.web-layout';
        if($siteType == 'pro') {
            $extends_str = 'pro.layouts.pro-layout';
            view()->share([
                'main_menu' => 'M6',
                'sub_menu' => 'SM1',
            ]);
        }
        view()->share([
            'extends_str' => $extends_str,
        ]);

        $tab = '4';
        view()->share([
            'tab'=>$tab,
        ]);
        return view('conference.detail.abstract.upsert', $this->conferenceServices->abstractUpsertService($request));
    }
    public function abstract_preview(Request $request)
    {
        $siteType = Session::get('siteType', 'main');
        $extends_str = 'layouts.web-layout';
        if($siteType == 'pro') {
            $extends_str = 'pro.layouts.pro-layout';
            view()->share([
                'main_menu' => 'M6',
                'sub_menu' => 'SM1',
            ]);
        }
        view()->share([
            'extends_str' => $extends_str,
        ]);
        $tab = '4';
        if($request->step){
            $sub = '1';
        }else{
            $sub = '2';
        }
        view()->share([
            'tab'=>$tab,
            'sub'=>$sub,
        ]);

        return view('conference.detail.abstract.preview', $this->conferenceServices->abstractUpsertService($request));
    }
    public function abstract_complete(Request $request)
    {
        $siteType = Session::get('siteType', 'main');
        $extends_str = 'layouts.web-layout';
        if($siteType == 'pro') {
            $extends_str = 'pro.layouts.pro-layout';
            view()->share([
                'main_menu' => 'M6',
                'sub_menu' => 'SM1',
            ]);
        }
        view()->share([
            'extends_str' => $extends_str,
        ]);
        $tab = '4';
        $sub = '1';
        view()->share([
            'tab'=>$tab,
            'sub'=>$sub,
        ]);

        return view('conference.detail.abstract.complete', $this->conferenceServices->abstractUpsertService($request));
    }
    public function data(Request $request)
    {
        return $this->conferenceServices->dataAction($request);
    }
}
