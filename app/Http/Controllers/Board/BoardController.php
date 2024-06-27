<?php

namespace App\Http\Controllers\Board;

use App\Http\Controllers\Controller;
use App\Services\Board\BoardServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class BoardController extends Controller
{
    private $boardServices;
    private $boardConfig;

    public function __construct()
    {
        $code = request()->code;
        $category = request()->category;
        $category2 = request()->category2;
        $abyear = request()->abyear;

        $this->boardServices = (new BoardServices());
        $this->boardConfig = config("site.board.{$code}");

        view()->share([
            'boardConfig' => $this->boardConfig,
            'main_menu' => $this->boardConfig['key']['main'] ?? '',
            'sub_menu' => $this->boardConfig['key']['sub'] ?? '',
            'low_menu' => $this->boardConfig['key']['low'] ?? 'SL'.$category,
            'small_menu' => $this->boardConfig['key']['small'] ?? 'SS'.$category,

            'code' => $code,
            'category' => $category ?? '1',
            'category2' => $category2 ?? '1',
            'abyear' => $abyear ?? date('Y'),
        ]);


        if($code=='videoGeneral'){
            view()->share([
                'sub_menu' => $this->boardConfig['key']['sub'][$category] ?? '',
            ]);
        }

    }

    public function index(Request $request)
    {
        $code = request()->code;
        $category = request()->category;
        $siteType = Session::get('siteType', 'main');

        $extends_str = 'layouts.web-layout';
        if($code=='video'){
            if($siteType == 'pro') {
                $extends_str = 'pro.layouts.pro-layout';
                view()->share([
                    'main_menu' => 'M2',
                    'sub_menu' => 'SM'.$category,
                ]);
            }
        }
        if($code=='judge'){
            if($siteType == 'pro') {
                $extends_str = 'pro.layouts.pro-layout';
                view()->share([
                    'main_menu' => 'M3',
                    'sub_menu' => 'SM2',
                    'low_menu' => 'SL'.request()->category,
                ]);
            }
        }
        if($code=='library'){
            if($siteType == 'pro') {
                $extends_str = 'pro.layouts.pro-layout';
                view()->share([
                    'main_menu' => 'M6',
                    'sub_menu' => 'SM2',
                ]);
            }
        }

        view()->share([
            'extends_str' => $extends_str,
        ]);
        if($request->code == 'photo' || $request->code == 'library'){
            if(!thisUser()){
                return authRedirect();
            }
        }
        return view("board.{$this->boardConfig['skin']}.index", $this->boardServices->listService($request));
    }

    public function view(Request $request)
    {
        $code = request()->code;
        $category = request()->category;
        $siteType = Session::get('siteType', 'main');

        $extends_str = 'layouts.web-layout';
        if($code=='video'){
            if($siteType == 'pro') {
                $extends_str = 'pro.layouts.pro-layout';
                view()->share([
                    'main_menu' => 'M2',
                    'sub_menu' => 'SM'.$category,
                ]);
            }
        }
        if($code=='judge'){
            if($siteType == 'pro') {
                $extends_str = 'pro.layouts.pro-layout';
                view()->share([
                    'main_menu' => 'M3',
                    'sub_menu' => 'SM2',
                    'low_menu' => 'SL'.request()->category,
                ]);
            }
        }
        if($code=='library'){
            if($siteType == 'pro') {
                $extends_str = 'pro.layouts.pro-layout';
                view()->share([
                    'main_menu' => 'M6',
                    'sub_menu' => 'SM2',
                ]);
            }
        }

        view()->share([
            'extends_str' => $extends_str,
        ]);
        return view("board.{$this->boardConfig['skin']}.view", $this->boardServices->viewService($request));
    }

    public function upsert(Request $request)
    {
        $code = request()->code;
        $category = request()->category;
        $siteType = Session::get('siteType', 'main');

        $extends_str = 'layouts.web-layout';
        if($code=='video'){
            if($siteType == 'pro') {
                $extends_str = 'pro.layouts.pro-layout';
                view()->share([
                    'main_menu' => 'M2',
                    'sub_menu' => 'SM'.$category,
                ]);
            }
        }
        if($code=='judge'){
            if($siteType == 'pro') {
                $extends_str = 'pro.layouts.pro-layout';
                view()->share([
                    'main_menu' => 'M3',
                    'sub_menu' => 'SM2',
                    'low_menu' => 'SL'.request()->category,
                ]);
            }
        }
        if($code=='library'){
            if($siteType == 'pro') {
                $extends_str = 'pro.layouts.pro-layout';
                view()->share([
                    'main_menu' => 'M6',
                    'sub_menu' => 'SM2',
                ]);
            }
        }

        view()->share([
            'extends_str' => $extends_str,
        ]);
        return view("board.{$this->boardConfig['skin']}.upsert", $this->boardServices->upsertService($request));
    }

    public function replyUpsert(Request $request)
    {
        return view("board.{$this->boardConfig['skin']}.reply.upsert", $this->boardServices->replyUpsertService($request));
    }

    public function replyView(Request $request) // 답글 상세페이지
    {
        return view("board.{$this->boardConfig['skin']}.reply.view", $this->boardServices->replyViewService($request));
    }


    public function data(Request $request)
    {
        return $this->boardServices->dataAction($request);
    }
}
