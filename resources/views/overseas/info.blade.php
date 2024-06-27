@extends('layouts.web-layout')

@section('addStyle')
@endsection

@section('contents')
    <article class="sub-contents">
        <div class="sub-conbox overseas-conbox inner-layer">
            @include('layouts.include.subTit')
            
{{--            <div class="sub-tab-wrap">--}}
{{--                <ul class="sub-tab-menu n2">--}}
{{--                    <li class="on"><a href="{{route('overseas.info')}}">안내 및 신청</a></li>--}}
{{--                    <li ><a href="{{route('board',['code'=>'overseas'])}}">자주하는 질문 (FAQ)</a></li>--}}
{{--                </ul>--}}
{{--            </div>--}}
            <div class="bg-box bg-img-box">
                <img src="/assets/image/sub/ic_overseas.png" alt="">
                <div class="text-wrap">
                    대한부정맥학회에서는 학회 회원의 해외 학술활동을 위해 해외학회 참석 체재비를 한국제약바이오협회, 다국적의약산업협회, 한국의료기기산업협회산업협회(이하 '3개 협회')의 공정경쟁규약에 의거하여 지원하고자 합니다. 아래의 내용을 숙지하여 주시기 바랍니다.
                </div>
            </div>
            <div class="sub-contit-wrap">
                <h4 class="sub-contit">신청자격</h4>
            </div>
            <ul class="list-type list-type-text">
                <li>
                    <span>1)</span>
                    <div>
                        대한의사협회 회원이면서 대한부정맥학회 회원
                    </div>
                </li>
                <li>
                    <span>2)</span>
                    <div>
                        3개 협회의 공정경쟁규약 제9조 학술대회 참가지원에서 명시한 참가자격을 갖추고 이를 서면 자료로 증빙할 수 있는 자
                    </div>
                </li>
            </ul>

            <div class="table-wrap scroll-x touch-help">
                <table class="cst-table">
                    <caption class="hide">해외학회 신청 자격</caption>
                    <colgroup>
                        <col style="width: 25%;">
                        <col style="width: 25%;">
                        <col style="width: 25%;">
                        <col style="width: 25%;">
                    </colgroup>
                    <thead>
                    <tr>
                        <th scope="col"></th>
                        <th scope="col">한국다국적의약산업협회 <br>(KRPIA)</th>
                        <th scope="col">한국제약바이오협회 <br>(KPBMA)</th>
                        <th scope="col">한국의료기기산업협회 <br>(KMDIA)</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <th scope="row">공정경쟁 규약</th>
                        <td colspan="4" class="text-left">
                            제 9조 제2항 제2호: 보건의료 전문가에 대한 지원은 발표자, 좌장, 토론자가 학술대회 주최자로부터 지원받는 실비의 교통비, 등록비, 식대, 숙박비에 한한다.
                        </td>
                    </tr>
                    <tr>
                        <th scope="row" rowspan="3">참가자격 <br>(미충족시 지원신청 불가)</th>
                        <td colspan="4" class="text-left">
                            발표자(초록 발표자, e-poster 발표자 포함), 좌장, 토론자는 학술대회 주최측에서 선정한 보건의료 전문가(의사)를 말하며, 이들에 대한 지원은 실비 정산으로 한다. 단, 발표자의 경우, 제 1저자 및 그 외 공동저자 1인만 지원할 수 있다. (e-poster는 하단에 별도 안내) <br>
                            제 1저자 미 참가시, 공동저자 1인만 지원 가능 (공동저자만 2명 참가할 수 없음) <br>
                            *제 1저자: 프로그램 북의 해당 초록 저자란에 첫번째 기재되어 있는 저자 (발표자와는 다른 개념입니다.)
                        </td>
                    </tr>
                    <tr>
                        <td class="text-left">
                            e-포스터 발표자의 경우 초청장, 초록채택 메일, 또는 프로그램 등에 발표시간 또는 질의 응답 시간 등이 명시되어 실제 학술대회에서 발표가 이루어지는 사실이 확인되어야 하며, 하나의 학술대회 당 (단, 하나의 학술대회가 여러 개의 코스, 강좌, 세션으로 구분이 되는 경우, 각 코스, 강좌 또는 세션 당) 1인에 한하여 지원 가능함
                        </td>
                        <td class="text-left">
                            e-포스터 발표자의 경우 초청장 또는 초록채택 메일에 발표시간 또는 질의응답 시간 등이 명시되어 발표자의 역할이 확인된 1인만 지원 대상에 포함키로 함
                        </td>
                        <td class="text-left">
                            e-poster 또는 포스터 발표자인 경우 초록의 주저자나 공동저자 중에서 발표에 참가하는 1인만 지원할 수 있다. (반드시 초록채택메일에 발표시간과 질의응답시간이 기재 되어 있어야 하며, 발표자의 역할이 확인 되어야 한다)
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4" class="text-left">
                            e-poster의 공동저자는 주최측으로 부터 발표자라는 사실을 확인된 자료를 제출해야 함
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">참가자격 증빙자료</th>
                        <td class="text-left" colspan="4">
                            <ul class="list-type list-type-text">
                                <li>
                                    <span>1)</span>
                                    <div>
                                        초록 발표자 및 e-poster 발표자
                                        <ul class="list-type list-type-text">
                                            <li>
                                                <span>①</span>
                                                <div>주최측에서 받은 초록채택 메일 (발표시간 또는 질의응답 시간 및 초록제목이 포함된 것)</div>
                                            </li>
                                            <li>
                                                <span>②</span>
                                                <div>
                                                    프로그램 북 사본 (제목과 저자명 포함된 것) <br>
                                                    * 공동저자 자격으로 참석하는 경우 학회 공식자료에 본인의 이름이 표기된 자료를 반드시 제출해야 함(미 구비시 정산 불가) 2) 초청 발표자, 좌장, 토론자 : 주최측에서 받은 초청 메일 또는 공문 (역할 및 세션일정 명시 된 것) 및 프로그램 북 사본
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                            </ul>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>

            <div class="sub-contit-wrap">
                <h4 class="sub-contit">참석 후 제출자료 (선정통보 후 제출자료 안내 메일 발송 예정)</h4>
            </div>
            <ul class="list-type list-type-text">
                <li>
                    <span>1)</span>
                    <div>
                        참가자격 증빙자료(초청 또는 채택 메일, 프로그램북 사본-제목, 참여자 본인 이름, 일정 표기된 것)
                    </div>
                </li>
                <li>
                    <span>2)</span>
                    <div>
                        항공료, 숙박비, 등록비, 식비, 현지 교통비 원본 영수증 및 3개 협회에서 요청한 결제 증빙자료
                    </div>
                </li>
            </ul>

            <div class="sub-contit-wrap">
                <h4 class="sub-contit">유의사항</h4>
            </div>
            <ul class="list-type list-type-text">
                <li>
                    <span>1)</span>
                    <div>
                        신청시 우선순위에 체크하신 내용을 기준으로 심사하며, 사실과 다른 경우 선정이 취소됩니다.
                    </div>
                </li>
                <li>
                    <span>2)</span>
                    <div>
                        신청 취소는 반드시 마감일 내에 메일로 연락 주시고, 선정통보 이후 취소연락 및 불참 시 향후 2년간 선정대상에서 제외됩니다.
                    </div>
                </li>
                <li>
                    <span>3)</span>
                    <div>
                        본 학회에서는 참석 전에 별도의 참가자격 확인절차를 진행하지 않습니다. 참가자격 미확인 및 증빙자료 미제출에 따른 불이익은 본인에게 있는 점 양지 바랍니다.
                    </div>
                </li>
            </ul>

            <div class="sub-contit-wrap">
                <h4 class="sub-contit">접수방법</h4>
            </div>
            <ul class="list-type list-type-bar">
                <li>기한 내 제출서류 양식을 전부 작성, 서명하신 후 증빙자료와 함께 제출하여 주십시오.</li>
                <li>제출서류: 해외학회 지원 신청서, 일정 및 이름 확인 가능한 공식 자료</li>
            </ul>

            <div class="sub-contit-wrap">
                <h4 class="sub-contit">신청 마감일</h4>
            </div>
            <ul class="list-type list-type-text">
                <li>
                    <span>1)</span>
                    <div>
                        개최시작일 기준 60일 전까지 이며, 좌측 메뉴 ‘해외학회 일정’ 에서 확인 가능합니다.
                    </div>
                </li>
                <li>
                    <span>2)</span>
                    <div>
                        채택발표가 나지 않은 경우 마감일은 연장될 수 있습니다.
                    </div>
                </li>
            </ul>

            <div class="sub-contit-wrap">
                <h4 class="sub-contit">선정발표</h4>
            </div>
            <ul class="list-type list-type-bar">
                <li>신청 마감일 이후 15일 이내 개별 이메일 통보 예정</li>
            </ul>

            <div class="sub-contit-wrap">
                <h4 class="sub-contit">정산금</h4>
            </div>
            <ul class="list-type list-type-bar">
                <li>정산금 입금까지는 12개월 이상 소요될 수 있사오니 이점 양지하시기 바랍니다.</li>
            </ul>

            <div class="btn-wrap text-center">
                @if(thisUser())
                    <a href="{{route('overseas.list')}}" class="btn btn-type1 color-type11">신청하러 가기 <span class="arrow">&gt;</span></a>
                @else
                    <a href="javascript:;" onclick="alert('로그인을 진행해주세요.'); location.href='{{ route('login') }}'; return false;" class="btn btn-type1 color-type11">신청하러 가기 <span class="arrow">&gt;</span></a>
                @endif
            </div>
        </div>
    </article>
@endsection

@section('addScript')

@endsection