<?php

namespace App\Http\Controllers\Kspay;

use App\Http\Controllers\Controller;
use App\Services\Kspay\KspayServices;
use Illuminate\Http\Request;

class KspayController extends Controller
{
    private $kspayServices;

    public function __construct(Request $request)
    {
        $this->kspayServices = (new KspayServices());
    }

    public function module(Request $request)
    {
        return $this->kspayServices->moduleService($request);
    }

    public function rcv(Request $request)
    {
        return view('kspay.ksypay_wh_rcv', $request->all());
    }

    public function result(Request $request)
    {
        return view('ksypay_wh_result', $request->all());
    }
}
