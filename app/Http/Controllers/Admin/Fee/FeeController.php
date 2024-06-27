<?php

namespace App\Http\Controllers\Admin\Fee;

use App\Http\Controllers\Controller;
use App\Services\Admin\Fee\FeeServices;
use Illuminate\Http\Request;

class FeeController extends Controller
{
    private $feeServices;

    public function __construct(Request $request)
    {
        $this->feeServices = (new FeeServices());

        view()->share([
            'userConfig' => config('site.user'),
            'feeConfig' => config('site.fee'),
            'main_menu' => 'M2',
        ]);
    }

    public function index(Request $request)
    {
        $this->data = $this->feeServices->indexService($request);
        return view('admin.fee.index', $this->data);
    }

    public function register(Request $request)
    {
        $this->data = $this->feeServices->registrationService($request);
        return view('admin.fee.register', $this->data);
    }

    public function memo(Request $request)
    {
        $this->data = $this->feeServices->memoService($request);
        return view('admin.fee.popup.memo', $this->data);
    }

    public function receipt(Request $request)
    {
        $this->data = $this->feeServices->receiptService($request);
        return view('admin.fee.receipt', $this->data);
    }


    public function excel(Request $request)
    {
        $request->merge(['excel' => true]);
        return $this->feeServices->indexService($request);
    }

    public function data(Request $request)
    {
        return $this->feeServices->dataAction($request);
    }
}
