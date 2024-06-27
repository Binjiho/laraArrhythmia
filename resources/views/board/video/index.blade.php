@extends($extends_str)

@section('addStyle')
@endsection

@section('contents')
<article class="sub-contents">
    <div class="sub-conbox inner-layer">

        @include('layouts.include.subTit')

        <div class="tab-wrap cf">
            <div class="board-cate-wrap sub-tab-wrap">

                <a href="javascript:;" class="btn-tab-menu js-btn-tab-menu">부정맥 기초</a>

                <ul class="board-cate sub-tab-menu js-tab-menu n{{ count($boardConfig['category2']['item']) }}">
                    @foreach($boardConfig['category']['item'] as $category_key => $category_val)
                        <li class="{{($category ?? '1') == $category_key ? "on":""}}">
                            <a href="{{ route('board', ['code' => 'video','category' => $category_key ,'category2'=>'1' ]) }}">{{$category_val}}</a>
                        </li>
                    @endforeach
                </ul>
            </div>

            @if($boardConfig['category2']['item'][$category])
                <div class="sub-tab-wrap">
                    <a href="#n" class="btn-tab-menu js-btn-tab-menu">부정맥 이란</a>

                    <ul class="sub-tab-menu type2 js-tab-menu n{{ count($boardConfig['category2']['item'][$category]) }}">
                        @foreach($boardConfig['category2']['item'][$category] as $category2_key => $category2_val)
                            <li class="{{($category2 ?? '1') == $category2_key ? "on":""}}"><a href="{{ route('board', ['code' => 'video','category' => $category, 'category2'=> $category2_key ]) }}">{{$category2_val}}</a></li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
        
        <div id="video-board" class="board-wrap">
            @if(isAdmin())
                <div class="top-btn-wrap text-right">
                    <a href="{{ route('board.upsert', ['code' => $code, 'category' => $category]) }}" class="btn btn-type1 color-type5">등록</a>
                </div>
            @endif
            <ul class="gall-list type2">
                @forelse($list ?? [] as $row)
                <li data-sid="{{ $row->sid }}">
                    <a href="{{ route('board.view', ['code' => $code, 'category' => $category, 'category2' => $category2, 'sid' => $row->sid]) }}">
                        <span class="gall-img">
                            @if($row->thumb_realfile)
                                <img src="{{ $row->thumb_realfile }}" alt="대한부정맥학회 Korean Heart Rhythm Society">
                            @else
                                <img src="/assets/image/board/no_image.png" alt="대한부정맥학회 Korean Heart Rhythm Society">
                            @endif
                            <span class="btn-more">
                                자세히 보기 <span class="arrow">&gt;</span>
                            </span>
                        </span>
                        <span class="gall-tit ellipsis">{{ $row->subject }}</span>
                    </a>
                    @if(isAdmin())
                    <div class="btn-admin">
                        <select name="hide" id="hide" class="form-item hidesel">
                            @foreach($boardConfig['options']['hide'] as $key => $val)
                                <option value="{{ $key }}" {{ $row->hide == $key ? 'selected' : '' }}>{{ $val }}</option>
                            @endforeach
                        </select>
                        <a href="{{ route('board.upsert', ['code' => $code, 'category' => $category, 'sid' => $row->sid]) }}" class="btn btn-board btn-modify">수정</a>
                        <a href="javascript:;" class="btn btn-board btn-delete">삭제</a>
                    </div>
                    @endif
                </li>
                @empty
                    <li style="width: 100%;">
                        <div class="ready-wrap">
                            <img src="/assets/image/sub/img_ready.png" alt="">
                            <strong class="tit">페이지 <span class="highlights text-red">준비중</span> 입니다.</strong>
                        </div>
                    </li>
                @endforelse
            </ul>

            <div class="paging-wrap">
                {{ $list->withQueryString($category)->links('pagination::custom') }}
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
