@extends('layouts.web-layout')

@section('addStyle')
    <link type="text/css" rel="stylesheet" href="{{ asset('plugins/plupload/2.3.6/jquery.plupload.queue/css/jquery.plupload.queue.css') }}" />
    <link type="text/css" rel="stylesheet" href="{{ asset('plugins/bootstrap-datepicker/css/bootstrap-datepicker.css') }}"/>
@endsection

@section('contents')
    <article class="sub-contents">
        <div class="sub-conbox inner-layer">
            <?/*
            <div class="sub-tit-wrap">
                <h3 class="sub-tit">{{config('site.menu')['web']['sub_menu'][$main_menu][$sub_menu]['name'] }}</h3>
            </div>
            */?>
            <div id="board" class="event-wrap board-wrap">
                <div class="board-write">
                    <div class="write-form-wrap">
                        <form id="board-frm" data-sid="{{ $group_conference->sid ?? 0 }}" data-case="board-{{ empty($group_conference->sid) ? 'create' : 'update' }}" onsubmit="return false;">
                            <input type="hidden" name="g_sid" value="{{ $group_conference->g_sid ?? request()->g_sid }}">
                            <fieldset>
                                <legend class="hide">글쓰기</legend>
                                <div class="write-wrap">
                                    @if($groupConfig['use']['writer'])
                                    <dl>
                                        <dt><strong class="required">*</strong> 작성자</dt>
                                        <dd>
                                            <input type="text" name="name" id="name" class="form-item" value="{{ $group_conference->name ?? '' }}">
                                        </dd>
                                    </dl>
                                    @endif
                                    <dl>
                                        <dt><strong class="required">*</strong> {{ $groupConfig['subject'] }}</dt>
                                        <dd>
                                            <input type="text" name="subject" id="subject" class="form-item" value="{{ $group_conference->subject ?? '' }}">
                                        </dd>
                                    </dl>

                                    @if($groupConfig['use']['gubun'])
                                        <dl>
                                            <dt><strong class="required">*</strong> 구분</dt>
                                            <dd>
                                                <div class="radio-wrap cst">
                                                    @foreach($groupConfig['gubun']['item'] as $gubun_key => $gubun_val)
                                                        <div class="radio-group">
                                                            <input type="radio" name="gubun" id="gubun_{{ $gubun_key }}" value="{{ $gubun_key }}" {{ (($group_conference->gubun ?? 'N') == $gubun_key) ? 'checked' : '' }}>
                                                            <label for="gubun_{{ $gubun_key }}">{{$gubun_val}}</label>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </dd>
                                        </dl>
                                    @endif

                                    @if($groupConfig['use']['date'])
                                        <dl>
                                            <dt><strong class="required">*</strong> 행사기간</dt>
                                            <dd>
                                                <div class="radio-wrap cst">
                                                    @foreach($groupConfig['options']['date_type'] as $date_type_key => $date_type_val)
                                                        <div class="radio-group">
                                                            <input type="radio" name="date_type" id="date_type_{{ $date_type_key }}" value="{{ $date_type_key }}" {{ (($group_conference->date_type ?? 'N') == $date_type_key) ? 'checked' : '' }}>
                                                            <label for="date_type_{{ $date_type_key }}">{{$date_type_val}}</label>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </dd>
                                        </dl>
                                    @endif

                                        <dl>
                                            <dt><strong class="required">*</strong> 행사일</dt>
                                            <dd>
                                                <div class="form-group form-group-text n2">
                                                    <input type="text" name="event_sdate" id="event_sdate" class="form-item" value="{{ $group_conference->event_sdate ?? '' }}" readonly datepicker>
                                                    <span class="text">~</span>
                                                    <input type="text" name="event_edate" id="event_edate" class="form-item" value="{{ $group_conference->event_edate ?? '' }}" {{ ($group_conference->date_type ?? '' =='D' ) ? 'disabled=disabled' : '' }} readonly datepicker>
                                                </div>
                                            </dd>
                                        </dl>
                                        <dl>
                                            <dt><strong class="required">*</strong> 장소</dt>
                                            <dd>
                                                <input type="text" name="place" id="place" value="{{ $group_conference->place ?? '' }}" class="form-item">
                                            </dd>
                                        </dl>
                                        <dl>
                                            <dt>사전등록 기간</dt>
                                            <dd>
                                                <div class="form-group form-group-text n2">
                                                    <input type="text" name="regist_sdate" id="regist_sdate" class="form-item" value="{{ $group_conference->regist_sdate ?? '' }}" readonly datepicker>
                                                    <span class="text">~</span>
                                                    <input type="text" name="regist_edate" id="regist_edate" class="form-item" value="{{ $group_conference->regist_edate ?? '' }}" readonly datepicker>
                                                </div>
                                            </dd>
                                        </dl>
                                        <dl>
                                            <dt>초록접수 기간</dt>
                                            <dd>
                                                <div class="form-group form-group-text n2">
                                                    <input type="text" name="abs_sdate" id="abs_sdate" class="form-item" value="{{ $group_conference->abs_sdate ?? '' }}" readonly datepicker>
                                                    <span class="text">~</span>
                                                    <input type="text" name="abs_edate" id="abs_edate" class="form-item" value="{{ $group_conference->abs_edate ?? '' }}" readonly datepicker>
                                                </div>
                                            </dd>
                                        </dl>

                                    @if($groupConfig['use']['link'])
                                        <dl>
                                            <dt>홈페이지 URL</dt>
                                            <dd>
                                                <input type="text" name="link_url" id="link_url" class="form-item" value="{{ $group_conference->linkurl ?? '' }}">
                                            </dd>
                                        </dl>
                                    @endif

                                    @if($groupConfig['use']['hide'])
                                        <dl>
                                            <dt><strong class="required">*</strong> 공개 여부</dt>
                                            <dd>
                                                <div class="radio-wrap cst">
                                                    @foreach($groupConfig['options']['hide'] as $hide_key => $hide_val)
                                                        <div class="radio-group">
                                                            <input type="radio" name="hide" id="hide_{{ $hide_key }}" value="{{ $hide_key }}" {{ (($group_conference->hide ?? 'N') == $hide_key) ? 'checked' : '' }}>
                                                            <label for="hide_{{ $hide_key }}">{{$hide_val}}</label>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </dd>
                                        </dl>
                                    @endif

                                    @if($groupConfig['use']['file'])
                                        <dl>
                                            <dt>첨부 파일</dt>
                                            <dd>
                                                <div class="filebox">
                                                    <input class="upload-name form-item" value="{{ $group->thumb_file ?? '' }}" placeholder="파일첨부" readonly>
                                                    <label for="thumb_file">파일첨부</label>
                                                    <input type="file" id="thumb_file" name="thumb_file" class="file-upload" accept="image/gif, image/jpeg, image/png">
                                                    @if (!empty($group_conference->thumb_file))
                                                    <div class="attach-file">
                                                        <a href="{{ $group_conference->downloadFileUrl('thumb_realfile', 'thumb_file') }}" target="_blank" class="link">{{$group_conference->thumb_file}}</a>
                                                        <a href="javascript:void(0);" class="file_del" data-type="thumb" data-path="{{ $group_conference->thumb_realfile }}"><img src="{{ asset('assets/image/icon/icon_del.png') }}" alt="삭제"></a>
                                                    </div>
                                                    @endif
                                                </div>
                                            </dd>
                                        </dl>
                                    @endif

                                    <dl>
                                        <dd>
                                            <textarea name="content" id="content" class="tinymce">{!! $group_conference->content ?? '' !!} </textarea>
                                        </dd>
                                    </dl>

                                    @if($groupConfig['use']['plupload'])
                                        <dl>
                                            <dd>
                                                <div id="plupload"></div>
                                            </dd>
                                        </dl>
                                    @endif
                                </div>
                                <div class="btn-wrap text-center">
                                    <a href="{{ route('introduce.group.detail', ['sid' => ($group_conference->g_sid ?? request()->g_sid) ]) }} " class="btn btn-type1 color-type4" id="gruoup_cancel">취소</a>
                                    <button type="submit" class="btn btn-type1 color-type5">{{ empty($group_conference->sid) ? '등록' : '수정' }}</button>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </article>
@endsection

@section('addScript')
    <script src="{{ asset('plugins/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ asset('plugins/plupload/2.3.6/plupload.full.min.js') }}"></script>
    <script src="{{ asset('plugins/plupload/2.3.6/jquery.plupload.queue/jquery.plupload.queue.min.js') }}"></script>
    <script src="{{ asset('script/plupload-tinymce.common.js') }}?v={{ config('site.app.asset_version') }}"></script>
    {{--<script src="{{ asset('plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>--}}
    <script src="{{ asset('assets/js/jquery-ui.min.js') }}"></script>

    <script>

        const dataUrl = '{{ route('introduce.group.data') }}';

        const boardConfig = @json($groupConfig);
        const boardForm = '#board-frm';

        $(document).on('click', '#gruoup_cancel', function() {

        });

        $(document).on('click', '.file_del', function() {
            let ajaxData = {};
            ajaxData.case = 'file-delete';
            ajaxData.fileType = $(this).data('type');
            ajaxData.filePath = $(this).data('path');

            actionConfirmAlert('삭제 하시겠습니까?', {'ajax': actionAjax(dataUrl, ajaxData)});
        });

        //행사기간
        $(document).on('click', 'input:radio[name="date_type"]', function() {
            if( $(this).val() == 'D'/*하루행사*/) {
                $('#event_edate').attr('disabled', 'disabled');
                $('#event_edate').val('');
            }else{
                $('#event_edate').attr('disabled', false);
            }
        });

        // 게시글 작성 취소
        $(document).on('click', '#board_cancel', function(e) {
            e.preventDefault();

            const msg = ($(boardForm).data('sid') == 0) ?
                '등록을 취소하시겠습니까?' :
                '수정을 취소하시겠습니까?';

            if (confirm(msg)) {
                {{--location.replace('{{ route('board', ['code' => $code]) }}');--}}
            }
        });


        defaultVaildation();

        // 게시판 폼 체크
        $(boardForm).validate({
            ignore: ['content', 'popup_content'],
            rules: {
                name: {
                    isEmpty: true,
                },
                subject: {
                    isEmpty: true,
                },
                category: {
                    isEmpty: true,
                },
                date_type: {
                    isEmpty: true,
                },
                place: {
                    isEmpty: true,
                },
                event_sdate: {
                    isEmpty: true,
                },
                event_edate: {
                    isEmpty: true,
                },
                hide: {
                    checkEmpty: true,
                },

                content: {
                    isTinyEmpty: true,
                },
            },
            messages: {
                name: {
                    isEmpty: '작성자를 입력해주세요.',
                },
                subject: {
                    isEmpty: `행사명을 입력해주세요.`,
                },
                category: {
                    isEmpty: '구분을 선택해주세요.',
                },
                date_type: {
                    isEmpty: '행사기간을 선택해주세요.',
                },
                place: {
                    isEmpty: '행사장소를 입력해주세요.',
                },
                event_sdate: {
                    isEmpty: '행사일 시작날짜를 선택해주세요.',
                },
                event_edate: {
                    isEmpty: '행사일 마감날짜를 선택해주세요.',
                },
                hide: {
                    checkEmpty: '공개여부를 체크해주세요.',
                },
                content: {
                    isTinyEmpty: '내용을 입력해주세요.',
                },
            },
            submitHandler: function() {

                boardSubmit();
            }
        });

        const boardSubmit = () => {
            let ajaxData = newFormData(boardForm);
            ajaxData.append('content', tinymce.get('content').getContent());
 
            callMultiAjax(dataUrl, ajaxData);
        }
    </script>
@endsection
