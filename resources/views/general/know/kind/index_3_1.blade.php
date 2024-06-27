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
                    <ul class="sub-tab-menu type2 js-tab-menu n5">
                        <li class="{{ ($category2 ?? '1') == '1' ? 'on' : '' }}"><a href="{{ route('general.know.kind', ['category'=>'3', 'category2'=>'1']) }}"><span>정의</span></a></li>
                        <li class="{{ ($category2 ?? '1') == '2' ? 'on' : '' }}"><a href="{{ route('general.know.kind', ['category'=>'3', 'category2'=>'2']) }}"><span>심신상실성빈맥</span></a></li>
                        <li class="{{ ($category2 ?? '1') == '3' ? 'on' : '' }}"><a href="{{ route('general.know.kind', ['category'=>'3', 'category2'=>'3']) }}"><span>심방빈맥</span></a></li>
                        <li class="{{ ($category2 ?? '1') == '4' ? 'on' : '' }}"><a href="{{ route('general.know.kind', ['category'=>'3', 'category2'=>'4']) }}"><span>심방조동</span></a></li>
                        <li class="{{ ($category2 ?? '1') == '5' ? 'on' : '' }}"><a href="{{ route('general.know.kind', ['category'=>'3', 'category2'=>'5']) }}"><span>심실빈맥</span></a></li>
                    </ul>
                </div>
            </div>
            <div class="sub-contit-wrap mt-0">
                <h4 class="sub-contit">빈맥 (頻脈, 빠른 맥, Tachycardia)</h4>
            </div>
            <h5 class="sub-contit-round">빈맥이란?</h5>
            <p>
                빈맥은 어떤 이유에서든지 맥박수가 분당 100회 이상인 경우를 말합니다. <br>
                운동을 할 때나 흥분 또는 긴장할 때 맥박수가 100회 이상으로 올라가는 것은 정상적인 것이지만 안정 시에도 빈맥을 보인다면 이에 대한 정확한 진단과 원인에 대한 규명이 필요합니다.
            </p>

            <h5 class="sub-contit-round">빈맥은 왜 생기나?</h5>
            <p>
                심장 안에 정상적인 전깃줄 이외에 비정상적인 전깃줄이 존재하여 전기신호가 정상적인 전깃줄과 비정상적인 전깃줄 통해 빠르게 회전하게 되면 심장박동이 갑자기 빨라지게 됩니다. 이전에 다른 심장질환을 앓아서 심장에 흉터가 남게 되면 그 주위로 비정상적인 전기회로가 존재하게 되어서 빈맥을 일으킬 수 있습니다. 또한 비정상적으로 전기를 만드는 능력을 얻은 근육에서 빈맥이 생기는 경우가 있을 수 있습니다. 그 외에 탈수, 저혈압, 저산소증이 있는 경우나 갑상선 기능 항진증, 그리고 카페인의 과도한 섭취나 투여 중인 약물에 의해서도 빈맥이 발생될 수 있습니다.
            </p>
        </div>
    </article>
@endsection

@section('addScript')
@endsection