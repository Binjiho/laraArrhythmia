@extends('pro.layouts.pro-layout')

@section('addStyle')
@endsection

@section('contents')

    <article class="sub-contents">
        <div class="sub-conbox greeting-conbox inner-layer">

            @include('layouts.include.subTit')

            <div class="intro-greeting-wrap">
                <div class="text-wrap">
                    <h4 class="greeting-tit">
                        안녕하세요. <br>
                        대한부정맥전문기술인회 3대 회장으로 선출된 
                        <strong>삼성서울병원 이창희입니다.</strong>
                    </h4>
                    <p>
                        뜻하지 않은 COVID 19로 인해, 회원님들 모두가 의료현장에서 누구 보다도 힘든 시간을 보내고 계시리라 생각합니다. 모두 힘내시길 바랍니다. <br><br>
                        
                        2007년, 이현수 초대회장님을 주축으로 조직된 대한부정맥전문기술인회는 부정맥 기기 및 진단 분야(ECG, Holter, 전기생리학검사 등)의 전문가 양성 및 교육을 위해  설립되었으며, 긴 역사에 맞게 국내/외를 통해 다양한 활동을 전개하였습니다. 미국부정맥학회(HRS)는 물론 아시아태평양부정맥학회(APHRS)에 이르기 까지 활동 영역을 넓혀가고 있습니다. 뿐만 아니라, 의료기사, 간호사, 의료기기 전문가가 함께 각자의 전문 분야에서 활동하며, 학술 교류하는 특수한 모임으로 변화 / 발전하고 있습니다. <br><br>
                        
                        회원 여러분, 새로운 “3기 대한부정맥전문기술인회” 는, 회원님들의  Special Needs에 함께하겠습니다.
                    </p>
                    <ul class="list-type list-type-text">
                        <li>
                            <span>
                                <strong>첫째</strong>
                            </span>
                            <div>
                                대한부정맥전문기술인회를 보다 Simple하게 구성하여, 효율적으로 운영하겠습니다.
                            </div>
                        </li>
                        <li>
                            <span>
                                <strong>둘째</strong>
                            </span>
                            <div>
                                신구 조화로 조직 구성력 “최고”에 도전하겠습니다.
                            </div>
                        </li>
                        <li>
                            <span>
                                <strong>셋째</strong>
                            </span>
                            <div>
                                Online을 통한 Cardiac Arrhythmia Education Program 을 활성화 하겠습니다.
                            </div>
                        </li>
                        <li>
                            <span>
                                <strong>넷째</strong>
                            </span>
                            <div>
                                부정맥전문가인증시험(KCAS)을 실시하고, 회원들의 권익보호 및 위상을 높이기 위해 노력하겠습니다.
                            </div>
                        </li>
                    </ul>
                    <p>
                        새롭게 시작하는 대한부정맥전문기술인회를 따뜻하게 봐주시기 바랍니다. 무언가를 해보지 않고 현실에 안주한다면 미래는 없다는 생각으로 최선을 다하겠습니다. 감사합니다.
                    </p>
                </div>
                <div class="img-wrap">
                    <picture>
                        <source srcset="/html/specialist/assets/image/sub/img_greeting_m.png" media="(max-width: 768px)">
                        <img src="/html/specialist/assets/image/sub/img_greeting.png" alt="">
                    </picture>
                </div>
            </div>
            <div class="name text-right">
                제3대 대한부정맥전문기술인회 회장
                <strong>이 창 희</strong>
            </div>
        </div>
    </article>

@endsection

@section('addScript')

@endsection