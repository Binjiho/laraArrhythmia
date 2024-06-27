<div class="popup-wrap full" id="member-search" style="display: block;">
    <div class="popup-contents">
        <div class="popup-header">
            <a href="javascript:window.close();" class="full-right" style="zoom: 2.5; padding: 5px; margin-right: 3px;">X</a>
        </div>

        <div class="popup-conbox">
            <form id="search-frm" data-case="member-search" style="padding: 10px;">
                <fieldset>
                    <table class="tblDef listTbl">
                        <colgroup>
                            <col style="width: 20%;">
                            <col style="width: *;">
                            <col style="width: 10%;">
                        </colgroup>

                        <tbody>
                        <tr>
                            <td>
                                <select name="keyfield" id="keyfield">
                                    <option value="">선택</option>
                                    @foreach($groupConfig['member-search'] as $key => $value)
                                        <option value="{{ $key }}">{{ $value }}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td>
                                <input type="text" name="keyword" id="keyword">
                            </td>
                            <td>
                                <div class="util btn" style="display: flex; justify-content: center; margin-top: 20px;">
                                    <input class="btnDel" type="submit" value="검색">
                                </div>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </fieldset>
            </form>

            <div style="overflow-y: scroll; min-height: 350px;" id="member-result">
                @include('admin.group.member.layer.member-result')
            </div>
        </div>
    </div>
</div>