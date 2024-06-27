<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FallbackController extends Controller
{
    public function __invoke(Request $request)
    {
        //이미지 경로 못찾을시 메인으로 넘김
        $tmp_uri = request()->requestUri;
        $img_array = ['jpeg','png','jpg','gif','pdf','psd','bmp','eps'];
        $ext = substr(strrchr($tmp_uri,"."),1);	//확장자앞 .을 제거하기 위하여 substr()함수를 이용
        $ext = strtolower($ext);			//확장자를 소문자로 변환
        if(in_array($ext,$img_array)){
            return '잘못된 image 경로입니다.';
        }

        dd(checkUrl());
        
        return (checkUrl() === 'api')
            ? ['result' => 'error', 'code' => '404']
            : notFoundRedirect();
    }
}
