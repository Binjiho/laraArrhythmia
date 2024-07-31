@extends($extends_str)

@section('addStyle')
@endsection

@section('contents')
    <article class="sub-contents">
        <div class="sub-conbox inner-layer">

            @if( ($siteType ?? 'main') == 'main' )
                @include('layouts.include.subTit')
            @endif

            <div class="event-wrap">
                <div class="event-cate-wrap">
                    <select name="year" id="year" class="form-item">
                        @foreach($conferenceConfig['year'] as $key => $val)
                            <option value="{{ $val }}" {{(request()->year ?? date('Y')) == $val ? 'selected':'' }}>{{ $val }}년</option>
                        @endforeach
                    </select>

                    <a href="{{ route('conference') }}" class="btn btn-type1 ev-cate ev-cate4">전체</a>
                    @foreach($conferenceConfig['category'] as $key => $val)
                        <a href="{{ route('conference', ['category' => $key ]) }}" class="btn btn-type1 ev-cate ev-cate{{ $key }}">{{ $val }}</a>
                    @endforeach

                    @if(isAdmin())
                        <a href="{{ route('conference.upsert') }}" class="btn btn-type1 color-type5 full-right">등록</a>
                    @endif
                </div>

                <div class="sub-contit-wrap">
                    <h4 class="sub-contit">진행중 행사</h4>
                </div>
                <ul class="event-list">
                    @foreach($list ?? [] as $row)
                        @continue($row->sid == '79' && $_SERVER['REMOTE_ADDR'] !=="218.235.94.247")
                        <li data-sid="{{ $row->sid }}">
                            <div class="date">
                                <span class="ev-cate ev-cate{{ $row->category ?? 1 }}">{{ $conferenceConfig['category'][$row->category ?? 1] }}</span>
                                <strong>{{ $row->event_sdate->format('Y-m-d') ?? '' }} {{ $row->event_edate ? ' ~ '.$row->event_edate->format('Y-m-d'): ''}}</strong>
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
                                    <a href="javascript:;" class="ev-tit">{{ $row->subject ?? '' }}</a>
                                    <ul>
                                        @if($row->place)
                                            <li>장소 : {{ $row->place ?? '' }}</li>
                                        @endif
                                        @if($row->regist_sdate && isValidTimestamp($row->regist_sdate) )
                                            <li>사전등록 기간 : {{ $row->regist_sdate->format('Y-m-d') ?? '' }} {{ $row->regist_edate ? ' ~ '.$row->regist_edate->format('Y-m-d'): ''}}</li>
                                        @endif
                                        @if($row->abs_sdate && isValidTimestamp($row->abs_sdate))
                                            <li>초록접수 기간 : {{ $row->abs_sdate->format('Y-m-d') ?? '' }} {{ $row->abs_edate ? ' ~ '.$row->abs_edate->format('Y-m-d'): ''}}</li>
                                        @endif
                                        @if($row->link_url)
                                            <li>홈페이지 URL : <a href="{{$row->link_url}}" target="_blank">{{$row->link_url}}</a></li>
                                        @endif
                                    </ul>
                                </div>
                            </div>
                            @if(isAdmin())
                                <div class="btn-admin">
                                    <select name="hide" id="hide" class="form-item hidesel">
                                        @foreach($conferenceConfig['hide'] as $key => $val)
                                            <option value="{{ $key }}" {{ $row->hide == $key ? 'selected' : '' }}>{{ $val }}</option>
                                        @endforeach
                                    </select>
                                    <br>
                                    <a href="{{ route('conference.upsert', ['sid' => $row->sid]) }}" class="btn btn-board btn-modify">수정</a>
                                    <a href="javascript:;" class="btn btn-board btn-delete">삭제</a>
                                </div>
                            @endif
                            @if(!isMobile())
                                <div class="btn-wrap text-right">
                                    @if( ($row->detail??'N') == 'Y' )
                                        <a href="{{ route('conference.detail', ['sid' => $row->sid]) }}" class="btn btn-small color-type14">상세보기</a>
                                    @endif
                                    @if( ($row->regist_yn??'N') == 'Y' )
                                        <a href="{{ route('conference.detail', ['sid' => $row->sid, 'tab'=>'3']) }}" class="btn btn-small color-type13">사전등록</a>
                                    @endif
                                    @if( ($row->abs_yn??'N') == 'Y' )
                                        <a href="{{ route('conference.detail', ['sid' => $row->sid, 'tab'=>'4']) }}" class="btn btn-small color-type21">초록접수</a>
                                    @endif
                                </div>
                            @endif
                        </li>
                    @endforeach
                </ul>

                <div class="sub-contit-wrap">
                    <h4 class="sub-contit">지난 행사</h4>
                </div>
                <ul class="event-list">
                    @foreach($list_fin ?? [] as $row)
                        <li data-sid="{{ $row->sid }}">
                            <div class="date">
                                <span class="ev-cate ev-cate{{ $row->category ?? 1 }}">{{ $conferenceConfig['category'][$row->category ?? 1] }}</span>
                                <strong>{{ $row->event_sdate->format('Y-m-d') ?? '' }} {{ $row->event_edate ? ' ~ '.$row->event_edate->format('Y-m-d'): ''}}</strong>
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
                                    <a href="javascript:;" class="ev-tit">{{ $row->subject ?? '' }}</a>
                                    <ul>
                                        @if($row->place)
                                            <li>장소 : {{ $row->place ?? '' }}</li>
                                        @endif
                                        @if($row->regist_sdate && isValidTimestamp($row->regist_sdate))
                                            <li>사전등록 기간 : {{ $row->regist_sdate->format('Y-m-d') ?? '' }} {{ $row->regist_edate ? ' ~ '.$row->regist_edate->format('Y-m-d'): ''}}</li>
                                        @endif
                                        @if($row->abs_sdate && isValidTimestamp($row->abs_sdate))
                                            <li>초록접수 기간 : {{ $row->abs_sdate->format('Y-m-d') ?? '' }} {{ $row->abs_edate ? ' ~ '.$row->abs_edate->format('Y-m-d'): ''}}</li>
                                        @endif
                                        @if($row->link_url)
                                            <li>홈페이지 URL : <a href="{{$row->link_url}}" target="_blank">{{$row->link_url}}</a></li>
                                        @endif
                                    </ul>
                                </div>
                            </div>
                            @if(isAdmin())
                                <div class="btn-admin">
                                    <select name="hide" id="hide" class="form-item hidesel">
                                        @foreach($conferenceConfig['hide'] as $key => $val)
                                            <option value="{{ $key }}" {{ $row->hide == $key ? 'selected' : '' }}>{{ $val }}</option>
                                        @endforeach
                                    </select>
                                    <br>
                                    <a href="{{ route('conference.upsert', ['sid' => $row->sid]) }}" class="btn btn-board btn-modify">수정</a>
                                    <a href="javascript:;" class="btn btn-board btn-delete">삭제</a>
                                </div>
                            @endif
                            @if(!isMobile())
                                <div class="btn-wrap text-right">
                                    @if( ($row->detail??'N') == 'Y' )
                                    <a href="{{ route('conference.detail', ['sid' => $row->sid]) }}" class="btn btn-small color-type14">상세보기</a>
                                    @endif
                                    @if( ($row->regist_yn??'N') == 'Y' )
                                    <a href="{{ route('conference.detail', ['sid' => $row->sid, 'tab'=>'3']) }}" class="btn btn-small color-type13">사전등록</a>
                                    @endif
                                    @if( ($row->abs_yn ?? 'N') == 'Y' )
                                    <a href="{{ route('conference.detail', ['sid' => $row->sid, 'tab'=>'4']) }}" class="btn btn-small color-type21">초록접수</a>
                                    @endif
                                </div>
                            @endif
                        </li>
                    @endforeach
                </ul>

                <div class="paging-wrap">
                    {{ $list_fin->links('pagination::custom') }}
                </div>

            </div>
        </div>
    </article>
@endsection

@section('addScript')
    <script>
        const dataUrl = '{{ route('conference.data', ['category' => request()->category ?? '']) }}';

        $(document).on('change', "#year", function() {
            const url = '{{ route('conference', ['category' => request()->category ?? '']) }}'
            location.replace(url + '&year=' + $(this).val());
        });

        $(document).on('click', '.btn-delete', function() {
            const _case = 'conference-delete';

            if (confirm('정말로 삭제 하시겠습니까?')) {
                callAjax(dataUrl, { case: _case, sid: $(this).closest('li').data('sid') });
            }
        });

        $(document).on('change', ".hidesel", function() {
            const _case = 'conference-hide';
            const _hide = $(this).find('option:selected').val();

            if (confirm('공개 여부를 변경 하시겠습니까?')) {
                callAjax(dataUrl, { case: _case, sid: $(this).closest('li').data('sid'), hide: _hide }, true);
            }
        });
    </script>
@endsection
