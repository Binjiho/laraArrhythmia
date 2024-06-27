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
    @include('pro.layouts.components.baseHead')
</head>

<body>
<div id="wrap" class="{{ $main_menu == 'main' ? "main" : "sub" }}">
    @include('pro.layouts.include.header')
    <hr/>
    
    <section id="container" class="{{ $main_menu == 'main' ? "main" : "sub" }}">
        @if($main_menu !== 'main')
            @include('pro.layouts.include.titArea')
        @endif

        @yield('contents')
        <!-- contents -->
    </section>
    <!-- container -->

{{--    <article class="sponsor-wrap">--}}
{{--        <div class="sponsor-rolling-wrap js-sponsor-rolling inner-layer">--}}
{{--            <a href="#n" target="_blank"><img src="/assets/image/common/img_sponsor01.png" alt=""></a>--}}
{{--            <a href="#n" target="_blank"><img src="/assets/image/common/img_sponsor02.png" alt=""></a>--}}
{{--            <a href="#n" target="_blank"><img src="/assets/image/common/img_sponsor03.png" alt=""></a>--}}
{{--            <a href="#n" target="_blank"><img src="/assets/image/common/img_sponsor04.png" alt=""></a>--}}
{{--            <a href="#n" target="_blank"><img src="/assets/image/common/img_sponsor05.png" alt=""></a>--}}
{{--            <a href="#n" target="_blank"><img src="/assets/image/common/img_sponsor01.png" alt=""></a>--}}
{{--            <a href="#n" target="_blank"><img src="/assets/image/common/img_sponsor02.png" alt=""></a>--}}
{{--            <a href="#n" target="_blank"><img src="/assets/image/common/img_sponsor03.png" alt=""></a>--}}
{{--            <a href="#n" target="_blank"><img src="/assets/image/common/img_sponsor04.png" alt=""></a>--}}
{{--            <a href="#n" target="_blank"><img src="/assets/image/common/img_sponsor05.png" alt=""></a>--}}
{{--        </div>--}}
{{--    </article>--}}
{{--    <article class="sponsor-wrap">--}}
{{--        <div class="sponsor-rolling-wrap js-sponsor-rolling inner-layer">--}}
{{--            <a href="#n" target="_blank"><img src="/html/pro/assets/image/main/img_sponsor01.png" alt=""></a>--}}
{{--            <a href="#n" target="_blank"><img src="/html/pro/assets/image/main/img_sponsor02.png" alt=""></a>--}}
{{--            <a href="#n" target="_blank"><img src="/html/pro/assets/image/main/img_sponsor03.png" alt=""></a>--}}
{{--            <a href="#n" target="_blank"><img src="/html/pro/assets/image/main/img_sponsor04.png" alt=""></a>--}}
{{--            <a href="#n" target="_blank"><img src="/html/pro/assets/image/main/img_sponsor05.png" alt=""></a>--}}
{{--            <a href="#n" target="_blank"><img src="/html/pro/assets/image/main/img_sponsor01.png" alt=""></a>--}}
{{--            <a href="#n" target="_blank"><img src="/html/pro/assets/image/main/img_sponsor02.png" alt=""></a>--}}
{{--            <a href="#n" target="_blank"><img src="/html/pro/assets/image/main/img_sponsor03.png" alt=""></a>--}}
{{--            <a href="#n" target="_blank"><img src="/html/pro/assets/image/main/img_sponsor04.png" alt=""></a>--}}
{{--            <a href="#n" target="_blank"><img src="/html/pro/assets/image/main/img_sponsor05.png" alt=""></a>--}}
{{--        </div>--}}
{{--    </article>--}}

    @include('pro.layouts.include.footer')

    <hr/>
</div>
<!-- //wrapper -->

@include('pro.layouts.components.spinner')
@yield('addScript')
</body>
</html>
