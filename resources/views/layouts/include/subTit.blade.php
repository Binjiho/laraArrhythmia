@php
    if( ($extends_str ?? 'main') == 'pro.layouts.pro-layout'){
        $target_menu = $menu['pro'];
    }else{
        $target_menu = $menu['web'];
    }
    $main_name = $target_menu['main'][$main_menu]['name'] ?? '';
    $sub_name = $target_menu['sub'][$main_menu][$sub_menu]['name'] ?? '';
    $low_name = $target_menu['sub'][$main_menu][$sub_menu]['low'][$low_menu]['name'] ?? '';
    $small_name = $target_menu['sub'][$main_menu][$sub_menu]['low'][$low_menu]['small'][$small_menu ?? 'SS1']['name'] ?? '';
    $sub_class = $target_menu['main'][$main_menu]['class'] ?? '';
@endphp

<div class="sub-tit-wrap">
    <h3 class="sub-tit">{{ $sub_name }}</h3>
</div>

@php
if( $_SERVER['REMOTE_ADDR']=="218.235.94.247") {
    echo "<pre>"; print_r('main_name : '.$main_name); echo "</pre>";

    echo "<pre>"; print_r('$sub_menu : '.$sub_menu); echo "</pre>";
    echo "<pre>"; print_r('sub_name : '.$sub_name); echo "</pre>";

    echo "<pre>"; print_r('low_menu : '.$low_menu); echo "</pre>";
    echo "<pre>"; print_r($low_name); echo "</pre>";

    echo "<pre>"; print_r($small_menu ?? 'SS1'); echo "</pre>";
    echo "<pre>"; print_r($small_name ?? ''); echo "</pre>";
}
@endphp

@if($target_menu['sub'][$main_menu][$sub_menu]['low'])
    <div class="tab-wrap cf">
        <div class="board-cate-wrap sub-tab-wrap">

            <a href="javascript:;" class="btn-tab-menu js-btn-tab-menu">{{ $target_menu['sub'][$main_menu][$sub_menu]['low']['SL1']['name'] ?? '' }}</a>

            <ul class="board-cate sub-tab-menu js-tab-menu n{{ count($target_menu['sub'][$main_menu][$sub_menu]['low']) }}">
                @foreach($target_menu['sub'][$main_menu][$sub_menu]['low'] ?? [] as $key => $val)
                    <li class="{{ ($low_menu ?? '') == $key ? 'on':'' }}"><a href="{{ empty($val['url']) ? route($val['route'], $val['param']) : $val['url'] }}">{{ $val['name'] }}</a></li>
                @endforeach
            </ul>
        </div>

        @if($target_menu['sub'][$main_menu][$sub_menu]['low'][$low_menu]['small'])
        <div class="sub-tab-wrap">
            <a href="javascript:;" class="btn-tab-menu js-btn-tab-menu">{{ $small_name ?? '' }}</a>

            <ul class="sub-tab-menu type2 js-tab-menu n{{ count($target_menu['sub'][$main_menu][$sub_menu]['low'][$low_menu]['small']) }}">
                @foreach($target_menu['sub'][$main_menu][$sub_menu]['low'][$low_menu]['small'] ?? [] as $key => $val)
                    <li class="{{ ($small_menu ?? 'SS1') == $key ? 'on':'' }}"><a href="{{ empty($val['url']) ? route($val['route'], $val['param']) : $val['url'] }}">{{ $val['name'] }}</a></li>
                @endforeach
            </ul>
        </div>
        @endif

    </div>
@endif