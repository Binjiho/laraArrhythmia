@extends('layouts.web-layout')

@section('addStyle')
@endsection

@section('contents')
    <div class="contents">
        @include('layouts.web.include.subTit')

        <div class="memberOut comp">
            <p>회원탈퇴가 <span>완료</span>되었습니다.</p>
            <p>대한심장혈관흉부외과학회 홈페이지를 이용해 주셔서 감사합니다.</p>

            <div class="btn btnArea">
                <a href="{{ route('main') }}" class="btnBig btnDef">Home</a>
            </div>
        </div>
    </div>
@endsection

@section('addScript')
@endsection
