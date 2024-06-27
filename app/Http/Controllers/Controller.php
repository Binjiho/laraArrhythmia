<?php

namespace App\Http\Controllers;

use App\Services\CommonServices;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
    
    protected $data = [];
    protected $jsonData = [];

    public function tinyUpload(Request $request)
    {
        return [
            'location' => (new CommonServices())->fileUploadService($request->file('file'), '/tinymce')['realfile'],
//            'location' => (new CommonServices())->fileUploadService($request->file('file'), '/tinymce')['file_path'],
        ];
    }

    public function plUpload(Request $request)
    {
        return (new CommonServices())->fileUploadService($request->file('file'), $request->directory);
    }

    public function fileDownload(Request $request)
    {
        return ($request->type === 'only')
            ? (new CommonServices())->fileDownloadService($request)
            : (new CommonServices())->zipDownloadService($request);
    }

    public function staticDownload(Request $request)
    {
        return (new CommonServices())->staticDownloadService($request);
    }

    public function refresh_captcha(Request $request)
    {
        return (new CommonServices())->refresh_captcha($request);
    }
    public function check_captcha(Request $request)
    {
        return (new CommonServices())->check_captcha($request);
    }

}
