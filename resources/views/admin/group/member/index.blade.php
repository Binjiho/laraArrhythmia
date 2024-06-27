@extends('admin.layouts.admin-layout')

@section('addStyle')
@endsection

@section('contents')
    <div class="contents">
        <div class="titArea">
            <h2>연구회/지회 관리</h2>
        </div>

        <div class="util btn" style="display: flex; justify-content: flex-start; margin-top: 20px;">
            <a href="{{ route('group.member.collective', ['g_sid' => $group->sid]) }}" class="call_popup btnBdNavy" data-popup_name="group-upsert" data-width="720">
                다건 등록
            </a>
            <a href="{{ route('group.member.upsert', ['g_sid' => $group->sid]) }}" class="call_popup btnBdNavy" data-popup_name="group-upsert">
                단건 등록
            </a>
        </div>

        <table class="tblDef listTbl">
            <colgroup>
                <col style="width: 7%;">
                <col style="width: *;">
                <col style="width: 15%;">
                <col style="width: 15%;">
                <col style="width: 15%;">
                <col style="width: 15%;">
                <col style="width: 7%;">
            </colgroup>
            <thead>
            <tr>
                <th>No</th>
                <th>직책</th>
                <th>아이디</th>
                <th>성명</th>
                <th>소속</th>
                <th>관리자 지정</th>
                <th>관리</th>
            </tr>
            </thead>
            <tbody class="table_sortable">
            @forelse($members as $row)
                <tr data-sid="{{ $row->sid }}">
                    <input type="hidden" name='sid[]' value="{{ $row->sid }}">
                    <td>{{ $row->seq }}</td>
                    <td>{{ $row->position }}</td>
                    <td>{{ $row->uid }}</td>
                    <td>{{ $row->name_kr }}</td>
                    <td>{{ $row->sosok }}</td>
                    <td>
                        <input type="checkbox" id="{{ $row->sid }}_admin" class="check_admin" {{ $row->is_admin == 'Y' ? 'checked' : '' }}>
                    </td>
                    <td>
                        <a href="{{ route('group.member.upsert', ['g_sid' => $row->g_sid, 'sid' => $row->sid]) }}" class="call_popup" data-popup_name="group-upsert">
                            <img src="/assets/image/admin/icon_modify.png" alt="수정">
                        </a>
                        <a href="javascript:void(0);" class="member-del"><img src="/assets/image/admin/icon_del.png" alt="삭제"></a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7">등록된 명단이 없습니다.</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
@endsection

@section('addScript')
    <script>
        const dataUrl = '{{ route('group.member.data', ['g_sid' => $group->sid]) }}';

        $(document).on('click', '.member-del', function() {
            if (confirm('삭제 하시겠습니까?')) {
                callAjax(dataUrl, {
                    'case': 'member-delete',
                    'sid': $(this).closest('tr').data('sid'),
                })
            }
        })

        $(document).on('click', '.check_admin', function() {
            callAjax(dataUrl, {
                'case': 'db-change',
                'field': 'is_admin',
                'value': $(this).is(':checked') ? 'Y' : 'N',
                'sid': $(this).closest('tr').data('sid'),
            });
        });

        $(function() {
            /**
             * 순서 저장
             */
            $(".table_sortable").sortable({
                axis: "y",
                containment: "parent",
                update: function () {
                    BsJs_setOrd('groups', 'sort');
                }
            }).disableSelection();
        });

        function BsJs_setOrd(targetDB, targetVAL) {
            if(!confirm("순서를 변경하시겠습니까?")){
                location.reload();
                return false;
            }
            var array_sid = [];

            // 순서대로 array_sid 가져와서 배열에 담기
            $("input[name='sid[]']").each(function() {
                array_sid.push($(this).val());
            });

            callAjax(dataUrl, {
                'case': 'sort-change',
                "array_sid": array_sid.join(','),
                "targetDB": targetDB,
                "targetVAL": targetVAL,
            });

        }
    </script>
@endsection
