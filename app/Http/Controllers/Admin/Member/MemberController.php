<?php

namespace App\Http\Controllers\Admin\Member;

use App\Http\Controllers\Controller;
use App\Services\Admin\Member\MemberServices;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    private $memberServices;

    public function __construct()
    {
        $this->memberServices = (new MemberServices());

        view()->share([
            'userConfig' => config('site.user'),
            'feeConfig' => config('site.fee'),
            'main_menu' => 'M1',
            'affi' => getAffiNm(),
        ]);
    }

    public function index(Request $request)
    {
        view()->share(['sub_menu' => 'SM1']);
        return view('admin.member.index', $this->memberServices->indexService($request));
    }

    public function modify(Request $request)
    {
        view()->share(['sub_menu' => 'SM1']);
        return view('admin.member.popup.register', $this->memberServices->modifyService($request));
    }

    public function withdrawal(Request $request)
    {
        view()->share(['sub_menu' => 'SM2']);
        $request->merge(['withdrawal' => true]);
        return view('admin.member.withdrawal', $this->memberServices->indexService($request));
    }

    public function excel(Request $request)
    {
        $request->merge(['excel' => true]);
        return $this->memberServices->indexService($request);
    }

    public function withdrawalExcel(Request $request)
    {
        $request->merge(['withdrawal' => true, 'excel' => true]);
        return $this->memberServices->indexService($request);
    }

    public function data(Request $request)
    {
        return $this->memberServices->dataAction($request);
    }
}
