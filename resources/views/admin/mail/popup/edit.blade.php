@extends('admin.layouts.pop-layout')

@section('addStyle')
    <style>
        table th {text-align: center!important;}
        .addFileBtn {
            background-color: #4d8eac !important;
            border-color: #4d8eac !important;
            color: #fff !important;
            padding: 5px 7px !important;
            margin-top: 3px !important;
            float: right !important;
            border-radius: 3px !important;
        }

        .delFileBtn {
            background-color: #fff1f4 !important;
            border-color: #eeafbb !important;
            color: #c92b49 !important;
            padding: 5px 7px !important;
            margin-top: 3px !important;
            float: right !important;
            border-radius: 3px !important;
        }
    </style>
@endsection

@section('contents')
    <div class="popupWrap" id="popupAdmin" style="width: 100%;">
        <h1>메일 {{ empty($mail->sid) ? '등록' : '수정' }}</h1>

        <div class="popupCon">
            <div class="formArea">
                <form method="post" action="{{ route('mail.data') }}" id="mail-frm" data-sid="{{ $mail->sid ?? 0 }}" data-case="mail-{{ empty($mail->sid) ? 'create' : 'update' }}" onsubmit="return false;">
                    <fieldset>
                        <legend>메일 {{ empty($mail->sid) ? '등록' : '수정' }}</legend>

                        <table class="inputTbl">
                            <colgroup>
                                <col style="width: 20%;">
                                <col style="*;">
                            </colgroup>
                            <tbody>
                            <tr>
                                <th>제목</th>
                                <td>
                                    <input type="text" name="subject" id="subject" value="{{ $mail->subject ?? '' }}">
                                </td>
                            </tr>
                            <tr>
                                <th>보낸 사람</th>
                                <td>
                                    <input type="text" name="sender_name" id="sender_name" value="{{ $mail->sender_name ?? env('APP_NAME') }}">
                                </td>
                            </tr>
                            <tr>
                                <th>보낸사람 이메일</th>
                                <td>
                                    <input type="text" name="sender_mail" id="sender_mail" value="{{ $mail->sender_mail ?? $mailConfig['email'] }}">
                                </td>
                            </tr>
                            <tr>
                                <th>받는사람</th>
                                <td class="multi">
                                    @foreach($mailConfig['send_type'] as $key => $val)
                                        <input type="radio" name="send_type" id="send_type_{{ $key }}" value="{{ $key }}" {{ ($mail->send_type ?? '') == $key ? 'checked' : '' }}>
                                        <label for="send_type_{{ $key }}">{{ $val }}</label>
                                    @endforeach
                                </td>
                            </tr>
                            <tr style="display:{{ ($mail->send_type ?? '') == 1 ? '' : 'none' }};" id="level-tr">
                                <th>회원등급</th>
                                <td class="multi">
                                    <input type="checkbox" id="level_all" {{ count($mail->level ?? []) == count(config('site.user')['level']) ? 'checked' : '' }}>
                                    <label for="level_all">전체</label>

                                    @foreach(config('site.user')['level'] as $key => $val)
                                        <input type="checkbox" name="level[]" id="level_{{ $key }}" value="{{ $key }}" {{ array_search($key, $mail->level ?? []) !== false ? 'checked' : '' }}>
                                        <label for="level_{{ $key }}">{{ $val }}</label>
{{--                                        <option value="{{ $key }}" {{ ($mail->level ?? '') == $key ? 'selected' : '' }}>{{ $val }}</option>--}}
                                    @endforeach
                                </td>
                            </tr>
                            <tr style="display:{{ ($mail->send_type ?? '') == 2 ? '' : 'none' }};" id="ma_sid-tr">
                                <th>주소록</th>
                                <td>
                                    <select name="ma_sid" style="width: 100%;">
                                        <option value="">주소록을 선택해주세요.</option>
                                        @foreach($address as $row)
                                            <option value="{{ $row->sid }}" {{ ($mail->ma_sid ?? '') == $row->sid ? 'selected' : '' }}>{{ $row->title }}</option>
                                        @endforeach
                                    </select>
                                </td>
                            </tr>
                            <tr style="display:{{ ($mail->send_type ?? '') == 9 ? '' : 'none' }};" id="testEmail-tr">
                                <th>테스트이메일</th>
                                <td class="multi">
                                    <input type="text" name="test_email" id="test_email" value="{{ $mail->test_email ?? '' }}">
                                </td>
                            </tr>
                            <tr>
                                <th>버튼사용</th>
                                <td class="multi">
                                    @foreach($mailConfig['use_btn'] as $key => $val)
                                        <input type="radio" name="use_btn" id="use_btn_{{ $key }}" value="{{ $key }}" {{ ($mail->use_btn ?? '') == $key ? 'checked' : '' }}>
                                        <label for="use_btn_{{ $key }}">{{ $val }}</label>
                                    @endforeach
                                </td>
                            </tr>
                            <tr style="display:{{ ($mail->use_btn ?? 9) != 9 ? '' : 'none' }};" id="link_url-tr">
                                <th>버튼링크</th>
                                <td class="multi">
                                    <input type="text" name="link_url" id="link_url" value="{{ $mail->link_url ?? '' }}">
                                </td>
                            </tr>
                            <tr>
                                <th>파일첨부</th>
                                <td>
                                    @for($i = 1; $i <= 10; $i++)
                                        @php
                                            $mailFile = empty($mail->file) ? [] : json_decode($mail->file);
                                            $file_name = $mailFile[$i - 1]->filename ?? '';
                                            $file_path = $mailFile[$i - 1]->realfile ?? '';
                                            $displayShowCnt = empty($mailFile) ? 1 : count($mailFile);
                                        @endphp

                                        <div class="selectFile" id="fileArea{{ $i }}" data-seq="{{ $i }}" style="display: {{ $i <= $displayShowCnt ? '' : 'none' }};" data-isfile="{{ empty($file_path) ? 'false' : $file_path }}">
                                            <input type="text" id="file_name{{ $i }}" readonly style="width: 35%;" value="{{ $file_name }}">
                                            <span class="search">
                                                파일 <input class="opacity0" name="file[]" id="file{{ $i }}" type="file" >
                                            </span>
                                            <span class="attach" id="attach{{ $i }}">
                                                {{ $file_name }}
                                                @if(!empty($file_name))
                                                    <a href="{{ $mail->downloadFileUrl($file_path, $file_name) }}" style="margin-left: 3px;color: #0f3476; font-weight: bold">DOWNLOAD</a>
                                                    <a href="javascript:void(0);" class="del mailFileDel">삭제</a>
                                                @endif
                                            </span>

                                            @if($i === 1)
                                                <input type="button" value="추가" id="addFileBtn" class="addFileBtn">
                                            @else
                                                <input type="button" value="삭제" class="delFileBtn" style="display: {{ $i == $displayShowCnt ? '' : 'none' }};">
                                            @endif
                                        </div>
                                    @endfor
                                </td>
                            </tr>
                            <tr>
                                <th>메일폼</th>
                                <td class="multi">
                                    @foreach($mailConfig['template'] as $key => $val)
                                        <input type="radio" name="template" id="template_{{ $key }}" value="{{ $key }}" {{ ($mail->template ?? '') == $key ? 'checked' : '' }}>
                                        <label for="template_{{ $key }}">{{ $val }}</label>
                                    @endforeach
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <textarea name="contents" id="contents" class="tinymce">{{ $mail->contents ?? '' }}</textarea>
                                </td>
                            </tr>
                            </tbody>
                        </table>

                        <div class="btnArea btn">
                            <input type="submit" value="{{ empty($mail->sid) ? '등록' : '수정' }}" data-use_send="N" class="btnPoint">
                            <input type="submit" value="{{ empty($mail->sid) ? '등록 후 발송' : '수정 후 발송' }}" data-use_send="Y" class="btnDef">
                            <input type="button" value="미리보기" class="btnBdNavy" id="previewBtn" >
                            <input type="button" id="popup_cancel_btn" value="취소" class="btnBig btnReset">
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
    <input type="hidden" name="preview-open" class="preview-open" value="" >
    <input type="hidden" name="preview-data" value="" >
@endsection

@section('addScript')
    <script>
        const form = '#mail-frm';
        const dataUrl = $(form).attr('action');
    </script>

    <script src="{{ asset('plugins/moment/js/moment.min.js') }}"></script>
    <script src="{{ asset('plugins/tinymce/tinymce.min.js') }}" referrerpolicy="origin"></script>
    <script src="{{ asset('script/plupload-tinymce.common.js') }}?v={{ config('site.default.asset_version') }}"></script>
    <script src="{{ asset('plugins/jquery-validation/jquery.validate.min.js') }}"></script>

    <script>
        $(document).on('click', '.preview-open', function() {
            const preview_pop = window.open('', 'mail-preview', 'width=700,height=900,resizeable,scrollbars');
            preview_pop.document.write($("input[name='preview-data']").val());
        });


        let deleteFile = [];
        let use_send = null; // 저장후 메일 발송 여부

        $(document).on('click', 'input[name=send_type]', function() {
            const value = $(this).val();

            $('#level-tr').hide();
            $('#ma_sid-tr').hide();
            $('#testEmail-tr').hide();

            if(value == 1) {
                $('#level-tr').show();
                return;
            }

            if(value == 2) {
                $('#ma_sid-tr').show();
                return;
            }

            if(value == 9) {
                $('#testEmail-tr').show();
                return;
            }
        });

        $(document).on('click', '#level_all', function() {
            const target = $("input:checkbox[name='level[]']");
            target.prop('checked', $(this).is(':checked'));
        });

        $(document).on('click', "input:checkbox[name='level[]']", function() {
            const target = $("#level_all");
            target.prop('checked', ($("input:checkbox[name='level[]']").length == $("input:checkbox[name='level[]']:checked").length));
        });

        $(document).on('click', 'input[name=use_btn]', function() {
            const value = $(this).val();
            const target = '#link_url-tr';

            (value == 9)
                ? $(target).hide()
                : $(target).show();
        });

        $(document).on('change', "input[name='file[]']", function() {
            const seq = $(this).parents('.selectFile').data('seq');
            const str = $(this).val();
            const fileName = str.split('\\').pop().toLowerCase();

            console.log(fileCheck(this));

            const html = `${fileName}<a href="javascript:void(0);" class="del mailFileDel">삭제</a>`
            $(`#file_name${seq}`).val(fileName);
            $(`#attach${seq}`).html(html);

            // if(fileCheck(this)) {
            //
            //     const html = `${fileName}<a href="javascript:void(0);" class="del mailFileDel">삭제</a>`
            //     $(`#file_name${seq}`).val(fileName);
            //     $(`#attach${seq}`).html(html);
            // }else {
            //     $(`#file${seq}`).val('');
            //     $(`#file_name${seq}`).val('');
            //     $(`#attach${seq}`).html('');
            // }
        });

        $(document).on('click', ".mailFileDel", function() {
            const seq = $(this).parents('.selectFile').data('seq');
            const isFile = $(this).parents('.selectFile').data('isfile');

            if(confirm('파일을 삭제 하시겠습니까?')) {
                if(isFile !== false) {
                    deleteFile.push(isFile);
                    $(this).parents('.selectFile').data('isfile', 'false');
                }

                $(`#file_name${seq}`).val('');
                $(`#file${seq}`).val('');
                $(`#attach${seq}`).html('');
            }
        });

        $(document).on('click', "#addFileBtn", function() {
            const seq = ($(".selectFile").filter(function() { return $(this).css('display') != 'none'; }).length + 1);
            $(`#fileArea${seq}`).show();
            $(`#fileArea${seq}`).find('.delFileBtn').show()

            if(seq > 2 && seq < 11) {
                $(`#fileArea${seq - 1}`).find('.delFileBtn').hide();
            }
        });

        $(document).on('click', ".delFileBtn", function() {
            const seq = $(this).parents('.selectFile').data('seq');
            const isFile = $(this).parents('.selectFile').data('isfile');

            if(isFile !== false) {
                deleteFile.push(isFile);
                $(this).parents('.selectFile').data('isfile', 'false');
            }

            $(`#file_name${seq}`).val('');
            $(`#file${seq}`).val('');
            $(`#attach${seq}`).html('');
            $(`#fileArea${seq}`).hide();

            if(seq > 2) {
                $(`#fileArea${seq - 1}`).find('.delFileBtn').show();
            }
        });

        $(document).on('click', "#previewBtn", function() {
            if($('input[name=template]:checked').length == 0) {
                actionAlert({
                    'case': true,
                    'msg': '템플릿을 선택해주세요.',
                    'focus': 'input[name=template]',
                });
                return;
            }

            let ajaxData = newFormData(form);

            ajaxData.append('case', 'mail-preview');
            ajaxData.append('contents', tinymce.get('contents').getContent());

            if(deleteFile.length > 0) {
                ajaxData.append('del_file', JSON.stringify(deleteFile));
            }

            callMultiAjax("{{ route('mail.data') }}", ajaxData);

            {{--for (const x of ajaxData.values()) {--}}
                {{--    console.log(x);--}}
                {{--}--}}
                {{--console.log('{{ route('mail.data') }}');--}}
                {{--return false;--}}

                // $.ajax({
                //     type: "POST",
                //     processData: false,
                //     contentType: false,
                //     url: $(form).attr('action'),
                //     data: ajaxData,
                //     beforeSend: function () {
                //         spinnerShow();
                //     },
                //     complete: function () {
                //         spinnerHide();
                //     },
                //     success: function (data) {
                //         const preview = window.open('', 'mail-preview', 'width=700,height=900,resizeable,scrollbars');
                //         preview.document.write(data.preview);
                //     },
                //     error: function (data) {
                //         console.log(data);
                //         alert('ERROR');
                //     }
                // });
            });

            defaultVaildation();

            // 받는사람 상세 확인
            $.validator.addMethod('senderCheck', function (value, element) {
                const sendType = $('input[name=send_type]:checked').val();
                const targetName = $(element).attr('name');

                if(parseInt(sendType) === 1 && targetName === 'level[]') {
                    return ($("input:checkbox[name='level[]']:checked").length > 0);
                }

                if(parseInt(sendType) === 2 && targetName === 'ma_sid') {
                    return !isEmpty(value);
                }

                if(parseInt(sendType) === 9 && targetName === 'test_email') {
                    return !isEmpty(value);
                }

                return true;
            });

            // 버튼사용 링크 입력 체크
            $.validator.addMethod('linkCheck', function (value, element) {
                const useBtn = $('input[name=use_btn]:checked').val();
                return (parseInt(useBtn) === 9)
                    ? true
                    : !isEmpty(value);
            });

            $(document).on('click', 'input[type=submit]', function() {
                use_send = $(this).data('use_send');

                $(form).validate({
                    ignore: ['contents'],
                    rules: {
                        subject: {
                            isEmpty: true,
                        },
                        sender_name: {
                            isEmpty: true,
                        },
                        sender_mail: {
                            isEmpty: true,
                        },
                        send_type: {
                            checkEmpty: true,
                        },
                        "level[]": {
                            senderCheck: true,
                        },
                        ma_sid: {
                            senderCheck: true,
                        },
                        test_email: {
                            senderCheck: true,
                        },
                        use_btn: {
                            checkEmpty: true,
                        },
                        link_url: {
                            linkCheck: true,
                        },
                        template: {
                            checkEmpty: true,
                        },
                        contents: {
                            isTinyEmpty: true,
                        },
                    },
                    messages: {
                        subject: {
                            isEmpty: '제목을 입력해주세요.',
                        },
                        sender_name: {
                            isEmpty: '보낸사람을 입력해주세요.',
                        },
                        sender_mail: {
                            isEmpty: '보낸사람 이메일을 입력해주세요.',
                        },
                        send_type: {
                            checkEmpty: '받는사람을 선택해주세요.',
                        },
                        "level[]": {
                            senderCheck: '회원등급을 선택해주세요.',
                        },
                        ma_sid: {
                            senderCheck: '주소록을 선택해주세요.',
                        },
                        test_email: {
                            senderCheck: '테스트이메일을 입력해주세요.',
                        },
                        use_btn: {
                            checkEmpty: '버튼사용을 선택해주세요.',
                        },
                        link_url: {
                            linkCheck: '버튼링크를 입력해주세요.',
                        },
                        template: {
                            checkEmpty: '메일폼을 선택해주세요.',
                        },
                        contents: {
                            isTinyEmpty: '내용을 입력해주세요.',
                        },
                    },
                    submitHandler: function () {
                        let ajaxData = newFormData(form);
                        ajaxData.append('use_send', use_send);
                        ajaxData.append('contents', tinymce.get('contents').getContent());

                        if(deleteFile.length > 0) {
                            ajaxData.append('del_file', JSON.stringify(deleteFile));
                        }

                        use_send = null;
                        callMultiAjax($(form).attr('action'), ajaxData);
                    }
                });
            });
    </script>
@endsection
