<?php

namespace App\Http\Controllers\Introduce\Group;

use App\Http\Controllers\Controller;
use App\Services\Introduce\Group\GroupServices;
use Illuminate\Http\Request;

class GroupControllr extends Controller
{
    private $groupServices;

    public function __construct()
    {
        $this->groupServices = new GroupServices();

        view()->share([
            'main_menu' =>'M10',
            'sub_menu' =>'SM6',
            'low_menu'=>'SL1',
            'groupConfig' => config('site.group'),
        ]);
    }

    public function list(Request $request)
    {
        return view('introduce.group.list', $this->groupServices->listService($request));
    }

    public function branch(Request $request)
    {
        return view('introduce.group.chapter', $this->groupServices->branchService($request));
    }

    public function guide(Request $request)
    {
        return view('introduce.group.guide', $this->groupServices->guideService($request));
    }

    public function join(Request $request)
    {
        return view('introduce.group.join', $this->groupServices->joinService($request));
    }

    public function detail(Request $request)
    {
        return view('introduce.group.detail', $this->groupServices->detailService($request));
    }

    //연구회/지회
    public function conference_upsert(Request $request)
    {
        return view('introduce.group.conference.upsert', $this->groupServices->conferenceUpsertService($request));
    }

    public function conference_view(Request $request)
    {
        return view('introduce.group.conference.view', $this->groupServices->conferenceViewService($request));
    }



    public function data(Request $request)
    {
        return $this->groupServices->dataAction($request);
    }
}
