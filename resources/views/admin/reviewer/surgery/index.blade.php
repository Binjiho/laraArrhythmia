@extends('admin.layouts.admin-layout')

@section('addStyle')
@endsection

@section('contents')
    <div class="contents">
        <div class="titArea">
            <h2>중재시술인증 심사자 관리</h2>
        </div>

        <form class="searchArea">
            <form id="search-frm" action="{{ route('reviewer',['code'=>'surgery']) }}" method="get">
                <fieldset>
                    <table class="tblDef listTbl">
                        <colgroup>
                            <col style="width: 20%;">
                            <col style="width: 30%;">
                            <col style="width: 20%;">
                            <col style="width: 30%;">
                        </colgroup>

                        <tbody>
                        <tr>
                            <th>이름</th>
                            <td><input type="text" name="name_kr" value="{{ request()->name_kr ?? '' }}"></td>

                            <th>이메일</th>
                            <td><input type="text" name="email" value="{{ request()->email ?? '' }}"></td>

                        </tr>

                        </tbody>
                    </table>
                </fieldset>

                <div class="util btn" style="display: flex; justify-content: center; margin-top: 20px;">
                    <input class="btnDel" type="submit" value="검색">
                    <a href="{{ route('reviewer',['code'=>'surgery']) }}" class="btnBdNavy">검색초기화</a>
                    <a href="{{ route('reviewer.excel', ['code'=>'surgery'], request()->except(['page']) ) }}" class="btnBdBlue">데이터 백업</a>
                </div>
            </form>
        </form>

        <div class="util btn" style="display: flex; justify-content: flex-start; margin-top: 20px;">
            <a href="{{ route('reviewer.upsert',['code'=>'surgery']) }}" class="call_popup btnBdNavy" data-popup_name="fee-create" data-width="900" data-height="900">
                등록
            </a>
        </div>

        

        <table class="tblDef listTbl">
            <colgroup>
                <col style="width: 8%;">
                <col style="width: 15%;">
                <col style="width: 20%;">
                <col style="width: 15%;">
                <col style="width: 15%;">
                <col style="width: 15%;">
                <col style="width: *;">
            </colgroup>
            <thead>
            <tr>
                <th>No</th>
                <th>이름</th>
                <th>소속</th>
                <th>이메일</th>
                <th>심사등급</th>
                <th>등록일</th>
                <th>관리</th>
            </tr>
            </thead>
            <tbody>
            @forelse($list as $row)
                <tr data-sid="{{ $row->sid }}">
                    <td>{{ $row->seq }}</td>
                    <td>{{ $row->user->name_kr }}</td>
                    <td>{{ $row->user->sosok_kr }}</td>
                    <td>{{ $row->user->uid }}</td>
                    <td>{{ $reviewerConfig['level'][$row->level ] ?? '' }}</td>
                    <td>{{ $row->created_at->format('Y-m-d') }}</td>
                    <td>
                        <a href="{{ route('reviewer.upsert', ['sid' => $row->sid, 'code' => $code ]) }}" class="call_popup" data-popup_name="reviewer-modify" data-width="900" data-height="900">
                            <img src="{{ asset('assets/image/admin/icon_modify.png') }}" alt="수정">
                        </a>
                        <a href="javascript:void(0);" class="btn-delete"><img src="{{ asset('assets/image/admin/icon_del.png') }}" alt="삭제"></a>
                    </td>

                </tr>
            @empty
                <tr>
                    <td colspan="13">등록된 내역이 없습니다.</td>
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
    $(document).on('click', '.btn-delete', function() {
        const _case = 'reviewer-delete';
        const _url = "{{ route('reviewer.data', ['code' => $code]) }}";

        if (confirm('삭제 하시겠습니까?')) {
            callAjax( _url, { case: _case, sid: $(this).closest('tr').data('sid') } );
        }
    });
</script>
@endsection