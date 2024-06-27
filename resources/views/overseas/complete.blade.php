@extends('layouts.web-layout')

@section('addStyle')
@endsection

@section('contents')
    <article class="sub-contents">
        <div class="sub-conbox inner-layer">
            <div class="sub-tit-wrap">
                <h3 class="sub-tit">해외학회신청</h3>
            </div>
            <div class="complete-conbox text-center">
                <img src="/assets/image/sub/ic_regi_complete.png" alt="">
                <p class="tit">
                    <strong>{{$conference->subject ?? ''}}</strong>
                    참가 신청이 완료 되었습니다.
                </p>
                <p>
                    본 학회에서 선정 여부 검토 후, 신청 시 입력한 E-mail 로 선정 결과를 안내 드릴 예정입니다.
                </p>
                <div class="btn-wrap text-center">
                    <a href="{{route('main')}}" class="btn btn-type1 btn-line color-type14">메인으로</a>
                    <a href="{{route('mypage.overseas')}}" class="btn btn-type1  color-type14">신청내역 확인</a>
                </div>
            </div>
        </div>
    </article>
@endsection

@section('addScript')

@endsection