@extends('layouts.web-layout')

@section('addStyle')
@endsection

@section('contents')
    <article class="sub-contents">
        <div class="sub-conbox inner-layer">

            @include('layouts.include.subTit')

            <ul class="box-list n2 down-list">
                <li>
                    <div class="img-wrap">
                        <img src="/assets/image/sub/img_guide.png" alt="대한부정맥학회">
                    </div>
                    <div class="text-wrap">
                        <strong class="tit">2018년 대한부정맥학회 실신 평가 및 치료 지침 – 총론</strong>
                        <a href="https://www.e-arrhythmia.org/upload/pdf/ija-19-2-145.pdf" target="_blank" class="btn btn-down">Download <img src="/assets/image/sub/btn_down.png" alt=""></a>
                    </div>
                </li>
                <li>
                    <div class="img-wrap">
                        <img src="/assets/image/sub/img_guide.png" alt="대한부정맥학회">
                    </div>
                    <div class="text-wrap">
                        <strong class="tit">2018년 대한부정맥학회 실신 평가 및 치료 지침 – 각론</strong>
                        <a href="https://www.e-arrhythmia.org/upload/pdf/ija-19-2-126.pdf" target="_blank" class="btn btn-down">Download <img src="/assets/image/sub/btn_down.png" alt=""></a>
                    </div>
                </li>
            </ul>
        </div>
    </article>
@endsection

@section('addScript')

@endsection