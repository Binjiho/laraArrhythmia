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
                    <ul class="sub-tab-menu type2 js-tab-menu n2">
                        <li class="{{ ($category2 ?? '1') == '1' ? 'on' : '' }}"><a href="{{ route('general.know.kind', ['category'=>'5', 'category2'=>'1']) }}"><span>실신</span></a></li>
                        <li class="{{ ($category2 ?? '1') == '2' ? 'on' : '' }}"><a href="{{ route('general.know.kind', ['category'=>'5', 'category2'=>'2']) }}"><span>돌연사</span></a></li>
                    </ul>
                </div>
            </div>
            <div class="sub-contit-wrap mt-0">
                <h4 class="sub-contit">돌연사(심장급사)</h4>
            </div>
            <h5 class="sub-contit-round">심장급사(돌연사)란?</h5>
            <p>
                돌연사 (sudden death)는 평소에 큰 이상이 없었던 사람이 교통사고나 약물중독, 심장병등의 확실한 원인이 밝혀지지 않는 상태에서 갑작스럽게 사망하는 것을 일컫습니다. 그리고, 심장급사(sudden cardiac death)는 이러한 돌연사 중 갑작스러운 심장기능 상실로 인한 예상 밖의 뜻하지 않은 사망을 일컫습니다. <br><br>

                심장마비 (cardiac arrest)는 문자 그대로 심장이 효과적으로 전신에 피를 공급하는 능력을 상실한 상태로 심장급사뿐만 아니라 무슨 병으로든지 사망할 때는 마지막으로 심장이 멈추는 심장마비가 될 수 있습니다. 그러나 최근에는 뇌파를 검사해서 뇌사에 합당한 결과가 나오면 심장이 정상이어도 사망으로 간주하기도 합니다. <br><br>

                심장발작 (heart attack)은 심근 경색증의 발생을 의미합니다. 심근경색증은 심장급사의 원인중의 하나가 될 수 있으며 갑자기 관상동맥이 막혀서 심장근육이 괴사되는 현상입니다.
            </p>

            <h5 class="sub-contit-round">빈도</h5>
            <p>
                미국에서는 가장 많은 자연사 원인중의 하나이며 연간 발생률은 약 0.1-0.2%로 1년에 30만여명이 심장급사로 사망합니다. 우리나라는 통계에 따르면 미국의 약 10분의 1수준이며 한해 약 3-4만건정도 발생하는 것으로 추정됩니다. 그러나 인구 10만명당 발생률로 환산해보면 미국은 약 50명내외, 우리나라는 약 40명 내외로 심장급사 발생이 결코 적지 않다고 할 수 있습니다. <br><br>

                심장급사는 40대중반의 성인에서 가장 많이 발생하며 남자가 여자의 2배이며 소아에서는 매우 드물어서 10만 소아청소년당 1-2명정도로 보고되고 있습니다.
            </p>

            <h5 class="sub-contit-round">증상</h5>
            <p>
                급사로 이어지기 때문에 사실 사망 전까지 특별한 증상을 느끼지 못하고 증상을 느꼈다고 하더라도 추후 언급할 수 없는 경우가 많으나 심폐소생술로 생존한 몇몇 환자들은 심장급사를 경험하기 전 어지럽거나, 매우 빠르게 뛰는 맥박을 느끼거나 울렁거리거나 토할 것 같은 증상, 극심한 가슴통증을 호소하는 경우가 있습니다. 그러나 절반 이상의 심장급사는 어떠한 전구증상 없이도 급작스럽게 발생합니다.
            </p>

            <h5 class="sub-contit-round">원인</h5>
            <p>
                많은 경우 심장급사는 비정상적인 심장리듬, 즉 부정맥 때문입니다. 가장 흔한 위험한 부정맥은 심실세동이며 심실에서 매우 비정상적이고 불규칙하며 빠른 부정맥이 생겨서 심장이 온몸으로 혈액을 펌프질 할 수 없는 상태가 되어 수분 내로 사망에 이르게 됩니다.
            </p>
        </div>
    </article>
@endsection

@section('addScript')
@endsection