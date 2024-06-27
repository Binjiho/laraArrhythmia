<!-- gnbWrap -->
<h2 class="hidden">주 메뉴</h2>

<div class="gnbWrap">
    <ul id="gnbUI">
        @foreach($menu['admin']['main'] ?? [] as $key => $val)
            <li style="width: 199px;" class="">
                <a href="{{ route($val['route'], $val['param']) }}">{{ $val['name'] }}</a>

                <ul style="min-width: 199px; display: none;">
                    @foreach($menu['admin']['sub'][$key] ?? [] as $sKey => $sVal)
                        <li>
                            @empty($sVal['route'])
                                <a href="{{ $sVal['url'] }}">{{ $sVal['name'] }}</a>
                            @else
                                <a href="{{ route($sVal['route'], $sVal['param']) }}">{{ $sVal['name'] }}</a>
                            @endempty
                        </li>
                    @endforeach
                </ul>
            </li>
        @endforeach
    </ul>
</div>
<!-- //gnbWrap -->
