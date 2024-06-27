@extends('general.layouts.general-layout')

@section('addStyle')
@endsection

@section('contents')
    <article class="sub-contents" style="min-height: 656px;">
        <div class="sub-conbox inner-layer">

            @include('general.layouts.include.subTit')
            
            <div id="board" class="event-wrap board-wrap">
                <div class="board-view">
                    <div class="write-wrap">
{{--                        <h4 class="board-tit">--}}
{{--                            {{ $board->subject }}--}}
{{--                        </h4>--}}
                        <dl>
                            <dt>일시</dt>
                            <dd>
                                {{ $board->event_sdate ?? '' }} {{ $board->event_edate ? ' ~ '.$board->event_edate: ''}}
                            </dd>
                        </dl>
                        @if($board->place)
                        <dl>
                            <dt>장소</dt>
                            <dd>
                                {{ $board->place ?? '' }}
                            </dd>
                        </dl>
                        @endif
                        @if($board->link_url)
                            <dl>
                                <dt>홈페이지</dt>
                                <dd>
                                    {{ $board->link_url ?? '' }}
                                </dd>
                            </dl>
                        @endif

                        <dl>
                            <dt>행사 소개</dt>
                            <dd>
                                @if($board->thumb_realfile)
                                <div class="img-wrap">
                                    <img src="{{ $board->thumb_realfile }}" alt="행사명">
                                </div>
                                @endif
                                {!! $board->content !!}
                            </dd>
                        </dl>

                    </div>

{{--                    @if($boardConfig['use']['plupload'] && $board->files_count > 0)--}}
{{--                        <div class="view-attach">--}}
{{--                            <div class="view-attach-con">--}}
{{--                                <strong class="tit">첨부파일</strong>--}}
{{--                                <div class="con">--}}
{{--                                    @foreach($board->files as $file)--}}
{{--                                        <a href="{{ $file->downloadUrl() }}">--}}
{{--                                            <img src="/assets/image/board/ic_file2.png" alt="">--}}
{{--                                            {{ $file->filename }} (다운 {{ number_format($file->download) }}건)--}}
{{--                                        </a>--}}
{{--                                    @endforeach--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    @endif--}}
                </div>

                <div class="btn-wrap text-center">
{{--                    @if($boardConfig['use']['reply'] && (empty($boardConfig['permission']['reply']) || in_array(thisUser()->level ?? null, $boardConfig['permission']['reply'])))--}}
{{--                        <a href="{{ route('board.reply.upsert', ['code' => $code, 'b_sid' => $board->sid]) }}">--}}
{{--                            답글--}}
{{--                        </a>--}}
{{--                    @endif--}}


                    @if(isAdmin() || (thisPk() != 0 && thisPk() == $board->user_sid))
                        <a href="{{ route('board.upsert', ['code' => $code, 'sid' => $board->sid]) }}" class="btn btn-type1 btn-board btn-modify">수정</a>
                        <a href="javascript:void(0);" class="btn btn-type1 btn-board btn-delete">삭제</a>
                    @endif

                    <a href="{{ route('board', ['code' => $code, 'abyear' => date('Y')]) }}" class="btn btn-type1 btn-board btn-list">목록</a>
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
