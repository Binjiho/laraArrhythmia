<?php

namespace App\Http\Controllers\Admin\Conference;

use App\Http\Controllers\Controller;
use App\Services\Admin\Conference\ConferenceServices;
use Illuminate\Http\Request;

class ConferenceController extends Controller
{
    private $conferenceServices;

    public function __construct()
    {
        $this->conferenceServices = new ConferenceServices();

        view()->share([
            'main_menu' => 'M4',
            'sub_menu' => 'SM1',
            'userConfig' => config('site.user'),
            'conferenceConfig' => config('site.conference'),
        ]);
    }

    public function index(Request $request)
    {
        return view('admin.conference.index', $this->conferenceServices->indexService($request));
    }

    public function modify(Request $request)
    {
        return view('admin.conference.modify', $this->conferenceServices->modifyService($request));
    }

    public function data(Request $request)
    {
        return $this->conferenceServices->dataAction($request);
    }
}
