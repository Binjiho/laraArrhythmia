<?php

namespace App\Http\Controllers\Admin\Conference;

use App\Http\Controllers\Controller;
use App\Services\Admin\Conference\RegistrationServices;
use Illuminate\Http\Request;

class RegistrationController extends Controller
{
    private $registrationServices;

    public function __construct()
    {
        $this->registrationServices = new RegistrationServices();

        view()->share([
            'main_menu' => 'M4',
            'userConfig' => config('site.user'),
            'conferenceConfig' => config('site.conference'),
        ]);
    }

    public function index(Request $request)
    {
        return view('admin.conference.registration.index', $this->registrationServices->indexService($request, 'all'));
    }

    public function withdrawal(Request $request)
    {
        return view('admin.conference.registration.withdrawal', $this->registrationServices->indexService($request, 'withdrawal'));
    }

    public function modify(Request $request)
    {
        return view('admin.conference.registration.modify', $this->registrationServices->modifyService($request));
    }

    public function excel(Request $request)
    {
        $request->merge(['excel' => true]);
        return $this->abstractServices->indexService($request, $request->case ?? 'all');
    }

    public function data(Request $request)
    {
        return $this->registrationServices->dataAction($request);
    }
}
