<?php

namespace App\Http\Controllers\Admin\Status;

use App\Http\Controllers\Controller;
use App\Services\Admin\Status\StatusServices;
use Illuminate\Http\Request;

class StatusController extends Controller
{
    private $statServices;

    public function __construct()
    {
        $this->statServices = (new StatusServices());
        view()->share(['statusConfig' => config('site.status')]);
    }

    public function stat(Request $request)
    {
        return view('admin.status.stat', $this->statServices->statService($request));
    }

    public function referer(Request $request)
    {
        return view('admin.status.referer', $this->statServices->refererService($request));
    }

    public function data(Request $request)
    {
        return $this->statServices->dataAction($request);
    }
}
