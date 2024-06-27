<table class="inputTbl">
    <colgroup>
        <col style="width: 33%;">
        <col style="width: 33%;">
        <col style="width: 33%;">
    </colgroup>

    <thead>
    <tr>
        <th>이름</th>
        <th>아이디</th>
        <th>선택</th>
    </tr>
    </thead>

    <tbody>
    @forelse($member ?? [] as $row)
        <tr data-sid="{{ $row->sid }}">
            <td>{{ $row->name_kr ?? '' }}</td>
            <td>{{ $row->uid ?? '' }}</td>
            <td>
                <div class="util btn" style="display: flex; justify-content: center; margin-top: 20px;">
                    <input class="btnSmall btnDel select-member" type="button" value="선택">
                </div>
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="5">검색 결과가 없습니다.</td>
        </tr>
    @endforelse
    </tbody>
</table>