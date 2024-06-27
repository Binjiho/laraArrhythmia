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
                    <a href="{{ route('general.know.kind', ['category'=>'1']) }}" class="btn-tab-menu js-btn-tab-menu">조기수축</a>
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
                <h4 class="sub-contit">조기수축</h4>
            </div>
            <p>
                심장에서 정상적으로 맥박을 만들어내는 곳 이외의 부위에서, 정상 맥박보다 조기에 한두 번의 엇박자 맥박이 생기는 질환입니다. 부정맥 가운데 가장 흔한 질환입니다. 맥이 건너뛰는 느낌이 나거나 가슴이 쿵 떨어지는 느낌, 또는 흉부 불쾌감이나 어지러움증의 증상을 일으킬 수 있으며 아무런 증상이 없기도 합니다. 엇박자 맥박이 나오는 부위에 따라서, 조기 심방 수축과 조기 심실 수축으로 나눌 수 있습니다. 이러한 조기 수축은, 다른 곳에서 맥박이 생긴다고 하여 ‘기외 수축’ 이라고 부르기도 합니다.
            </p>
            <div class="img-wrap text-center">
                <img src="/html/general/assets/image/sub/img_knowledge02.png" alt="동방결졀(정상 맥박이 만들어지는 곳), 우심방, 방실결절, 우심실, 좌심실, 좌심방. 조기 심방 수축 그래프. 조기 심실 수축 그래프">
            </div>
        </div>
    </article>
@endsection

@section('addScript')
@endsection