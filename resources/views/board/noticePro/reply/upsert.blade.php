@extends('layouts.web-layout')

@section('addStyle')
    <link type="text/css" rel="stylesheet" href="{{ asset('plugins/plupload/2.3.6/jquery.plupload.queue/css/jquery.plupload.queue.css') }}" />
@endsection

@section('contents')
    <form id="reply-frm" data-sid="{{ $reply->sid ?? 0 }}" data-b_sid="{{ $b_sid }}" data-case="reply-{{ empty($reply->sid) ? 'create' : 'update' }}">
        <fieldset>
            <legend>게시판 답글 글쓰기</legend>
            <table class="inputTbl">
                <colgroup>
                    <col style="width:15%;">
                    <col style="width:*;">
                </colgroup>

                <tbody>
                <tr>
                    <th>{{ $boardConfig['subject'] }}</th>
                    <td>
                        <input type="text" name="subject" id="subject" value="{{ $reply->subject ?? '' }}">
                    </td>
                </tr>

                @if($boardConfig['use']['file'])
                    <tr>
                        <th>{{ $boardConfig['file']['name'] }}</th>
                        <td>
                            <input type="file" name="attach_file" id="attach_file" onchange="fileCheck(this)" onclick="return fileDelCheck('#attach_file_del')">

                            @if (!empty($reply->file_path))
                                <div style="display: flex; align-items: center">
                                    <input type="checkbox" name="attach_file_del" id="attach_file_del">
                                    <label for="attach_file_del" style="margin-left: 0.3rem; margin-right: 0.5rem;"> 삭제 - </label>

                                    <a href="{{ $reply->downloadUrl() }}">
                                        {{ $reply->file_name }}
                                    </a>

                                    <span style="margin-left: 0.3rem;">(다운 : {{ number_format($reply->download) }})</span>
                                </div>
                            @endif
                        </td>
                    </tr>
                @endif

                @if($boardConfig['use']['plupload'] && ($reply->files_count ?? 0) > 0)
                    <tr>
                        <th>첨부파일</th>
                        <td colspan="3">
                            @foreach($reply->files as $key => $file)
                                <div style="display: flex; align-items: center">
                                    <input type="checkbox" name="plupload_file_del[]" id="plupload_file_del_{{ $key }}" value="{{ $file->sid }}">
                                    <label for="plupload_file_del_{{ $key }}" style="margin-left: 0.3rem; margin-right: 0.5rem;"> 삭제 - </label>

                                    <a href="{{ $file->downloadUrl() }}">
                                        {{ $file->file_name }}
                                    </a>

                                    <span style="margin-left: 0.3rem;">(다운 : {{ number_format($file->download) }})</span>
                                </div>
                            @endforeach
                        </td>
                    </tr>
                @endif

                <tr>
                    <td class="pluginArea" colspan="2">
                        <textarea name="contents" id="contents" class="tinymce">{{ $reply->contents ?? '' }}</textarea>
                    </td>
                </tr>

                @if($boardConfig['use']['plupload'])
                    <tr>
                        <td class="pluginArea" colspan="2">
                            <div id="plupload"></div>
                        </td>
                    </tr>
                @endif
                </tbody>
            </table>

            <div class="btnArea btn">
                <input type="submit" class="btnOk btnBig" value="확인">
                <input type="button" class="btnReset btnBig" value="취소" id="reply_cancel">
            </div>
        </fieldset>
    </form>
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
                subject: {
                    isEmpty: true,
                },
                contents: {
                    isTinyEmpty: true,
                },
            },
            messages: {
                subject: {
                    isEmpty: `${boardConfig.subject}을 입력해주세요.`,
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
            ajaxData.append('b_sid', $(replyForm).data('b_sid'));
            ajaxData.append('plupload_file', JSON.stringify(plupladFile));

            callMultiAjax(dataUrl, ajaxData);
        }
    </script>
@endsection
