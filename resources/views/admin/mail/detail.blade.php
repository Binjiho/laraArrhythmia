@extends('admin.layouts.admin-layout')

@section('addStyle')
    <link type="text/css" rel="stylesheet" href="{{ asset('plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}"/>
@endsection

@section('contents')
    <div class="contents">
        <div class="titArea">
            <h2>메일 발송내역 상세 [{{ $mail->subject }}]</h2>
        </div>

        <table class="tblDef listTbl">
            <caption class="btn" style="width: 100%;height: 30px;visibility: visible;margin: 15px 0;">
{{--                <a href="{{ route('mail.detail.excel', ['ml_sid' => $mail->sid]) }}" class="btnDef" style="float: right;">엑셀백업</a>--}}
            </caption>

            <colgroup>
                <col style="width: 5%;">
                <col style="width: 13%;">
                <col style="width: *;">
                <col style="width: 10%;">
                <col style="width: 30%;">
                <col style="width: 10%;">
            </colgroup>

            <thead>
            <tr>
                <th>No</th>
                <th>받는이</th>
                <th>받는이 이메일</th>
                <th>상태</th>
                <th>상태 메세지</th>
                <th>재발송</th>
{{--                <th>삭제</th>--}}
            </tr>
            </thead>

            <tbody>
            @forelse($list as $row)
                <tr data-sid="{{ $row->sid }}">
                    <td>{{ $row->seq }}</td>
                    <td>{{ $row->recipient_name }}</td>
                    <td>{{ $row->recipient_email }}</td>
                    <td>
                        @if($row->status === 'S')
                            <span style="color: #0e9ad0 !important;">성공</span>
                        @elseif($row->status === 'F')
                            <span class="fcRed">실패</span>
                        @else
                            <span style="color: #eb5e00!important;">발송중</span>
                        @endif
                    </td>
                    <td>{{ $row->status_msg }}</td>
                    <td class="btn">
                        <a href="javascript:void(0);" class="btnSmall btnBlue re-mail">재발송</a>
                    </td>
{{--                    <td>--}}
{{--                        <a href="javascript:void(0);" class="del-btn"><img src="/image/admin/icon_del.png" alt="삭제"></a>--}}
{{--                    </td>--}}
                </tr>
            @empty
                <tr>
                    <td colspan="12">메일 내역이 없습니다.</td>
                </tr>
            @endforelse
            </tbody>
        </table>

        <ul class="pager">
            {{ $list->links('pagination::custom') }}
        </ul>
    </div>
@endsection

@section('addScript')
    <script>
        const dataUrl = '{{ route('mail.data') }}';

        $(document).on('click', '.re-mail', function() {
            let ajaxData = {};
            ajaxData.case = 'mail-targetResend';
            ajaxData.ml_sid = '{{ request()->ml_sid }}';
            ajaxData.sid = $(this).parents('tr').data('sid');

            actionConfirmAlert('메일을 재발송 하시겠습니까?', {'ajax': actionAjax(dataUrl, ajaxData)})
        });
    </script>
@endsection
