@extends($extends_str)

@section('addStyle')
@endsection

@section('contents')
    <article class="sub-contents">
        <div class="sub-conbox inner-layer">
            <div class="sub-tit-wrap">
                <h3 class="sub-tit">학술행사 자료</h3>
            </div>
            <div class="ev-banner type2">
                <strong class="ev-tit">{{ $board->subject ?? '' }}</strong>
                <ul>
                    <li>{{ $board->event_sdate ?? '' }} {{ $board->event_edate ? '~'.$board->event_edate : '' }}</li>
                    <li>{{ $board->place ?? '' }}</li>
                </ul>
            </div>

            @if(isAdmin())
            <div class="top-btn-wrap">
                <a href="{{ route('library.program',['bsid'=>$board->sid ]) }}" class="btn btn-type1 btn-add-session color-type2">세부 프로그램 등록</a>
            </div>
            @endif

            @foreach($list as $row)

            <div class="table-wrap">
                <table class="cst-table session-table">
                    <caption class="hide">프로그램</caption>
                    <colgroup>
                        <col style="width: 13%;">
                        <col>
                    </colgroup>
                    <thead>
                    <tr>
                        <th scope="col" colspan="2" class="text-left">
                            <strong class="session-tit">{{ $row->title ?? '' }}</strong>
                            <p class="text-right">
                                {{ $row->room ?? '' }} <br>
                                {{ $row->chair_person ?? '' }}
                            </p>
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($row->programs as $item)
                        <tr>
                            <td>
                                <input type="hidden" name='sid[]' value="{{ $item->sid }}">
                                <strong class="time">{{ $item->time ?? '' }}</strong>
                            </td>
                            <td class="text-left">
                                <div class="session-con">
                                    <div class="session-info">
                                        <strong class="tit">{{ $item->title ?? '' }}</strong>
                                        <p>
                                            {{ $item->speaker ?? '' }}
                                        </p>
                                    </div>
                                    <div class="btn-admin">
                                        @if($item->link_url)
                                            <a href="{{ $item->link_url }}" target="_blank"><img src="/assets/image/sub/ic_video.png" alt=""></a>
                                        @endif
                                        @if($item->thumb_file)
                                            <a href="{{ $item->downloadFileUrl('thumb_realfile', 'thumb_file') }}" target="_blank"><img src="/assets/image/sub/ic_session_file.png" alt=""></a>
                                        @endif

                                        @if(isAdmin())
                                            <button type="button" class="btn btn-arrow" onclick="BsJs_setOrd(this,'up')"><img src="{{ asset('assets/image/icon/ic_arrow_top.png') }}" alt="위로"></button>
                                            <button type="button" class="btn btn-arrow" onclick="BsJs_setOrd(this,'down')"><img src="{{ asset('assets/image/icon/ic_arrow_bottom.png') }}" alt="아래로"></button>

                                            <a href="{{ route('library.program',['bsid'=>$board->sid ]) }}" class="btn btn-board btn-modify">수정</a>
{{--                                            <a href="#n" class="btn btn-board btn-delete">삭제</a>--}}
                                       @endif
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @endforeach
        </div>
    </article>
@endsection

@section('addScript')

    <script>
        const dataUrl = '{{ route('library.data') }}';

        function BsJs_setOrd(el, mode) {

            var target = $(el).closest($("tr"));
            if( mode == "down" ){
                target.next().after(target);
            }else{
                target.prev().before(target);
            }

            // if(!confirm("순서를 변경하시겠습니까?")){
            //     location.reload();
            //     return false;
            // }
            var array_sid = [];

            // 순서대로 array_sid 가져와서 배열에 담기
            $("input[name='sid[]']").each(function() {
                array_sid.push($(this).val());
            });

            callAjax(dataUrl, {
                'case': 'sort-change',
                "array_sid": array_sid.join(','),
                "targetDB": 'session_programs',
                "targetVAL": 'sort',
            });

        }

        $(document).on('change', "#abyear", function() {
            const url = '{{ route('board', ['code' => 'conference', 'category' => request()->category]) }}'
            location.replace(url + '&abyear=' + $(this).val());
        });

        $(document).on('click', '.btn-delete', function() {
            const _case = $(this).hasClass('reply') ? 'reply-delete' : 'board-delete';

            if (confirm('정말로 삭제 하시겠습니까?')) {
                callAjax(dataUrl, { case: _case, sid: $(this).closest('li').data('sid') });
            }
        });

        $(document).on('change', ".hidesel", function() {
            const _case = 'board-hide';
            const _hide = $(this).find('option:selected').val();

            if (confirm('게시글 공개 여부를 변경 하시겠습니까?')) {
                callAjax(dataUrl, { case: _case, sid: $(this).closest('li').data('sid'), hide: _hide }, true);
            }
        });
    </script>
@endsection
