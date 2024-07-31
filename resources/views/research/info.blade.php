@extends('layouts.web-layout')

@section('addStyle')
@endsection

@section('contents')
<article class="sub-contents">
        <div class="sub-conbox inner-layer">

            @include('layouts.include.subTit')

            <div class="sub-tab-wrap">
                <ul class="sub-tab-menu n2">
                    <li class="on"><a href="{{route('research.info')}}">안내 및 신청</a></li>
                    <li><a href="{{ route('board', ['code' => 'research']) }}">자주하는 질문 (FAQ)</a></li>
                </ul>
            </div>
            <div class="sub-contit-wrap">
                <h4 class="sub-contit">연구비 신청 안내</h4>
            </div>
            <div class="table-wrap">
                <table class="cst-table">
                    <caption class="hide">연구비 신청 안내</caption>
                    <colgroup>
                        <col style="width: 50%;">
                        <col style="width: 50%;">
                    </colgroup>
                    <thead>
                    <tr>
                        <th scope="col" colspan="2">2024년 학회 연구과제 공모 Time Table</th>
                    </tr>
                    <tr>
                        <th scope="col">구분</th>
                        <th scope="col">일정</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>1. 연구과제 접수기간</td>
                        <td>24. 04. 15(월) ~ 24. 05. 16(화)</td>
                    </tr>
                    <tr>
                        <td>2. 서류 심사 및 보완 요청 <br>- 사무국</td>
                        <td>24. 05. 13(월) ~ 24. 05. 19(일)</td>
                    </tr>
                    <tr>
                        <td>3. 종합심사 및 수혜자 선정 <br>- 연구위원회</td>
                        <td>24. 05. 20(월) ~ 24. 05. 31(금)</td>
                    </tr>
                    <tr>
                        <td>4. 수혜자 선정 안내</td>
                        <td>6월 첫째 주</td>
                    </tr>
                    <tr>
                        <td>5. 수혜자 선정 발표 및 시상</td>
                        <td>24. 06. 22(토) KHRS 총회</td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="btn-wrap text-center">
                @if(thisUser())
{{--                <a href="{{route('research.register')}}" class="btn btn-type1 color-type11">연구비 신청하기 <span class="arrow">&gt;</span></a>--}}
                <a href="javascript:alert('추후 오픈 예정입니다.')" class="btn btn-type1 color-type11">연구비 신청하기 <span class="arrow">&gt;</span></a>
                @else
                <a href="javascript:;" onclick="alert('로그인을 진행해주세요.'); location.href='{{ route('login') }}'; return false;" class="btn btn-type1 color-type11">연구비 신청하기 <span class="arrow">&gt;</span></a>
                @endif
            </div>
        </div>
    </article>
@endsection

@section('addScript')

@endsection