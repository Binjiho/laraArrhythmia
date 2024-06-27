{{-- base css --}}
<link rel="icon" href="/assets/image/favicon.ico">
<link href="https://cdn.jsdelivr.net/gh/orioncactus/pretendard@v1.3.5/dist/web/variable/pretendardvariable.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/gh/sun-typeface/SUITE/fonts/variable/woff2/SUITE-Variable.css" rel="stylesheet">
<link rel="stylesheet" href="/assets/css/jquery-ui.min.css">
<link rel="stylesheet" href="/assets/css/slick.css">
<link rel="stylesheet" href="{{ asset('plugins/flatpickr/css/flatpickr.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}">
<link rel="stylesheet" href="/html/general/assets/css/common.css">
{{--<link rel="stylesheet" href="/assets/css/common.css">--}}

{{-- addCss --}}
@yield('addStyle')
