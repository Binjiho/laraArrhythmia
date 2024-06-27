@extends('admin.layouts.admin-layout')

@section('addStyle')
@endsection

@section('contents')
    <div class="contents">
        <div class="titArea">
            <h2>회비관리</h2>
        </div>

        <form class="searchArea">
            <form id="search-frm" action="{{ route('fee') }}" method="get">
                <fieldset>
                    <table class="tblDef listTbl">
                        <colgroup>
                            <col style="width: 13%;">
                            <col style="width: 20%;">
                            <col style="width: 13%;">
                            <col style="width: 20%;">
                            <col style="width: 13%;">
                            <col style="width: 20%;">
                        </colgroup>

                        <tbody>
                        <tr>
                            <th>회원구분</th>
                            <td>
                                <select name="level">
                                    <option value="">회원구분</option>
                                    @foreach($userConfig['level'] as $key => $val)
                                        <option value="{{ $key }}" {{ (request()->level ?? '') === $key ? 'selected' : '' }}>{{ $val }}</option>
                                    @endforeach
                                </select>
                            </td>

                            <th>아이디</th>
                            <td><input type="text" name="uid" value="{{ request()->uid ?? '' }}"></td>

                            <th>이름</th>
                            <td><input type="text" name="name_kr" value="{{ request()->name_kr ?? '' }}"></td>
                        </tr>

                        <tr>
                            <th>E-mail</th>
                            <td><input type="text" name="email" value="{{ request()->email ?? '' }}"></td>

                            <th>납부상태</th>
                            <td colspan="3">
                                <select name="pay_status">
                                    <option value="">선택</option>
                                    @foreach($feeConfig['pay_status'] as $key => $val)
                                        <option value="{{ $key }}" {{ (request()->pay_status ?? '') === $key ? 'selected' : '' }}>{{ $val }}</option>
                                    @endforeach
                                </select>
                            </td>

{{--                            <th>자격구분</th>--}}
{{--                            <td>--}}
{{--                                <select name="level">--}}
{{--                                    <option value="">선택</option>--}}
{{--                                    @foreach($feeConfig['pay_status'] as $key => $val)--}}
{{--                                        <option value="{{ $key }}" {{ (request()->pay_status ?? '') === $key ? 'selected' : '' }}>{{ $val }}</option>--}}
{{--                                    @endforeach--}}
{{--                                </select>--}}
{{--                            </td>--}}
                        </tr>
                        </tbody>
                    </table>
                </fieldset>

                <div class="util btn" style="display: flex; justify-content: center; margin-top: 20px;">
                    <input class="btnDel" type="submit" value="검색">
                    <a href="{{ route('fee') }}" class="btnBdNavy">검색초기화</a>
                    <a href="{{ route('fee.excel', request()->except(['page'])) }}" class="btnBdBlue">엑셀 백업</a>
                </div>
            </form>
        </form>

        <div class="util btn" style="display: flex; justify-content: flex-start; margin-top: 20px;">
            <a href="{{ route('fee.register') }}" class="call_popup btnBdNavy" data-popup_name="fee-create" data-width="900" data-height="900">
                회비 단건 등록
            </a>
        </div>

        <table class="tblDef listTbl">
            <colgroup>
                <col style="width: *;">
                <col style="width: 8%;">
                <col style="width: 9%;">
                <col style="width: 8%;">
                <col style="width: 8%;">
                <col style="width: 8%;">

                <col style="width: 8%;">
                <col style="width: 11%;">
                <col style="width: 8%;">
                <col style="width: 8%;">
                <col style="width: 8%;">

                <col style="width: 6%;">
            </colgroup>
            <thead>
            <tr>
                <th>No</th>
                <th>회원구분</th>
                <th>회비년도</th>
                <th>이름</th>
                <th>면허번호</th>
                <th>E-mail</th>

                <th>납부금액</th>
                <th>입금상태</th>
                <th>결제방법</th>
                <th>입금완료일</th>
                <th>영수증</th>

                <th>관리</th>
            </tr>
            </thead>
            <tbody>
            @forelse($list as $row)
                <tr data-sid="{{ $row->sid }}">
                    <td>{{ $row->seq }}</td>
                    <td>{{ $userConfig['level'][$row->user->level ?? 'A'] }}</td>
                    <td>{{ $row->year ?? '' }}</td>
                    <td>{{ $row->user->name_kr ?? '' }}</td>
                    <td>{{ $row->user->license_number ?? '' }}</td>
                    <td>{{ $row->user->uid ?? '' }}</td>

                    <td>{{ number_format($row->price ?? 0) }}원</td>
                    <td>{{ $feeConfig['pay_status'][$row->pay_status ?? ''] }}</td>
                    <td>{{ $row->method ? $feeConfig['method'][$row->method] : '' }}</td>
                    <td>{{ $row->pay_date ?? '' }}</td>
{{--                    <td>--}}
{{--                        <select name="confirm">--}}
{{--                            @foreach($userConfig['confirm'] as $key => $val)--}}
{{--                                <option value="{{ $key }}" {{ $key === $row->confirm ? 'selected' : '' }}>{{ $val }}</option>--}}
{{--                            @endforeach--}}
{{--                        </select>--}}
{{--                    </td>--}}
                    <td>
                        <div class="util btn">
                            @if(($row->pay_status ?? 'A') == 'C')
                            <a href="javascript:alert('준비중입니다');" class="btnSmall btnGrey2 " data-popup_name="fee-history" data-width="1100" data-height="700">영수증</a>
                            @endif
{{--                            <a href="javascript:alert('준비중입니다');" class="btnSmall btnGrey2 call_popup" data-popup_name="fee-history" data-width="1100" data-height="700">영수증</a>--}}
                        </div>
                    </td>
                    <td>
                        <a href="{{ route('fee.register', ['sid' => $row->sid ]) }}" class="call_popup" data-popup_name="fee-modify" data-width="900" data-height="900">
                            <img src="{{ asset('assets/image/admin/icon_modify.png') }}" alt="수정">
                        </a>
                        <a href="javascript:void(0);" class="btn-delete"><img src="{{ asset('assets/image/admin/icon_del.png') }}" alt="삭제"></a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="13">등록된 회비가 없습니다.</td>
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
        const _case = 'fee-delete';
        const _url = "{{ route('fee.data') }}";

        if (confirm('삭제 하시겠습니까?')) {
            callAjax( _url, { case: _case, sid: $(this).closest('tr').data('sid') } );
        }
    });
</script>
@endsection
