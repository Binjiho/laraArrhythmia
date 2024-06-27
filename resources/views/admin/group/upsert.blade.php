@extends('admin.layouts.pop-layout')

@section('addStyle')
@endsection

@section('contents')
    <div style="padding: 15px;">
        <div class="titArea">
            <h2>연구회 {{ empty($group->sid) ? '등록' : '수정' }}</h2>
        </div>

        <form id="group-frm" data-sid="{{ $group->sid ?? 0 }}" data-case="group-{{ empty($group->sid) ? 'create' : 'update' }}" onsubmit="return false;">
            <fieldset>
                <table class="tblDef listTbl">
                    <colgroup>
                        <col style="width: 20%;">
                        <col style="width: *;">
                    </colgroup>

                    <tbody>
                    <tr>
                        <th>연구회 명 (국문)</th>
                        <td>
                            <input type="text" name="subject" value="{{ $group->subject ?? '' }}">
                        </td>
                    </tr>

                    <tr>
                        <th>공개 상태</th>
                        <td>
                            @foreach($groupConfig['hide'] as $key => $val)
                                <input type="radio" id="hide_{{ $key }}" name="hide" value="{{ $key }}" {{ $key == ($group->hide ?? '') ? 'checked' : '' }}>
                                <label for="hide_{{ $key }}" style="margin-left: 5px; margin-right: 5px;">{{ $val }}</label>
                            @endforeach
                        </td>
                    </tr>

                    <tr>
                        <th>로고 이미지</th>
                        <td>
                            <div class="filebox">
                                <input class="upload-name form-item" id="logo_text" placeholder="파일 업로드" readonly>
                                <label for="logo">파일 업로드</label>
                                <input type="file" id="logo" name="logo" class="file-upload">
                            </div>

                            @if (!empty($group->logo_realfile))
                                <div style="margin-top: 10px;">
                                    <input type="checkbox" id="logo_del" name="logo_del" value="Y">
                                    <label for="logo_del">삭제 - {{ $group->logo_filename }}</label>
                                </div>
                            @endif
                        </td>
                    </tr>
                    </tbody>
                </table>
            </fieldset>

            <div class="util btn" style="display: flex; justify-content: center; margin-top: 20px;">
                <a href="javascript:window.close();" class="btnBdBlue">닫기</a>
                <input class="btnDel" type="submit" value="{{ empty($group->sid) ? '등록' : '수정' }}">
            </div>
        </form>
    </div>
@endsection

@section('addScript')
    <script>
        const dataUrl = '{{ route('group.data') }}';
        const groupFrm = '#group-frm';

        $(document).on('change', '#logo', function() {
            fileCheck(this, '#logo_text');
        });

        $(document).on('click', '#logo', function(e) {
            if (!fileDelCheck('#logo_del')) {
                e.preventDefault();
            }
        });

        defaultVaildation();

        $(groupFrm).validate({
            rules: {
                subject: {
                    isEmpty: true,
                },
                hide: {
                    checkEmpty: true,
                },
            },
            messages: {
                subject: {
                    isEmpty: '연구회 명 (국문)을 입력해주세요.',
                },
                hide: {
                    checkEmpty: '공개여부를 체크해주세요.',
                },
            },
            submitHandler: function() {
                callMultiAjax(dataUrl, newFormData(groupFrm));
            }
        });
    </script>
@endsection
