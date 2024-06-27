@extends($extends_str)

@section('addStyle')
@endsection

@section('contents')

    <article class="sub-contents">
        <div class="sub-conbox inner-layer">

            @include('layouts.include.subTit')
            
            <div class="greeting-wrap">
                <div class="img-wrap">
                    <div class="img">
                        <img src="{{ asset('assets/image/sub/img_greeting_2024.jpg') }}" alt="대한부정맥학회 이사장 차태준">
                    </div>
                    <div class="name">
                        대한부정맥학회 이사장
                        <img src="{{ asset('/assets/image/sub/img_sign.png') }}" alt="차태준">
                    </div>
                </div>
                <div class="text-wrap">
                    <strong class="tit">존경하는 대한부정맥학회 회원 여러분,</strong>
                    <p>
                        안녕하십니까? 아직도 covid-19 감염이 일어나고 있고, 나라 안팎의 여러 상황이 어렵지만, 저는 여러 선배 선생님들이 이루어 놓은 훌륭한 우리 부정맥학회를 더욱 발전시키기 위해 노력하겠습니다. <br><br>

                        대한부정맥학회는 1997년 대한심장학회 산하 부정맥 연구회로 시작하여 2017년 1월 대한부정맥학회로 발돋움하였고, 2023년 현재 대한부정맥학회 회원 수는 1750명에 육박하고 있습니다. <br><br>

                        2022년 개최한 제14회 대한부정맥학회 국제학술대회(KHRS)는 1182명이 참석하고 총 91개 세션이 열렸으며, 국내 연자 145명, 해외 연자 83명이 참석하는 대규모 국제학술대회로 발전하였습니다. <br><br>

                        
                        저와 우리 임원진들은 빠른 속도로 성장하고 있는 학회의 역량을 더욱 발전시키기 위해서 다음과 같이 노력하겠습니다. <br>
                    </p>
                    <ul class="list-type list-type-text">
                        <li>
                            <span>(1)</span>
                            <div>
                                부정맥질환들에 대한 대국민 홍보를 여러 매체를 통해 실시하여, 인지도를 증대시키겠습니다.
                            </div>
                        </li>
                        <li>
                            <span>(2)</span>
                            <div>
                                지금까지 발전한 많은 분야별 학술 행사를 더욱 세분화해서 진행하고 그 행사의 결과물들을 대한부정맥학회 학술지 International Journal of Arrhythmia (IJA)에 게재하여, 여러 연구회, 위원회들과 학술지의 역량을 더욱 강화하겠습니다.
                            </div>
                        </li>
                        <li>
                            <span>(3)</span>
                            <div>
                                새롭게 도입되는 여러 최신 의료 기법들을 빨리 도입하고 잘 활용할 수 있게 정부를 설득하도록 하겠습니다.
                            </div>
                        </li>
                        <li>
                            <span>(4)</span>
                            <div>
                                대한부정맥학회 학술지에 대한 재정지원을 심장학회 학술지 수준으로 올려서 학술지의 역량을 강화하여 학회의 역량을 증대시키겠습니다.
                            </div>
                        </li>
                        <li>
                            <span>(5)</span>
                            <div>
                                지금까지 진행되고 있는 개원의와 학회 회원들 대상의 Virtual Symposium을 더욱 강화하고, live 시술을 직접 중계하는 format을 도입하는 등 회원들 간의 정보 공유 기회를 넓히도록 하겠습니다.
                            </div>
                        </li>
                    </ul>
                    <br>
                    <p>
                        더욱 내실 있고 회원과 함께 성장하는 학회를 만들기 위해, 임원진들과 합심하여 열심히 노력하겠습니다. 회원 여러분들의 많은 지지와 격려 그리고 적극적인 참여 부탁드립니다. <br><br>

                        감사합니다.
                    </p>
                </div>
            </div>
        </div>
    </article>
@endsection

@section('addScript')

@endsection