@extends('admin.layouts.admin-layout')

@section('addStyle')
@endsection

@section('contents')
    <div class="contents">
        <div class="titArea">
            <h2>학술대회 관리</h2>
        </div>

        <form class="searchArea">
            <form id="search-frm" action="{{ route('conference') }}" method="get">
                <table class="tblDef listTbl">
                    <colgroup>
                        <col style="width: 15%;">
                        <col style="width: 35%;">
                        <col style="width: 15%;">
                        <col style="width: 35%;">
                    </colgroup>

                    <tbody>
                    <tr>
                        <th>연도</th>
                        <td>
                            <select name="year">
                                <option value="">전체</option>

                                @foreach($conferenceConfig['year'] as $key => $val)
                                    <option value="{{ $val }}" {{ (request()->year ?? '') == $val ? 'selected':'' }}>{{ $val }}</option>
                                @endforeach
                            </select>
                        </td>

                        <th>행사명</th>
                        <td><input type="text" name="subject" value="{{ request()->subject ?? '' }}"></td>
                    </tr>
                    </tbody>
                </table>

                <div class="util btn" style="display: flex; justify-content: center; margin-top: 20px;">
                    <input class="btnDel" type="submit" value="검색">
                    <a href="{{ route('conference') }}" class="btnBdNavy">검색초기화</a>
                </div>
            </form>
        </form>

        <table class="tblDef listTbl">
            <colgroup>
                <col style="width: 4%;">
                <col>
                <col STYLE="width: 8%">
                <col STYLE="width: 13%">
                <col STYLE="width: 8%">
                <col STYLE="width: 13%">
                <col STYLE="width: 8%">
                <col STYLE="width: 6%">
            </colgroup>
            <thead>
            <tr>
                <th>No</th>
                <th>행사명</th>
                <th>행사일시</th>
                <th>사전등록 기간</th>
                <th>사전등록</th>
                <th>초록접수 기간</th>
                <th>초록접수</th>
                <th>관리</th>
            </tr>
            </thead>
            <tbody>
            @forelse($list as $row)
                <tr data-sid="{{ $row->sid }}">
                    <td>{{ $row->seq }}</td>
                    <td>{{ $row->subject }}</td>
                    <td>{{ $row->eventDate() }}</td>
                    <td>{{ $row->regDate() }}</td>
                    <td>
                        @if($row->regist_yn == 'Y')
                            <div class="btn">
                                <a href="{{ route('conference.registration', ['csid' => $row->sid]) }}" class="btnSmall btnGrey2">사전등록</a>
                            </div>
                        @endif
                    </td>
                    <td>{{ $row->absDate() }}</td>
                    <td>
                        @if($row->abs_yn == 'Y')
                            <div class="btn">
                                <a href="{{ route('conference.abstract', ['csid' => $row->sid]) }}" class="btnSmall btnGrey2">초록등록</a>
                            </div>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('conference.modify', ['sid' => $row->sid]) }}" class="call_popup" data-popup_name="abstract-modify" data-width="1200" data-height="900">
                            <img src="{{ asset('assets/image/admin/icon_modify.png') }}" alt="수정">
                        </a>
                        <a href="javascript:void(0);" class="btn-delete"><img src="{{ asset('assets/image/admin/icon_del.png') }}" alt="삭제"></a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8">등록된 학술행사가 없습니다.</td>
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
        const dataUrl = '{{ route('conference.data') }}';
        const thisPk = (_this) => {
            return $(_this).closest('tr').data('sid');
        }

        $(document).on('click', '.btn-delete', function() {
            if (confirm('삭제 하시겠습니까?')) {
                callAjax(dataUrl, {
                    'case': 'conference-delete',
                    'sid': thisPk(this),
                });
            }
        });
    </script>
@endsection
