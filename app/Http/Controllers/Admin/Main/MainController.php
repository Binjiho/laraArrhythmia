<?php

namespace App\Http\Controllers\Admin\Main;

use App\Http\Controllers\Controller;
use App\Services\Admin\Main\MainServices;
use Illuminate\Http\Request;

class MainController extends Controller
{
    private $mainServices;

    public function __construct()
    {
        $this->mainServices = (new MainServices());

        view()->share([
            'main_menu' => 'M1',
        ]);
    }

    public function main(Request $request)
    {
        return view('admin.index', $this->mainServices->indexService($request));
    }

    public function logout(Request $request)
    {
        return $this->mainServices->logoutAction($request);
    }

    public function data(Request $request)
    {
        return $this->mainServices->dataAction($request);
    }
}