@extends('admin.layouts.admin-layout')

@section('addStyle')
@endsection

@section('contents')
    <div class="contents">
        <div class="titArea">
            <h2>초록 관리 - {{ $conference->subject }}</h2>
        </div>

        @include('admin.conference.abstract.include.search-frm', ['routeName' => request()->route()->getName()])

        <div class="util btn" style="display: flex; justify-content: flex-start; margin-top: 20px;">
            <a href="javascript:void(0);" class="btnGrey2">전체 List</a>
            <a href="{{ route('conference.abstract.withdrawal', ['csid' => request()->csid]) }}" class="btnBdNavy">삭제 List</a>
        </div>

        <table class="tblDef listTbl">
            <colgroup>
                <col style="width: 4%;">
                <col style="width: 7%;">
                <col style="width: 7%;">
                <col>
                <col style="width: 15%;">
                <col style="width: 8%;">
                <col style="width: 8%;">
                <col style="width: 8%;">
                <col style="width: 6%;">
                <col style="width: 7%;">
                <col style="width: 6%;">
                <col>
            </colgroup>
            <thead>
            <tr>
                <th>No</th>
                <th>접수번호</th>
                <th>발표유형</th>
                <th>초록제목</th>
                <th>접수자 아이디</th>
                <th>접수자 이름</th>
                <th>접수자 소속</th>
                <th>접수일</th>
                <th>접수상태</th>
                <th>메일</th>
                <th>관리</th>
            </tr>
            </thead>
            <tbody>
            @forelse($list as $row)
                <tr data-sid="{{ $row->sid }}">
                    <td>{{ $row->seq }}</td>
                    <td>{{ $row->regnum }}</td>
                    <td>{{ $row->getAbsType() }}</td>
                    <td></td>
                    <td>{{ $row->uid }}</td>
                    <td>{{ $row->name_kr }}</td>
                    <td>{{ $row->sosok_kr }}</td>
                    <td>{{ $row->created_at }}</td>
                    <td>{{ $row->status }}</td>
                    <td>메일</td>
                    <td>
                        <a href="{{ route('conference.abstract.modify', ['csid' => request()->csid, 'sid' => $row->sid]) }}" class="call_popup" data-popup_name="abstract-modify" data-width="1200" data-height="900">
                            <img src="{{ asset('assets/image/admin/icon_modify.png') }}" alt="수정">
                        </a>
                        <a href="javascript:void(0);" class="btn-delete"><img src="{{ asset('assets/image/admin/icon_del.png') }}" alt="삭제"></a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="11">등록된 초록이 없습니다.</td>
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
        const dataUrl = '{{ route('conference.abstract.data', ['csid' => request()->csid]) }}';
        const thisPk = (_this) => {
            return $(_this).closest('tr').data('sid');
        }

        $(document).on('click', '.btn-delete', function() {
            if (confirm('삭제 하시겠습니까?')) {
                callAjax(dataUrl, {
                    'case': 'abstract-delete',
                    'sid': thisPk(this),
                });
            }
        });
    </script>
@endsection
