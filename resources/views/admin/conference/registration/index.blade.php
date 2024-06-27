@extends('admin.layouts.admin-layout')

@section('addStyle')
@endsection

@section('contents')
    <div class="contents">
        <div class="titArea">
            <h2>사전등록 관리 - {{ $conference->subject }}</h2>
        </div>

        @include('admin.conference.registration.include.search-frm', ['routeName' => request()->route()->getName()])

        <div class="util btn" style="display: flex; justify-content: flex-start; margin-top: 20px;">
            <a href="javascript:void(0);" class="btnGrey2">전체 List</a>
            <a href="{{ route('conference.registration.withdrawal', ['csid' => request()->csid]) }}" class="btnBdNavy">삭제 List</a>
        </div>

        <table class="tblDef listTbl">
            <colgroup>
                <col style="width: 4%;">
                <col style="width: 6%;">

                <col>
                <col>
                <col>
                <col>
                <col>
                <col>
                <col>
                <col>
                <col>
                <col>
                <col>
                <col>
                <col>
                <col>
                <col>
            </colgroup>
            <thead>
            <tr>
                <th>No</th>
                <th>접수번호</th>
                <th>회원구분</th>
                <th>가입구분</th>
                <th>이름</th>
                <th>면허번호</th>
                <th>E-mail</th>
                <th>병원명<br>(소속)</th>
                <th>휴대폰번호</th>
                <th>납부금액</th>
                <th>입금상태</th>
                <th>입금예정일</th>
                <th>입금완료일</th>
                <th>참석여부</th>
                <th>영수증</th>
                <th>메일</th>
                <th>관리</th>
            </tr>
            </thead>
            <tbody>
            @forelse($list as $row)
                <tr data-sid="{{ $row->sid }}">
                    <td>{{ $row->seq }}</td>
                    <td>{{ $row->regnum ?? '' }}</td>
                    <td>{{ $userConfig['level'][$row->user->level ?? '' ] ?? '' }}</td>
                    <td>{{ $userConfig['category'][$row->user->category ?? '' ] ?? '' }}</td>
                    <td>{{ $row->name_kr ?? '' }}</td>
                    <td>{{ $row->license_number ?? '' }}</td>
                    <td>{{ $row->uid ?? '' }}</td>
                    <td>{{ $row->sosok_kr ?? '' }}</td>
                    <td>{{ $row->phone[0] ?? [] }}-{{ $row->phone[1] ?? [] }}-{{ $row->phone[2] ?? [] }}</td>
                    <td>{{ number_format($row->tot_pay) ?? '0' }}원</td>
                    <td>{{ $conferenceConfig['pay_status'][$row->pay_status ?? ''] ?? '' }}</td>
                    <td>{{ $row->sender_date ? $row->sender_date->format('Y-m-d') : '' }}</td>
                    <td>{{ $row->send_complete_date ? $row->send_complete_date->format('Y-m-d') : '' }}</td>
                    <td>
                        <select name="change_result">
                            @foreach($conferenceConfig['attend'] as $key => $val)
                                <option value="{{ $key }}" {{ $key === $row->attend ? 'selected' : '' }}>{{ $val }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <div class="btn">
                            <a href="javascript:alert('준비중입니다.');" class="btnSmall btnGrey2">영수증</a>
                        </div>
                    </td>
                    <td>
                        <div class="btn">
{{--                            <a href="javascript:alert('준비중입니다.');" class="btnSmall btnGrey2"></a>--}}
                            <a href="{{ route('mail.resend', ['search' => '사전등록', 'email'=>$row->uid ]) }}" class="btnSmall btnGrey2 call_popup" data-popup_name="mail-resend" data-width="900" data-height="800" style="font-weight: bold">재발송</a>
                        </div>
                    </td>
                    <td>
                        <a href="{{ route('conference.registration.modify', ['csid' => request()->csid, 'sid' => $row->sid]) }}" class="call_popup" data-popup_name="registration-modify" data-width="1200" data-height="900">
                            <img src="{{ asset('assets/image/admin/icon_modify.png') }}" alt="수정">
                        </a>
                        <a href="javascript:void(0);" class="btn-delete"><img src="{{ asset('assets/image/admin/icon_del.png') }}" alt="삭제"></a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="17">등록된 사전등록이 없습니다.</td>
                </tr>
            @endforelse
            </tbody>
        </table>

        <div class="paging-wrap">
            {{ $list->links('pagination::custom') }}
        </div>
    </div>
@endsection

@section('addScript')
    <script>
        const dataUrl = '{{ route('conference.registration.data', ['csid' => request()->csid]) }}';
        const thisPk = (_this) => {
            return $(_this).closest('tr').data('sid');
        }

        $(document).on('change', "select[name='change_result']", function() {
            let ajaxData = {};
            ajaxData.case = 'change-result';
            ajaxData.sid = $(this).parents('tr').data('sid');
            ajaxData.target = $(this).val();

            if (confirm('변경 하시겠습니까?')) {
                callAjax(dataUrl, ajaxData);
            }
        });

        $(document).on('click', '.btn-delete', function() {
            if (confirm('삭제 하시겠습니까?')) {
                callAjax(dataUrl, {
                    'case': 'registration-delete',
                    'sid': thisPk(this),
                });
            }
        });
    </script>
@endsection
