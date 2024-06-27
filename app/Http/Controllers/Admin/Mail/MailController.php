<?php

namespace App\Http\Controllers\Admin\Mail;

use App\Http\Controllers\Controller;
use App\Services\Admin\Mail\MailServices;
use Illuminate\Http\Request;

class MailController extends Controller
{
    private $mailServices;

    public function __construct(Request $request)
    {
//        customDump($request);
//        dd($request->all(), $request);
        $this->mailServices = (new MailServices());
    }

    public function index(Request $request)
    {
        $this->data = $this->mailServices->indexService($request);
        return view('admin.mail.index', $this->data);
    }

    public function detail(Request $request)
    {
        $this->data = $this->mailServices->detailService($request);
        return view('admin.mail.detail', $this->data);
    }

    public function detailExcel(Request $request)
    {
        $request->merge(['excel' => true]);
        return $this->data = $this->mailServices->detailService($request);
    }

    public function edit(Request $request)
    {
        $this->data = $this->mailServices->mailEditService($request);
        return view('admin.mail.popup.edit', $this->data);
    }

    public function preview(Request $request)
    {
        $this->data = $this->mailServices->mailGetPreview($request);
        return view('common.mail.' . $this->data['view'], $this->data);
    }

    public function resend(Request $request)
    {
        $this->data = $this->mailServices->mailGetResend($request);
        return view('common.mail.' . $this->data['view'], $this->data);
    }

    public function data(Request $request)
    {
        return $this->mailServices->dataAction($request);
    }
}
