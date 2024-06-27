@extends('admin.layouts.admin-layout')

@section('addStyle')
@endsection

@section('contents')
    <div class="contents">
        <div class="titArea">
            <h2>주소록관리 [{{ $address->title ?? '' }}]</h2>
        </div>

        <div class="searchArea">
            <form id="search-frm" action="{{ route('mail.address.list', ['ma_sid' => request()->ma_sid]) }}" method="get">
                <fieldset>
                    <legend>검색</legend>
                    <select name="searchKey">
                        <option value="name" {{ (request()->searchKey ?? '') === 'name' ? 'selected' : '' }}>이름</option>
                        <option value="email" {{ (request()->searchKey ?? '') === 'email' ? 'selected' : '' }}>이메일</option>
                    </select>

                    <input type="text" name="keyword" value="{{ request()->keyword ?? '' }}">

                    <input class="search" type="submit" value="검색">
                    <button type="button" class="reset" onclick="location.replace('{{ route('mail.address.list', ['ma_sid' => request()->ma_sid]) }}')">검색초기화</button>
                </fieldset>
            </form>
        </div>

        <div class="util btn ar">
{{--            <button class="fl btnDel" type="button" id="all-del-btn">전체 삭제</button>--}}
            <a href="{{ route('mail.address') }}" class="btnDel">목록으로</a>
            <a href="{{ route('mail.address.list.upload', ['type' => 'individual', 'ma_sid' => request()->ma_sid]) }}" class="btnBdNavy call_popup" data-popup_name="addressList-individual" data-width="600" data-height="344">직접입력</a>
            <a href="{{ route('mail.address.list.upload', ['type' => 'collective', 'ma_sid' => request()->ma_sid]) }}" class="btnBdBlue call_popup" data-popup_name="addressList-collective" data-width="730" data-height="700">엑셀업로드</a>
        </div>

        <table class="tblDef listTbl" id="addressList-table">
            <colgroup>
                <col style="width:*;">
                <col style="width:25%;">
                <col style="width:25%;">
                <col style="width:25%;">
                <col style="width:10%;">
            </colgroup>
            <thead>
            <tr>
                <th>No</th>
                <th>이름</th>
                <th>이메일</th>
                <th>휴대폰번호</th>
                <th>관리</th>
            </tr>
            </thead>
            <tbody>
            @forelse($list ?? [] as $row)
                <tr data-sid="{{ $row->sid }}">
                    <td>{{ $row->seq }}</td>
                    <td>{{ $row->name }}</td>
                    <td>{{ $row->email }}</td>
                    <td>{{ $row->phone }}</td>
                    <td>
                        <a href="{{ route('mail.address.list.upload', ['type' => 'individual', 'ma_sid' => request()->ma_sid, 'sid' => $row->sid]) }}" class="call_popup" data-popup_name="addressList-individual" data-width="600" data-height="344">
                            <img src="{{ asset('assets/image/admin/icon_modify.png') }}" alt="수정">
                        </a>
                        <a href="javascript:void(0);" class="del-btn"><img src="{{ asset('assets/image/admin/icon_del.png') }}" alt="삭제"></a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">등록된 명단이 없습니다.</td>
                </tr>
            @endforelse
            </tbody>
        </table>

        {{ $list->links('pagination::custom') }}
    </div>
@endsection

@section('addScript')
    <script>
        const dataUrl = '{{ route('mail.address.list.data', ['ma_sid' => request()->ma_sid]) }}';

        $(document).on('click', '#all-del-btn', function() {
            let ajaxData = {};
            ajaxData.case = 'addressList-delete';

            actionConfirmAlert('전체 리스트를 삭제하시겠습니까?', {'ajax': actionAjax(dataUrl, ajaxData)})
        });

        $(document).on('click', '.del-btn', function() {
            let ajaxData = {};
            ajaxData.case = 'addressList-delete';
            ajaxData.sid = $(this).parents('tr').data('sid');

            actionConfirmAlert('삭제 하시겠습니까?', {'ajax': actionAjax(dataUrl, ajaxData)})
        });

        // $('#addressList-table tbody').sortable({
        //     start: function (event, ui) {
        //         ui.item.data('start_index', ui.item.index());
        //     },
        //     stop: function (event, ui) {
        //         const si = ui.item.data('start_index');
        //         const ei = ui.item.index();
        //
        //         if (si !== ei) {
        //             let sortData = [];
        //             $('#addressList-table tbody tr').each(function (key, val) {
        //                 sortData.push({'sid': $(val).data('sid'), 'seq': key + 1});
        //             });
        //
        //             let ajaxData = {};
        //             ajaxData.case = 'addressList-seq';
        //             ajaxData.sortData = sortData;
        //
        //             callAjax(dataUrl, ajaxData);
        //         }
        //     }
        // }).disableSelection();
    </script>
@endsection
