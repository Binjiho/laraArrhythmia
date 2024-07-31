@extends('layouts.web-layout')

@section('addStyle')
@endsection

@section('contents')
    <article class="sub-contents">
        <div class="sub-conbox inner-layer">
{{--            @include('layouts.include.subTit')--}}

            <div class="sub-tit-wrap">
                <h3 class="sub-tit">팩트시트</h3>
            </div>

            <div id="board" class="board-wrap">
                <div class="board-view">
                    <div class="board-contop">
                        <h4 class="board-tit">
                            {{ $board->subject }}
                        </h4>

                        <div class="board-info">
                            <span>{{ $board->name }}</span>
                            <span>{{ $board->created_at->format('Y-m-d') }}</span>
                            <span>조회수 : {{ number_format($board->ref) }}</span>
                        </div>
                    </div>

                    <div class="view-contents editor-contents">
                        {!! $board->content !!}
                        @if($board->thumb_realfile)
                        <div class="img-wrap text-center">
                            <img src="{{ $board->thumb_realfile }}" alt="">
                        </div>
                        @endif
                    </div>

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

                <div class="view-move type2">
					@if( !empty($board->getNext($board->sid)) )
                        <div class="view-move-con view-prev">
                            <strong class="tit">다음글</strong>
                            <div class="con"><a href="{{ route('board.view', ['code' => $board->getNext($board->sid)->bbs_code, 'category'=>$board->getNext($board->sid)->category, 'sid' => $board->getNext($board->sid)->sid]) }}" class="ellipsis">{{ $board->getNext($board->sid)->subject ?? '' }}</a><span class="date">{{ $board->getNext($board->sid)->created_at->format('Y-m-d') }}</span></div>
                        </div>
                    @endif
                    @if( !empty($board->getPrev($board->sid)) )
                        <div class="view-move-con view-next">
                            <strong class="tit">이전글</strong>
                            <div class="con"><a href="{{ route('board.view', ['code' => $board->getPrev($board->sid)->bbs_code, 'category'=>$board->getPrev($board->sid)->category, 'sid' => $board->getPrev($board->sid)->sid]) }}" class="ellipsis">{{ $board->getPrev($board->sid)->subject ?? '' }}</a><span class="date">{{ $board->getPrev($board->sid)->created_at->format('Y-m-d') }}</span></div>
                        </div>
                    @endif                    
                </div>
                
                <div class="btn-wrap text-center">
                    {{--                    @if($boardConfig['use']['reply'] && (empty($boardConfig['permission']['reply']) || in_array(thisUser()->level ?? null, $boardConfig['permission']['reply'])))--}}
                    {{--                        <a href="{{ route('board.reply.upsert', ['code' => $code, 'b_sid' => $board->sid]) }}">--}}
                    {{--                            답글--}}
                    {{--                        </a>--}}
                    {{--                    @endif--}}


                    @if(isAdmin() || (thisPk() != 0 && thisPk() == $board->user_sid))
                        <a href="{{ route('board.upsert', ['code' => $code,'category'=>$category, 'sid' => $board->sid]) }}" class="btn btn-type1 btn-board btn-modify">수정</a>
                        <a href="javascript:void(0);" class="btn btn-type1 btn-board btn-delete">삭제</a>
                    @endif

                    <a href="{{ route('board', ['code' => $code, 'category'=>$category,]) }}" class="btn btn-type1 btn-board btn-list">목록</a>
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