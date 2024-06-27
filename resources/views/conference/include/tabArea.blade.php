@php
    $tab_cnt = 5;
    if($conference->regist_yn != 'Y') $tab_cnt--;
    if($conference->abs_yn != 'Y') $tab_cnt--;
@endphp

<div class="tab-wrap cf">
    <div class="board-cate-wrap sub-tab-wrap">
        <a href="{{ route('conference.detail', ['sid'=>$conference->sid, 'tab'=>'1']) }}" class="btn-tab-menu js-btn-tab-menu">초대의 글</a>
        <ul class="sub-tab-menu type3 n{{$tab_cnt}} cf js-tab-menu">
            <li class="{{ ($tab ?? '')=='1' ? 'on' : '' }}"><a href="{{ route('conference.detail', ['sid'=>$conference->sid, 'tab'=>'1']) }}">초대의 글</a></li>
            <li class="{{ ($tab ?? '')=='2' ? 'on' : '' }}"><a href="{{ route('conference.detail', ['sid'=>$conference->sid, 'tab'=>'2']) }}">프로그램</a></li>
            @if($conference->regist_yn == 'Y')
            <li class="{{ ($tab ?? '')=='3' ? 'on' : '' }}"><a href="{{ route('conference.detail', ['sid'=>$conference->sid, 'tab'=>'3']) }}">등록안내</a></li>
            @endif
            @if($conference->abs_yn == 'Y')
            <li class="{{ ($tab ?? '')=='4' ? 'on' : '' }}"><a href="{{ route('conference.detail', ['sid'=>$conference->sid, 'tab'=>'4']) }}">초록접수</a></li>
            @endif
            <li class="{{ ($tab ?? '')=='5' ? 'on' : '' }}"><a href="{{ route('conference.detail', ['sid'=>$conference->sid, 'tab'=>'5']) }}">오시는 길</a></li>
        </ul>
    </div>

    @if($tab == '3' || $tab == '4')
        <div class="sub-tab-wrap">
            <a href="{{ route('conference.detail', ['sid'=>$conference->sid, 'tab'=>$tab]) }}" class="btn-tab-menu js-btn-tab-menu">{{ ($tab ?? '3') == '3' ? '온라인 사전등록':'초록접수' }}</a>
            <ul class="sub-tab-menu type2 js-tab-menu n2">
                <li class="{{ ($sub ?? '1') == '1' ? 'on' : '' }}"><a href="{{ route('conference.detail', ['sid'=>$conference->sid, 'tab'=>$tab]) }}">{{ ($tab ?? '3') == '3' ? '온라인 사전등록':'초록접수' }}</a></li>
                <li class="{{ ($sub ?? '1') == '2' ? 'on' : '' }}"><a href="{{ route('conference.confirm', ['sid'=>$conference->sid, 'tab'=>$tab]) }}">{{ ($tab ?? '3') == '3' ? '사전등록 확인':'초록접수 확인' }}</a></li>
            </ul>
        </div>
    @endif
</div>