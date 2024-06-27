@extends('general.layouts.general-layout')

@section('addStyle')
@endsection

@section('contents')
    <article class="sub-contents">
        <div class="sub-conbox inner-layer">

            @include('general.layouts.include.subTit')
            
            <div id="acco-board" class="board-wrap cf">
                <div class="tab-wrap cf">
                    <div class="board-cate-wrap sub-tab-wrap">

                        <a href="#n" class="btn-tab-menu js-btn-tab-menu">환자 교육자료</a>

                        <ul class="board-cate sub-tab-menu js-tab-menu n4">
                            <li class=""><a href="{{ route('general.know.therapy', ['category'=>'1']) }}">약물치료</a></li>
                            <li class=""><a href="{{ route('general.know.therapy', ['category'=>'2']) }}">고주파 전극도자 절제술</a></li>
                            <li class=""><a href="{{ route('general.know.therapy', ['category'=>'3']) }}">삽입형 기기 이식술</a></li>
                            <li class="on"><a href="{{ route('board', ['code'=>'sickQna']) }}">환자 교육자료</a></li>
                        </ul>
                    </div>

                </div>


                <div class="sub-contit-wrap top-btn-wrap">
{{--                    <h4 class="sub-contit">자주묻는 질문</h4>--}}

                    @if(isAdmin())
                    <a href="{{ route('board.upsert', ['code' => $code]) }}" class="btn btn-type1 color-type5 full-right">등록</a>
                    @endif
                </div>

                <ul class="acco-list js-acco-list">
                    @foreach($list ?? [] as $row)
                    <li data-sid="{{ $row->sid }}">
                        <a href="javascript:;" class="acco-tit edu-tit">
                            {{ $row->subject }}
                        </a>
                        <div class="acco-con edu-con">
                            <div class="view-contents">
                                {!! $row->content !!}
                            </div>
                            <div class="btn-wrap text-right">
                                @if($row->thumb_realfile)
                                <a href="{{ $row->downloadFileUrl('thumb_realfile', 'thumb_file') }}" class="btn btn-small color-type10" >다운로드 <span class="arrow">&gt;</span></a>
                                @endif
                            </div>
                        </div>

                        @if(isAdmin())
                        <div class="btn-admin" style="text-align: right;margin: 10px 0;">
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

            <div class="paging-wrap">
                {{ $list->links('pagination::custom') }}
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
