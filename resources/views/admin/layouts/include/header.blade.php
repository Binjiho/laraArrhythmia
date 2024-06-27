<!-- headerWrap -->
<div id="headerWrap">
    <!-- skip navigation -->
    <dl id="skipNavi">
        <dt>바로가기 메뉴</dt>
        <dd><a href="#container">본문내용 바로가기</a></dd>
        <dd><a href="#footerWrap">하단내용 바로가기</a></dd>
    </dl>
    <!-- //skip navigation -->

    <!-- header -->
    <div class="header">
        <h1><a href="{{ route('main') }}"><img src="/assets/image/common/h1_logo_on.png" alt="{{ env('APP_NAME') }}" /></a></h1>

        <!-- util menu -->
        <dl id="utilMenu">
            <dt class="hidden">유틸메뉴</dt>
            <dd>
                <ul class="clfix">
                    <li><a href="{{ env('APP_URL') }}" target="_blank">홈페이지</a></li>
                    <li><a href="javascript:logout();">LOGOUT</a></li>
                </ul>
            </dd>
        </dl>
        <!-- //util menu -->
    </div>
    <!-- //header -->
</div>
<!-- //headerWrap -->
