<?php

namespace App\Http\Controllers\Admin\Conference;

use App\Http\Controllers\Controller;
use App\Services\Admin\Conference\AbstractServices;
use Illuminate\Http\Request;

class AbstractController extends Controller
{
    private $abstractServices;

    public function __construct()
    {
        $this->abstractServices = new AbstractServices();

        view()->share([
            'main_menu' => 'M4',
            'userConfig' => config('site.user'),
            'conferenceConfig' => config('site.conference'),
        ]);
    }

    public function index(Request $request)
    {
        return view('admin.conference.abstract.index', $this->abstractServices->indexService($request, 'all'));
    }

    public function withdrawal(Request $request)
    {
        return view('admin.conference.abstract.withdrawal', $this->abstractServices->indexService($request, 'withdrawal'));
    }

    public function modify(Request $request)
    {
        return view('admin.conference.abstract.modify', $this->abstractServices->modifyService($request));
    }

    public function excel(Request $request)
    {
        $request->merge(['excel' => true]);
        return $this->abstractServices->indexService($request, $request->case ?? 'all');
    }

    public function data(Request $request)
    {
        return $this->abstractServices->dataAction($request);
    }
}
