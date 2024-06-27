<?php

namespace App\Http\Controllers\Admin\Group;

use App\Http\Controllers\Controller;
use App\Services\Admin\Group\GroupServices;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    private $groupServices;

    public function __construct()
    {
        $this->groupServices = new GroupServices();

        view()->share([
            'main_menu' =>'M7',
            'sub_menu' =>'S1',
            'groupConfig' => config('site.group'),
        ]);
    }

    public function index(Request $request)
    {
        return view('admin.group.index', $this->groupServices->indexService($request));
    }

    public function upsert(Request $request)
    {
        return view('admin.group.upsert', $this->groupServices->upsertService($request));
    }

    public function data(Request $request)
    {
        return $this->groupServices->dataAction($request);
    }
}
