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
                <h4 class="sub-contit">심방세동의 원인</h4>
            </div>
            <p>
                심방 세동의 원인은 다양하며, 과거 류마티스성 판막질환이 가장 흔한 원인이었으나, 현재는 노화나 고혈압에 의해 생기는 경우가 가장 많습니다.
            </p>

            <h5 class="sub-contit-round">심장 원인</h5>
            <ul class="list-type list-type-bar">
                <li>노화, 고혈압, 허혈성 심질환, 심부전, 심장판막질환, 심근질환, 심낭염, 동기능부전, 심장수술 후, 심방중격 결손증</li>
            </ul>

            <h5 class="sub-contit-round">심장 외 원인</h5>
            <ul class="list-type list-type-bar">
                <li>만성 폐질환, 폐렴, 폐색전증, 갑상선 항진증, 음주, 과식, 전해질 불균형</li>
            </ul>
        </div>
    </article>
@endsection

@section('addScript')
@endsection