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

                @if($conference->place)
                <div class="sub-contit-wrap mt-0">
                    <h4 class="sub-contit">오시는 길</h4>
                </div>
                <div class="ev-map-wrap">
                    <iframe src="https://maps.google.co.kr/maps?q={{ urlencode($conference->place) ?? '' }}&amp;aq=&amp;sll=36.430122,128.056641&amp;sspn=7.034145,9.876709&amp;ie=UTF8&amp;hq=&amp;hnear={{ urlencode($conference->place) ?? '' }}&amp;t=m&amp;z=16&amp;output=embed" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                </div>
                @endif
{{--                <div class="ev-map-wrap">--}}
{{--                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3163.8095444052988!2d126.96877597635446!3d37.535986625878444!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x357ca399c58923a3%3A0x9a8865c724c45ed!2z64yA7ZWc67aA7KCV66el7ZWZ7ZqM!5e0!3m2!1sko!2skr!4v1711872425230!5m2!1sko!2skr" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>--}}
{{--                </div>--}}
                <div class="ev-map-info">
                    <ul>
                        @if($conference->zipcode)
                        <li class="address">
                            <span class="tit">주소 : </span>
                            <div class="con">
                                ({{ $conference->zipcode }}) {{ $conference->addr1 }} {{ $conference->addr2 }}
                            </div>
                        </li>
                        @endif
                        @if($conference->tel)
                        <li class="tel">
                            <span class="tit">연락처 : </span>
                            <div class="con view-contents editor-contents">
                                {{ $conference->tel ?? '' }}
                            </div>
                        </li>
                        @endif
                    </ul>
                </div>
            </div>

        </div>
    </article>
@endsection

@section('addScript')
    <script>

    </script>
@endsection
