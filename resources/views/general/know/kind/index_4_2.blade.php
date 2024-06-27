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
                <h4 class="sub-contit">심방세동의 위험성</h4>
            </div>
            <div class="video-contents">
                <div class="text-wrap">
                    심방세동은 임상에서 가장 흔하게 보는 부정맥의 한 종류로 일반 인구의 1-2% 에서 발생하며 나이가 들수록 많아져 85세 이상에서는 20% 이상에서 심방 세동을 가지게 됩니다. <br><br>

                    심방 세동에서는 심방이 정상적으로 수축하지 않고 미세하게 떨고 있는 상태로, 좌심방 안에 와류가 생기고 피가 굳어 혈전(피떡)이 만들어 질 수 있습니다. 만들어진 혈전은 갑자기 떨어져나가 좌심실과 대동맥혈관을 통해 뇌혈관이나 다른 장기 혈관으로 흘러가면 혈관을 막을 수 있기 때문에 아주 위험합니다. 이렇게 피의 흐름이 갑자기 중단되면 그 부위 장기가 상하게 되는데, 대표적으로 뇌혈관이 막히면 뇌졸중 (중풍, 뇌경색) 이 발생합니다. 일반인에 비해 심방세동 환자에서는 뇌졸중이 발생할 가능성이 5배 정도로 알려져 있으며, 이러한 경우 사지 마비와 같은 심각한 신경학적 후유증이 발생할 수 있고, 응급치료나 수술을 요할 수 있습니다.
                </div>
                <div class="video-wrap">
                    <div class="video">
                        <iframe src="https://www.youtube.com/embed/uI-EgJknmvY" title="심방세동은 왜 빨리 치료해야 하나요?" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                    </div>
                </div>
            </div>
        </div>
    </article>
@endsection

@section('addScript')
@endsection