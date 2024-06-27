@extends($extends_str)

@section('addStyle')
    <style>
        .acco-list .acco-con {
            /*display: -webkit-inline-box;*/
            /*-webkit-box-orient: vertical;*/
            /*-webkit-line-clamp: 20;*/
            /*overflow: hidden;*/
            max-height: 300px;
            overflow: hidden;
        }
    </style>
@endsection

@section('contents')

    <article class="sub-contents">
        <div class="sub-conbox inner-layer">

{{--            @if(($extends_str ?? 'main') == 'layouts.web-layout')--}}
{{--                @include('layouts.include.subTit')--}}
{{--            @else--}}
{{--                <div class="tab-wrap cf">--}}
{{--                    <div class="board-cate-wrap sub-tab-wrap">--}}

{{--                        <a href="javascript:;" class="btn-tab-menu js-btn-tab-menu">고주파 전극도자절제술</a>--}}

{{--                        <ul class="board-cate sub-tab-menu js-tab-menu n3">--}}
{{--                            <li class="{{ ($category ?? '1') == '1' ? 'on' : '' }}"><a href="{{ route('board',['code' => 'judge', 'category'=>'1']) }}">고주파 전극도자절제술</a></li>--}}
{{--                            <li class="{{ ($category ?? '1') == '2' ? 'on' : '' }}"><a href="{{ route('board',['code' => 'judge', 'category'=>'2']) }}">이식형 사건기록기</a></li>--}}
{{--                            <li class="{{ ($category ?? '1') == '3' ? 'on' : '' }}"><a href="{{ route('board',['code' => 'judge', 'category'=>'3']) }}">RFCA &amp; Cryoablation</a></li>--}}
{{--                        </ul>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            @endif--}}
            @include('layouts.include.subTit')
            
            <div id="acco-board" class="board-wrap">

                <div class="sub-contit-wrap top-btn-wrap">
                    <h4 class="sub-contit">{{$boardConfig['category']['item'][$category]}}</h4>
                    @if(isAdmin() || (!empty($boardConfig['permission']['write']) && in_array($user->level, $boardConfig['permission']['write'])))
                    <a href="{{ route('board.upsert', ['code' => $code]) }}" class="btn btn-type1 color-type5 full-right">등록</a>
                    @endif
                </div>
                <ul class="acco-list js-acco-list">
                    @foreach($list ?? [] as $row)
                    <li data-sid="{{ $row->sid }}">
                        <a href="javascript:;" class="acco-tit">
                            {{ $row->subject }}
                        </a>
                        <div class="acco-con" style="">
                            <div class="view-contents">
                                {!! $row->content !!}
                            </div>
                            <a href="{{ route('board.view', ['code' => $code , 'category' => $category, 'sid' => $row->sid]) }}" class="btn-more">+</a>
                        </div>
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
        $(function (){
            if($('.js-acco-list').length){
                $('.js-acco-list .acco-tit').on('click',function(e){
                    $(this).next('.acco-con').stop().slideToggle();
                    $(this).parent('li').toggleClass('on');
                });
            }
        });
    </script>
@endsection
