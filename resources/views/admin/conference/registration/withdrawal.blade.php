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
            <a href="{{ route('conference.registration', ['csid' => request()->csid]) }}" class="btnBdNavy">전체 List</a>
            <a href="javascript:void(0);" class="btnGrey2">삭제 List</a>
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
                    <td>접수번호</td>
                    <td>회원구분</td>
                    <td>가입구분</td>
                    <td>이름</td>
                    <td>면허번호</td>
                    <td>E-mail</td>
                    <td>병원명<br>(소속)</td>
                    <td>휴대폰번호</td>
                    <td>납부금액</td>
                    <td>입금상태</td>
                    <td>입금예정일</td>
                    <td>입금완료일</td>
                    <td>참석여부</td>
                    <td>영수증</td>
                    <td>메일</td>
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

        $(document).on('click', '.btn-delete', function() {
            if (confirm('완전히삭제 하시겠습니까?')) {
                callAjax(dataUrl, {
                    'case': 'registration-forceDelete',
                    'sid': thisPk(this),
                });
            }
        });
    </script>
@endsection
