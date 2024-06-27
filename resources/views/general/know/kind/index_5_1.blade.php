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
                <h4 class="sub-contit">실신</h4>
            </div>
            <h5 class="sub-contit-round">실신이란?</h5>
            <p>
                실신은 뇌로 순간적인 혈액순환이 차단되어 의식을 소실하는 의학용어입니다. <br>
                실신은 혈압의 갑작스러운 저하나 심장박동의 저하 또는 체내 순환되는 혈액의 급작스러운 재분포 (changes in the amount of blood in areas of your body) 때문에 일어날수 있습니다. <br>
                실신 후에는 바로 다시 의식을 되찾는 경우도 있지만 어느 정도 기간 동안 의식혼란이 있는 경우까지 다양합니다.
            </p>

            <h5 class="sub-contit-round">자율신경계 (ANS; autonomic nervous system)</h5>
            <p>
                자율신경계란 우리가 인지하지 못하여도 우리 몸의 기본적 기능, 호흡, 혈압, 맥박, 소변조절 등을 조절하는 신경입니다.
            </p>

            <h5 class="sub-contit-round">빈도</h5>
            <p>
                실신은 꽤 자주 일어나는 의학적 상황으로 평생을 두고 본다면 남자는 약 3%, 여자는 약 3.5%의 사람들이 실신을 경험합니다. 실신은 나이가 들수록 더 자주 일어나서 75세 이상인 경우 6%의 사람들이 실신을 경험했다고 보고합니다. 그러나 실신은 어떤 나이이던 질병이 있던 없던 간에 발생할 수 있습니다.
            </p>

            <h5 class="sub-contit-round">증상</h5>
            <p>
                실신과 동반된 증상은 다음과 같습니다.
            </p>
            <div class="bd-box">
                <div class="text-wrap">
                    <ul class="list-type list-type-dot">
                        <li>앞이 깜깜해진다.</li>
                        <li>갑자기 주저 앉는다.</li>
                        <li>어지럽다.</li>
                        <li>힘이 빠진다.</li>
                        <li>식사나 운동할 때 또는 서 있을 때 기운이 빠진다.</li>
                        <li>시야가 갑자기 흐려진다.</li>
                        <li>터널에 들어온 것처럼 시약 좁아진다. </li>
                        <li>머리가 멍하면서 아프다.</li>
                    </ul>
                </div>
            </div>
            <p>
                많은 경우 환자들은 실신이 오기 전 전구증상(prodrome)을 느끼는데 이러한 전구증상은 다음과 같습니다.
            </p>
            <div class="bd-box">
                <div class="text-wrap">
                    <ul class="list-type list-type-dot">
                        <li>울렁거리면서 토할 것 같다.</li>
                        <li>머리가 멍하다.</li>
                        <li>갑자기 심장이 빨리 뛴다.</li>
                        <li>복통이 극심하면서 식은땀이 난다.</li>
                    </ul>
                </div>
            </div>

            <h5 class="sub-contit-round">원인</h5>
            <p>
                실신의 원인은 여러 가지가 있습니다. <br>
                기립성 저혈압이나 자율신경계의 불균형으로 인한 미주신경성 실신부터 위험한 심장질환에 의한 심장 빈맥으로 실신하는 경우까지 다양합니다.
            </p>

            <h5 class="sub-contit-round">진단</h5>
            <p>
                실신의 진단을 위해서는 자세한 병력청취와 함께 다음과 같은 검사들이 도움이 됩니다. 그러나 이러한 검사를 모두 한다고 해도 실신의 정확한 원인을 알지 못하는 경우가 절반 이상입니다. <br><br>

                심전도, 혈액검사, 운동부하검사, 24시간 활동혈압검사, 심장초음파, 기립경검사 등을 시행합니다.
            </p>
            <div class="img-wrap text-center">
                <img src="/html/general/assets/image/sub/img_knowledge02_5.png" alt="">
                <div class="img-tit">
                    <span class="highlights">기립경검사 [출처] 클리브랜드클리닉</span>
                </div>
            </div>

            <h5 class="sub-contit-round">치료</h5>
            <p>
                실신의 치료는 그 원인에 따라 다양합니다. 미주신경성실신은 주로 생활습관교정 및 전구증상시 대처방법에 따라 실신의 빈도를 경감시킬 수 있고 기립성저혈압으로 인한 실신은 기존의 혈압약을 조절하고 갑작스러운 기립등의 자세변화를 조절하는 것으로 호전될 수 있습니다. 심장질환에 의한 심각한 부정맥으로 인한 실신은 인공심장박동기나 삽입형 제세동기를 삽입하는 시술로 예방할수도 있으며 기저 심장질환에 따라 치료가 달라집니다. 원인을 못찾는 실신이 재발하는 경우 피부밑에 삽입하는 이식형심장기록기(implantable loop recorder)로 원인을 밝혀내어 치료에 도움을 줄 수 있습니다.
            </p>
            <div class="img-wrap text-center">
                <img src="/html/general/assets/image/sub/img_knowledge02_5_1.png" alt="">
                <div class="img-tit">
                    <span class="highlights">삽입형 심장 기록기 [출처] 메드트로닉</span>
                </div>
            </div>
        </div>
    </article>
@endsection

@section('addScript')
@endsection