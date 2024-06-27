@extends('layouts.web-layout')

@section('addStyle')
@endsection

@section('contents')
    
    <article class="sub-contents">
        <div class="sub-conbox inner-layer">

            @include('layouts.include.subTit')

            <div class="bd-box bg-info-box">
                <img src="/assets/image/sub/img_research.png" alt="">
                <div class="text-wrap">
                    <p>
                        부정맥학회 연구비 신청 및 심사 프로그램은 회원들의 연구력 향상 및 국제 경쟁력 획득과 다기관 연구 독려를 위한 공정하고 객관적이며 명확한 연구비 공모, 선정, 관리 및 평가를 위한 목적으로 운영됩니다.
                    </p>
                </div>
                <div class="btn-wrap text-center">
                    <a href="/assets/file/대한부정맥학회_연구비규정_(2019.06.개정).pdf" target="_blank" class="btn btn-type1 color-type17">연구비 규정 <img src="/assets/image/sub/ic_download.png" alt="" class="ic-down"></a>
                    <a href="/assets/file/연구비_서식_(2020.07개정).docx" target="_blank" class="btn btn-type1 color-type15">연구비 서식 <img src="/assets/image/sub/ic_download.png" alt="" class="ic-down"></a>
                </div>
            </div>
        </div>
    </article>
@endsection

@section('addScript')

@endsection