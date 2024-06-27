@extends($extends_str)

@section('addStyle')
@endsection

@section('contents')

    <article class="sub-contents">
        <div class="sub-conbox inner-layer">

            @if(($extends_str ?? 'main') == 'layouts.web-layout')
                @include('layouts.include.subTit')
            @endif
            
            <div id="acco-board" class="board-wrap cf">
                <div class="tab-wrap cf">
                    <div class="board-cate-wrap sub-tab-wrap">

                        <a href="javascript:;" class="btn-tab-menu js-btn-tab-menu">KHRS</a>

                        <ul class="board-cate sub-tab-menu js-tab-menu n{{ count($boardConfig['category2']['item']) }}">
                            @foreach($boardConfig['category']['item'] as $category_key => $category_val)
                            <li class="{{($category ?? '1') == $category_key ? "on":""}}"><a href="{{ route('board', ['code' => 'library','category' => $category_key ,'category2'=>($category_key == '1' || $category_key == '5' ? '1' : '') ]) }}">{{$category_val}}</a></li>
                            @endforeach
                        </ul>
                    </div>

                    @if($boardConfig['category2']['item'][$category])
                    <div class="sub-tab-wrap">
                        <a href="#n" class="btn-tab-menu js-btn-tab-menu">KHRS Scientific Session</a>

                        <ul class="sub-tab-menu type2 js-tab-menu n{{ count($boardConfig['category2']['item'][$category]) }}">
                            @foreach($boardConfig['category2']['item'][$category] as $category2_key => $category2_val)
                                <li class="{{($category2 ?? '1') == $category2_key ? "on":""}}"><a href="{{ route('board', ['code' => 'library','category' => $category, 'category2'=> $category2_key]) }}">{{$category2_val}}</a></li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                </div>


                <div class="sub-contit-wrap top-btn-wrap">
                    @if($boardConfig['category2']['item'][$category])
                    <h4 class="sub-contit">{{ $boardConfig['category2']['item'][$category][$category2 ?? ''] }}</h4>
                    @else
                    <h4 class="sub-contit">{{ $boardConfig['category']['item'][$category]}}</h4>
                    @endif
                    @if(isAdmin())
                    <a href="{{ route('board.upsert', ['code' => $code, 'category'=>$category, 'category2' => $category2]) }}" class="btn btn-type1 color-type5 full-right">등록</a>
                    @endif
                </div>

                <ul class="acco-list js-acco-list">
                    @foreach($list ?? [] as $row)
                    <li data-sid="{{ $row->sid }}">
                        <a href="javascript:;" class="acco-tit">
                            {{ $row->subject }}
                        </a>
{{--                        <a href="{{ route('board.view', ['code' => $code, 'category' => $category, 'sid' => $row->sid]) }}" class="acco-tit">--}}
{{--                            {{ $row->subject }}--}}
{{--                        </a>--}}
                        <div class="acco-con">
                            <div class="view-contents">
                                {!! $row->content !!}
                            </div>
                            <div class="btn-wrap text-right">
                                @if($row->linkurl2)
                                <a href="{{ $row->linkurl2 }}" class="btn btn-small color-type12" target="_blank">학술대회 원고보기 <span class="arrow">&gt;</span></a>
                                @endif
                                @if($row->thumb_realfile)
                                <a href="{{ $row->downloadFileUrl('thumb_realfile', 'thumb_file') }}" class="btn btn-small color-type8" target="_blank">프로그램북 보기 <span class="arrow">&gt;</span></a>
                                @endif
                                @if($row->linkurl)
                                <a href="{{$row->linkurl}}" class="btn btn-small btn-line color-type2" target="_blank">홈페이지 바로가기 <span class="arrow">&gt;</span></a>
                                @endif
                            </div>
                        </div>

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
                    @endforeach
                </ul>
            </div>
        </div>
    </article>
@endsection

@section('addScript')
    @include("board.{$boardConfig['skin']}.script.default-script")
    <script>
        $(function(e){
            if($('.js-acco-list').length){
                $('.js-acco-list .acco-tit').on('click',function(e){
                    $(this).next('.acco-con').stop().slideToggle();
                    $(this).parent('li').toggleClass('on');
                });
            }
            // btn-tab-menu remove link
            $('.js-btn-tab-menu').attr('href','#n');
        });

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
