@extends('pro.layouts.pro-layout')

@section('addStyle')
@endsection

@section('contents')
    <article class="sub-contents" style="min-height: 656px;">
        <div class="sub-conbox inner-layer">

            <div class="sub-tit-wrap">
                <h3 class="sub-tit">포토갤러리</h3>
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

                    @if($boardConfig['use']['plupload'] && $board->files_count > 0)
                    <div class="gall-view-rolling js-view-rolling">
                        @foreach($board->files as $file)
                        <div class="gall-view-con">
                            <img src="{{$file->realfile}}" alt="{{$file->filename}}">
                        </div>
                        @endforeach
                    </div>
                    @endif

                    <div class="view-contents">{!! $board->content !!}</div>

                </div>

                <div class="btn-wrap text-center">
                    @if(isAdmin() || (thisPk() != 0 && thisPk() == $board->user_sid))
                        <a href="{{ route('board.upsert', ['code' => $code, 'sid' => $board->sid]) }}" class="btn btn-type1 btn-board btn-modify">수정</a>
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
        $(document).on('click', '.btn-delete', function() {
            if (confirm('정말로 삭제 하시겠습니까?')) {
                callAjax(dataUrl, { case: 'board-delete', sid: {{ $board->sid }} });
            }
        });
    </script>

    <script>
        $(function(e){
            if($('.js-view-rolling').length){
                $('.js-view-rolling').not('.slick-initialized').slick({
                    arrows: true,
                    dots: false,
                    autoplay: true,
                    autoplaySpeed: 3000,
                    speed: 1000,
                    infinite: true,
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    adaptiveHeight: true,
                });
            }
        });
    </script>
@endsection
