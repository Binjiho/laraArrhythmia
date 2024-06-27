@extends('layouts.web-layout')

@section('addStyle')
@endsection

@section('contents')
    <article class="sub-contents" style="min-height: 656px;">
        <div class="sub-conbox inner-layer">
            <div class="sub-tit-wrap">
                <h3 class="sub-tit">{{config('site.menu')['web']['sub_menu'][$main_menu][$sub_menu]['name'] }}</h3>
            </div>
            <div id="board" class="event-wrap board-wrap">
                <div class="board-view">
                    <div class="write-wrap">

                        <dl>
                            <dt>행사명</dt>
                            <dd>
                                {{ $group_conference->subject ?? '' }}
                            </dd>
                        </dl>

                        @if($groupConfig['use']['category'])
                            <dl>
                                <dt>구분</dt>
                                <dd>
                                    {{ $groupConfig['category']['item'][$group_conference->category] }}
                                </dd>
                            </dl>
                        @endif

                        <dl>
                            <dt>행사기간</dt>
                            <dd>
                                {{ $groupConfig['options']['date_type'][$group_conference->date_type] }}
                            </dd>
                        </dl>

                        <dl>
                            <dt>행사일</dt>
                            <dd>
                                {{ $group_conference->event_sdate ?? '' }} {{ $group_conference->event_edate ? ' ~ '.$group_conference->event_edate: ''}}
                            </dd>
                        </dl>

                        @if($group_conference->place)
                        <dl>
                            <dt>장소</dt>
                            <dd>
                                {{ $group_conference->place ?? '' }}
                            </dd>
                        </dl>
                        @endif

                        <dl>
                            <dt>사전등록 기간</dt>
                            <dd>
                                {{ $group_conference->regist_sdate ?? '' }} {{ $group_conference->regist_edate ? ' ~ '.$group_conference->regist_edate: ''}}
                            </dd>
                        </dl>

                        <dl>
                            <dt>초록접수 기간</dt>
                            <dd>
                                {{ $group_conference->abs_sdate ?? '' }} {{ $group_conference->abs_edate ? ' ~ '.$group_conference->abs_edate: ''}}
                            </dd>
                        </dl>

                        <dl>
                            <dt>홈페이지 Url</dt>
                            <dd>
                                {{ $group_conference->link_url ?? '' }}
                            </dd>
                        </dl>

                        <dl>
                            <dt>행사 소개</dt>
                            <dd>
                                @if($group_conference->thumb_realfile)
                                <div class="img-wrap">
                                    <img src="{{ $group_conference->thumb_realfile }}" alt="행사명">
                                </div>
                                @endif
                                {!! $group_conference->content !!}
                            </dd>
                        </dl>

                    </div>

                    @if($groupConfig['use']['plupload'] && $group_conference->files_count > 0)
                        <div class="view-attach">
                            <div class="view-attach-con">
                                <strong class="tit">첨부파일</strong>
                                <div class="con">
                                    @foreach($group_conference->files as $file)
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
                    @if(isAdmin() || thisPk() != 0 )
                        <a href="{{ route('introduce.group.conference.upsert', ['g_sid' => $group_conference->g_sid, 'sid' => $group_conference->sid  ]) }}" class="btn btn-type1 btn-board btn-modify">수정</a>
                        <a href="javascript:void(0);" class="btn btn-type1 btn-board btn-delete">삭제</a>
                    @endif

                    <a href="{{ route('introduce.group.detail', ['sid' => $group_conference->g_sid ]) }} " class="btn btn-type1 btn-board btn-list">목록</a>
                </div>
            </div>
        </div>
    </article>
@endsection

@section('addScript')
    <script>
        $(document).on('click', '.btn-delete', function() {
            if (confirm('정말로 삭제 하시겠습니까?')) {
                callAjax( {{ route('introduce.group.data') }}, { case: 'board-delete', sid: {{ $group_conference->g_sid }} });
            }
        });
    </script>
@endsection
