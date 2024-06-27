@extends($extends_str)

@section('addStyle')
@endsection

@section('contents')
    <article class="sub-contents">
        <div class="sub-conbox inner-layer">
            <div class="sub-tit-wrap">
                <h3 class="sub-tit">국내외 학술행사</h3>
            </div>
            <div id="board" class="event-wrap board-wrap" data-sid="{{ $conference->sid }}">
                <div class="ev-banner">
                    <strong class="ev-tit">{{ $conference->subject }}</strong>
                    <ul>
                        <li>{{ $conference->event_sdate->format('Y-m-d') }} ~ {{ $conference->event_edate->format('Y-m-d') }}</li>
                        <li>{{ $conference->place ?? '' }}</li>
                    </ul>
                </div>

                @include('conference.include.tabArea')

                <div class="ev-banner ev-notice-banner">
                    <img src="/assets/image/sub/ic_ev_calendar.png" alt="">
                    사전등록 마감일 : <strong class="text-pink2">{{ $conference->regist_edate->format('Y-m-d') }}</strong> 까지
                </div>

                @if($conference->etc_text)
                    <div class="view-contents">
                        {!! $conference->etc_text ?? ''  !!}
                    </div>
                @endif

                @php
                    $isOnsite = false;
                    foreach($conference->res_fee as $key => $val){
                        if(!empty($val['onsite'])) $isOnsite = true;
                    }
                @endphp
                <div class="sub-contit-wrap">
                    <h4 class="sub-contit">등록비</h4>
                </div>
                <div class="table-wrap">
                    <table class="cst-table">
                        <colgroup>
                            <col style="width: 40%;">
                            <col>
                            @if($isOnsite)
                            <col>
                            @endif
                        </colgroup>
                        <thead>
                        <tr>
                            <th scope="col">등록구분</th>
                            <th scope="col">사전등록비</th>
                            @if($isOnsite)
                            <th scope="col">현장등록비</th>
                            @endif
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($conference->res_fee as $key => $val)
                            <tr>
                                <td>{{ $val['gubun'] }}</td>
                                <td>{{ $val['early'] == '0' ? '무료' : $val['early'] }}</td>
                                @if($isOnsite)
                                <td>{{ $val['onsite'] == '0' ? '무료' : $val['onsite'] }}</td>
                                @endif
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

                @if($conference->account)
                <div class="sub-contit-wrap">
                    <h4 class="sub-contit">입금계좌</h4>
                </div>
                <div class="view-contents">
                    {!! $conference->account ?? ''  !!}
                </div>
                @endif

                @if($conference->refund_text)
                <div class="sub-contit-wrap">
                    <h4 class="sub-contit">환불규정</h4>
                </div>
                <div class="view-contents">
                    {!! $conference->refund_text ?? ''  !!}
                </div>
                @endif

                @if($conference->notice_text)
                <div class="sub-contit-wrap">
                    <h4 class="sub-contit">유의사항</h4>
                </div>
                <div class="view-contents">
                    {!! $conference->notice_text ?? ''  !!}
                </div>
                @endif

                @if($conference->contact_name)
                <div class="sub-contit-wrap">
                    <h4 class="sub-contit">문의처</h4>
                </div>
                <div class="view-contents">
                    {!! $conference->contact_name ?? ''  !!} <br>
                    - TEL : {!! $conference->contact_tel ?? ''  !!} <br>
                    - E-mail : {!! $conference->contact_email ?? ''  !!}
                </div>
                @endif
            </div>

            <div class="btn-wrap text-center">
                <a href="{{ route('conference.registration.upsert',['csid'=>$conference->sid]) }}" class="btn btn-type1 color-type15">사전등록 바로가기 <span class="arrow">&gt;</span></a>
            </div>

        </div>
    </article>
@endsection

@section('addScript')
    <script>

    </script>
@endsection
