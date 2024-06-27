<?php

namespace App\Http\Controllers\Admin\Mail;

use App\Http\Controllers\Controller;
use App\Services\Admin\Mail\MailAddressServices;
use Illuminate\Http\Request;

class MailAddressController extends Controller
{
    private $mailAddressServices;

    public function __construct(Request $request)
    {
        $this->mailAddressServices = (new MailAddressServices());
        view()->share([
            'userConfig' => config('site.user'),
            'main_menu' => 'M8',
        ]);
    }

    public function address(Request $request)
    {
        $this->data = $this->mailAddressServices->addressService($request);
        return view('admin.mail.address.index', $this->data);
    }

    public function edit(Request $request)
    {
        $this->data = $this->mailAddressServices->editService($request);
        return view('admin.mail.address.popup.addressEdit', $this->data);
    }

    public function data(Request $request)
    {
        return $this->mailAddressServices->dataAction($request);
    }
}
