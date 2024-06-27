<?php

namespace App\Http\Controllers\Admin\Reviewer;

use App\Http\Controllers\Controller;
use App\Services\Admin\Reviewer\ReviewerServices;
use Illuminate\Http\Request;

class ReviewerController extends Controller
{
    private $reviewerServices;
    private $reviewerConfig;

    public function __construct()
    {
        $this->reviewerServices = (new ReviewerServices());

        $code = request()->code;
        $this->reviewerConfig = config("site.reviewer.{$code}");

        view()->share([
            'code' => $code,
            'reviewerConfig' => $this->reviewerConfig,
            'userConfig' => config('site.user'),
            'main_menu' => 'M5',
        ]);

        if($code=='surgery'){
            view()->share([
                'sub_menu' => 'SM2',
            ]);
        }
    }

    public function index(Request $request) //심사자 리스트
    {
        return view("admin.reviewer.{$this->reviewerConfig['skin']}.index", $this->reviewerServices->indexService($request));
    }

    public function upsert(Request $request) //심사자 등록
    {
        $this->data = $this->reviewerServices->upsertService($request);
        return view("admin.reviewer.{$this->reviewerConfig['skin']}.upsert", $this->data);
    }

    public function excel(Request $request)
    {
        $request->merge(['excel' => true]);
        return $this->reviewerServices->indexService($request);
    }

    public function data(Request $request)
    {
        return $this->reviewerServices->dataAction($request);
    }
}
