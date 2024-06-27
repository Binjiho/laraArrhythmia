<header id="header" class="js-header">
    <div class="util-wrap font-pre">
        <div class="inner-layer wide">
            <ul class="util-link-menu">
                <li><a href="{{ route('pro') }}">전문기술인회 홈페이지</a></li>
                <li><a href="{{ route('general') }}">일반인 홈페이지</a></li>
				<li><a href="{{ route('eng') }}">ENGLISH</a></li>
                <li><a href="{{ route('intro') }}">INTRO</a></li>
            </ul>

            <ul class="util-menu">
            @if(thisAuth()->check())
                <li class="mypage">
                    <a href="{{ route('mypage.intro') }}">MY PAGE</a>
                </li>
                <li class="logout">
                    <a href="javascript:logout();" id="logout_btn">LOGOUT</a>
                </li>
            @else
                <li class="signup">
                    <a href="{{ route('auth.info') }}">SIGN UP</a>
                </li>
                <li class="login">
                    <a href="{{ route('login') }}">LOGIN</a>
                </li>
            @endif

            @if(thisAuth()->check() && getLevel() === 'M')
                <li class="admin">
                    <a href="{{ env('APP_URL') }}/admin">ADMIN</a>
                </li>
            @endif

            </ul>
        </div>
    </div>

{{--  모바일  --}}
    <div id="dim" class="js-dim"></div>
    <div class="header-wrap">
        <div class="inner-layer wide">
            <h1 class="header-logo">
                <a href="{{ route('main') }}"><span class="hide">대한부정맥학회 Korean Heart Rhythm Society</span></a>
            </h1>
            <div class="gnb-wrap">
                <div class="gnb-header">
                    <ul class="util-menu">
                        @if(thisAuth()->check())
                            <li class="mypage">
                                <a href="{{ route('mypage.intro') }}">MY PAGE</a>
                            </li>
                            <li class="logout">
                                <a href="javascript:logout();" id="logout_btn">LOGOUT</a>
                            </li>
                        @else
                            <li class="signup">
                                <a href="{{ route('auth.info') }}">SIGN UP</a>
                            </li>
                            <li class="login">
                                <a href="{{ route('login') }}">LOGIN</a>
                            </li>
                        @endif

                        @if(thisAuth()->check() && getLevel() === 'M')
                            <li class="admin">
                                <a href="{{ env('APP_URL') }}/admin">ADMIN</a>
                            </li>
                        @endif
                    </ul>
                    
                </div>
                <nav id="gnb">
                    <ul class="gnb js-gnb">
                        @foreach($menu['web']['main'] as $key => $val)
                            @if($val['continue']) @continue @endif
                            <li>
                                <a href="{{ empty($val['url']) ? route($val['route'], $val['param']) : $val['url'] }}">{{ $val['name'] }}</a>

                                @foreach($menu['web']['sub'][$key] ?? [] as $sKey => $sVal)
                                    @if($loop->first)
                                        <div class="inner-layer wide">
                                            <div class="gnb-img"></div>
                                            <ul>
                                    @endif

                                            <li><a href="{{ empty($sVal['url']) ? route($sVal['route'], $sVal['param']) : $sVal['url'] }}">{{ $sVal['name'] }}</a></li>

                                    @if($loop->last)
                                            </ul>
                                        </div>
                                    @endif
                                @endforeach
                            </li>
                        @endforeach
                    </ul>
                </nav>
                <button type="button" class="btn-menu-close js-btn-menu-close"><span class="hide">메뉴 닫기</span></button>
            </div>

            <button type="button" class="btn-menu-open js-btn-menu-open"><span class="hide">메뉴 열기</span></button>
        </div>
    </div>
</header>
<!-- //headerWrap -->