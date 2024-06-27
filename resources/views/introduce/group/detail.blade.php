@extends('layouts.web-layout')

@section('addStyle')
@endsection

@section('contents')
    <article class="sub-contents" style="min-height: 656px;">
        <div class="sub-conbox inner-layer">
            <div class="research-tit-wrap">
                <h3 class="research-tit">{{ $group->subject ?? '' }}</h3>
            </div>

            <div class="sub-contit-wrap">
                <h4 class="sub-contit">연구회 조직</h4>
            </div>
            <div class="table-wrap">
                <table class="cst-table">
                    <caption class="hide">연구회 조직</caption>
                    <colgroup>
                        <col style="width: 20%;">
                        <col style="width: 30%;">
                        <col style="width: 50%;">
                    </colgroup>
                    <thead>
                    <tr>
                        <th scope="col">직책</th>
                        <th scope="col">성명</th>
                        <th scope="col">소속</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($group->members as $key => $value)
                    <tr>
                        <td>{{ $value->position ?? '' }}</td>
                        <td>{{ $value->name_kr ?? '' }}</td>
                        <td>{{ $value->sosok ?? '' }}</td>
                    </tr>
                    @empty
                        <tr>
                            <td colspan="3">소속 인원이 없습니다.</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>

            <div class="sub-contit-wrap">
                <h4 class="sub-contit">학술활동</h4>
                @if(isAdmin())
                    <a href="{{ route('introduce.group.conference.upsert', ['g_sid' => $group->sid ]) }}" class="full-right btn btn-type1 color-type17"><span class="plus">+</span> 연혁 추가</a>
                @endif

            </div>
            <div id="board" class="board-wrap">
                <ul class="board-list">
                    <li class="list-head">
                        <div class="bbs-event">행사명</div>
                        <div class="bbs-place">장소</div>
                        <div class="bbs-regi-date">일시</div>
                        <div class="bbs-admin">관리</div>
                    </li>
                    @forelse($group->group_conferences as $key => $value)
                        <li>
                            <div class="bbs-event"><a href="{{ route('introduce.group.conference.view',['sid' => $value->sid ]) }}">{{$value -> subject }}</a></div>
                            <div class="bbs-place"> {{$value -> place }} </div>
                            <div class="bbs-regi-date">
                                {{$value -> event_sdate }} {{ $value->event_edate ? ' ~ '.$value->event_edate: ''}}
                            </div>
                            <div class="bbs-admin">
                                <div class="btn-admin">
                                    <a href="{{ route('introduce.group.conference.upsert', ['g_sid' => $value->g_sid, 'sid' => $value->sid  ]) }}" class="btn btn-board btn-modify">수정</a>
                                    <a href="#n" class="btn btn-board btn-delete" data-sid="{{ $value->sid }}" >삭제</a>
                                </div>
                            </div>
                        </li>
                    @empty
                        <li class="no-data">
                            학술대회가 없습니다.
                        </li>
                    @endforelse

                </ul>
            </div>

{{--            <div class="paging-wrap">--}}
{{--                <ul class="paging">--}}
{{--                    <li class="first"><a href="#n"><img src="/assets/image/board/ic_first.png" alt=""></a></li>--}}
{{--                    <li class="prev"><a href="#n"><img src="/assets/image/board/ic_prev.png" alt=""></a></li>--}}
{{--                    <li class="num"><a href="#n">1</a></li>--}}
{{--                    <li class="num"><a href="#n">2</a></li>--}}
{{--                    <li class="num"><a href="#n">3</a></li>--}}
{{--                    <li class="num"><a href="#n">4</a></li>--}}
{{--                    <li class="num"><a href="#n">5</a></li>--}}
{{--                    <li class="next"><a href="#n"><img src="/assets/image/board/ic_next.png" alt=""></a></li>--}}
{{--                    <li class="last"><a href="#n"><img src="/assets/image/board/ic_last.png" alt=""></a></li>--}}
{{--                </ul>--}}
{{--            </div>--}}

        </div>
    </article>
@endsection

@section('addScript')

    <script>
        $(document).on('click', '.btn-delete', function() {
            const _sid = $(this).data('sid');
            if (confirm('정말로 삭제 하시겠습니까?')) {
                callAjax( '{{ route('introduce.group.data') }}', { case: 'board-delete', sid: _sid, g_sid: {{ $group->sid }} });
            }
        });
    </script>

@endsection