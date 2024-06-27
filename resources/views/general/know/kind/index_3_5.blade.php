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
            <div class="ready-wrap">
                <img src="/html/general/assets/image/sub/img_ready.png" alt="">
                <strong class="tit">페이지 <span class="highlights text-red">준비중</span> 입니다.</strong>
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