@php
    $main_name = $menu['web']['main'][$main_menu]['name'] ?? '';
    $sub_name = $menu['web']['sub'][$main_menu][$sub_menu]['name'] ?? '';
    $sub_class = $menu['web']['main'][$main_menu]['class'] ?? '';

@endphp

<article class="sub-visual {{ $sub_class }}">
    <div class="sub-visual-con">
        <div class="sub-visual-text inner-layer">
            <h2 class="sub-visual-tit">{{ $main_name }}</h2>
            <ul class="breadcrumb">
                <li>{{ $main_name }}</li>
                @if(!empty($sub_name))
                    <li>{{ $sub_name }}</li>
                @endif
            </ul>
        </div>
    </div>
</article>


<article class="sub-menu-wrap">
    <div class="sub-menu inner-layer">
        <a href="/" class="btn-home"><span class="hide">홈</span></a>
        <ul class="sub-menu-list js-sub-menu-list">
            {{--모바일--}}
            <li class="sub-menu-depth01">
                @foreach($menu['web']['main'] as $key => $val)
                    @if($loop->first)
                        <a href="{{ empty($menu['web']['main'][$main_menu]['url']) ? route($menu['web']['main'][$main_menu]['route'], $menu['web']['main'][$main_menu]['param']) : $menu['web']['main'][$main_menu]['url'] }}" class="btn-sub-menu js-btn-sub-menu">{{ $menu['web']['main'][$main_menu]['name'] }}</a>
                        <ul>
                    @endif

                    @if($val['continue']) @continue @endif

                        <li><a href="{{ empty($val['url']) ? route($val['route'], $val['param']) : $val['url'] }}">{{ $val['name'] }}</a></li>

                    @if($loop->last)
                        </ul>
                    @endif
                @endforeach
            </li>

            <li class="sub-menu-depth02">
                @foreach($menu['web']['sub'][$main_menu] ?? [] as $key => $val)
                    @if($loop->first)
                        <a href="{{ empty($menu['web']['sub'][$main_menu][$key]['url']) ? route($menu['web']['sub'][$main_menu][$key]['route'], $menu['web']['sub'][$main_menu][$key]['param']) : $menu['web']['sub'][$main_menu][$key]['url'] }}" class="btn-sub-menu js-btn-sub-menu">{{ $sub_name }}</a>
                        <ul>
                    @endif

                            <li class="{{ $key == $sub_menu ? 'on' : '' }}"><a href="{{ empty($val['url']) ? route($val['route'], $val['param']) : $val['url'] }}">{{ $val['name'] }}</a></li>

                    @if($loop->last)
                        </ul>
                    @endif
                @endforeach
            </li>
        </ul>
    </div>
</article>