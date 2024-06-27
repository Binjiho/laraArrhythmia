@extends('pro.layouts.pro-layout')

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
                        <form id="reply-frm" data-sid="{{ $reply->sid ?? 0 }}" data-bsid="{{ $bsid }}" data-bbs_code="{{ $board->bbs_code }}" data-case="reply-{{ empty($reply->sid) ? 'create' : 'update' }}">
                            <fieldset>
                                <legend class="hide">게시판 답글 글쓰기</legend>
                                <div class="write-wrap">
                                    <dl>
                                        <dt><strong class="required">*</strong> 작성자</dt>
                                        <dd>
                                            <input type="text" name="name" id="name" class="form-item" value="{{ $reply->writer ?? '' }}">
                                        </dd>
                                    </dl>
                                    <dl>
                                        <dt><strong class="required">*</strong> 제목</dt>
                                        <dd>
                                            <input type="text" name="subject" id="subject" class="form-item" value="[RE] {{ $board->subject ?? '' }}" readonly>
                                        </dd>
                                    </dl>
                                    <dl>
                                        <dt><strong class="required">*</strong> 이메일</dt>
                                        <dd>
                                            <input type="text" name="email" id="email" class="form-item" value="{{ $reply->email ?? '' }}">
                                        </dd>
                                    </dl>
                                    <dl>
                                        <dt>LINK URL</dt>
                                        <dd>
                                            <input type="text" name="linkurl" id="linkurl" class="form-item" value="{{ $reply->linkurl ?? '' }}">
                                        </dd>
                                    </dl>

{{--                                    <dl>--}}
{{--                                        <dt>공개 여부</dt>--}}
{{--                                        <dd>--}}
{{--                                            <div class="radio-wrap cst">--}}
{{--                                                @foreach($boardConfig['options']['hide'] as $key => $val)--}}
{{--                                                    <div class="radio-group">--}}
{{--                                                        <input type="radio" name="hide" id="hide_{{ $key }}" value="{{ $key }}" {{ (($board->hide ?? 'N') == $key) ? 'checked' : '' }}>--}}
{{--                                                        <label for="hide_{{ $key }}">{{ $val }}</label>--}}
{{--                                                    </div>--}}
{{--                                                @endforeach--}}
{{--                                            </div>--}}
{{--                                        </dd>--}}
{{--                                    </dl>--}}

                                    @if($boardConfig['use']['plupload'] && ($reply->files_count ?? 0) > 0)
                                        <dl>
                                            <dt>첨부 파일</dt>
                                            <dd>
                                                <div class="filebox">
                                                    @foreach($reply->files as $file)
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
                                            <textarea name="content" id="content" class="tinymce">{{ empty($reply->sid) ? '<br><br>'.'------------------------------------------------------------------------------------------------------------------------------------------------------'.'<br>'.$board->content : $reply->content }}</textarea>
                                        </dd>
                                    </dl>

                                    <dl>
                                        <dd>
                                            <div id="plupload"></div>
                                        </dd>
                                    </dl>

                                </div>

                                <div class="btn-wrap text-center">
                                    <a href="javascript:void(0);" class="btn btn-type1 color-type4" id="reply_cancel">취소</a>
                                    <button type="submit" class="btn btn-type1 color-type5">{{ empty($reply->sid) ? '등록' : '수정' }}</button>
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
        // 답글 작성 취소
        $(document).on('click', '#reply_cancel', function(e) {
            e.preventDefault();

            const msg = ($(replyForm).data('sid') == 0) ?
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
                    directory: boardConfig.directory + '/reply',
                },
                filters: {
                    max_file_size: '20mb'
                },
            });
        }

        defaultVaildation();

        // 게시판 답글 폼 체크
        $(replyForm).validate({
            rules: {
                name: {
                    isEmpty: true,
                },
                subject: {
                    isEmpty: true,
                },
                email: {
                    isEmpty: true,
                },
                contents: {
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
                email: {
                    isEmpty: '이메일을 입력해주세요.',
                },
                contents: {
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
                                replySubmit();
                            } else {
                                alert('파일 업로드 실패');
                                location.reload();
                            }
                        });

                        return false;
                    }
                }

                replySubmit();
            }
        });

        const replySubmit = () => {
            let ajaxData = newFormData(replyForm);
            ajaxData.append('bsid', $(replyForm).data('bsid'));
            ajaxData.append('bbs_code', $(replyForm).data('bbs_code'));
            ajaxData.append('plupload_file', JSON.stringify(plupladFile));
            ajaxData.append('content', tinymce.get('content').getContent());
            callMultiAjax(dataUrl, ajaxData);
        }
    </script>
@endsection
