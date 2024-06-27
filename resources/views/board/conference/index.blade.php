@extends('layouts.web-layout')

@section('addStyle')
@endsection

@section('contents')
    <article class="sub-contents">
        <div class="sub-conbox inner-layer">
            @include('layouts.include.subTit')
            
            <div class="event-wrap">
                <div class="event-cate-wrap">
                    <select name="abyear" id="abyear" class="form-item">
                        <option value="2024" {{($abyear ?? '') == '2024' ? 'selected':'' }}>2024년</option>
                        <option value="2025" {{($abyear ?? '') == '2025' ? 'selected':'' }}>2025년</option>
                        <option value="2026" {{($abyear ?? '') == '2026' ? 'selected':'' }}>2026년</option>
                        <option value="2027" {{($abyear ?? '') == '2027' ? 'selected':'' }}>2027년</option>
                        <option value="2028" {{($abyear ?? '') == '2028' ? 'selected':'' }}>2028년</option>
                    </select>
                    <a href="{{ route('board', ['code' => 'conference','abyear'=> date('Y'), 'category' => '1']) }}" class="btn btn-type1 ev-cate ev-cate1">KHRS 학술대회</a>
                    <a href="{{ route('board', ['code' => 'conference','abyear'=> date('Y'), 'category' => '2']) }}" class="btn btn-type1 ev-cate ev-cate2">연관학회 학술대회</a>
                    <a href="{{ route('board', ['code' => 'conference','abyear'=> date('Y'), 'category' => '3']) }}" class="btn btn-type1 ev-cate ev-cate3">해외 학술대회</a>
                    @if(isAdmin())
                    <a href="{{ route('board.upsert', ['code' => $code, 'category'=>$category]) }}" class="btn btn-type1 color-type5 full-right">등록</a>
                    @endif
                </div>
                <ul class="event-list">
                    @foreach($list ?? [] as $row)
                    <li data-sid="{{ $row->sid }}">
                        <div class="date">
                            <span class="ev-cate ev-cate{{ $row->category }}">{{$boardConfig['category']['item'][$row->category]}}</span>
                            <strong>{{ $row->event_sdate ?? '' }} {{ $row->event_edate ? ' ~ '.$row->event_edate: ''}}</strong>
                        </div>
                        <div class="event-con">
                            <div class="img-wrap">
                            @if($row->thumb_realfile)
                                <img src="{{ $row->thumb_realfile }}" alt="행사명">
                            @else
                                <img src="/assets/image/board/no_image.png" alt="행사명">
                            @endif
                            </div>
                            <div class="text-wrap">
                                <a href="{{ route('board.view', ['code' => $code, 'category' => $category, 'sid' => $row->sid]) }}" class="ev-tit">{{ $row->subject ?? '' }}</a>
                                <ul>
                                    @if($row->place)
                                    <li>장소 : {{ $row->place ?? '' }}</li>
                                    @endif
                                    @if($row->regist_sdate)
                                    <li>사전등록 기간 : {{ $row->regist_sdate ?? '' }} {{ $row->regist_edate ? ' ~ '.$row->regist_edate: ''}}</li>
                                    @endif
                                    @if($row->abs_sdate)
                                    <li>초록접수 기간 : {{ $row->abs_sdate ?? '' }} {{ $row->abs_edate ? ' ~ '.$row->abs_edate: ''}}</li>
                                    @endif
                                    @if($row->linkurl)
                                    <li>홈페이지 URL : <a href="{{$row->linkurl}}" target="_blank">{{$row->linkurl}}</a></li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                        @if(isAdmin())
                        <div class="btn-admin">
                            <select name="hide" id="hide" class="form-item hidesel">
                                @foreach($boardConfig['options']['hide'] as $key => $val)
                                    <option value="{{ $key }}" {{ $row->hide == $key ? 'selected' : '' }}>{{ $val }}</option>
                                @endforeach
                            </select>
                            <br>
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
        $(document).on('change', "#abyear", function() {
            const url = '{{ route('board', ['code' => 'conference', 'category' => request()->category ?? '1']) }}'
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
