@extends('admin.layouts.admin-layout')

@section('addStyle')
@endsection

@section('contents')
    <div class="contents">
        <div class="titArea">
            <h2>연구회/지회 관리</h2>
        </div>

        <div class="util btn" style="display: flex; justify-content: flex-start; margin-top: 20px;">
            <a href="{{ route('group.upsert') }}" class="call_popup btnBdNavy" data-popup_name="group-upsert">
                연구회 등록
            </a>
        </div>

        <table class="tblDef listTbl">
            <colgroup>
                <col style="width: 7%;">
                <col style="width: *;">
                <col style="width: 15%;">
                <col style="width: 15%;">
                <col style="width: 7%;">
            </colgroup>
            <thead>
            <tr>
                <th>No</th>
                <th>연구회 명</th>
                <th>명단관리</th>
                <th>공개 상태</th>
                <th>관리</th>
            </tr>
            </thead>
            <tbody class="table_sortable">
            @forelse($list as $row)
                <tr data-sid="{{ $row->sid }}">
                    <input type="hidden" name='sid[]' value="{{ $row->sid }}">
                    <td>{{ $row->seq }}</td>
                    <td>{{ $row->subject }}</td>
                    <td>
                        <div class="util btn">
                            <a href="{{ route('group.member', ['g_sid' => $row->sid]) }}" class="btnBdNavy cal_popup">명단관리</a>
                        </div>
                    </td>
                    <td>
                        @foreach($groupConfig['hide'] as $key => $val)
                            <input type="radio" name="{{ $row }}_hide" id="{{ $row->sid }}_hide_{{ $key }}" value="{{ $key }}" {{ $key == $row->hide ? 'checked' : '' }} class="g_hide">
                            <label for="{{ $row->sid }}_hide_{{ $key }}">{{ $val }}</label>
                        @endforeach
                    </td>
                    <td>
                        <a href="{{ route('group.upsert', ['sid' => $row->sid]) }}" class="call_popup" data-popup_name="group-upsert">
                            <img src="/assets/image/admin/icon_modify.png" alt="수정">
                        </a>
                        <a href="javascript:void(0);" class="group-del"><img src="/assets/image/admin/icon_del.png" alt="삭제"></a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">등록된 연구회가 없습니다.</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
@endsection

@section('addScript')
    <script>
        const dataUrl = '{{ route('group.data') }}';

        $(document).on('change', '.g_hide', function() {
            callAjax(dataUrl, {
                'case': 'db-change',
                'sid': $(this).closest('tr').data('sid'),
                'field': 'hide',
                'value': $(this).val(),
            });
        });

        $(document).on('click', '.group-del', function() {
            if (confirm('삭제 하시겠습니까?')) {
                callAjax(dataUrl, {
                    'case': 'group-delete',
                    'sid': $(this).closest('tr').data('sid'),
                });
            }
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
