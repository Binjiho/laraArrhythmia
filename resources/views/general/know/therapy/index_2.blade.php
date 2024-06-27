@extends('general.layouts.general-layout')

@section('addStyle')
@endsection

@section('contents')
    <article class="sub-contents">
        <div class="sub-conbox knowledge-conbox inner-layer">
            <div class="sub-tit-wrap">
                <h3 class="sub-tit">부정맥 치료 방법</h3>
            </div>
            <div class="tab-wrap cf">
                <div class="board-cate-wrap sub-tab-wrap">
                    <a href="#n" class="btn-tab-menu js-btn-tab-menu">고주파 전극도자 절제술</a>
                    <ul class="board-cate sub-tab-menu js-tab-menu n4">
                        <li class="{{ ($category ?? '1') == '1' ? 'on' : '' }}"><a href="{{ route('general.know.therapy', ['category'=>'1']) }}">약물치료</a></li>
                        <li class="{{ ($category ?? '1') == '2' ? 'on' : '' }}"><a href="{{ route('general.know.therapy', ['category'=>'2']) }}">고주파 전극도자 절제술</a></li>
                        <li class="{{ ($category ?? '1') == '3' ? 'on' : '' }}"><a href="{{ route('general.know.therapy', ['category'=>'3']) }}">삽입형 기기 이식술</a></li>
                        <li class="{{ ($category ?? '1') == '4' ? 'on' : '' }}"><a href="{{ route('board', ['code'=>'sickQna']) }}">환자 교육자료</a></li>
                    </ul>
                </div>
            </div>
            <div class="sub-contit-wrap mt-0">
                <h4 class="sub-contit">고주파 전극도자 절제술</h4>
            </div>
            <p>
                고주파 전극도자 절제술은 심장 전기생리검사를 이용하여 부정맥의 원인이 되는 조직을 찾아서 그 곳에 고주파를 방출하여 원인 조직을 파괴함으로써 부정맥을 근본적으로 완치시키는 치료 방법입니다.
            </p>
            <div class="bg-box">
                <p>	고주파 전극도자 절제술을 시행하는 경우</p>
                <ul class="list-type list-type-dot">
                    <li>약물치료에 반응이 없는 회귀성 또는 국소성 빈맥 환자</li>
                    <li>약물치료에 반응이 있으나 보다 근본적인 치료를 받기 원하는 환자</li>
                    <li>증상의 빈도나 지속시간이 약물로 치료할 만큼 지속적이지 않지만 이로 인하여 직업선택에 제약이 있어서 이에 대한 근본적인 치료를 원하는 사람</li>
                </ul>
            </div>
            <p>
                시술 시간은 환자의 질환에 따라 다르며 전기 생리검사를 포함하여 2-3시간 정도입니다. 시술 중 안정을 위하여 수면마취제가 투여될 수 있습니다. <br>일반적으로 시술 전날 입원하고 시술 다음날 퇴원 이후에는 일상생활이 가능합니다. 전극도자절제술에는 방사선 장치뿐 아니라 심장 구조를 컴퓨터 상에 3차원적으로 복제하여 부정맥이 유발되는 부위와 통로를 검사할 수 있는 최신 장비를 이용하며 방사선 장치를 사용하지 않고도 심장 내에서 전극도자가 어디에 위치하고 있는지, 어디에서 움직이고 있는지를 볼 수 있습니다. <br>고주파 전극도자 절제술로 완치의 가능성이 높은 대표적인 질환은 발작성 심실상성 빈맥 (paroxysmal supraventricular tachycardia, PSVT) 입니다. 고주파 전극도자 절제술로 치료될 확률이 낮거나 시술 후에도 재발률이 높은 부정맥 질환은 약물치료를 먼저 하고, 잘 치료되지 않는 경우 절제술을 시도합니다. 이 경우에 해당하는 대표적인 부정맥이 심방세동 입니다.
            </p>
        </div>
    </article>
@endsection

@section('addScript')
@endsection