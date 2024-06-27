<?php

namespace App\Services\Admin\Main;

use App\Services\AppServices;
use Illuminate\Http\Request;

/**
 * Class MainServices
 * @package App\Services
 */
class MainServices extends AppServices
{
    public function indexService(Request $request)
    {
        return $this->data;
    }

    public function logoutAction(Request $request)
    {
        thisAuth()->logout();
        $request->session()->flush();

        return $this->returnJsonData('location', $this->ajaxActionLocation('replace', getDefaultUrl(true)));
    }


    public function dataAction(Request $request)
    {
        switch ($request->case) {
            default:
                return notFoundRedirect();
        }
    }
}
