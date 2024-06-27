@extends('admin.layouts.admin-layout')

@section('addStyle')
@endsection

@section('contents')
    <div class="contents">
        <div class="titArea">
            <h2>연구지원 관리</h2>
        </div>

        <form class="searchArea">
            <form id="search-frm" action="{{ route('research') }}" method="get">
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
                            <th>이름</th>
                            <td><input type="text" name="name_kr" value="{{ request()->name_kr ?? '' }}"></td>

                            <th>E-mail</th>
                            <td><input type="text" name="email" value="{{ request()->email ?? '' }}"></td>

                            <th>심사현황</th>
                            <td>
                                <select name="result">
                                    <option value="">선택</option>
                                    @foreach($researchConfig['result'] as $key => $val)
                                        <option value="{{ $key }}" {{ (request()->result ?? '') === $key ? 'selected' : '' }}>{{ $val }}</option>
                                    @endforeach
                                </select>
                            </td>
                        </tr>

                        </tbody>
                    </table>
                </fieldset>

                <div class="util btn" style="display: flex; justify-content: center; margin-top: 20px;">
                    <input class="btnDel" type="submit" value="검색">
                    <a href="{{ route('research') }}" class="btnBdNavy">검색초기화</a>
                    <a href="{{ route('research.excel', request()->except(['page'])) }}" class="btnBdBlue">엑셀 백업</a>
                </div>
            </form>
        </form>

        <table class="tblDef listTbl">
            <colgroup>
                <col style="width: 4%;">
                <col style="width: 5%;">
                <col style="width: 9%;">
                <col style="width: 8%;">
                <col style="width: 8%;">

                <col style="width: 8%;">
                <col style="width: 8%;">
                <col style="width: 10%;">
                <col style="width: 7%;">
                <col style="width: 7%;">

                <col style="width: 6%;">
                <col style="width: 7%;">
                <col style="width: *;">
            </colgroup>
            <thead>
            <tr>
                <th>No</th>
                <th>이름</th>
                <th>소속</th>
                <th>이메일</th>
                <th>책임연구자</th>

                <th>연구비용</th>
                <th>과제구분</th>
                <th>연구기간</th>
                <th>심사현황</th>
                <th>심사배정</th>

                <th>심사결과</th>
                <th>신청일</th>
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
                    <td>{{ $row->name }}</td>

                    <td>{{ number_format($row->tot_price) ?? '-' }}</td>
                    <td>
                        {{ $researchConfig['date_type'][$row->date_type ?? '' ] }}
                    </td>
                    <td>
                        {{ $row->sdate }} ~<br/>
                        {{ $row->edate }}
                    </td>
                    <td>
                        <select name="change_result">
                            @foreach($researchConfig['result'] as $key => $val)
                                <option value="{{ $key }}" {{ $key === $row->result ? 'selected' : '' }}>{{ $val }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <div class="util btn">
                        <a href="{{ route('research.reviewer.register', ['research' => $row->sid, 'research_sid' => $row->sid ]) }}" class="btnSmall btnGrey2 call_popup" data-popup_name="research-reviewer-register" data-width="1100" data-height="700">배정</a>
                        </div>
                    </td>


                    <td>
                        <div class="util btn">
                        <a href="{{ route('research.reviewer.preview', ['sid' => $row->sid ]) }}" class="btnSmall btnGrey2 call_popup" data-popup_name="research-reviewer-register" data-width="1100" data-height="700">보기</a>
                        </div>
                    </td>
                    <td>{{ $row->created_at->format('Y-m-d') }}</td>
                    <td>
                        <a href="{{ route('research.register', ['sid' => $row->sid]) }}" class="call_popup" data-popup_name="research_regist_form" data-width="900" data-height="1000">
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
        const dataUrl = '{{ route('research.data') }}';

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
            const _case = 'research-delete';
            const _url = "{{ route('research.data') }}";

            if (confirm('삭제 하시겠습니까?')) {
                callAjax( _url, { case: _case, sid: $(this).closest('tr').data('sid') } );
            }
        });

    </script>
@endsection
