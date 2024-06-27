@extends('admin.layouts.pop-layout')

@section('addStyle')
@endsection

@section('contents')
    <div class="popupWrap" id="popupAdmin" style="width: 100%;">
        <h1>주소록 {{ empty($address->sid) ? '추가' : '수정' }}</h1>

        <div class="popupCon">
            <div class="formArea">
                <form action="{{ route('mail.address.data') }}" id="mail-address-frm" method="post" data-sid="{{ $address->sid ?? 0 }}" data-case="address-{{ empty($address->sid) ? 'create' : 'update' }}" onsubmit="return false;">
                    <fieldset>
                        <legend>주소록 {{ empty($address->sid) ? '추가' : '수정' }}</legend>

                        <table class="inputTbl">
                            <colgroup>
                                <col style="width: 25%;">
                                <col style="width: *;">
                            </colgroup>
                            <tbody>
                            <tr>
                                <th style="text-align: center;">주소록<br>그룹명칭</th>
                                <td>
                                    <input type="text" name="title" value="{{ $address->title ?? '' }}">
                                </td>
                            </tr>
                            </tbody>
                        </table>

                        <div class="btnArea btn">
                            <input type="submit" value="{{ empty($address->sid) ? '등록' : '수정' }}" class="btnPoint">
                            <input type="button" id="popup_cancel_btn" value="취소" class="btnBig btnReset">
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('addScript')
    <script src="{{ asset('plugins/jquery-validation/jquery.validate.min.js') }}"></script>
    <script>
        const form = '#mail-address-frm';

        defaultVaildation();

        $(form).validate({
            rules: {
                title: {
                    isEmpty: true,
                },
            },
            messages: {
                title: {
                    isEmpty: '주소록 명칭을 입력해주세요.',
                },
            },
            submitHandler: function () {
                callAjax($(form).attr('action'), formSerialize(form));
            }
        });

        $(document).on('click', '.btnSelect', function() {
            const data = $(this).data();

            if(parents === 'fee-registration') {
                $(opener.document).find("input[name=u_sid]").val(data.sid);
                $(opener.document).find("#uid").html(`${data.name_kr} (${data.uid})`);
            }

            if(parents === 'committee-individual') {
                $(opener.document).find("input[name=uid]").val(data.uid);
                $(opener.document).find("input[name=name_kr]").val(data.name_kr);
                $(opener.document).find("input[name=office]").val(data.office);
                $(opener.document).find("input[name=email]").val(data.email);
            }

            window.close();
        });
    </script>
@endsection
