@extends('pro.layouts.pro-layout')

@section('addStyle')
@endsection

@section('contents')

    <article class="sub-contents">
        <div class="sub-conbox inner-layer">

            @include('layouts.include.subTit')

            <div class="ready-wrap">
                <img src="{{ asset('assets/image/sub/img_ready_specialist.png') }}" alt="">
                <strong class="tit">페이지 <span class="highlights text-blue">준비중</span> 입니다.</strong>
                <p>
                    이용에 불편을 드려 대단히 죄송합니다. <br>
                    빠른 시일내에 준비하여 찾아뵙겠습니다.
                </p>
            </div>
        </div>
    </article>

@endsection

@section('addScript')

@endsection