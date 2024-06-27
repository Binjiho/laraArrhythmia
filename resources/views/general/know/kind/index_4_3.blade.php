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
                <h4 class="sub-contit">심방세동의 증상</h4>
            </div>
            <p>
                부정맥의 증상은 부정맥의 종류나 심한 정도에 따라 다양한데, 아무런 증상이 없는 경우로부터 실신이나 심장 돌연사에 이르기까지 매우 다양합니다. 심방 세동에서도 증상은 다양하며, 특히 심방에서 심실로의 전도 속도가 빨라져 심장 박동수가 빠른 경우에 심한 증상을 느끼게 되는 경우가 많습니다. <br><br>

                심방 세동에서는 심방이 정상적으로 수축하지 않고 미세하게 떨고 있는 상태로, 좌심방 안에 와류가 생기고 피가 굳어 혈전(피떡)이 만들어 질 수 있습니다. 만들어진 혈전은 갑자기 떨어져나가 좌심실과 대동맥을 거쳐 뇌혈관이나 다른 장기 혈관으로 흘러가면 혈관을 막을 수 있기 때문에 아주 위험합니다. 이렇게 피의 흐름이 갑자기 중단되면 그 부위 장기가 상하게 되는데, 대표적으로 뇌혈관이 막히면 뇌졸중 (중풍, 뇌경색) 이 발생합니다. 일반인에 비해 심방세동 환자에서는 뇌졸중이 발생할 가능성이 5배 정도로 알려져 있으며, 이러한 경우 사지 마비와 같은 심각한 신경학적 후유증이 발생할 수 있고, 응급치료나 수술을 요할 수 있습니다.
            </p>
            <div class="bd-box">
                <div class="img-wrap">
                    <img src="/html/general/assets/image/sub/img_knowledge02_4_3.png" alt="">
                    <div class="img-tit">
                        <span class="highlights">부정맥의 증상들 [출처] 삼성서울병원 홈페이지</span>
                    </div>
                </div>
                <div class="text-wrap">
                    <ul class="list-type list-type-dot">
                        <li>무증상</li>
                        <li>가슴 두근거림: 크게 뛰고, 가슴이 흔들리는 느낌</li>
                        <li>무기력하고 피곤한 느낌</li>
                        <li>어지러움: 머리가 핑 도는 느낌 / 어찔한 느낌</li>
                        <li>숨이 차다, 운동시 호흡곤란</li>
                        <li>흉부 압박감</li>
                    </ul>
                </div>
            </div>
            <div class="img-contents">
                <p>
                    심방 세동은 초기에는 발작성으로 짧은 시간 동안 나타났다가 저절로 소실되는 경우가 더 많으므로 진료실에서 부정맥을 확인하지 못할 수도 있습니다. <br>발작성 심방 세동의 경우 손목의 맥박을 스스로 짚어보고 규칙적인지를 확인하는 것이 도움이 됩니다. 또한, 혈압을 측정할 때 맥박수가 자동으로 측정되는 자가 혈압계도 흔하며, 최근 맥박수를 측정해주는 스마트폰 어플리케이션도 있어서 적절히 활용하면 도움을 받을 수 있습니다.
                </p>
                <div class="img-wrap">
                    <img src="/html/general/assets/image/sub/img_knowledge02_4_3_2.png" alt="">
                    <div class="img-tit">
                        <span class="highlights">요골동맥에서의 맥박 측정</span>
                    </div>
                </div>
            </div>
        </div>
    </article>
@endsection

@section('addScript')
@endsection