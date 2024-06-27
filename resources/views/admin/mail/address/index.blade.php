@extends('admin.layouts.admin-layout')

@section('addStyle')
    <style>
        .trainingHide {margin-left: 7px!important;margin-bottom: 4px!important}
    </style>
@endsection

@section('contents')
    <div class="contents">
        <div class="titArea">
            <h2>주소록 관리</h2>
        </div>

        <div class="formArea">
            <form id="search-frm" action="{{ route('mail.address') }}" method="get">
                <fieldset>
                    <legend>검색</legend>

                    <table class="inputTbl">
                        <colgroup>
                            <col style="width: 20%;">
                            <col style="width: 30%;">
                        </colgroup>
                        <tbody>
                            <tr>
                                <th>상세 검색</th>
                                <td>
                                    <select name="search">
                                        <option value="">선택</option>
                                        <option value="title" {{ (request()->search ?? '') === 'title' ? 'selected' : '' }}>주소록 명</option>
                                    </select>
                                </td>
                                <td colspan="2">
                                    <input type="text" name="keyword" id="keyword" value="{{ request()->keyword ?? '' }}">
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <div class="btn btnArea" style="padding-top: 15px;">
                        <button type="submit" class="search" style="background-color: #e86710;">검색</button>
                        <button type="button" class="btnGrey2" onclick="location.replace('{{ route('mail.address') }}')">초기화</button>
                    </div>
                </fieldset>
            </form>
        </div>

        <div class="util btn ar">
            <a href="{{ route('mail.address.edit') }}" class="btnSmall btnDef call_popup" data-popup_name="addressForm" data-width="500" data-height="263">등록</a>
        </div>

        <table class="tblDef listTbl" id="address-table">
            <colgroup>
                <col style="width:*;">
                <col style="width:75%;">
                <col style="width:9%;">
                <col style="width:9%;">
            </colgroup>
            <thead>
            <tr>
                <th>No</th>
                <th>주소록명</th>
                <th>인원</th>
                <th>관리</th>
            </tr>
            </thead>
            <tbody>
            @forelse($list as $row)
                <tr data-sid="{{ $row->sid }}">
                    <td>{{ $row->seq }}</td>
                    <td>
                        <a href="{{ route('mail.address.list', ['ma_sid' => $row->sid]) }}" style="margin-left: 10px;font-weight: bold;">{{ $row->title }}</a>
                    </td>
                    <td>{{ number_format($row->list_count) }}</td>
                    <td>
                        <a href="{{ route('mail.address.edit', ['sid' => $row->sid]) }}" class="btnSmall btnDef call_popup" data-popup_name="addressForm" data-width="500" data-height="263">
                            <img src="{{ asset('assets/image/admin/icon_modify.png') }}" alt="수정">
                        </a>
                        <a href="javascript:void(0);" class="del-btn"><img src="{{ asset('assets/image/admin/icon_del.png') }}" alt="삭제"></a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">등록된 주소록이 없습니다.</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
@endsection

@section('addScript')
    <script>
        const dataUrl = '{{ route('mail.address.data') }}';

        $(document).on('click', '.del-btn', function() {
            let ajaxData = {};
            ajaxData.case = 'address-delete';
            ajaxData.sid = $(this).parents('tr').data('sid');

            actionConfirmAlert('삭제 하시겠습니까?', {'ajax': actionAjax(dataUrl, ajaxData)})
        });
    </script>
@endsection
