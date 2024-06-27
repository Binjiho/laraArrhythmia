<form id="search-frm" class="searchArea" action="{{ route($routeName, ['csid' => request()->csid]) }}" method="get">
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

                <th>ID</th>
                <td><input type="text" name="uid" value="{{ request()->uid ?? '' }}"></td>

                <th>접수번호</th>
                <td><input type="text" name="regnum" value="{{ request()->regnum ?? '' }}"></td>
            </tr>
            </tbody>
        </table>
    </fieldset>

    <div class="util btn" style="display: flex; justify-content: center; margin-top: 20px;">
        <input class="btnDel" type="submit" value="검색">
        <a href="{{ route($routeName, ['csid' => request()->csid]) }}" class="btnBdNavy">검색초기화</a>

        @if($routeName == 'conference.abstract.withdrawal')
            <a href="{{ route('conference.abstract.excel', ['csid' => request()->csid, 'case' => 'withdrawal'] + request()->except(['page'])) }}" class="btnBdBlue">엑셀 백업</a>
        @else
            <a href="{{ route('conference.abstract.excel', ['csid' => request()->csid] + request()->except(['page'])) }}" class="btnBdBlue">엑셀 백업</a>
        @endif

        <a href="{{ route('conference') }}" class="btnBdBlue">목록</a>
    </div>
</form>