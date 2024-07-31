@extends('layouts.web-layout')

@section('addStyle')
@endsection

@section('contents')
<article class="sub-contents">
    <div class="sub-conbox inner-layer">

        @include('layouts.include.subTit')

        <div id="board" class="board-wrap">
            <div class="sch-form-wrap">
                <form action="{{ route('board', ['code' => $code]) }}" method="get">
                    <fieldset>
                        <legend class="hide">검색</legend>
                        <div class="sch-wrap">
                            <span class="cnt">총 게시글 <strong class="text-skyblue">{{ number_format($total) }}</strong>건</span>
                            <div class="form-group">
                                <select name="search" id="search" class="form-item sch-cate">
                                    @foreach($boardConfig['search'] as $key => $val)
                                        <option value="{{ $key }}" {{ ((request()->search ?? '') == $key) ? 'selected'  : '' }}>{{ $val }}</option>
                                    @endforeach
                                </select>

                                <input type="text" name="keyword" id="keyword" class="form-item sch-key" placeholder="검색하실 내용을 입력해주세요." value="{{ request()->keyword ?? '' }}">
                                <button type="submit" class="btn btn-sch"><span class="hide">검색</span></button>
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>

            <ul class="board-list">
                <li class="list-head">
                    <div class="bbs-no">번호</div>
                    <div class="bbs-tit">제목</div>
                    <div class="bbs-file">첨부파일</div>
                    <div class="bbs-date">작성일</div>
                    <div class="bbs-hit">조회수</div>

                    @if(isAdmin())
                        <div class="bbs-show">공개여부</div>
                        <div class="bbs-admin">관리</div>
                    @endif
                </li>

                @foreach($notice ?? [] as $key => $row)
                    <li class="active" data-sid="{{ $row->sid }}">
                        <div class="bbs-no">
                            @if($row->notice == 'Y')
                                <img src="/assets/image/board/ic_notice1.png" alt="공지" class="ic-notice">
                            @else
                                {{ $row->seq }}
                            @endif
                        </div>
                        <div class="bbs-tit">
                            <a href="{{ route('board.view', ['code' => $code, 'sid' => $row->sid]) }}" class="ellipsis">
                                {{ $row->subject }}
                            </a>
                            @if($row->isNew())
                                <span class="new">new</span>
                            @endif
                        </div>
                        <div class="bbs-file">
                            @if(($row->files_count ?? 0) > 0)
                                <a href="{{ $row->plDownloadUrl() }}">
                                    <img src="/assets/image/board/ic_attach_file.png" alt="">
                                </a>
                            @endif
                        </div>
                        <div class="bbs-date">{{ $row->created_at->format('Y-m-d') }}</div>
                        <div class="bbs-hit">{{ number_format($row->ref) }}</div>

                        @if(isAdmin())
                            <div class="bbs-show">
                                <select name="hide" class="form-item">
                                    @foreach($boardConfig['options']['hide'] as $key => $val)
                                        <option value="{{ $key }}" {{ $row->hide == $key ? 'selected' : '' }}>{{ $val }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="bbs-admin">
                                <div class="btn-admin">
                                    <a href="{{ route('board.upsert', ['code' => $code, 'sid' => $row->sid]) }}" class="btn btn-board btn-modify">수정</a>
                                    <a href="javascript:void(0);" class="btn btn-board btn-delete">삭제</a>
                                </div>
                            </div>
                        @endif
                    </li>
                @endforeach
                

                @foreach($list ?? [] as $row)
                    <li -class="active" data-sid="{{ $row->sid }}">
                        <div class="bbs-no">
                            @if($row->notice == 'Y')
                                <img src="/assets/image/board/ic_notice.png" alt="공지" class="ic-notice">
                            @else
                                {{ $row->seq }}
                            @endif
                        </div>
                        <div class="bbs-tit">
                            <a href="{{ route('board.view', ['code' => $code, 'sid' => $row->sid]) }}" class="ellipsis">
                                {{ $row->subject }}
                            </a>
                            @if($row->isNew())
                                <span class="new">new</span>
                            @endif
                        </div>
                        <div class="bbs-file">
                            @if(($row->files_count ?? 0) > 0)
                                <a href="{{ $row->plDownloadUrl() }}">
                                    <img src="/assets/image/board/ic_attach_file.png" alt="">
                                </a>
                            @endif
                        </div>
                        <div class="bbs-date">{{ $row->created_at->format('Y-m-d') }}</div>
                        <div class="bbs-hit">{{ number_format($row->ref) }}</div>

                        @if(isAdmin())
                            <div class="bbs-show">
                                <select name="hide" class="form-item">
                                    @foreach($boardConfig['options']['hide'] as $key => $val)
                                        <option value="{{ $key }}" {{ $row->hide == $key ? 'selected' : '' }}>{{ $val }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="bbs-admin">
                                <div class="btn-admin">
                                    <a href="{{ route('board.upsert', ['code' => $code, 'sid' => $row->sid]) }}" class="btn btn-board btn-modify">수정</a>
                                    <a href="javascript:void(0);" class="btn btn-board btn-delete">삭제</a>
                                </div>
                            </div>
                        @endif
                    </li>

                    {{-- 답글 --}}
{{--                    @foreach($row->replies as $reply)--}}
{{--                        <li data-sid="{{ $reply->sid }}">--}}
{{--                            <div class="bbs-no">--}}
{{--                                <img src="/assets/image/board/ic_reply.png" alt="" class="ic-reply">--}}
{{--                            </div>--}}
{{--                            <div class="bbs-tit">--}}
{{--                                <a href="{{ route('board.reply.view', ['code' => $code, 'b_sid' => $row->sid, 'sid' => $reply->sid]) }}" class="ellipsis">[RE] {{ $reply->subject }}</a>--}}
{{--                            </div>--}}
{{--                            <div class="bbs-file">--}}
{{--                                @if($reply->files()->count() > 0)--}}
{{--                                    <a href="{{ $reply->plDownloadUrl() }}">--}}
{{--                                        <img src="/assets/image/board/ic_attach_file.png" alt=""></div>--}}
{{--                                    </a>--}}
{{--                                @endif--}}
{{--                            <div class="bbs-date">{{ $reply->created_at->format('Y-m-d') }}</div>--}}
{{--                            <div class="bbs-hit">{{ number_format($reply->ref) }}</div>--}}

{{--                            @if(isAdmin())--}}
{{--                                <div class="bbs-show">--}}
{{--                                    <select name="reply-hide" class="form-item">--}}
{{--                                        @foreach($boardConfig['options']['hide'] as $key => $val)--}}
{{--                                            <option value="{{ $key }}" {{ $reply->hide == $key ? 'selected' : '' }}>{{ $val }}</option>--}}
{{--                                        @endforeach--}}
{{--                                    </select>--}}
{{--                                </div>--}}

{{--                                <div class="bbs-admin">--}}
{{--                                    <div class="btn-admin">--}}
{{--                                        <a href="{{ route('board.reply.upsert', ['code' => $code, 'b_sid' => $row->sid, 'sid' => $reply->sid]) }}" class="btn btn-board btn-modify">수정</a>--}}
{{--                                        <a href="javascript:void(0);" class="btn btn-board btn-delete reply">삭제</a>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            @endif--}}
{{--                        </li>--}}
{{--                    @endforeach--}}
                @endforeach
            </ul>

            @if(isAdmin() || (!empty($boardConfig['permission']['write']) && in_array($user->level, $boardConfig['permission']['write'])))
                <div class="btn-wrap text-right">
                    <a href="{{ route('board.upsert', ['code' => $code]) }}" class="btn btn-type1 color-type5">등록</a>
                </div>
            @endif

            <div class="paging-wrap">
                {{ $list->links('pagination::custom') }}
            </div>

        </div>
    </div>
</article>
@endsection

@section('addScript')
    @include("board.{$boardConfig['skin']}.script.default-script")
    <script>
        $(document).on('click', '.btn-delete', function() {
            const _case = $(this).hasClass('reply') ? 'reply-delete' : 'board-delete';

            if (confirm('정말로 삭제 하시겠습니까?')) {
                callAjax(dataUrl, { case: _case, sid: $(this).closest('li').data('sid') });
            }
        });

        // $(document).on('change', ".hidesel", function() {
        //     const _case = 'board-hide';
        //     const _hide = $(this).find('option:selected').val();
        //
        //     if (confirm('게시글 공개 여부를 변경 하시겠습니까?')) {
        //         callAjax(dataUrl, { case: _case, sid: $(this).closest('li').data('sid'), hide: _hide }, true);
        //     }
        // });
    </script>
@endsection
