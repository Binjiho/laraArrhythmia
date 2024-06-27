@extends('eng.layouts.eng-layout')

@section('addStyle')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
@endsection

@section('contents')
<!--
    main일 때 class="main",
    sub일 때 class="sub"
-->

<article class="main-visual js-main-visual">
    <div class="main-visual-con main-visual-con01">
        <div class="main-visual-text inner-layer">
            <h2 class="main-visual-tit font-gmaket">
                Welcome To
                <strong>Korean Heart Rhythm Society</strong>
            </h2>
            <p>
                The Korean Heart Rhythm Society shares a variety of <br>
                information for the general public and specialists
            </p>
        </div>
    </div>
    <!-- <div class="main-visual-con main-visual-con02">
        <div class="main-visual-text inner-layer">
            <h2 class="main-visual-tit font-gmaket">
                Welcome To
                <strong>Korean Heart Rhythm Society</strong>
            </h2>
            <p>
                The Korean Heart Rhythm Society shares a variety of <br>
                information for the general public and specialists
            </p>
        </div>
    </div>
    <div class="main-visual-con main-visual-con03">
        <div class="main-visual-text inner-layer">
            <h2 class="main-visual-tit font-gmaket">
                Welcome To
                <strong>Korean Heart Rhythm Society</strong>
            </h2>
            <p>
                The Korean Heart Rhythm Society shares a variety of <br>
                information for the general public and specialists
            </p>
        </div>
    </div> -->
</article>
<article class="main-contents inner-layer cf">
    <div class="journal-conbox">
        <div class="img-wrap">
            <img src="/html/eng/assets/image/main/img_journal.png" alt="International Journal of Arrhythmia">
        </div>
        <div class="text-wrap">
            <a href="/eng/journal" class="btn btn-journal">About the Journal <span class="arrow"></span></a> <br>
            <a href="/eng/journal/submission" class="btn btn-journal">Online Submission <span class="arrow"></span></a>
            <p>
                International Journal of <br>
                <strong>Arrhythmia</strong>
            </p>
        </div>
    </div>
    <div class="main-menu-wrap">
        <a href="/eng/about">
            <span class="icon"></span>
            <span class="tit">About KHRS</span>
        </a>
        <a href="/board/noticeEng">
            <span class="icon"></span>
            <span class="tit">News</span>
        </a>
        <a href="/eng/about/info">
            <span class="icon"></span>
            <span class="tit">Contact Us</span>
        </a>
    </div>
</article>
    
@endsection

@section('addScript')
@endsection