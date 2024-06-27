@extends('layouts.web-layout')

@section('addStyle')
@endsection

@section('contents')
    <article class="sub-contents">
        <div class="sub-conbox signup-intro inner-layer">
			<div class="sub-tit-wrap">
                <h3 class="sub-tit">연구회/지회</h3>
            </div>
            
            @include('introduce.group.include.tab')

            <div class="sub-contit-wrap">
                <h4 class="sub-contit">설립 요건</h4>
            </div>

            <div class="table-wrap scroll-x touch-help">
                <table class="cst-table">
                    <caption class="hide">설립 요건</caption>
                    <colgroup>
                        <col style="width: 18%;">
                        <col>
                        <col>
                    </colgroup>
                    <thead>
                    <tr>
                        <th scope="col">구분</th>
                        <th scope="col">연구회</th>
                        <th scope="col">지회</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>기본요건</td>
                        <td class="text-left">
                            회원이 주체가 되어 자발적으로 결성하고(자발성), 지속적인 지원이 필요한 분야임을 충족 하여야 함(지속성).
                        </td>
                        <td class="text-left">
                            해당 지역에 근무지를 둔 대한부정맥학회 전문회원 50% 이상이 지회 설립에 동의하여야 함.
                        </td>
                    </tr>
                    <tr>
                        <td>회원요건</td>
                        <td class="text-left">
                            대한부정맥학회 회원 25명 이상
                        </td>
                        <td class="text-left">
                            근무지가 해당 지역에 소속된 대한부정맥학회 회원으로 인원 제한은 없음. <br>(단, 타 지회와 중복 가입 불가)
                        </td>
                    </tr>
                    <tr>
                        <td>학술활동 실적</td>
                        <td class="text-left" colspan="2">
                            1년에 1회 이상, 최소 2년간 누적된 학술활동 실적이 있어야 함.
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="sub-contit-wrap">
                <h4 class="sub-contit">신청 방법</h4>
            </div>
            <div class="table-wrap scroll-x touch-help">
                <table class="cst-table">
                    <caption class="hide">신청 방법</caption>
                    <colgroup>
                        <col style="width: 18%;">
                        <col>
                        <col>
                    </colgroup>
                    <thead>
                    <tr>
                        <th scope="col">구분</th>
                        <th scope="col">연구회</th>
                        <th scope="col">지회</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>제출서류</td>
                        <td class="text-left">
                            <ul class="list-type list-type-bar">
                                <li>신청서(공문양식)</li>
                                <li>연구회 내규</li>
                                <li>최근 2년 동안의 학술활동보고서(소정양식)</li>
                                <li>회원명부</li>
                                <li>회원의 서명이 날인된 회원 가입 신청서 원본</li>
                            </ul>
                        </td>
                        <td class="text-left">
                            <ul class="list-type list-type-bar">
                                <li>신청서(공문양식)</li>
                                <li>지회 내규</li>
                                <li>최근 2년 동안의 학술활동보고서(소정양식)</li>
                                <li>회원명부</li>
                                <li>서명이 날인된 지회 설립 동의서 원본</li>
                                <li>서명이 날인된 지회 가입 신청서 원본</li>
                            </ul>
                        </td>
                    </tr>
                    <tr>
                        <td>신청방법</td>
                        <td class="text-left" colspan="2">
                            제출서류를 서면 및 파일 저장본에 의하여 우편 제출 <br>
                            제출처 : 대한부정맥학회 사무국 <br>
                            (04323)서울특별시 용산구 한강대로 372, A동 1604호 (동자동, 센트레빌아스테리움)
                        </td>
                    </tr>
                    <tr>
                        <td>심사주기</td>
                        <td class="text-left" colspan="2">
                            매 2~3개월 마다
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>

            <div class="sub-contit-wrap">
                <h4 class="sub-contit">신청 시 유의사항</h4>
            </div>
            <p>
                연구회 내규에는 다음과 같은 내용이 명시되어 있어야 합니다.
            </p>
            <ul class="list-type list-type-dot">
                <li>명칭, 목적, 사업</li>
                <li>회원 및 임원의 구성, 임원의 선출 임기, 임원의 의무</li>
                <li>회의, 재정, 사무</li>
            </ul>

            <div class="sub-contit-wrap">
                <h4 class="sub-contit">학술황동보고서</h4>
            </div>
            <ul class="list-type list-type-dot">
                <li>임원이상이 기술하시기 바랍니다.</li>
                <li>임원진, 현황, 이름, 소속, 연락처를 포함하는 임원 명단을 별도 제출하시기 바랍니다.</li>
                <li>회원 현황 연구회의 회원 구성에 맞는 인원수를 기재하시기 바랍니다. <br>
                    이름, 소속, 연락처를 포함하는 전체 회원명부를 별도 제출하시기 바랍니다. <br>
                    준회원이 없을 시 양식을 수정하실 수 있습니다.
                </li>
                <li>학술활동 및 연구현황 현재 진행 중이거나 이미 진행한 세미나, 연구 활동, 기타사업 등을 기재하시기 바랍니다. <br>
                    내년도 학술대회, 연수강좌 및 기타 행사 개최 계획시행 예정의 세미나, 연구 활동, 기타사업 등을 기재하시기 바랍니다.
                </li>
                <li>결산 수입과 지출 부분의 총 금액은 일치하여야 합니다. 지출 부분은 계획 중인 학술 대회, 연구사업 등 항목별로 구분하여 상세히 기재하시기 바랍니다.</li>
                <li>
                    회원명부 연구회 회원으로 가입한다는 내용과 회원의 서명이 포함된 회원신청서를 받는 등의 절차가 완료된 후 작성하시기 바랍니다. 설립 요건 목록 - 설립 요건목록으로 설립 요건, 연구회, 지회를 나타내는 테이블입니다.
                </li>
            </ul>

            <div class="bg-box bg-notice-box bg-pink">
                <img src="/assets/image/sub/ic_notice.png" alt="">
                <div class="text-wrap">
                    <p>
                        대한부정맥학회 연구회와 지회는 부정맥에 관련된 다양한 분야의 학술 연구 사업의 발전과 회원 상호간의 정보 교환, 학술 교류, 지역사회 활동 등을 돕고자 결성된 학회 산하 모임입니다. <br>
                        '연구회 운영지침' 및 '지회 운영지침'에 의거하여 학회 후원을 받을 수 있으며, 매년 학술활동을 보고할 의무가 있습니다.
                    </p>
                </div>
            </div>
            <div class="btn-wrap text-center">
                <a href="/assets/file/application_form.zip" class="btn btn-type1 color-type15" target="_blank">신청서류 다운로드 <img src="/assets/image/sub/ic_download.png" alt="" class="ic-down"></a>
            </div>
        </div>
    </article>
@endsection

@section('addScript')

@endsection