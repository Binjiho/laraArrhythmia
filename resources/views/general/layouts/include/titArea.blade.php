@php
    $menu = config('site.menu')['general'];
    $main_name = $menu['main'][$main_menu]['name'] ?? '';
    $sub_name = $menu['sub'][$main_menu][$sub_menu]['name'] ?? '';
    $sub_class = $menu['main'][$main_menu]['class'] ?? '';
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
        <ul class="sub-menu-list">
            <li class="sub-menu-depth01">
                <a href="#n" class="btn-sub-menu js-btn-sub-menu">{{$main_name}}</a>
                <ul>
                    @foreach($menu['main'] ?? [] as $key => $val)
                        <li class="{{ $main_menu === $key ? 'on' : '' }}">
                            <a href="{{ route($val['route'], $val['param']) }}">{{ $val['name'] }}</a>
                        </li>
                    @endforeach
                </ul>
            </li>
            @if(!empty($sub_name))
            <li class="sub-menu-depth02">
                <a href="#n" class="btn-sub-menu js-btn-sub-menu">{{$sub_name}}</a>
                <ul>
                    @foreach($menu['sub'][$main_menu] ?? [] as $key => $row)
                        <li class="{{ $sub_menu === $key ? 'on' : '' }}">
                            @empty($row['route'])
                                <a href="{{ $row['url'] }}" {{ strpos($row['url'],'javascript:alert') !== false  ? 'target=_blank' : '' }}><span>{{ $row['name'] }}</span></a>
                            @else
                                <a href="{{ route($row['route'], $row['param']) }}"><span>{{ $row['name'] }}</span></a>
                            @endempty
                        </li>
                    @endforeach
                </ul>
            </li>
            @endif
        </ul>
    </div>
</article>