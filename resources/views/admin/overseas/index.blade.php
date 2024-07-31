@extends('admin.layouts.admin-layout')

@section('addStyle')
@endsection

@section('contents')
    <div class="contents">
        <div class="titArea">
            <h2>해외학회 관리</h2>
        </div>

        <div class="util btn" style="display: flex; justify-content: flex-end; margin-top: 20px;">
            <a href="{{ route('overseas.register') }}" class="call_popup btnBdNavy" data-popup_name="conference-insert" data-width="1000" data-height="800">
                해외학술대회 등록
            </a>
        </div>

        <table class="tblDef listTbl">
            <colgroup>
                <!-- <col style="width: 3%;">
                <col style="width: 10%;">
                <col style="width: 10%;">
                <col style="width: 8%;">
                <col style="width: 8%;">
                
                <col style="width: 8%;">
                <col style="width: 8%;">
                <col style="width: 6%;">
                <col style="width: 8%;">
                <col style="width: 8%;"> -->

				<col style="width: 3%;">
				<col style="width: 8%;">
				<col style="width: 8%;">
				<col style="width: 8%;">
				<col style="width: 8%;">
				<col style="width: 8%;">
				<col style="width: 8%;">

				<col style="width: 5%;">
				<col style="width: 5%;">
				<col style="width: 5%;">
				<col style="width: 5%;">
				<col style="width: 5%;">
				<col style="width: 5%;">
				<col style="width: 5%;">

				<col style="width: 8%;">
				<col style="width: 6%;">
            </colgroup>
            <thead>
            <tr>
                <th rowspan="2">No</th>
                <th rowspan="2">학술대회명</th>
                <th rowspan="2">개최장소</th>
                <th rowspan="2">개최기간</th>
                <th rowspan="2">신청기간</th>
                <th rowspan="2">결과보고기간</th>

                <th rowspan="2">결과발표일</th>
                <th colspan="7">신청자통계</th>
                <th rowspan="2">신청자</th>
                <th rowspan="2">관리</th>
            </tr>
            <tr>
                <th style="border-left: 1px solid #d9e0eb !important;">접수중</th>
                <th>접수<br>완료</th>
                <th>선정</th>
                <th>미선정</th>
                <th>철회</th>
                <th>정산 <br>완료</th>
                <th>총계</th>
            </tr>
            </thead>
            <tbody>
            @forelse($list as $row)
                <tr data-sid="{{ $row->sid }}">
                    <td>{{ $row->seq }}</td>
                    <td>{{ $row->subject }}</td>
                    <td>{{ $row->place }}</td>
                    <td>{{ $row->event_sdate }} {{ $row->event_edate }}</td>
                    <td>{{ $row->regist_sdate }} {{ $row->regist_edate }}</td>
                    <td>{{ $row->result_sdate }} {{ $row->result_edate }}</td>

{{--                    <td>{{ $row->updated_at->format('Y-m-d') }}</td>--}}
                    <td>{{ $row->result_date }}</td>
                    <td>{{ $row->static[0]->i_cnt ?? 0 }}</td>
                    <td>{{ $row->static[0]->u_cnt ?? 0 }}</td>
                    <td>{{ $row->static[0]->s_cnt ?? 0 }}</td>
                    <td>{{ $row->static[0]->d_cnt ?? 0 }}</td>
                    <td>{{ $row->static[0]->w_cnt ?? 0 }}</td>
                    <td>{{ $row->static[0]->c_cnt ?? 0 }}</td>
                    <td>{{ $row->static[0]->tot_cnt ?? 0 }}</td>
                    <td >
                        <div class="util btn">
                        <a href="{{ route('overseas.detail',[ 'csid' => $row->sid ]) }}" class="btnSmall btnGrey2">상세보기</a>
                        </div>
                    </td>
                    <td>
                        <a href="{{ route('overseas.register',[ 'sid' => $row->sid, 'isAdmin' => 'Y' ]) }}" class="call_popup" data-popup_name="confernece-modify" data-width="1000" data-height="800">
                            <img src="{{asset('assets/image/admin/icon_modify.png')}}" alt="수정">
                        </a>
                        <a href="javascript:void(0);" class="btn-delete"><img src="{{asset('assets/image/admin/icon_del.png')}}" alt="삭제"></a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="10">등록된 학술대회가 없습니다.</td>
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
            const _case = 'conference-delete';
            const _url = "{{ route('overseas.data') }}";

            if (confirm('행사 신청 내역이 있을 경우 모두 삭제 되어 복구가 불가능합니다. 그래도 삭제 하시겠습니까?')) {
                callAjax( _url, { case: _case, sid: $(this).closest('tr').data('sid') } );
            }
        });

    </script>
@endsection
