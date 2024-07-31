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
                    초록접수 마감일 : <strong class="text-pink2">{{ $conference->abs_edate->format('Y-m-d') }}</strong> 까지
                </div>

                @if($conference->caution_text)
                <div class="sub-contit-wrap">
                    <h4 class="sub-contit">주의사항</h4>
                </div>
                <div class="view-contents editor-contents">
                    {!! $conference->caution_text ?? ''  !!}
                </div>
                @endif
            </div>

            <div class="btn-wrap text-center">
                <a href="{{ route('conference.abstract.upsert',['csid'=>$conference->sid]) }}" class="btn btn-type1 color-type21">초록접수 바로가기 <span class="arrow">&gt;</span></a>
            </div>

        </div>
    </article>
@endsection

@section('addScript')
    <script>

    </script>
@endsection
