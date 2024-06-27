@extends('layouts.web-layout')

@section('addStyle')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
@endsection

@section('contents')
<!--
    main일 때 class="main",
    sub일 때 class="sub"
-->
<section id="container" class="main">
    <article class="main-visual">
        <div class="main-visual-wrap js-main-visual">
            <div class="main-visual-con main-visual-con01">
                <picture>
                    <source srcset="/assets/image/main/img_mainvisual01_m.png" media="(max-width: 768px)">
                    <img src="/assets/image/main/img_mainvisual01.png" alt="MISSION: 심장의 건강함 리듬을 지키기 위해 끊임없이 도전하고 헌신한다. + VISION: 부정맥 극볼을 위한 창의적 연구, 인재교육 및 국민인식 개선을 통해 의료의 선진화를 주도해 나가는 학회">
                </picture>
            </div>
            <div class="main-visual-con main-visual-con02">
                <img src="/assets/image/main/img_mainvisual02.png" alt="KHRS 2024. The 16th Auunal Scientific Session of the Korean Heart Rhythm Society. June 21(Fri.) - 22(Sat.), 2024. Grand Walkerhill Seoul, Korea. Beyound Rhythm, Better Life" usemap="#mainvisual02" class="p-show">
                <img src="/assets/image/main/img_mainvisual02_m.png" alt="KHRS 2024. The 16th Auunal Scientific Session of the Korean Heart Rhythm Society. June 21(Fri.) - 22(Sat.), 2024. Grand Walkerhill Seoul, Korea. Beyound Rhythm, Better Life" usemap="#mainvisual02-m" class="m-show">
                <map name="mainvisual02">
                    <area target="_blank" href="https://abstract-hrs.org/abstract/" alt="[Abstract Submission] by April 22, 2024" coords="849,707,1168,620" shape="rect">
                    <area target="_blank" href="https://abstract-hrs.org/registration/" alt="[Pre-Registration] by June 7, 2024" coords="1219,707,1534,618" shape="rect">
                </map>
                <map name="mainvisual02-m">
                    <area target="_blank" href="https://abstract-hrs.org/abstract/" alt="[Abstract Submission] by April 22, 2024" coords="38,472,356,559" shape="rect">
                    <area target="_blank" href="https://abstract-hrs.org/registration/" alt="[Pre-Registration] by June 7, 2024" coords="365,470,681,559" shape="rect">
                </map>
            </div>
			<div class="main-visual-con main-visual-con03">
				<a href="https://abstract-hrs.org/" target="_blank"><img src="/assets/image/main/img_mainvisual03.png" alt="" class="p-show"></a>
				<a href="https://abstract-hrs.org/" target="_blank"><img src="/assets/image/main/img_mainvisual03_m.png" alt="" class="m-show"></a>
			</div>
			<div class="main-visual-con main-visual-con04">
				<a href="https://abstract-hrs.org/" target="_blank"><img src="/assets/image/main/img_mainvisual04.png" alt="" class="p-show"></a>
				<a href="https://abstract-hrs.org/" target="_blank"><img src="/assets/image/main/img_mainvisual04_m.png" alt="" class="m-show"></a>
			</div>
			<div class="main-visual-con main-visual-con05">
				<a href="https://abstract-hrs.org/" target="_blank"><img src="/assets/image/main/img_mainvisual05.png" alt="" class="p-show"></a>
				<a href="https://abstract-hrs.org/" target="_blank"><img src="/assets/image/main/img_mainvisual05_m.png" alt="" class="m-show"></a>
			</div>
			<div class="main-visual-con main-visual-con06">
				<a href="/assets/file/main_bnr_240620.pdf" target="_blank"><img src="/assets/image/main/img_mainvisual06_v2.png" alt="" class="p-show"></a>
				<a href="/assets/file/main_bnr_240620.pdf" target="_blank"><img src="/assets/image/main/img_mainvisual06_m.png" alt="" class="m-show"></a>
			</div>
			<div class="main-visual-con main-visual-con07">
				<img src="/assets/image/main/img_mainvisual07.jpg" alt="" class="p-show">
				<img src="/assets/image/main/img_mainvisual07_m.jpg" alt="" class="m-show">
			</div>
        </div>
        <div class="btn-visual-wrap">
            <button type="button" class="btn-visual btn-visual-prev">&lt;<span class="hide">이전</span></button>
            <button type="button" class="btn-visual btn-visual-next">&gt;<span class="hide">다음</span></button>
        </div>
    </article>
    <article class="main-contents bg-skyblue">
        <div class="quick-menu-wrap inner-layer">
            <div class="main-tit-wrap">
                <h3 class="main-tit">
                    대한부정맥학회
                    <span>Korea Heart Rhythm Society</span>
                </h3>
                <div class="btn-rolling-wrap">
                    <button type="button" class="btn-rolling btn-rolling-prev">&lt;<span class="hide">이전</span></button>
                    <button type="button" class="btn-rolling btn-rolling-next">&gt;<span class="hide">다음</span></button>
                </div>
            </div>
            <div class="quick-menu-list js-quick-menu">
                <a href="{{ route('board',['code'=>'notice']) }}">
                    <span class="icon"><img src="/assets/image/main/ic_main_quick01.png" alt=""></span>
                    <strong class="tit">뉴스 및 공지사항</strong>
                </a>
                <a href="http://k-hrs.m2comm.co.kr/board/conference?abyear=2024">
                    <span class="icon"><img src="/assets/image/main/ic_main_quick02.png" alt=""></span>
                    <strong class="tit">학술대회 일정</strong>
                </a>
                <a href="http://k-hrs.m2comm.co.kr/board/video?category=1">
                    <span class="icon"><img src="/assets/image/main/ic_main_quick03.png" alt=""></span>
                    <strong class="tit">교육자료실</strong>
                </a>
                <a href="http://k-hrs.m2comm.co.kr/board/photo">
                    <span class="icon"><img src="/assets/image/main/ic_main_quick04.png" alt=""></span>
                    <strong class="tit">회원공간</strong>
                </a>
                <a href="http://k-hrs.m2comm.co.kr/overseas/info">
                    <span class="icon"><img src="/assets/image/main/ic_main_quick05.png" alt=""></span>
                    <strong class="tit">해외학회신청</strong>
                </a>
                <a href="http://k-hrs.m2comm.co.kr/research/info">
                    <span class="icon"><img src="/assets/image/main/ic_main_quick06.png" alt=""></span>
                    <strong class="tit">연구비 신청</strong>
                </a>
            </div>
        </div>
    </article>
    <article class="main-contents">
        <div class="inner-layer">
            <div class="main-board-wrap">
                <div class="main-tit-wrap text-center">
                    <h3 class="main-tit">뉴스 및 공지사항</h3>
                </div>
                <div class="notice-list js-notice-rolling cf">

                    @foreach($notice ?? [] as $row)
                    <div class="notice-conbox">
                        <a href="{{ route('board.view', ['code' => 'notice', 'sid' => $row->sid]) }}">
                            <strong class="main-board-tit ellipsis2">{{ $row->subject }}</strong>
                            <span class="main-board-date">{{ $row->created_at ? $row->created_at->format('Y-m-d') : '' }}</span>
                            <div class="main-board-con ellipsis3">
                                {!! $row->content !!}
                            </div>
                        </a>
                    </div>
                    @endforeach

                </div>
                <div class="btn-rolling-wrap">
                    <button type="button" class="btn-rolling btn-rolling-prev">&lt;<span class="hide">이전</span></button>
                    <button type="button" class="btn-rolling btn-rolling-next">&gt;<span class="hide">다음</span></button>
                </div>
                <a href="{{ route('board',['code'=>'notice']) }}" class="btn btn-more"><span class="hide"> 더보기</span></a>
            </div>
        </div>
    </article>
    <article class="main-contents">
        <div class="video-rolling-wrap inner-layer">
            <div class="main-tit-wrap text-center">
                <h3 class="main-tit">부정맥과 심전도 동영상 강의</h3>
            </div>
            <div class="video-rolling swiper-container">
                <div class="swiper-wrapper">
                    @foreach($video ?? [] as $row)
                    <div class="swiper-slide">
                        <a href="{{ route('board.view', ['code' => 'video', 'category' => $row->category, 'sid' => $row->sid]) }}"><img src="{{ $row->thumb_realfile }}" alt=""></a>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="btn-rolling-wrap">
                <button type="button" class="btn-rolling btn-rolling-prev">&lt;<span class="hide">이전</span></button>
                <button type="button" class="btn-rolling btn-rolling-next">&gt;<span class="hide">다음</span></button>
            </div>
        </div>
    </article>
    <article class="main-contents bg-brown">
        <div class="journal-contents inner-layer">
            <div class="img-wrap">
                <img src="/assets/image/main/img_journal.png" alt="International Journal of Arrhythmia">
            </div>
            <div class="text-wrap">
                <span>학회지 안내</span>
                <h3 class="journal-tit">International Journal of Arrhythmia</h3>
                <p class="font-pre">
                    'International Journal of Arrhythmia'는 부정맥과 관련된 새로운 임상 연구, 진료지침, 증례 등을 소개하여 부정맥연구회 회원 및 개원의의 지속적인 의학교육에 이바지하고자 발행되는 학술지입니다.
                </p>
                <div class="btn-wrap cf">
                    <a href="https://www.e-arrhythmia.org/" class="btn btn-journal" target="_blank">국문 홈페이지 바로가기</a>
                    <a href="https://arrhythmia.biomedcentral.com/" class="btn btn-journal btn-line" target="_blank">영문 홈페이지 바로가기</a>
                </div>
            </div>
        </div>
    </article>

</section>

@endsection

@section('addScript')
    <script type="text/javascript" src="{{ asset('script/popup.common.js') }}"></script>
    <script>
        @php
            /* popup img 업로드시 폴더 경로 public/image/popup 에 올려주셔야 합니다. */
        @endphp

        $(function() {
            // const popupList = {
                //'popup_01': {
                //   'img': 'pop231017.png', // 이미지 명
                //   'link': 'https://www.ktcvs.or.kr/auth/login', // 링크 설정시 없을경우 ''
                //  'position_x': 0, // 왼쪽부터
                // 'position_y': 0, // 위에서부터
                // },


                // 'popup_0': {
                //     'path': '',
                //     'position_x': '',
                //     'position_y': '',
                // },

                // 'popup_02': {
                //     'path': '',
                //     'position_x': '',
                //     'position_y': '',
                // },
            // }

            let popupList = [];
            @foreach($popupList ?? [] as $row /*게시판 팝업입니다*/)
                popupList[ {{ $row->sid }} ] = {
                @if($row->popupSelect == '2'/*popup 컨텐츠사용*/)
                    'popup_contents': `{!! $row->popup_content !!}`,
                @else
                    'popup_contents': `{!! $row->content !!}`,
                @endif
                'link': '{{ $row->popup_link ?? '' }}',
                'popup_width': '{{ $row->popup_width }}',
                'popup_height': '{{ $row->popup_height }}',
                'popup_position_x': '{{ $row->popup_position_x }}',
                'popup_position_y': '{{ $row->popup_position_y }}',
                'popup_skin': '{{ $row->popup_skin }}',
                'popup_detail': '{{ $row->popup_detail }}',
                'sid': '{{ $row->sid }}',
                'subject': '{{ $row->subject }}',
                'case' : 'main-popup',
                'key' : '{{ $row->sid }}',
            }
            @endforeach

            for(var key in popupList){
                const popNm = 'popup_'+key;
                if(isEmpty(getCookie(popNm))) {
                    callNoneSpinnerAjax('{{ route('main.data') }}', popupList[key]);
                }
            }

        });
    </script>
@endsection