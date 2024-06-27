<?php

namespace App\Http\Controllers\Admin\Group;

use App\Http\Controllers\Controller;
use App\Services\Admin\Group\GroupMemberServices;
use Illuminate\Http\Request;

class GroupMemberController extends Controller
{
    private $groupMemberServices;

    public function __construct()
    {
        $this->groupMemberServices = new GroupMemberServices();

        view()->share([
            'main_menu' =>'M7',
            'groupConfig' => config('site.group'),
        ]);
    }

    public function index(Request $request)
    {
        return view('admin.group.member.index', $this->groupMemberServices->indexService($request));
    }

    public function upsert(Request $request)
    {
        return view('admin.group.member.upsert', $this->groupMemberServices->upsertService($request));
    }

    public function collective(Request $request)
    {
        return view('admin.group.member.collective-upload');
    }

    public function data(Request $request)
    {
        return $this->groupMemberServices->dataAction($request);
    }
}
