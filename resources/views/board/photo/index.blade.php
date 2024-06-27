@extends('layouts.web-layout')

@section('addStyle')
@endsection

@section('contents')

    <article class="sub-contents">
        <div class="sub-conbox inner-layer">
            @include('layouts.include.subTit')
            
            <div id="gall-board" class="board-wrap">
                @if(isAdmin() )
                <div class="top-btn-wrap text-right">
                    <a href="{{ route('board.upsert', ['code' => $code]) }}" class="btn btn-type1 color-type5">등록</a>
                </div>
                @endif
                <ul class="gall-list">
                    @foreach($list ?? [] as $row)
                    <li data-sid="{{ $row->sid }}">
                        @if($row->linkurl)
                            <a href="{{ $row->linkurl }}" target="_blank">
                        @else
                            <a href="{{ route('board.view', ['code' => $code, 'sid' => $row->sid]) }}">
                        @endif

                            <span class="gall-img">
                                @if($row->thumb_realfile)
                                    <img src="{{ $row->thumb_realfile }}" alt="대한부정맥학회 Korean Heart Rhythm Society">
                                @else
                                    <img src="/assets/image/board/no_image.png" alt="대한부정맥학회 Korean Heart Rhythm Society">
                                @endif
                            </span>

                            <span class="gall-text">
                                <span class="gall-tit ellipsis">{{ $row->subject }}</span>
                                <span class="gall-con">
                                    <span class="gall-date">{{ $row->created_at->format('Y-m-d') }}</span>
{{--                                    <span class="gall-hit">View {{ number_format($row->ref) }}</span>--}}
                                </span>
                            </span>
                        </a>
                        @if(isAdmin())
                        <div class="btn-admin">
                            <select name="hide" id="hide" class="form-item hidesel">
                                @foreach($boardConfig['options']['hide'] as $key => $val)
                                    <option value="{{ $key }}" {{ $row->hide == $key ? 'selected' : '' }}>{{ $val }}</option>
                                @endforeach
                            </select>
                            <a href="{{ route('board.upsert', ['code' => $code, 'sid' => $row->sid]) }}" class="btn btn-board btn-modify">수정</a>
                            <a href="javascript:;" class="btn btn-board btn-delete">삭제</a>
                        </div>
                        @endif
                    </li>
                    @endforeach
                </ul>
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

        $(document).on('change', ".hidesel", function() {
            const _case = 'board-hide';
            const _hide = $(this).find('option:selected').val();

            if (confirm('게시글 공개 여부를 변경 하시겠습니까?')) {
                callAjax(dataUrl, { case: _case, sid: $(this).closest('li').data('sid'), hide: _hide }, true);
            }
        });
    </script>
@endsection
