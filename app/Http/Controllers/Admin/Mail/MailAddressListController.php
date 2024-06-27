<?php

namespace App\Http\Controllers\Admin\Mail;

use App\Http\Controllers\Controller;
use App\Services\Admin\Mail\MailAddressListServices;
use Illuminate\Http\Request;

class MailAddressListController extends Controller
{
    private $mailAddressListServices;

    public function __construct(Request $request)
    {
        $this->mailAddressListServices = (new MailAddressListServices());

    }

    public function list(Request $request)
    {
        $this->data = $this->mailAddressListServices->detailListService($request);
        return view('admin.mail.address.list', $this->data);
    }

    public function upload(Request $request)
    {
        $this->data = $this->mailAddressListServices->editDataService($request);
        return view('admin.mail.address.popup.' . $request->type . '-upload', $this->data);
    }

    public function data(Request $request)
    {
        return $this->mailAddressListServices->dataAction($request);
    }
}
