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
                    <a href="#n" class="btn-tab-menu js-btn-tab-menu">삽입형 기기 이식술</a>
                    <ul class="board-cate sub-tab-menu js-tab-menu n4">
                        <li class="{{ ($category ?? '1') == '1' ? 'on' : '' }}"><a href="{{ route('general.know.therapy', ['category'=>'1']) }}">약물치료</a></li>
                        <li class="{{ ($category ?? '1') == '2' ? 'on' : '' }}"><a href="{{ route('general.know.therapy', ['category'=>'2']) }}">고주파 전극도자 절제술</a></li>
                        <li class="{{ ($category ?? '1') == '3' ? 'on' : '' }}"><a href="{{ route('general.know.therapy', ['category'=>'3']) }}">삽입형 기기 이식술</a></li>
                        <li class="{{ ($category ?? '1') == '4' ? 'on' : '' }}"><a href="{{ route('board', ['code'=>'sickQna']) }}">환자 교육자료</a></li>
                    </ul>
                </div>
            </div>
            <div class="sub-contit-wrap mt-0">
                <h4 class="sub-contit">인공 심박동기 (Pacemaker)</h4>
            </div>
            <p>
                인공 심박동기란 심장에서 전기자극을 잘 만들어내지 못하거나 잘 전도되지 않아서 맥박이 매우 느려진 병적인 서맥 환자에 대하여 심장이 정상적으로 뛰도록 해주는 기계 장치입니다. 증상을 동반하는 병적인 느린 맥의 치료방법은 인공심박동기가 유일하다고 할 수 있습니다. 전극선 (lead)라고 부르는 일종의 전깃줄을 쇄골 아래에 있는 정맥을 통하여 심장 안에 위치시킨 후, 왼쪽 가슴 윗부분에 건전지 역할을 하는 납작한 금속판을 피부 밑에 위치시키고 전극선과 연결합니다. 전극선은 두 개를 넣을 수도 있고, 환자의 질환과 상태에 따라서 하나만 넣을 수도 있습니다.
            </p>
            <div class="img-wrap text-center">
                <img src="/html/general/assets/image/sub/img_therapy_01.png" alt="[출처] 대한심장학회 홈페이지">
                <div class="img-tit">
                    <span class="highlights">[출처] <a href="http://www.circulation.or.kr/" target="_blank">대한심장학회 홈페이지</a></span>
                </div>
            </div>
            <p>
                심장 내에 넣어둔 전깃줄이 안정되려면 약 2개월 정도가 필요하며 그 이후에는 정기적으로 (대부분 6개월 정도) 심박동기를 점검하여 환자에게 적절하면서 전지를 가능한 오랫동안 쓸 수 있도록 조정합니다. 심박동기의 전지는 영구적이지 않으며 환자의 질환과 상태에 따라 다르지만 짧게는 6-7년, 길게는 9-10년 정도 사용할 수 있으며 심박동기의 전지가 다 닳았을 경우에는 전기 교체술을 시행합니다.
            </p>
            <div class="sub-contit-wrap">
                <h4 class="sub-contit">삽입형 제세동기 (Implantable Cardioverter-Defibrillator, ICD)</h4>
            </div>
            <p>
                급사의 많은 원인은 심실빈맥이나 심실세동입니다. 흔히 알려진 심장마비가 바로 이 질환들입니다. 특히 과거에 심근경색을 앓았거나, 심근증, 심부전 등의 심장병이 있는 경우에 드물지 않게 생기지만, 드물게는 심장병이나 전조증상 없이 심장마비가 오기도 합니다. 이러한 경우는 위에 설명한 방법으로는 치료가 어렵고 삽입형 제세동기를 체내에 삽입하게 됩니다. 삽입형 제세동기는 인공 심박동기와 비슷하게 생겼지만, 배터리 부분이 훨씬 두껍고 큽니다. 환자에서 위험한 부정맥이 발생하면, 이를 스스로 감지하여 전기충격을 가함으로써 환자의 생명을 구할 수 있게 됩니다. 심장마비의 위험이 큰 환자들이 이러한 치료의 대상이 됩니다.
            </p>
            <div class="img-wrap text-center">
                <img src="/html/general/assets/image/sub/img_therapy_02.gif" alt="[출처] 대한심장학회 홈페이지">
                <div class="img-tit">
                    <span class="highlights">[출처] <a href="http://www.circulation.or.kr/" target="_blank">대한심장학회 홈페이지</a></span>
                </div>
            </div>
        </div>
    </article>
@endsection

@section('addScript')
@endsection