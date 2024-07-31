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
                {{--                <div class="tab-wrap cf">--}}
                {{--                    <div class="board-cate-wrap sub-tab-wrap">--}}
                {{--                        <a href="#n" class="btn-tab-menu js-btn-tab-menu">초대의 글</a>--}}
                {{--                        <ul class="sub-tab-menu type3 n5 cf js-tab-menu">--}}
                {{--                            <li class="on"><a href="#n">초대의 글</a></li>--}}
                {{--                            <li><a href="#n">프로그램</a></li>--}}
                {{--                            <li><a href="#n">등록안내</a></li>--}}
                {{--                            <li><a href="#n">초록접수</a></li>--}}
                {{--                            <li><a href="#n">오시는 길</a></li>--}}
                {{--                        </ul>--}}
                {{--                    </div>--}}
                {{--                </div>--}}
                <div class="sub-contit-wrap mt-0">
                    <h4 class="sub-contit">프로그램</h4>
                </div>
                <div class="view-contents editor-contents">
                    {!! $conference->schedule_text ?? ''  !!}
                </div>
            </div>
        </div>
    </article>
@endsection

@section('addScript')
    <script>

    </script>
@endsection
