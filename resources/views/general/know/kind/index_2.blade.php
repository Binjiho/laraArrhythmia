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
            </div>
            <div class="sub-contit-wrap mt-0">
                <h4 class="sub-contit">서맥 (徐脈, 느린 맥, Bradycardia)</h4>
            </div>
            <h5 class="sub-contit-round">서맥이란?</h5>
            <p>
                안정하고 있을 때 정상 맥박수는 분당 60~100회로 정의되어 있습니다. 보통의 경우 분당 50회 정도까지도 정상으로 간주합니다. 맥박이 느려져 분당 50회 미만으로 저하되면 서맥(徐脈)이라고 합니다.
            </p>
            <div class="img-wrap text-center">
                <img src="/html/general/assets/image/sub/img_knowledge02_2.png" alt="">
                <div class="img-tit">
                    <span class="highlights">정상맥과 서맥 심전도</span>
                </div>
            </div>

            <h5 class="sub-contit-round">서맥은 왜 생기나?</h5>
            <p>
                심장이 뛰도록 신호를 만들어 내는 곳을 의학적인 용어로 동방결절이라고 하고. 동방결절에서 만들어진 전기신호가 심방을 통과하여 심실로 전달되는 과정에서 연결통로가 되는 곳을 방실결절이라고 합니다. 다시 말해 동방결절에서 시작된 전기 신호가 방실결절을 지나 심실에 도달하면 비로소 한 번의 심실수축 즉 심장박동이 이루어지게 됩니다. 어떤 원인에서든지 동방결절에서 전기신호를 만들어내지 못하거나 (동기능 부전) 방실결절의 문제로 전기신호가 심실로 도달하지 못하면 (방실차단) 서맥이 발생하게 됩니다.
            </p>
            <div class="img-wrap text-center">
                <img src="/html/general/assets/image/sub/img_knowledge02_2_1.png" alt="">
                <div class="img-tit">
                    <span class="highlights">서맥의 발생</span>
                </div>
            </div>
        </div>
    </article>
@endsection

@section('addScript')
@endsection