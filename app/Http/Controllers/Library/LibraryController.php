<?php

namespace App\Http\Controllers\Library;

use App\Http\Controllers\Controller;
use App\Services\Library\LibraryServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class LibraryController extends Controller
{
    private $libraryServices;

    public function __construct()
    {
        $this->libraryServices = (new LibraryServices());
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
        }
        view()->share([
            'extends_str' => $extends_str,
        ]);
        return view('board.library.session_view', $this->libraryServices->listService($request));
    }

    public function upsert(Request $request)
    {
        $siteType = Session::get('siteType', 'main');
        $extends_str = 'layouts.web-layout';
        if($siteType == 'pro') {
            $extends_str = 'pro.layouts.pro-layout';
        }
        view()->share([
            'extends_str' => $extends_str,
        ]);

        return view('board.library.session_upsert', $this->libraryServices->upsertService($request));
    }


    public function data(Request $request)
    {
        return $this->libraryServices->dataAction($request);
    }
}
