@extends('pro.layouts.pro-layout')

@section('addStyle')
@endsection

@section('contents')
    <article class="sub-contents" style="min-height: 656px;">
        <div class="sub-conbox inner-layer">

            <div id="board" class="board-wrap">
                <div class="bbsView">
                    <div class="board-contop">
                        <h4 class="board-tit">
                            {{ $reply->subject }}
                        </h4>

                        <div class="board-info">
                            <span>{{ $reply->writer }}</span>
                            <span>{{ $reply->created_at->format('Y-m-d') }}</span>
                            <span>View : {{ number_format($reply->ref) }}</span>
                        </div>
                    </div>

                    <div class="view-contents editor-contents">{!! $reply->content !!}</div>

                    @if($boardConfig['use']['plupload'] && $reply->files_count > 0)
                        <div class="view-attach">
                            <div class="view-attach-con">
                                <strong class="tit">File</strong>
                                <div class="con">
                                    @foreach($reply->files as $file)
                                        <a href="{{ $file->downloadUrl() }}">
                                            <img src="/assets/image/board/ic_file2.png" alt="">
                                            {{ $file->filename }} (Down {{ number_format($file->download) }})
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
                <!-- //bbs -->

                <div class="btn-wrap text-center">
                    @if(isAdmin() || (thisPk() != 0 && thisPk() == $board->user_sid))
                        <a href="{{ route('board.reply.upsert', ['code' => $code, 'bsid' => $board->sid, 'sid' => $reply->sid]) }}" class="btn btn-type1 btn-board btn-modify">수정</a>
                        <a href="javascript:void(0);" class="btn btn-type1 btn-board btn-delete">삭제</a>
                    @endif

                    <a href="{{ route('board', ['code' => $code]) }}" class="btn btn-type1 btn-board btn-list">목록</a>
                </div>
            </div>
        </div>
    </article>
@endsection

@section('addScript')
    @include("board.{$boardConfig['skin']}.script.default-script")

    <script>
        $(document).on('click', '#reply-del', function() {
            if (confirm('정말로 삭제 하시겠습니까?')) {
                callAjax(dataUrl, { case: 'reply-delete', sid: {{ $reply->sid }} });
            }
        });
    </script>
@endsection
