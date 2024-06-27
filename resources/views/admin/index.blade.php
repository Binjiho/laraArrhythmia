@extends('admin.layouts.admin-layout')

@section('addStyle')
    <style>
        /* 인트로 */
        div.admin_intro {width:712px;margin:100px auto;border:1px solid #d7d7d7;}
        div.admin_intro p {width:700px;padding:220px 0 60px;border:6px solid #f1f1f1;background:url('https://www.gie.or.kr/image/admin/intro_img.jpg') center 66px no-repeat;text-align:center;color:#000;font-size:50px;line-height:1.2;letter-spacing:-3px;}
        div.admin_intro p span {}
        div.admin_intro p span:first-child {color:#737373;font-size:34px;}
    </style>
@endsection

@section('contents')
    <div class="contents">
        <div class="admin_intro">
            <p>
                <span>{{ env('APP_NAME') }}</span><br>
                <span class="fwBold">관리자페이지</span>입니다.
            </p>
        </div>
    </div>
@endsection

@section('addScript')
@endsection
