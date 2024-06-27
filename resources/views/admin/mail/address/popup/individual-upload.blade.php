@extends('admin.layouts.pop-layout')

@section('addStyle')
    <link type="text/css" rel="stylesheet" href="{{ asset('plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}"/>
@endsection

@section('contents')
    <div class="popupWrap" id="popupAdmin" style="padding: 20px 0;">
        <h1>명단 {{ empty($address->sid) ? '추가' : '수정' }}</h1>
        <div class="popupCon">
            <div class="formArea">
                <form method="post" action="{{ route('mail.address.list.data', ['ma_sid' => request()->ma_sid]) }}" id="individual-frm" data-sid="{{ $address->sid ?? 0 }}" data-case="{{ empty($address->sid) ? 'individual-create' : 'addressList-update' }}" onsubmit="return false;">
                    <fieldset>
                        <legend>명단 {{ empty($address->sid) ? '추가' : '수정' }}</legend>
                        <table class="inputTbl">
                            <colgroup>
                                <col style="width: 25%;">
                                <col style="width: *;">
                            </colgroup>
                            <tbody>
                            <tr>
                                <th><label class="">이름</label></th>
                                <td><input type="text" name="name" id="name" value="{{ $address->name ?? '' }}"></td>
                            </tr>
                            <tr>
                                <th><label class="">이메일</label></th>
                                <td><input type="text" name="email" id="email" value="{{ $address->email ?? '' }}"></td>
                            </tr>
                            <tr>
                                <th><label class="">휴대폰번호</label></th>
                                <td><input type="text" name="phone" id="phone" value="{{ $address->phone ?? '' }}" phoneHyphen></td>
                            </tr>
                            </tbody>
                        </table>

                        <div class="btn btnArea">
                            <input type="submit" value="{{ empty($address->sid) ? '등록' : '수정' }}" class="btnBig btnOk">
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
        const form = '#individual-frm';

        defaultVaildation();

        $(form).validate({
            rules: {
                name: {
                    isEmpty: true,
                },
                email: {
                    isEmpty: true,
                    email: true,
                },
                phone: {
                    isEmpty: true,
                    telRegExp: true,
                },
            },
            messages: {
                name: {
                    isEmpty: '이름을 입력해주세요.',
                },
                email: {
                    isEmpty: '이메일을 입력해주세요.',
                    email: '올바른 이메일 형식을 입력해주세요.',
                },
                phone: {
                    isEmpty: '휴대폰 번호를 입력해주세요.',
                    telRegExp: '올바른 휴대폰 형식을 입력해주세요.',
                },
            },
            submitHandler: function () {
                callAjax($(form).attr('action'), formSerialize(form));
            }
        });
    </script>
@endsection
