@extends('layouts.web-layout')

@section('addStyle')
@endsection

@section('contents')
    <article class="sub-contents">
        <div class="sub-conbox inner-layer">
            <div class="sub-tit-wrap">
                <h3 class="sub-tit">해외학회 참가지원 신청</h3>
            </div>
            <div id="board" class="board-wrap">
                <ul class="board-list">
                    <li class="list-head">
                        <div class="bbs-event">해외학회명</div>
{{--                        <div class="bbs-nation">국가명</div>--}}
                        <div class="bbs-regi-date">개최 기간</div>
                        <div class="bbs-nation">개최 장소</div>
                        <div class="bbs-regi-date">신청기간</div>
                        <div class="bbs-regi">신청</div>
                    </li>
                    @if(count($list?? []) > 0 )
                        @foreach($list ?? [] as $row)
                        <li data-sid="{{ $row->sid }}">
                            <div class="bbs-event">{{ $row->subject }} <!-- <br>{{ $row->place }} --></div>
                            <div class="bbs-regi-date">{{ $row->event_sdate ?? '' }} {{ $row->event_edate ? ' ~ '.$row->event_edate: ''}}</div>
                            <div class="bbs-nation">{{ $row->place ?? '' }}</div>
                            <div class="bbs-regi-date">
                                {{ $row->regist_sdate ?? '' }} {{ $row->regist_edate ? ' ~ '.$row->regist_edate: ''}}
                            </div>
                            <div class="bbs-regi">
                                @if(thisUser())
                                    <a href="{{ route('overseas.register', ['csid' => $row->sid]) }}" class="btn btn-small color-type13">신청하기 <span class="arrow">&gt;</span></a>
                                @else
                                    <a href="javascript:;" onclick="alert('로그인을 진행해주세요.'); location.href='{{ route('login') }}'; return false;" class="btn btn-small color-type13">신청하러 가기 <span class="arrow">&gt;</span></a>
                                @endif

                            </div>
                        </li>
                        @endforeach
                    @else
                        <li class="no-data">
                            <img src="/assets/image/board/ic_nodata.png" alt="">
                            <p>신청 가능한 행사가 없습니다.</p>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </article>
@endsection

@section('addScript')

@endsection