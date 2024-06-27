@extends('general.layouts.general-layout')

@section('addStyle')
@endsection

@section('contents')
    <article class="sub-contents">
        <div class="sub-conbox knowledge-conbox inner-layer">
            <div class="sub-tit-wrap">
                <h3 class="sub-tit">부정맥의 종류</h3>
            </div>
            <div class="tab-wrap cf">
                <div class="board-cate-wrap sub-tab-wrap">
                    <a href="{{ route('general.know.kind', ['category'=>'1']) }}" class="btn-tab-menu js-btn-tab-menu">서맥</a>
                    <ul class="board-cate sub-tab-menu js-tab-menu n5">
                        <li class="{{ ($category ?? '1') == '1' ? 'on' : '' }}"><a href="{{ route('general.know.kind', ['category'=>'1']) }}">조기수축</a></li>
                        <li class="{{ ($category ?? '1') == '2' ? 'on' : '' }}"><a href="{{ route('general.know.kind', ['category'=>'2']) }}">서맥</a></li>
                        <li class="{{ ($category ?? '1') == '3' ? 'on' : '' }}"><a href="{{ route('general.know.kind', ['category'=>'3', 'category2'=>'1']) }}">빈맥</a></li>
                        <li class="{{ ($category ?? '1') == '4' ? 'on' : '' }}"><a href="{{ route('general.know.kind', ['category'=>'4', 'category2'=>'1']) }}">심방세동</a></li>
                        <li class="{{ ($category ?? '1') == '5' ? 'on' : '' }}"><a href="{{ route('general.know.kind', ['category'=>'5', 'category2'=>'1']) }}">실신과 돌연사</a></li>
                    </ul>
                </div>
                <div class="sub-tab-wrap">
                    <a href="#n" class="btn-tab-menu js-btn-tab-menu">자주묻는 질문</a>
                    <ul class="sub-tab-menu type2 js-tab-menu n6">
                        <li class="{{ ($category2 ?? '1') == '1' ? 'on' : '' }}"><a href="{{ route('general.know.kind', ['category'=>'4', 'category2'=>'1']) }}"><span>정의</span></a></li>
                        <li class="{{ ($category2 ?? '1') == '2' ? 'on' : '' }}"><a href="{{ route('general.know.kind', ['category'=>'4', 'category2'=>'2']) }}"><span>심방세동의 위험성</span></a></li>
                        <li class="{{ ($category2 ?? '1') == '3' ? 'on' : '' }}"><a href="{{ route('general.know.kind', ['category'=>'4', 'category2'=>'3']) }}"><span>심방세동의 증상</span></a></li>
                        <li class="{{ ($category2 ?? '1') == '4' ? 'on' : '' }}"><a href="{{ route('general.know.kind', ['category'=>'4', 'category2'=>'4']) }}"><span>심방세동의 원인</span></a></li>
                        <li class="{{ ($category2 ?? '1') == '5' ? 'on' : '' }}"><a href="{{ route('general.know.kind', ['category'=>'4', 'category2'=>'5']) }}"><span>치료</span></a></li>
                        <li class=""><a href="{{ route('board', ['code'=>'atrialQna']) }}"><span>자주묻는 질문</span></a></li>
                    </ul>
                </div>
            </div>
            <div class="sub-contit-wrap mt-0">
                <h4 class="sub-contit">심방세동 (心房細動, Atrial Fibrillation)</h4>
            </div>
            <div class="video-contents">
                <div class="text-wrap">
                    심장은 2개의 심방과 심실로 구성이 되어 있습니다. 심장은 스스로 박동할 수 있는 능력을 가진 전기 세포에서 전기 자극을 만들고 이 자극이 심장 근육세포에 전달이 되어 심방과 심실이 규칙적인 수축과 이완을 반복하여, 심방에서 심실로, 심실에서 각 장기와 조직으로 필요한 혈액을 공급하게 됩니다. <br><br>
                    심방 세동은 부정맥 중 심방에서 발생하는 빈맥(빠른 맥)의 한 형태입니다. 비정상적인 전기신호가 심방 내로 전도되거나 심방 자체에서 비정상적인 전기신호가 발생하여 심방 안에서 불규칙한 전기신호가 분당 600회 정도의 빠르기로 발생합니다. 이렇게 비정상적인 전기신호가 매우 빠르고 제멋대로 전도 되어 심방은 정상적인(규칙적인) 수축을 하지 못하며, 매우 빠른 심방 내 전기신호는 방실 결절을 통해 매우 불규칙하게 심실로 전도가 되므로 심장박동이 빠르며 박동끼리의 간격이 매우 불규칙한 것이 특징입니다.
                </div>
                <div class="video-wrap">
                    <div class="video">
                        <iframe src="https://www.youtube.com/embed/TmCZwm75Zb4?si=rzR92z_nkNYCkUXR" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                    </div>
                </div>
            </div>
            <div class="img-wrap text-center">
                <img src="/html/general/assets/image/sub/img_knowledge02_4.png" alt="정상적인 심장의 전기전도와 심전도. 심방 세동 심장의 전기전도와 심전도">
            </div>
        </div>
    </article>
@endsection

@section('addScript')
@endsection