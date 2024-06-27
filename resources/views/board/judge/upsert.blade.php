@extends($extends_str)

@section('addStyle')
    <link type="text/css" rel="stylesheet" href="{{ asset('plugins/plupload/2.3.6/jquery.plupload.queue/css/jquery.plupload.queue.css') }}" />
@endsection

@section('contents')
    <article class="sub-contents">
        <div class="sub-conbox inner-layer">

            @if(($extends_str ?? 'main') == 'layouts.web-layout')
                @include('layouts.include.subTit')
            @endif

            <div id="board" class="board-wrap">
                <div class="board-write">
                    <div class="write-form-wrap">
                        <form id="board-frm" data-sid="{{ $board->sid ?? 0 }}" data-case="board-{{ empty($board->sid) ? 'create' : 'update' }}" onsubmit="return false;">
                            <fieldset>
                                <legend class="hide">글쓰기</legend>
                                <div class="write-wrap">
                                    @if($boardConfig['use']['writer'])
                                        <dl>
                                            <dt><strong class="required">*</strong> 작성자</dt>
                                            <dd>
                                                <input type="text" name="name" id="name" class="form-item" value="{{ $board->name ?? '' }}">
                                            </dd>
                                        </dl>
                                    @endif
                                    @if($boardConfig['use']['category'])
                                        <dl>
                                            <dt><strong class="required">*</strong> 카테고리</dt>
                                            <dd>
                                                <select name="category" id="category" class="form-item">
                                                    <option value="">선택</option>
                                                    @foreach($boardConfig['category']['item'] as $category_key => $category_val)
                                                        <option value="{{ $category_key }}" {{ (($board->category ?? '') == $category_key) ? 'selected' : '' }}>{{ $category_val }}</option>
                                                    @endforeach
                                                </select>
                                            </dd>
                                        </dl>
                                    @endif
                                        <dl>
                                            <dt><strong class="required">*</strong> {{ $boardConfig['subject'] }}</dt>
                                            <dd>
                                                <input type="text" name="subject" id="subject" class="form-item" value="{{ $board->subject ?? '' }}">
                                            </dd>
                                        </dl>

                                    @if($boardConfig['use']['file'])
                                        <dl>
                                            <dt><strong class="required">*</strong> 첨부 파일</dt>
                                            <dd>
                                                <div class="filebox">
                                                    <input class="upload-name form-item" value="{{ $board->thumb_file ?? '' }}" placeholder="파일첨부" readonly>
                                                    <label for="thumb_file">파일첨부</label>
                                                    <input type="file" id="thumb_file" name="thumb_file" class="file-upload">
                                                    @if (!empty($board->thumb_file))
                                                        <div class="attach-file">
                                                            <a href="{{ $board->downloadFileUrl('thumb_realfile', 'thumb_file') }}" target="_blank" class="link">{{$board->thumb_file}}</a>
                                                            <a href="javascript:void(0);" class="file_del" data-type="thumb" data-path="{{ $board->thumb_realfile }}"><img src="{{ asset('assets/image/icon/icon_del.png') }}" alt="삭제"></a>
                                                        </div>
                                                    @endif
                                                </div>
                                            </dd>
                                        </dl>
                                    @endif

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
                                                    @foreach($boardConfig['options']['hide'] as $hide_key => $hide_val)
                                                        <div class="radio-group">
                                                            <input type="radio" name="hide" id="hide_{{ $hide_key }}" value="{{ $hide_key }}" {{ (($board->hide ?? 'N') == $hide_key) ? 'checked' : '' }}>
                                                            <label for="hide_{{ $hide_key }}">{{$hide_val}}</label>
                                                        </div>
                                                    @endforeach
                                                </div>
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
                let _url = "{{ route('board', ['code' => $code, 'category' => $category]) }}";
                _url = _url.replace(/&amp;/g, '&');
                location.replace(_url);
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
        

        defaultVaildation();

        // 게시판 폼 체크
        $(boardForm).validate({
            ignore: ['content', 'popup_content'],
            rules: {
                name: {
                    isEmpty: true,
                },
                category: {
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
                category: {
                    isEmpty: '카테고리를 선택해주세요.',
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

            callMultiAjax(dataUrl, ajaxData);
        }
    </script>
@endsection
