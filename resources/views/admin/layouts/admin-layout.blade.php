<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!--[if IE 7]><html xmlns="http://www.w3.org/1999/xhtml" lang="eng" xml:lang="eng" class="ie7"><![endif]-->
<!--[if IE 8]><html xmlns="http://www.w3.org/1999/xhtml" lang="eng" xml:lang="eng" class="ie8"><![endif]-->
<!--[if IE 9]><html xmlns="http://www.w3.org/1999/xhtml" lang="eng" xml:lang="eng" class="ie9"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--><html xmlns="http://www.w3.org/1999/xhtml" lang="eng" xml:lang="eng"><!--<![endif]-->
<head>
    @include('admin.layouts.components.baseHead')
</head>
<body>
<div class="wrapper">
    @include('admin.layouts.include.header')

    <hr />

    <!-- containerWrap -->
    <!-- <div id="containerWrap" class="gnbLeft"> -->
    <div id="containerWrap" class="gnbTop">
        <div class="container">
            @include('admin.layouts.include.gnbWrap')

            @yield('contents')
            <!-- //contents -->
        </div>
        <!-- //container -->
    </div>
    <!-- //containerWrap -->
    <hr />
</div>

@include('admin.layouts.components.spinner')
@yield('addScript')
</body>
</html>
