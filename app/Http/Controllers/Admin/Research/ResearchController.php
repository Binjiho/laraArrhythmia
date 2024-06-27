<?php

namespace App\Http\Controllers\Admin\Research;

use App\Models\Research;

use App\Http\Controllers\Controller;
use App\Services\Admin\Research\ResearchServices;
use Illuminate\Http\Request;

class ResearchController extends Controller
{
    private $researchServices;

    public function __construct()
    {
        $this->researchServices = (new ResearchServices());

        view()->share([
            'researchConfig' => config('site.research'),
            'main_menu' => 'M5',
        ]);
    }

    public function index(Request $request)
    {
        view()->share(['sub_menu' => 'SM1']);
        return view('admin.research.index', $this->researchServices->indexService($request));
    }

    public function register(Request $request)
    {
        view()->share([
            'sub_menu' => 'SM1',
            'researchConfig' => config('site.research'),
        ]);
        return view('admin.research.popup.register',$this->researchServices->registerService($request));
    }

    public function preview(Request $request)
    {
        view()->share([
            'sub_menu' => 'SM1',
            'researchConfig' => config('site.research'),
        ]);
        return view('admin.research.popup.preview',$this->researchServices->previewService($request));
    }

    public function register_reviewer(Request $request)
    {
        return view('admin.research.reviewer_register', $this->researchServices->listService($request));
    }

    public function excel(Request $request)
    {
        $request->merge(['excel' => true]);
        return $this->researchServices->indexService($request);
    }

    public function data(Request $request)
    {
        return $this->researchServices->dataAction($request);
    }
}
