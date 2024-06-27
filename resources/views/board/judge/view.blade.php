@extends($extends_str)

@section('addStyle')
@endsection

@section('contents')
    <article class="sub-contents" style="min-height: 656px;">
        <div class="sub-conbox inner-layer">

            @if(($extends_str ?? 'main') == 'layouts.web-layout')
                @include('layouts.include.subTit')
            @endif
            
            <div id="acco-board" class="board-wrap">
                <div class="board-view">
                    <div class="board-contop">
                        <h4 class="board-tit">
                            {{ $board->subject }}
                        </h4>
                    </div>

                    <div class="view-contents">{!! $board->content !!}</div>

                    @if($boardConfig['use']['file'])
                        @if (!empty($board->thumb_file))
                            <div class="view-attach">
                                <div class="view-attach-con">
                                    <strong class="tit">
                                        <img src="/assets/image/board/ic_file.png" alt=""> 첨부파일
                                    </strong>
                                    <div class="con">
                                        <a href="{{ $board->downloadFileUrl('thumb_realfile', 'thumb_file') }}" target="_blank">{{$board->thumb_file}}</a>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endif

                    @if($boardConfig['use']['plupload'] && $board->files_count > 0)
                        <div class="view-attach">
                            <div class="view-attach-con">
                                <strong class="tit">첨부파일</strong>
                                <div class="con">
                                    @foreach($board->files as $file)
                                        <a href="{{ $file->downloadUrl() }}">
                                            <img src="/assets/image/board/ic_file2.png" alt="">
                                            {{ $file->filename }} (다운 {{ number_format($file->download) }}건)
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endif
                </div>

                <div class="btn-wrap text-center">
                    @if(isAdmin() || (thisPk() != 0 && thisPk() == $board->user_sid))
                        <a href="{{ route('board.upsert', ['code' => $code, 'category' => $category, 'sid' => $board->sid]) }}" class="btn btn-type1 btn-board btn-modify">수정</a>
                        <a href="javascript:void(0);" class="btn btn-type1 btn-board btn-delete">삭제</a>
                    @endif

                    <a href="{{ route('board', ['code' => $code, 'category' => $category]) }}" class="btn btn-type1 btn-board btn-list">목록</a>
                </div>
            </div>
        </div>
    </article>
@endsection

@section('addScript')
    @include("board.{$boardConfig['skin']}.script.default-script")

    <script>
        $(document).on('click', '.btn-delete', function() {
            if (confirm('정말로 삭제 하시겠습니까?')) {
                callAjax(dataUrl, { case: 'board-delete', sid: {{ $board->sid }} });
            }
        });
    </script>
@endsection
