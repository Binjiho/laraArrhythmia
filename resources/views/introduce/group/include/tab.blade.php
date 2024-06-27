<div class="sub-tab-wrap">
    <ul class="sub-tab-menu n4 cf">
        <li class="{{ $category == 'list' ? 'on' : '' }}"><a href="{{ route('introduce.group.list') }}">연구회</a></li>
        <li class="{{ $category == 'branch' ? 'on' : '' }}"><a href="{{ route('introduce.group.branch') }}">지회</a></li>
        <li class="{{ $category == 'guide' ? 'on' : '' }}"><a href="{{ route('introduce.group.guide') }}">연구회 / 지회 신청안내</a></li>
        <li class="{{ $category == 'join' ? 'on' : '' }}"><a href="{{ route('introduce.group.join') }}">연구회 / 지회 회원가입</a></li>
    </ul>
</div>