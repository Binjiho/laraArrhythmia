@extends('layouts.pop-layout')

@section('addStyle')
    <link type="text/css" rel="stylesheet" href="{{ asset('plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}"/>
@endsection

@section('contents')
    <div class="popup-wrap win-popup-wrap">
        <div class="popup-contents">
            <div class="popup-tit-wrap">
                <h3 class="popup-tit">회비 납부</h3>
            </div>
            <div class="popup-conbox">
                <form id="fee-frm" action="{{ route('mypage.data') }}" method="post" data-sid="{{ $fee->sid ?? 0 }}" data-case="deposit-create" onsubmit="return false;">
                    <fieldset>
                        <legend class="hide">회비 납부</legend>
                        <div class="table-wrap">
                            <table class="cst-table type-list">
                                <caption class="hide">회비 납부</caption>
                                <colgroup>
                                    <col style="width: 20%;">
                                    <col style="width: 30%;">
                                    <col style="width: 20%;">
                                    <col style="width: 30%;">
                                </colgroup>
                                <tbody>
                                <tr>
                                    <th scope="row">이름</th>
                                    <td class="text-left">{{ $user->name_kr ?? '' }}</td>
                                    <th scope="row">면허번호</th>
                                    <td class="text-left">{{ $user->license_number ?? '' }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">입금예정일</th>
                                    <td class="text-left">
                                        <input type="text" name="deposit_date" id="deposit_date" value="{{ $fee->deposit_date ?? '' }}" class="form-item" readonly datePicker>
                                    </td>
                                    <th scope="row">입금자명</th>
                                    <td class="text-left">
                                        <input type="text" name="depositor" id="depositor" value="{{ $fee->depositor ?? '' }}" class="form-item">
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">입금 계좌번호</th>
                                    <td class="text-left" colspan="3">{{ $infoConfig['bank'] }} / {{ $infoConfig['account'] }}<br>(예금주 : {{ env('APP_NAME') }})</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="table-wrap">
                            <table class="cst-table type-list">
                                <caption class="hide">회비 납부</caption>
                                <colgroup>
                                    <col style="width: 50%;">
                                    <col style="width: 50%;">
                                </colgroup>
                                <thead>
                                <tr>
                                    <th scope="col">회비 구분</th>
                                    <th scope="col">금액</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>{{ $fee->year ?? date('Y') }}년도</td>
                                    <td>{{ number_format($fee->price ?? 0) }}원</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="price-con text-right">
                            &#8361; 결제금액 : <strong class="text-skyblue">{{ number_format($fee->price ?? 0) }}원</strong>
                        </div>

                        <div class="btn-wrap text-center">
                            <a href="#n" id="popup_cancel_btn" class="btn btn-type1 color-type4">취소</a>
                            <button type="submit" class="btn btn-type1 color-type6">확인</button>
                        </div>
                    </fieldset>
                </form>
            </div>
            <a href="#n" class="btn btn-popup-close"><span class="hide">팝업 닫기</span></a>
        </div>
    </div>
@endsection

@section('addScript')
    <script src="{{ asset('plugins/jquery-validation/jquery.validate.min.js') }}"></script>
    <script>
        const form = '#fee-frm';
        const dataUrl = '{{ route('mypage.data') }}'

        defaultVaildation();

        $(form).validate({
            rules: {
                depositor: {
                    isEmpty: true,
                },
                deposit_date: {
                    isEmpty: true,
                },
            },
            messages: {
                depositor: {
                    isEmpty: '입금자명을 입력해주세요.',
                },
                deposit_date: {
                    isEmpty: '입금예정일을 선택해주세요.',
                },
            },
            submitHandler: function () {
                // callAjax($(form).attr('action'), formSerialize(form));
                registerSubmit();
            }
        });

        const registerSubmit = () => {
            let ajaxData = newFormData(form);
            // if($("input[name='mypage']").val()=='Y'){
            //     ajaxData.case = 'overseas-mypage-update';
            // }
            callMultiAjax(dataUrl, ajaxData);
        }
    </script>
@endsection
