@extends('layouts.web-layout')

@section('addStyle')
@endsection

@section('contents')
    <article class="sub-contents">
        <div class="sub-conbox signup-intro inner-layer">
            <div class="sub-tit-wrap">
                <h3 class="sub-tit">회원정보 수정</h3>
            </div>
            <ul class="box-list mypage-list n3">
                <li>
                    <a href="{{route('mypage.confirm')}}">
                        <strong class="tit ">회원정보 수정</strong>
                        <span class="icon"><img src="/assets/image/sub/ic_mypage01.png" alt=""></span>
                    </a>
                </li>
                <li>
                    <a href="{{route('mypage.changePw')}}">
                        <strong class="tit">비밀번호 변경</strong>
                        <span class="icon"><img src="/assets/image/sub/ic_mypage02.png" alt=""></span>
                    </a>
                </li>
                <li>
                    <a href="{{route('mypage.fee')}}">
                        <strong class="tit">회비납부</strong>
                        <span class="icon"><img src="/assets/image/sub/ic_mypage03.png" alt=""></span>
                    </a>
                </li>
                <li>
                    <a href="{{route('mypage.conference')}}">
                        <strong class="tit">학술행사</strong>
                        <span class="icon"><img src="/assets/image/sub/ic_mypage04.png" alt=""></span>
                    </a>
                </li>
                <li>
                    <a href="{{route('mypage.group')}}">
                        <strong class="tit">연구회 / 지회</strong>
                        <span class="icon"><img src="/assets/image/sub/ic_mypage05.png" alt=""></span>
                    </a>
                </li>
                <li>
                    <a href="{{route('mypage.research')}}">
                        <strong class="tit">연구지원</strong>
                        <span class="icon"><img src="/assets/image/sub/ic_mypage06.png" alt=""></span>
                    </a>
                </li>
                <li>
                    <a href="{{route('mypage.surgery')}}">
                        <strong class="tit">중재시술인증</strong>
                        <span class="icon"><img src="/assets/image/sub/ic_mypage07.png" alt=""></span>
                    </a>
                </li>
                <li>
                    <a href="{{route('mypage.withdrawal')}}">
                        <strong class="tit">회원탈퇴</strong>
                        <span class="icon"><img src="/assets/image/sub/ic_mypage08.png" alt=""></span>
                    </a>
                </li>
            </ul>
        </div>
    </article>
@endsection

@section('addScript')
@endsection