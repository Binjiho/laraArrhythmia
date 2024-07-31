<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!--[if IE 7]>
<html xmlns="http://www.w3.org/1999/xhtml" lang="eng" xml:lang="eng" class="ie7"><![endif]-->
<!--[if IE 8]>
<html xmlns="http://www.w3.org/1999/xhtml" lang="eng" xml:lang="eng" class="ie8"><![endif]-->
<!--[if IE 9]>
<html xmlns="http://www.w3.org/1999/xhtml" lang="eng" xml:lang="eng" class="ie9"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!-->
<html xmlns="http://www.w3.org/1999/xhtml" lang="eng" xml:lang="eng"><!--<![endif]-->

<head>
    @include('layouts.components.baseHead')
</head>
<body>
<div id="wrap" class="{{ $main_menu == 'main' ? "main" : "sub" }}">
    @include('layouts.include.header')
    <hr/>

    <!--
        메인 class="main"
        회원메뉴 class="sub01"
        마이페이지 class="sub02"
        학회소개 class="sub03"
        공지사항 class="sub04"
        학회지 class="sub05"
        학술행사 class="sub06"
        전공의 class="sub07"
        체외순환사 class="sub08"
        학회자료 class="sub09"
        위원회/분과학회 class="sub10"
        회원공간 class="sub11"
    -->
    <section id="container" class="{{ $main_menu == 'main' ? "main" : "sub" }}">
        @if($main_menu !== 'main')
            @include('layouts.include.titArea')
        @endif

        @yield('contents')
        <!-- contents -->
    </section>
    <!-- container -->

    <article class="sponsor-wrap">
        <div class="sponsor-rolling-wrap js-sponsor-rolling inner-layer">
            <a href="#n" target="_blank"><img src="/assets/image/common/img_sponsor01.png" alt=""></a>
            <a href="#n" target="_blank"><img src="/assets/image/common/img_sponsor02.png" alt=""></a>
            <a href="#n" target="_blank"><img src="/assets/image/common/img_sponsor03.png" alt=""></a>
            <a href="#n" target="_blank"><img src="/assets/image/common/img_sponsor04.png" alt=""></a>
            <a href="#n" target="_blank"><img src="/assets/image/common/img_sponsor05.png" alt=""></a>
            <a href="#n" target="_blank"><img src="/assets/image/common/img_sponsor01.png" alt=""></a>
            <a href="#n" target="_blank"><img src="/assets/image/common/img_sponsor02.png" alt=""></a>
            <a href="#n" target="_blank"><img src="/assets/image/common/img_sponsor03.png" alt=""></a>
            <a href="#n" target="_blank"><img src="/assets/image/common/img_sponsor04.png" alt=""></a>
            <a href="#n" target="_blank"><img src="/assets/image/common/img_sponsor05.png" alt=""></a>
        </div>
    </article>

    <!-- 추가 -->
    <article class="sponsor-wrap">
        <div class="sponsor-rolling-wrap js-sponsor-rolling inner-layer">
            <a href="https://www.bayer.com/ko/kr/korea-home" target="_blank"><img src="/assets/image/common/img_sponsor_bnr01.png" alt=""></a>
            <a href="https://www.bms.com/kr" target="_blank"><img src="/assets/image/common/img_sponsor_bnr02.png" alt=""></a>
            <a href="https://www.pfizerpro.co.kr/medicine/eliquis" target="_blank"><img src="/assets/image/common/img_sponsor_bnr03.gif" alt=""></a>
            <a href="https://www.hanmi.co.kr/business/product/finder/detail-6484.hm" target="_blank"><img src="/assets/image/common/img_sponsor_bnr04.png" alt=""></a>
            <a href="https://www.daiichisankyo.co.kr/product/1/detail?menu=%EC%A0%84%EC%B2%B4&terms=" target="_blank"><img src="/assets/image/common/img_sponsor_bnr_daiichisankyo.png" alt=""></a>
			<a href="#" target="_blank"><img src="/assets/image/common/img_no_sponsor.png" alt=""></a>
            <!-- <a href="https://www.campus.sanofi/kr" target="_blank"><img src="/assets/image/common/img_sponsor_bnr_MULTAQ.png" alt=""></a> -->
            <!-- <a href="#n" target="_blank"><img src="/assets/image/common/img_no_sponsor.png" alt=""></a>
            <a href="#n" target="_blank"><img src="/assets/image/common/img_no_sponsor.png" alt=""></a>
            <a href="#n" target="_blank"><img src="/assets/image/common/img_no_sponsor.png" alt=""></a>
            <a href="#n" target="_blank"><img src="/assets/image/common/img_no_sponsor.png" alt=""></a> -->
        </div>
    </article>

    @include('layouts.include.footer')

    <hr/>
</div>
<!-- //wrapper -->

@include('layouts.components.spinner')
@yield('addScript')
</body>
</html>
