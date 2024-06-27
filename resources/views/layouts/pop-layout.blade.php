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
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ env('APP_NAME') }}</title>
    
    @if(CheckUrl() === 'admin')
        <link type="text/css" rel="stylesheet" href="{{ asset('assets/css/ktcvs_admin.css') }}?v={{ config('site.default.asset_version') }}">
    @endif

    {{-- base css --}}
    <link rel="icon" href="/assets/image/favicon.ico">
    <link href="https://cdn.jsdelivr.net/gh/orioncactus/pretendard@v1.3.5/dist/web/variable/pretendardvariable.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/gh/sun-typeface/SUITE/fonts/variable/woff2/SUITE-Variable.css" rel="stylesheet">
    <link rel="stylesheet" href="/assets/css/jquery-ui.min.css">
    <link rel="stylesheet" href="/assets/css/slick.css">
    <link rel="stylesheet" href="{{ asset('plugins/flatpickr/css/flatpickr.min.css') }}">
    <link rel="stylesheet" href="/assets/css/common.css">

    @yield('addStyle')

    {{-- Scripts --}}
    <script src="/assets/js/jquery-1.12.4.min.js"></script>
    <script src="/assets/js/jquery-ui.min.js"></script>
    <script src="/assets/js/slick.min.js"></script>
    <script src="/assets/js/common.js"></script>
    <script src="{{ asset('plugins/moment/js/moment.min.js') }}"></script>
    <script src="{{ asset('plugins/crypto-js/crypto-js.min.js') }}"></script>
    <script src="{{ asset('plugins/flatpickr/js/flatpickr.min.js') }}"></script>
{{--    <script src="{{ asset('plugins/flatpickr/js/flatpickr-ko.min.js') }}"></script>--}}
    <script src="{{ asset('plugins/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('script/app.common.js') }}?v={{ config('site.app.asset_version') }}"></script>

    @if(Session::has('msg') && !empty(Session::get('msg')))
        <script>
            alert('{!! Session::pull("msg") !!}');
        </script>
    @endif
    {{-- Scripts --}}
</head>
<body>
@yield('contents')

@yield('addScript')
</body>
</html>