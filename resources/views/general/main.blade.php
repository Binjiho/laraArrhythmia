@extends('general.layouts.general-layout')

@section('addStyle')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
@endsection

@section('contents')
<!--
    main일 때 class="main",
    sub일 때 class="sub"
-->

<article class="main-contents inner-layer">
    <ul class="main-menu-list">
        <li>
            <a href="http://k-hrs.m2comm.co.kr/general/know">
                        <span class="icon">
                            <img src="/html/general/assets/image/main/ic_main_menu01.png" alt="">
                        </span>
                <span class="tit">부정맥이란</span>
            </a>
        </li>
        <li>
            <a href="http://k-hrs.m2comm.co.kr/general/know/kind?category=1">
                        <span class="icon">
                            <img src="/html/general/assets/image/main/ic_main_menu02.png" alt="">
                        </span>
                <span class="tit">부정맥의 종류</span>
            </a>
        </li>
        <li>
            <a href="http://k-hrs.m2comm.co.kr/general/know/diagnosis">
                        <span class="icon">
                            <img src="/html/general/assets/image/main/ic_main_menu03.png" alt="">
                        </span>
                <span class="tit">부정맥 진단 방법</span>
            </a>
        </li>
        <li>
            <a href="http://k-hrs.m2comm.co.kr/general/know/therapy?category=1">
                        <span class="icon">
                            <img src="/html/general/assets/image/main/ic_main_menu04.png" alt="">
                        </span>
                <span class="tit">부정맥 치료 방법</span>
            </a>
        </li>
        <li>
            <a href="http://k-hrs.m2comm.co.kr/general/search">
                        <span class="icon">
                            <img src="/html/general/assets/image/main/ic_main_menu05.png" alt="">
                        </span>
                <span class="tit">부정맥 전문가 찾기</span>
            </a>
        </li>
    </ul>
</article>
<article class="main-contents inner-layer">
    <div class="main-conbox">
        <div class="main-video-wrap">
            <div class="main-video-rolling js-video-rolling">
                <div class="main-video-con">
                    <a href="#n">
                        <img src="/html/general/assets/image/main/img_video.png" alt="심장이 '철렁', 부정맥! 큰일나는 거 아닌가?">
                    </a>
                </div>
                <div class="main-video-con">
                    <a href="#n">
                        <img src="/html/general/assets/image/main/img_video.png" alt="심장이 '철렁', 부정맥! 큰일나는 거 아닌가?">
                    </a>
                </div>
            </div>
            <div class="btn-video-wrap text-right">
                <button type="button" class="btn-video btn-video-prev">&lt;<span class="hide">이전</span></button>
                <button type="button" class="btn-video btn-video-next">&gt;<span class="hide">다음</span></button>
            </div>
        </div>
    </div>
    <div class="main-conbox">
        <div class="campaign-conbox">
            <picture>
                <source srcset="/html/general/assets/image/main/img_campaign_m.png" media="(max-width: 768px)">
                <img src="/html/general/assets/image/main/img_campaign.png" alt="">
            </picture>
            <div class="main-tit-wrap">
                <h3 class="main-tit">하트리듬의 날 캠페인</h3>
                <p>
                    11월 11일에는 맥박을 측정해 보세요!
                </p>
            </div>
            <div class="btn-wrap text-center">
                <a href="http://k-hrs.m2comm.co.kr/general/heart" class="btn">자세히 보기 <span class="arrow">&gt;</span></a>
            </div>
        </div>
    </div>
</article>
    
@endsection

@section('addScript')
@endsection