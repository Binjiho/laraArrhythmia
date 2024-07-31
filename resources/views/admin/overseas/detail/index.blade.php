@extends('admin.layouts.admin-layout')

@section('addStyle')
@endsection

@section('contents')
    <div class="contents">
        <div class="titArea">
            <h2>{{$conference->subject ?? ''}}</h2>
        </div>

        <form class="searchArea">
            <form id="search-frm" action="{{ route('overseas.detail',['csid'=>request()->csid]) }}" method="get">
                <input type="hidden" name="csid" id="csid" value="{{request()->csid}}">
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

                            <th>심사상태</th>
                            <td>
                                <select name="result">
                                    <option value="">선택</option>
                                    @foreach($overseasConfig['result'] as $key => $val)
                                        <option value="{{ $key }}" {{ (request()->result ?? '') === $key ? 'selected' : '' }}>{{ $val }}</option>
                                    @endforeach
                                </select>
                            </td>

                            <th>지원협회</th>
                            <td>
                                <select name="assistant">
                                    <option value="">선택</option>
                                    @foreach($overseasConfig['assistant'] as $key => $val)
                                        <option value="{{ $key }}" {{ (request()->assistant ?? '') === $key ? 'selected' : '' }}>{{ $val }}</option>
                                    @endforeach
                                </select>
                            </td>

                        </tr>

                        </tbody>
                    </table>
                </fieldset>

                <div class="util btn" style="display: flex; justify-content: center; margin-top: 20px;">
                    <input class="btnDel" type="submit" value="검색">
                    <a href="{{ route('overseas.detail',['csid'=>request()->csid]) }}" class="btnBdNavy">검색초기화</a>
                    <a href="{{ route('overseas.excel', ['csid'=>request()->csid] ) }}" class="btnBdBlue">데이터 백업</a>
{{--                    <a href="{{ route('overseas.excel', request()->except(['page']) ) }}" class="btnBdBlue">데이터 백업</a>--}}
                </div>

                <div class="util btn" style="display: flex; margin-top: 20px;">
                    <div style="justify-content: flex-start;">
                        <a href="{{ route('direct.overseas.register',[ 'csid'=>request()->csid ]) }}" class="call_popup btnBdNavy" data-popup_name="direct-insert" data-width="1000" data-height="800">
                            신청자 추가등록
                        </a>
                        <a href="{{ route('overseas.detail.assist_group',[ 'csid'=>request()->csid ] ) }}" class="call_popup btnBdNavy" data-popup_name="group-insert" data-width="1000" data-height="800">
                            일괄심사
                        </a>
                    </div>

                    <div style="float: right;">
                        <a href="{{ route('overseas.detail.mail',[ 'csid'=>request()->csid, 'type'=>'A' ] ) }}" class="call_popup btnBdNavy" data-popup_name="mail-A" data-width="1000" data-height="800">
                            선정 메일발송
                        </a>
                        <a href="{{ route('overseas.detail.mail',[ 'csid'=>request()->csid, 'type'=>'B' ] ) }}" class="call_popup btnBdNavy" data-popup_name="mail-B" data-width="1000" data-height="800">
                            미선정 메일발송
                        </a>
                        <a href="{{ route('overseas.detail.mail',[ 'csid'=>request()->csid, 'type'=>'C' ] ) }}" class="call_popup btnBdNavy" data-popup_name="mail-C" data-width="1000" data-height="800">
                            정산서류 수령 메일발송
                        </a>
                        <a href="{{ route('overseas.detail.mail',[ 'csid'=>request()->csid, 'type'=>'D' ] ) }}" class="call_popup btnBdNavy" data-popup_name="mail-D" data-width="1000" data-height="800">
                            지급완료 메일발송
                        </a>
                    </div>
                </div>

                <div class="util btn" style="display: flex; justify-content: flex-end; ">

                </div>
            </form>
        </form>

        <table class="tblDef listTbl">
            <colgroup>
                <col style="width: 3%;">
                <col style="width: 8%;">
                <col style="width: 6%;">
                <col style="width: 7%;">
                <col style="width: 7%;">
                <col style="width: 7%;">

                <col style="width: 7%;">
{{--                <col style="width: 7%;">--}}
{{--                <col style="width: 7%;">--}}
{{--                <col style="width: 8%;">--}}
                <col style="width: 7%;">

                <col style="width: 9%;">
                <col style="width: 6%;">
                <col style="width: 5%;">
                <col style="width: 5%;">
                <col style="width: 6%;">
            </colgroup>
            <thead>
            <tr>
                <th>No</th>
                <th>아이디</th>
                <th>성명</th>
                <th>소속</th>
                <th>핸드폰번호</th>
                <th>참가자격</th>

                <th>공동저자<br>여부</th>
{{--                <th>초록</th>--}}
{{--                <th>초청메일</th>--}}
{{--                <th>등록상태</th>--}}
                <th>심사상태</th>

                <th>결과보고서</th>
                <th>등록일</th>
                <th>지급<br>완료</th>
                <th>메모</th>
                <th>관리</th>
            </tr>
            </thead>
            <tbody>

            @forelse($list as $row)
                <tr data-sid="{{ $row->sid }}">
                    <td>{{ $row->seq }}</td>
                    <td>
                        <a href="{{ route('overseas.detail.preview', ['sid' => $row->sid, 'csid'=>request()->csid]) }}" class="call_popup" data-popup_name="overseas-preview" data-width="1450" data-height="1000">{{ $row->user->uid }}</a>
                    </td>
                    <td>{{ $row->user->name_kr }}</td>
                    <td>{{ $row->user->sosok_kr ?? '' }}</td>
                    <td>{{ $row->user->phone[0] ?? '' }}-{{ $row->user->phone[1] ?? '' }}-{{ $row->user->phone[2] ?? '' }}</td>
                    <td>{{ $overseasConfig['participant'][$row->participant ?? ''] }}</td>

                    <td>{{ ($row->common_author ?? 'N') == 'N' ? 'X':'O' }}</td>

{{--                    <td>--}}
{{--                        <a href="{{ $row->downloadFileUrl('thumb_realfile', 'thumb_file') }}" target="_blank" class="link" style="color:dodgerblue">{{$row->thumb_file}}</a>--}}
{{--                    </td>--}}
{{--                    <td>--}}
{{--                        <a href="{{ $row->downloadFileUrl('realfile2', 'file2') }}" target="_blank" class="link" style="color:dodgerblue">{{$row->file2}}</a>--}}
{{--                    </td>--}}

                    <td>
                        <p style="color:crimson">
                            <a href="{{ route('overseas.detail.assist',['user_sid'=>$row->user->sid, 'sid'=>$row->sid, 'csid'=>request()->csid]) }}" class="call_popup btnBdNavy" data-popup_name="assist-create" data-width="900" data-height="600">
                                {{ $overseasConfig['result'][$row->result ?? ''] }}
                            </a>
                        </p>
                        @if($row->assistant)
                            <br>
                            {{ $overseasConfig['assistant'][$row->assistant ?? ''] }}
                        @endif
                    </td>

                    <td >
                    @if($row->result_request_state == 'Y')
                        <div class="util btn">
                            <a href=" {{ route('overseas.detail.result.preview', ['sid' => $row->sid]) }} " class="btnSmall btnGrey2 call_popup" data-popup_name="result_preview" data-width="1100" data-height="700">상세보기</a>
                        </div>
                        <select name="confirm">
                            @foreach($overseasConfig['result_request_state'] as $key => $val)
                                <option value="{{ $key }}" {{ $key === $row->result_request_state ? 'selected' : '' }}>{{ $val }}</option>
                            @endforeach
                        </select>
                    @else
                        -
                    @endif
                    </td>
                    <td>{{ $row->created_at->format('Y-m-d') }}</td>
                    <td class="check">
                        <input type="checkbox" name="pay_result" id="pay_result" value="Y" {{ ($row->pay_result ?? '') === 'Y' ? 'checked' : '' }} >
                    </td>
                    <td >
                        <div class="util btn">
                            <a href="{{ route('overseas.detail.memo', ['sid'=>$row->sid, 'csid'=>request()->csid]) }}" class="call_popup btnSmall btnGrey2" data-popup_name="overseas-modify" data-width="1100" data-height="700">메모</a>
                        </div>
                    </td>
                    <td>
                        <a href="{{ route('overseas.detail.modify', ['sid' => $row->sid, 'csid'=>request()->csid]) }}" class="call_popup" data-popup_name="overseas-modify" data-width="1450" data-height="1000">
                            <img src="{{asset('assets/image/admin/icon_modify.png')}}" alt="수정">
                        </a>
                        <a href="javascript:void(0);" class="btn-delete"><img src="{{asset('assets/image/admin/icon_del.png')}}" alt="삭제"></a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="14">등록된 신청자가 없습니다.</td>
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
        const dataUrl = '{{ route('overseas.data') }}';

        $(document).on('change', "input:checkbox[name='pay_result']", function() {
            let ajaxData = {};
            let target = 'N';
            if($(this).is(":checked")){
                target = 'Y';
            }
            ajaxData.case = 'change-pay-result';
            ajaxData.sid = $(this).parents('tr').data('sid');
            ajaxData.target = target;
            if (confirm('변경 하시겠습니까?')) {
                callAjax(dataUrl, ajaxData);
            }else{
                location.reload();
            }
        });

        $(document).on('click', '.btn-delete', function() {
            const _case = 'overseas-delete';
            const _url = "{{ route('overseas.data') }}";


            if (confirm('삭제 하시겠습니까?')) {
                callAjax( _url, { case: _case, sid: $(this).closest('tr').data('sid')} );
            }
        });
    </script>
@endsection
