@extends('layouts.web-layout')

@section('addStyle')
@endsection

@section('contents')
    <article class="sub-contents">
        <div class="sub-conbox signup-info-conbox inner-layer">
            <div class="sub-tit-wrap">
                <h3 class="sub-tit">전문회원 가입안내</h3>
            </div>
            <div class="sub-contit-wrap">
                <h4 class="sub-contit">신청기간</h4>
            </div>
            <ul class="list-type list-type-bar">
                <li>연 2회 (상반기: 3-4월 / 하반기: 9-10월)</li>
            </ul>

            <div class="sub-contit-wrap">
                <h4 class="sub-contit">신청절차</h4>
            </div>
            <ol class="process-list">
                <li>
                            <span class="icon">
                                <img src="../../assets/image/sub/ic_process01.png" alt="">
                            </span>
                    <p>
                        <strong class="tit">1차</strong>
                        서면심사
                    </p>
                </li>
                <li>
                            <span class="icon">
                                <img src="../../assets/image/sub/ic_process02.png" alt="">
                            </span>
                    <p>
                        <strong class="tit">2차</strong>
                        면접심사
                    </p>
                </li>
                <li>
                            <span class="icon">
                                <img src="../../assets/image/sub/ic_process03.png" alt="">
                            </span>
                    <p>
                        <strong class="tit">회비 납부</strong>
                    </p>
                </li>
            </ol>
            <ul class="list-type list-type-star">
                <li>서면심사: 전문회원 추천서 2부, 학술행사 참가이력, IJA 원저 1편 투고 (제1 저자 혹은 교신저자)</li>
                <li>IJA 투고 내역이 없는 경우 서약서 제출</li>
            </ul>

            <div class="sub-contit-wrap">
                <h4 class="sub-contit">신청자격</h4>
            </div>
            <ul class="list-type list-type-bar">
                <li>부정맥질환을 치료 및 연구하는 전문의사, 또는 연구하는 기초의학자, 의공학자 또는 기타 관련 분야 석사 학위 이상 소지자로 본 학회의 목적에 찬동하고 소정의 입회 절차를 마친 자.</li>
                <li>전문회원의 경우, 의결권을 가지며 회의에 참석할 수 있다.</li>
                <li>
                    순환기내과 분과 Fellow 수련 시작한 지 만 3년 이후 신청 가능(4년째부터 신청 가능)(EP Fellow 1년 이상 수련). *제18차 이사회 결정사항(2020.07.24)

                </li>
            </ul>

            <div class="bg-box">
                <img src="../../assets/image/sub/ic_contact02.png" alt="">
                <p>
                    문의처 : <a href="mailto:khrs10@k-hrs.org" target="_blank">khrs10@k-hrs.org</a>
                </p>
            </div>
        </div>
    </article>
@endsection

@section('addScript')

@endsection