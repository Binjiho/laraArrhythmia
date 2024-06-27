@extends('layouts.web-layout')

@section('addStyle')
@endsection

@section('contents')
    <article class="sub-contents">
        <div class="sub-conbox signup-intro inner-layer">
            <div class="sub-tit-wrap">
                <h3 class="sub-tit">회원가입 안내</h3>
            </div>
            <div class="sub-contit-wrap">
                <h4 class="sub-contit">회원 구분</h4>
            </div>
            <ol class="list-type list-type-decimal">
                <li>
                    <strong>전문회원</strong>
                    <ul class="list-type list-type-bar">
                        <li>부정맥질환을 치료 및 연구하는 전문의사, 또는 연구하는 기초의학자, 의공학자 또는 기타 관련 분야 석사 학위 이상 소지자로 본 학회의 목적에 찬동하고 소정의 입회 절차를 마친 자.</li>
                        <li>전문회원의 경우, 의결권을 가지며 회의에 참석할 수 있다.</li>
                        <li>부정맥 중재 시술 회원 - 전문회원 중 부정맥 중재 시술 회원의 자격을 갖춘 자</li>
                    </ul>
                </li>
                <li>
                    <strong>회원</strong>
                    <ul class="list-type list-type-bar">
                        <li>부정맥질환에 대한 관심을 가진 대한의사협회 회원, 연구에 종사하는 학사 학위 소지자 및 관련업무 종사자 (간호사, 약사, 임상검사기사, 진료 방사선기사, 임상공학기사 및 이사회가 인정하는 자)로 본회의 목적에 찬동하며 소정의 연회비를 납부한 자.</li>
                        <li>회원은 의결권이 없으며, 회의에는 참석할 수 있다.</li>
                    </ul>
                </li>
            </ol>

            <div class="sub-contit-wrap">
                <h4 class="sub-contit">회비 납부 안내</h4>
            </div>
            <div class="table-wrap">
                <table class="cst-table">
                    <caption class="hide">회비 납부 안내</caption>
                    <colgroup>
                        <col style="width: 33.33%;">
                        <col style="width: 33.33%;">
                        <col style="width: 33.33%;">
                    </colgroup>
                    <thead>
                    <tr>
                        <th scope="col">구분</th>
                        <th scope="col">신청 기간</th>
                        <th scope="col">연회비</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>가입대기</td>
                        <td>상시</td>
                        <td>-</td>
                    </tr>
                    <tr>
                        <td>회원</td>
                        <td>상시</td>
                        <td>1만원</td>
                    </tr>
                    <tr>
                        <td>전문회원</td>
                        <td>상/하반기 별도 신청</td>
                        <td>10만원</td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="tooltip-con">
                <strong class="tit">연회비 납부 방법</strong>
                <ul class="list-type list-type-bar">
                    <li>연회비: 1만 원</li>
                    <li>무통장 입금(우리은행 1005-203-444715, 예금주:대한부정맥학회)</li>
                    <li>입금 시 '성함/회비' 를 적어 송금 부탁드립니다. ex) 홍길동 회비</li>
                </ul>
            </div>

            <div class="sub-contit-wrap">
                <h4 class="sub-contit">회원 가입 절차</h4>
            </div>
            <strong class="tit">회원</strong>
            <ol class="list-type list-type-decimal">
                <li>홈페이지(www.k-hrs.org)에서 회원 가입 신청</li>
                <li>부정맥학회 사무국에서 회원 가입 확인 후 이메일 안내</li>
                <li>연회비 납부 확인 후 회원 가입 완료</li>
            </ol>
            <strong class="tit">전문회원</strong>
            <ol class="list-type list-type-decimal">
                <li>상반기(3~4월)/하반기(10~11월)에 대상자에게 메일로 별도 신청 안내</li>
                <li>기한 내에 제출 서류를 준비하여 담당자(<a href="mailto:khrs9@k-hrs.org" target="_blank" class="link">khrs9@k-hrs.org</a>) 메일로 회신</li>
                <li>임원교수님들의 전문회원 심사</li>
                <li>심사 결과 통보 및 회비 납부 안내</li>
                <li>전문회원 회비 납부</li>
            </ol>

            <div class="btn-wrap text-center">
                <a href="{{ route('register', ['step' => 'step1']) }}" class="btn btn-type1 color-type1">회원가입 바로가기 <span class="arrow">&gt;</span></a>
            </div>
        </div>
    </article>
@endsection

@section('addStyle')
@endsection