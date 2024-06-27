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
                <h4 class="sub-contit">치료</h4>
            </div>
            <p>
                심방 세동의 치료는 심장 박동수 조절, 율동 조절, 뇌졸중 예방 (항응고 치료)으로 크게 세 가지로 나눌 수 있습니다.
            </p>

            <div class="video-wrap text-center">
                <div class="video">
                    <iframe src="https://www.youtube.com/embed/48vIiczL_io" title="심방세동은 어떻게 치료 하나요?" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                </div>
            </div>

            <h5 class="sub-contit-round">심장 박동수 조절</h5>
            <p>
                심방에서 심실로의 전도 속도가 빨라져 심장 박동수가 빨라지면, 심실에 피가 채워질 시간이 줄어들고 펌프할 피가 모자라 전신 순환이 적절하지 않고 심한 증상을 느끼게 되는 경우가 많습니다. 이런 경우에 약물 치료를 통해 심방에서 심실로의 전도 속도를 늦게 하는 심장 박동수 조절을 하면 비록 불규칙한 맥일 지라도 환자분들의 비교적 편하게 느낍니다.
            </p>

            <h5 class="sub-contit-round">심장 율동 조절</h5>
            <p>
                고르지 않은 맥을 고르게 만드는 것을 심장의 율동 조절이라고 하는데, 여기에는 항부정맥 약물요법과 전극 도자 절제술이라는 시술 요법이 있습니다.
            </p> <br>
            <ol class="list-type list-type-decimal">
                <li>
                    항부정맥 약물 요법이란 항부정맥 약을 투여하여 심장 박동을 비정상적으로 빠르게 만들어 내는 비정상 심장 조직을 억제하여 부정맥을 정상으로 전환시키거나 부정맥이 재발하지 않도록 하는 것을 말합니다. 항부정맥 약에는 여러 가지 종류가 있는데 부정맥의 종류와 환자의 상태에 따라 사용하는 약제의 종류가 다릅니다. 항부정맥 약은 심장 기능을 억제하고 다른 부정맥을 유발할 수도 있으므로 부정맥 치료 경험이 많은 부정맥 전문의로부터 처방을 받아야 합니다.
                </li>
                <li>
                    전극 도자 절제술은 약물 치료의 낮은 효율과 부작용을 극복하기 위하여 개발된 치료법입니다. 흉부 절개나 전신마취 없이 양쪽 사타구니의 대퇴혈관에 직경 3.5mm 의 가는 전극 도자관을 넣어 심장까지 접근 시키고, 고주파 에너지로 조직에 화상을 입혀 심방 세동의 나타나는 300-400 군데 부위를 지져서 근본적으로 없애는 시술입니다. 매우 정밀한 시술이기 때문에 시술 시간이 약 4시간 가량 걸리지만 약물 치료보다 성공률이 높고 수술보다 회복이 빠릅니다.
                </li>
            </ol>

            <h5 class="sub-contit-round">뇌졸중 예방 (항응고 치료)</h5>
            <p>
                앞에서 언급했듯이, 심방세동 환자에서는 일반인에 비해 뇌졸중이 발생할 확률이 5배 정도 됩니다. 이는 나이가 많을 수록, 여성일수록, 동반 질환 (고혈압, 당뇨병, 심부전, 심근경색 등)이 많을 수록 발생할 확률이 높아집니다. <br><br>

                뇌졸중 예방을 위한 항응고 치료에는 전통적으로 와파린이라는 약물을 사용해 왔습니다. 와파린은 혈액 내 응고 과정에 관여하여 혈전의 생성을 억제하는데, 특히 체내 비타민K 작용을 억제하여 그 치료효과를 나타냅니다. 와파린은 약값이 저렴하고, 혈액 검사로 와파린 복용 중 그 용량을 평가하여 조절 할 수 있으며, 과량 복용 시 직접적으로 작용하는 해독제 (비타민 K 주사)가 있는 장점이 있습니다. 하지만 이러한 항응고 치료에는 출혈의 부작용을 항상 염두해 두어야 하는데, 대표적으로 뇌출혈과 같은 부작용이 생길 수 있습니다. 와파린은 이런 효과와 부작용이 모두 안전한 약물 농도의 범위 (즉, 치료 범위)가 좁고 음식이나 약물과의 상호작용이 많아 사용에 다소 어려움이 있습니다. <br><br>

                이러한 단점을 개선하여 최근 사용되고 있는 약이 새로운 항응고제 (NOACs, 노악)입니다. 와파린과 비교해 뇌졸중 예방 효과는 비슷하면서도 뇌출혈과 같은 부작용이 적고, 정기적인 혈액 검사없이 고정된 용량을 복용하고, 다른 약물이나 음식과의 영향이 적습니다. 그러나 와파린에 비해 약값이 비싸고, 약물 효과를 반영하는 검사가 없고, 과량 복용 시 직접적으로 작용하는 해독제가 없는 단점이 있습니다. 새로운 경구 항응고제는 약물 배출이 신장으로 되는 경우가 많아, 신기능 저하 환자나 고령의 환자들은 주의가 필요합니다. 그리고 약물 효과가 와파린과 달리 오래 지속되지 않아 중대한 중단 사유가 아니면 환자 임의로 중단해서는 안되며, 시술이나 수술과 같은 항응고제 중단이 필요한 경우 전문의와 상의하여야 합니다.
            </p>
        </div>
    </article>
@endsection

@section('addScript')
@endsection