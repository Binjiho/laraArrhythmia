@extends('eng.layouts.eng-layout')

@section('addStyle')
    <link type="text/css" rel="stylesheet" href="{{ asset('plugins/plupload/2.3.6/jquery.plupload.queue/css/jquery.plupload.queue.css') }}" />
@endsection

@section('contents')
    <article class="sub-contents">
        <div class="sub-conbox inner-layer">

{{--            @include('layouts.include.subTit')--}}

            <div id="board" class="board-wrap">
                <div class="board-write">
                    <div class="write-form-wrap">
                        <form id="board-frm" data-sid="{{ $board->sid ?? 0 }}" data-case="board-{{ empty($board->sid) ? 'create' : 'update' }}" onsubmit="return false;">
                            <fieldset>
                                <legend class="hide">글쓰기</legend>
                                <div class="write-wrap">
                                    <dl>
                                        <dt><strong class="required">*</strong> 작성자</dt>
                                        <dd>
                                            <input type="text" name="name" id="name" class="form-item" value="{{ $board->name ?? '' }}">
                                        </dd>
                                    </dl>
                                    <dl>
                                        <dt><strong class="required">*</strong> {{ $boardConfig['subject'] }}</dt>
                                        <dd>
                                            <input type="text" name="subject" id="subject" class="form-item" value="{{ $board->subject ?? '' }}">

                                            <div class="checkbox-wrap cst ">
                                                <div class="checkbox-group">
                                                    <input type="checkbox" name="notice" id="chk-tit1" value="Y" {{ ($board->notice ?? '') == 'Y' ? 'checked' : ''  }}> <label for="chk-tit1">공지</label>
                                                </div>
                                                <div class="checkbox-group">
                                                    <input type="checkbox" name="app_push" id="chk-tit2" value="Y" {{ ($board->app_push ?? '') == 'Y' ? 'checked' : ''  }}> <label for="chk-tit2">푸시</label>
                                                </div>
                                            </div>
                                        </dd>
                                    </dl>


                                    @if($boardConfig['use']['link'])
                                        <dl>
                                            <dt>LINK URL</dt>
                                            <dd>
                                                <input type="text" name="linkurl" id="linkurl" class="form-item" value="{{ $board->linkurl ?? '' }}">
                                            </dd>
                                        </dl>
                                    @endif

                                    @if($boardConfig['use']['hide'])
                                        <dl>
                                            <dt>공개 여부</dt>
                                            <dd>
                                                <div class="radio-wrap cst">
                                                    @foreach($boardConfig['options']['hide'] as $key => $val)
                                                        <div class="radio-group">
                                                            <input type="radio" name="hide" id="hide_{{ $key }}" value="{{ $key }}" {{ (($board->hide ?? 'N') == $key) ? 'checked' : '' }}>
                                                            <label for="hide_{{ $key }}">{{ $val }}</label>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </dd>
                                        </dl>
                                    @endif

                                    @if($boardConfig['use']['popup'])
                                        @php
                                            $popupDisplay = (($board->popup ?? 'N') === 'Y') ? '' : 'none';
                                            $popupDetailDisplay = (($board->popup_detail ?? 'N') === 'Y') ? '' : 'none';
                                            $popupContentDisplay = (($board->popup_select ?? '1') == '2') ? '' : 'none';
                                        @endphp

                                        <dl>
                                            <dt>팝업 설정</dt>
                                            <dd>
                                                <div class="radio-wrap cst">
                                                    @foreach($boardConfig['options']['popup_yn'] as $key => $val)
                                                        <div class="radio-group">
                                                            <input type="radio" name="popup" id="popup_{{ $key }}"  value="{{ $key }}" {{ (($board->popup ?? 'N') == $key) ? 'checked' : '' }}>
                                                            <label for="popup_{{ $key }}">{{ $val }}</label>
                                                        </div>
                                                    @endforeach
                                                </div>

                                                <div class="help-text mt-10 text-red">
                                                    * 다음 게시물을 메인 페이지의 팝업으로 설정합니다.
                                                </div>
                                            </dd>
                                        </dl>

                                        <dl class="popupBox" style="display: {{ $popupDisplay }}">
                                            <dt>팝업 템플릿</dt>
                                            <dd>
                                                <div class="radio-wrap cst">
                                                    @foreach($boardConfig['options']['popup_skin'] as $key => $val)
                                                        <div class="radio-group">
                                                            <input type="radio" name="popup_skin" id="popup_skin_{{ $key }}"  value="{{ $key }}" {{ (($board->skin ?? 'N') == $key) ? 'checked' : '' }}>
                                                            <label for="popup_skin_{{ $key }}">{{ $val }}</label>
                                                        </div>
                                                    @endforeach
                                                </div>

                                                <div class="btn-wrap text-center">
                                                    <button type="button" class="btn btn-type2 color-type5" id="popup_preview">미리보기</button>
                                                </div>
                                            </dd>
                                        </dl>

                                        <dl class="popupBox" style="display: {{ $popupDisplay }}">
                                            <dt>팝업 내용 선택</dt>
                                            <dd>
                                                <div class="radio-wrap cst">
                                                    @foreach($boardConfig['options']['popup_content'] as $key => $val)
                                                        <div class="radio-group">
                                                            <input type="radio" name="popup_select" id="popup_select_{{ $key }}"  value="{{ $key }}" {{ (($board->popup_select ?? 'N') == $key) ? 'checked' : '' }}>
                                                            <label for="popup_select_{{ $key }}">{{ $val }}</label>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </dd>
                                        </dl>

                                        <dl class="popupBox" style="display: {{ $popupDisplay }}">
                                            <dt>팝업 내용 선택</dt>
                                            <dd>
                                                <ul class="popSize">
                                                    <li>
                                                        <span>사이즈 :</span>
                                                        <input type="text" name="width" id="width" value="{{ $popup->width ?? '500' }}" maxlength="4" onlyNumber>
                                                        <span> X </span>
                                                        <input type="text" name="height" id="height" value="{{ $popup->height ?? '400' }}" maxlength="4" onlyNumber>
                                                    </li>

                                                    <li>
                                                        <span>위치 :</span>
                                                        <span>위에서 </span>
                                                        <input type="text" name="position_y" id="position_y" value="{{ $popup->position_y ?? '0' }}" maxlength="4" onlyNumber>
                                                        <span>px, </span>

                                                        <span>왼쪽에서 </span>
                                                        <input type="text" name="position_x" id="position_x" value="{{ $popup->position_x ?? '0' }}" maxlength="4" onlyNumber>
                                                        <span>px</span>
                                                    </li>
                                                </ul>
                                            </dd>
                                        </dl>

                                        <dl class="popupBox" style="display: {{ $popupDisplay }}">
                                            <dt>팝업 자세히 보기</dt>
                                            <dd>
                                                <div class="radio-wrap cst">
                                                    @foreach($boardConfig['options']['popup_detail'] as $key => $val)
                                                        <div class="radio-group">
                                                            <input type="radio" name="popup_detail" id="popup_detail_{{ $key }}"  value="{{ $key }}" {{ (($board->popup_detail ?? 'N') == $key) ? 'checked' : '' }}>
                                                            <label for="popup_detail_{{ $key }}">{{ $val }}</label>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </dd>
                                        </dl>

                                        <dl class="popupBox" style="display: {{ $popupDisplay }}">
                                            <dt>팝업 시작일 / 종료일</dt>
                                            <dd>
                                                <span>시작일 : </span>
                                                <input type="text" name="popup_sDate" id="popup_sDate" value="{{ $popup->popup_sDate ?? '' }}" readonly datepicker>

                                                <span>종료일 : </span>
                                                <input type="text" name="popup_eDate" id="popup_eDate" value="{{ $popup->popup_eDate ?? '' }}" readonly datepicker>
                                            </dd>
                                        </dl>

                                        <dl class="popupDetailBox" style="display: {{ $popupDetailDisplay }}">
                                            <dt>자세히 보기 LINK</dt>
                                            <dd>
                                                <input type="text" value="{{ $popup->popup_link ?? '' }}" name="popup_link" id="popup_link" style="width: 100%;">
                                            </dd>
                                        </dl>

                                        <dl class="popupContentBox" style="display: {{ $popupContentDisplay }}">
                                            <dd>
                                                <textarea name="popup_content" id="popup_content" class="tinymce">{{ $popup->popup_content ?? '' }}</textarea>
                                            </dd>
                                        </dl>
                                    @endif

                                    @if($boardConfig['use']['plupload'] && ($board->files_count ?? 0) > 0)
                                        <dl>
                                            <dt>첨부 파일</dt>
                                            <dd>
                                                <div class="filebox">
                                                    @foreach($board->files as $file)
                                                        <div class="attach-file">
                                                            <a href="{{ $file->downloadUrl() }}" target="_blank" class="link">{{ $file->filename }}</a>
                                                            <a href="javascript:void(0);" class="file_del" data-type="plupload" data-path="{{ $file->realfile }}"><img src="{{ asset('assets/image/icon/icon_del.png') }}" alt="삭제"></a>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </dd>
                                        </dl>
                                    @endif

                                    <dl>
                                        <dd>
                                            <textarea name="content" id="content" class="tinymce">{{ $board->content ?? '' }}</textarea>
                                        </dd>
                                    </dl>

                                    @if($boardConfig['use']['plupload'])
                                        <dl>
                                            <dd>
                                                <div id="plupload"></div>
                                            </dd>
                                        </dl>
                                    @endif
                                </div>
                                <div class="btn-wrap text-center">
                                    <a href="javascript:void(0);" class="btn btn-type1 color-type4" id="board_cancel">취소</a>
                                    <button type="submit" class="btn btn-type1 color-type5">{{ empty($board->sid) ? '등록' : '수정' }}</button>
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
    @include("board.{$boardConfig['skin']}.script.default-script")

    <script>
        $(document).on('click', '.file_del', function() {
            let ajaxData = {};
            ajaxData.case = 'file-delete';
            ajaxData.fileType = $(this).data('type');
            ajaxData.filePath = $(this).data('path');

            actionConfirmAlert('삭제 하시겠습니까?', {'ajax': actionAjax(dataUrl, ajaxData)});
        });

        // 게시글 작성 취소
        $(document).on('click', '#board_cancel', function(e) {
            e.preventDefault();

            const msg = ($(boardForm).data('sid') == 0) ?
                '등록을 취소하시겠습니까?' :
                '수정을 취소하시겠습니까?';

            if (confirm(msg)) {
                location.replace('{{ route('board', ['code' => $code]) }}');
            }
        });

        // 첨부파일 (plupload) 사용시
        if(boardConfig.use.plupload) {
            pluploadInit({
                multipart_params: {
                    directory: boardConfig.directory,
                },
                filters: {
                    max_file_size: '20mb'
                },
            });
        }

        // 팝업 사용시
        if(boardConfig.use.popup) {
            // 팝업 설정 radio
            $(document).on('click', 'input:radio[name=popup]', function() {
                if ($(this).val() === "Y") {
                    $(".popupBox").show();
                } else {
                    $(".popupBox").hide();
                    $(".popupBox").find("input:text").val('');
                    tinymce.get('popup_content').getContent('');
                }
            });

            // 팝업 자세히 보기 radio
            $(document).on('click', 'input:radio[name=popup_detail]', function() {
                if ($(this).val() === "Y") {
                    $(".popupDetailBox").show();
                } else {
                    $(".popupDetailBox").hide();
                    $(".popupDetailBox").find("input:text").val('');
                }
            });

            // 팝업 자세히 보기 radio
            $(document).on('click', 'input:radio[name=popup_select]', function() {
                if ($(this).val() == "1") {
                    $(".popupContentBox").hide();
                    tinymce.get('popup_content').getContent('');
                } else {
                    $(".popupContentBox").show();
                }
            });

            // 팝업 미리보기
            $(document).on('click', '#popup_preview', function(e) {
                const subject = $("#subject").val();

                if (isEmpty(subject)) {
                    alert('제목을 입력해주세요.');
                    $('#subject').focus();
                    return;
                }

                if (parseInt($("#width").val()) < popupMinWidth) {
                    alert(`${popupMinWidth} 이상 입력해주세요.`);
                    $('#width').focus();
                    return;
                }

                if (parseInt($("#height").val()) < popupMinHeight) {
                    alert(`${popupMinHeight} 이상 입력해주세요.`);
                    $('#height').focus();
                    return;
                }

                const popupSelect = $('input:radio[name=popup_select]:checked').val();

                if (isEmpty(popupSelect)) {
                    alert(`팝업 내용 선택 을 해주세요.`);
                    $('#input:radio[name=popup_select]').focus();
                    return;
                }

                const contents = (popupSelect == "1")
                    ? 'content'
                    : 'popup_content';

                const tinyVal = tinymce.get(contents).getContent();
                let tinyValChk = tinyVal.replace(/<[^>]*>?/g, ''); // html 태그 삭제
                tinyValChk = tinyValChk.replace(/\&nbsp;/g, ' '); // &nbsp 삭제;

                if (isEmpty(tinyValChk)) {
                    alert('내용을 입력해주세요.');
                    $('#' + contents).focus();
                    return;
                }

                let ajaxData = newFormData(boardForm);
                ajaxData.case = 'popup-preview';

                if ($('.pop-layer').length > 0) {
                    $('.pop-layer').remove();
                }

                callAjax(dataUrl, ajaxData);
            });

            // 팝업 입력정보 체크
            $.validator.addMethod('popupIsEmpty', function(value, element) {
                if ($('input:radio[name=popup]:checked').val() === 'Y') {
                    return !isEmpty(value);
                }

                return true;
            });

            // 팝업 옵션정보 체크
            $.validator.addMethod('popupCheckEmpty', function(value, element) {
                return $(`input[name='${element.name}']:checked`).length > 0
            });

            // 팝업 사이즈 체크
            $.validator.addMethod('popupSize', function(value, element) {
                const size = (element.name === 'width')
                    ? popupMinWidth
                    : popupMinHeight;

                return (parseInt(uncomma(value)) >= size);
            });

            // 팝업 자세히보기 링크 체크
            $.validator.addMethod('popupLinkIsEmpty', function(value, element) {
                return !isEmpty(value);
            });

            // 팝업 내용 체크
            $.validator.addMethod('PopupIsTinyEmpty', function(value, element) {
                if ($('input:radio[name=popup_select]:checked').val() == '2') {
                    let tinyVal = tinymce.get(element.id).getContent(); // 내용 가져오기
                    tinyVal = tinyVal.replace(/<[^>]*>?/g, ''); // html 태그 삭제
                    tinyVal = tinyVal.replace(/\&nbsp;/g, ' '); // &nbsp 삭제

                    return !isEmpty(tinyVal);
                }

                return true;
            });
        }

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
                hide: {
                    checkEmpty: true,
                },
                popup: {
                    checkEmpty: true,
                },
                popup_content: {
                    PopupIsTinyEmpty: true,
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
                    isEmpty: `${boardConfig.subject}을 입력해주세요.`,
                },
                hide: {
                    checkEmpty: '공개여부를 체크해주세요.',
                },
                popup: {
                    checkEmpty: '팝업 설정을 체크해주세요.',
                },
                popup_content: {
                    PopupIsTinyEmpty: '팝업 내용을 입력해주세요.',
                },
                content: {
                    isTinyEmpty: '내용을 입력해주세요.',
                },
            },
            submitHandler: function() {
                if(boardConfig.use.plupload) { // plupload 사용할때
                    const plupload_queue = $('#plupload').pluploadQueue();

                    let fileCnt = plupload_queue.files.length;
                    fileCnt = (fileCnt - previousUploadedFilesCount);

                    if (fileCnt > 0) {
                        spinnerShow();
                        plupload_queue.start();

                        plupload_queue.bind('UploadComplete', function(up, files) {
                            spinnerHide();

                            if (plupload_queue.total.failed === 0) {
                                previousUploadedFilesCount = up.files.length; // 업로드된 파일 수를 저장
                                boardSubmit();
                            } else {
                                alert('파일 업로드 실패');
                                location.reload();
                            }
                        });

                        return false;
                    }
                }

                boardSubmit();
            }
        });

        const boardSubmit = () => {
            let ajaxData = newFormData(boardForm);
            ajaxData.append('plupload_file', JSON.stringify(plupladFile));
            ajaxData.append('content', tinymce.get('content').getContent());
            ajaxData.append('popup_content', tinymce.get('popup_content').getContent());
            callMultiAjax(dataUrl, ajaxData);
        }
    </script>
@endsection
