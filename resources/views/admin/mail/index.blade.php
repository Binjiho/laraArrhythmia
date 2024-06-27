@extends('admin.layouts.admin-layout')

@section('addStyle')
{{--    <link type="text/css" rel="stylesheet" href="{{ asset('plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}"/>--}}
@endsection

@section('contents')
    <div class="contents">
        <div class="titArea">
            <h2>메일관리</h2>
        </div>

        <div class="formArea">
            <form id="search-frm" action="{{ route('mail') }}" method="get">
                <fieldset>
                    <legend>검색</legend>

                    <table class="inputTbl">
                        <colgroup>
                            <col style="width: 10%;">
                            <col style="width: 20%;">
                            <col style="width: 10%;">
                            <col style="width: 20%;">
                        </colgroup>
                        <tbody>
                        <tr>
                            <th>메일 제목</th>
                            <td><input type="text" name="subject" id="subject" value="{{ request()->subject ?? '' }}" style="width: 100%;"></td>
                            <th>발송자명</th>
                            <td><input type="text" name="sender_name" id="sender_name" value="{{ request()->sender_name ?? '' }}" style="width: 100%;"></td>
                        </tr>
                        <tr>
                            <th><label>작성일</label></th>
                            <td class="term">
                                <input type="text" name="create_sDate" id="create_sDate" value="{{ request()->create_sDate ?? '' }}" readonly datepicker>
                                <span>~</span>
                                <input type="text" name="create_eDate" id=create_eDate" value="{{ request()->create_eDate ?? '' }}" readonly datepicker>
                            </td>

                            <th><label>발송일</label></th>
                            <td class="term">
                                <input type="text" name="sDate" id="sDate" value="{{ request()->sDate ?? '' }}" readonly datepicker>
                                <span>~</span>
                                <input type="text" name="eDate" id="eDate" value="{{ request()->eDate ?? '' }}" readonly datepicker>
                            </td>
                        </tr>
                        </tbody>
                    </table>

                    <div class="btn btnArea" style="padding-top: 15px;">
                        <button type="submit" class="search" style="background-color: #e86710;">검색</button>
                        <button type="button" class="btnGrey2" onclick="location.replace('{{ route('mail') }}')">초기화</button>
                    </div>
                </fieldset>
            </form>
        </div>

        <div class="util btn ar">
            <a href="{{ route('mail.edit') }}" class="btnSmall btnDef call_popup" style="float: right;" data-popup_name="mail-form" data-width="900" data-height="1000">등 록</a>
        </div>

        <table class="tblDef listTbl">
            <colgroup>
                <col style="width: 4%;">
                <col style="width: *;">
                <col style="width: 13%;">
                <col style="width: 7%;">
                <col style="width: 10%;">
                <col style="width: 7%;">
                <col style="width: 6%;">
                <col style="width: 8%;">
                <col style="width: 8%;">
                <col style="width: 6%;">
            </colgroup>

            <thead>
            <tr>
                <th>No</th>
                <th>제목</th>
                <th>발송자명</th>
                <th>Send</th>
                <th>대기/실패/성공</th>
                <th>발송횟수</th>
                <th>재발송</th>
                <th>작성일</th>
                <th>최종발송일</th>
                <th>관리</th>
            </tr>
            </thead>

            <tbody>
            @forelse($mail as $row)
                @php($mailCnt = $row->mailCnt())
                
                <tr data-sid="{{ $row->sid }}">
                    <td>{{ $row->seq }}</td>
                    <td>
                        <a href="{{ route('mail.preview', ['sid' => $row->sid]) }}" class="call_popup" data-popup_name="mail-preview" data-width="700" data-height="900" style="font-weight: bold">{{ $row->subject }}</a>
                    </td>
                    <td>{{ $row->sender_name }}</td>
                    <td>{{ number_format(array_sum(array_values($mailCnt))) }}</td>
                    <td>
                        <span style="color: #eb5e00!important;">{{ number_format($mailCnt['R'] ?? 0) }}</span>/
                        <span class="fcRed">{{ number_format($mailCnt['F'] ?? 0) }}</span>/
                        <span style="color: #0e9ad0 !important;">{{ number_format($mailCnt['S'] ?? 0) }}</span>

                        <div class="btn tm10">
                            <a href="{{ route('mail.detail', ['ml_sid' => $row->sid]) }}" class="btnSmall btnGrey">상세보기</a>
                        </div>
                    </td>
                    <td>{{ number_format($row->thread) }}</td>
                    <td>
						<div class="btn">
							@if(isDateEmpty($row->send_date))
								<a href="javascript:void(0);" class="btnSmall btnGrey new-mail">발송</a>
							@else
								<a href="javascript:void(0);" class="btnSmall btnBlue re-mail">재발송</a>
							@endif
						</div>
                    </td>
                    <td>{{ $row->created_at->format('Y-m-d') }}</td>
                    <td>{{ isDateEmpty($row->send_date) ? '' : $row->send_date->format('Y-m-d') }}</td>
                    <td>
                        <a href="{{ route('mail.edit', ['sid' => $row->sid]) }}" class="call_popup" data-popup_name="mail-form" data-width="900" data-height="1000">
                            <img src="{{ asset('assets/image/admin/icon_modify.png') }}" alt="수정">
                        </a>
                        <a href="javascript:void(0);" class="del-btn"><img src="{{ asset('assets/image/admin/icon_del.png') }}" alt="삭제"></a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="12">메일 내역이 없습니다.</td>
                </tr>
            @endforelse
            </tbody>
        </table>

        <ul class="pager">
            {{ $mail->links('pagination::custom') }}
        </ul>
    </div>
@endsection

@section('addScript')
{{--    <script src="{{ asset('plugins/moment/js/moment.min.js') }}"></script>--}}
{{--    <script src="{{ asset('plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>--}}
    <script>
        const form = '#search-frm';
        const dataUrl = '{{ route('mail.data') }}';

        callDatePicker();

        const mailSendAction = (sid, msg) => {
            let ajaxData = {};
            ajaxData.case = 'mail-resend';
            ajaxData.sid = sid;

            actionConfirmAlert(msg, {'ajax': actionAjax(dataUrl, ajaxData)})
        }

        $(document).on('click', '.new-mail', function() {
            mailSendAction($(this).parents('tr').data('sid'), '메일을 발송 하시겠습니까?');
        });

        $(document).on('click', '.re-mail', function() {
            mailSendAction($(this).parents('tr').data('sid'), '메일을 재발송 하시겠습니까?');
        });

        $(document).on('click', '.del-btn', function() {
            let ajaxData = {};
            ajaxData.case = 'mail-delete';
            ajaxData.sid = $(this).parents('tr').data('sid');

            actionConfirmAlert('삭제 하시겠습니까?', {'ajax': actionAjax(dataUrl, ajaxData)})
        });
    </script>
@endsection
