@extends('admin.layouts.admin-layout')

@section('addStyle')
@endsection

@section('contents')
    <div class="contents">
        <div class="titArea">
            <h2>회원관리</h2>
        </div>

        <form class="searchArea">
            <form id="search-frm" action="{{ route('member') }}" method="get">
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

                            <th>휴대폰 번호</th>
                            <td><input type="text" name="phone" value="{{ request()->phone ?? '' }}"></td>

                            <th>근무처 명</th>
                            <td><input type="text" name="sosok" value="{{ request()->sosok ?? '' }}"></td>
                        </tr>
                        </tbody>
                    </table>
                </fieldset>

                <div class="util btn" style="display: flex; justify-content: center; margin-top: 20px;">
                    <input class="btnDel" type="submit" value="검색">
                    <a href="{{ route('member') }}" class="btnBdNavy">검색초기화</a>
                    <a href="{{ route('member.excel', request()->except(['page'])) }}" class="btnBdBlue">엑셀 백업</a>
                </div>
            </form>
        </form>

        <table class="tblDef listTbl">
            <tbody>
            <tr>
                <td>회원구분</td>
                <td>
                    <span class="lm2">전체: {{ number_format($count['level']['total'] ?? 0) }}명</span>
                    @foreach($userConfig['level'] as $key => $val)
                        <span class="lm2">{{ $val }}: {{ number_format($count['level'][$key] ?? 0) }}명</span>
                    @endforeach
                </td>
            </tr>
            <tr>
                <td>가입구분</td>
                <td>
                    <span class="lm2">전체: {{ number_format($count['category']['total'] ?? 0) }}명</span>
                    @foreach($userConfig['category'] as $key => $val)
                        <span class="lm2">{{ $val }}: {{ number_format($count['category'][$key] ?? 0) }}명</span>
                    @endforeach
                </td>
            </tr>
            </tbody>
        </table>

        <table class="tblDef listTbl">
            <colgroup>
                <col style="width: *;">
                <col style="width: 7%;">
                <col style="width: 7%;">
                <col style="width: 7%;">
                <col style="width: 7%;">
                <col style="width: 7%;">

                <col style="width: 7%;">
                <col style="width: 7%;">
                <col style="width: 10%;">
                <col style="width: 7%;">
                <col style="width: 7%;">
                <col style="width: 7%;">

                <col style="width: 6%;">
                <col style="width: 6%;">
            </colgroup>
            <thead>
            <tr>
                <th>No</th>
                <th>이름</th>
                <th>아이디</th>
                <th>회원구분</th>
                <th>전문의번호</th>
                <th>소속</th>

                <th>의대</th>
                <th>근무처구분</th>
                <th>가입일</th>
                <th>회비납부여부</th>
                <th>핸드폰번호</th>
                <th>수정일</th>
                <th>최종방문일</th>

                <th>로그인</th>
                <th>관리</th>
            </tr>
            </thead>
            <tbody>
            @forelse($list as $row)
                <tr data-sid="{{ $row->sid }}">
                    <td>{{ $row->seq }}</td>
                    <td><a href="javascript:void(0);" class="fwBold cal_popup" data-popup_name="member-modify"  data-width="1450" data-height="1000">{{ $row->name_kr }}</a></td>
                    <td>{{ $row->uid }}</td>
                    <td>
                        <select name="level" class="level_change">
                            @foreach($userConfig['level'] as $key => $val)
                                <option value="{{ $key }}" {{ $key === $row->level ? 'selected' : '' }}>{{ $val }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>{{ $row->license_number ?? '' }}</td>
                    <td>{{ $row->sosok_kr ?? '' }} {{ $row->sosok_en ? '('.$row->sosok_en.')' : '' }}</td>

                    <td>{{ $row->school_kr ?? '' }}{{ $row->school_en ? '('.$row->school_en.')' : '' }}</td>
                    <td>{{ $userConfig['office'][$row->office ?? ''] }}</td>
                    <td>{{ $row->created_at->format('Y-m-d') }}</td>
                    <td>
                        {{ $feeConfig['pay_status'][$row->fee_status ?? 'A'] }}
                    </td>
                    <td>
                        @foreach(($row->phone ?? []) as $key => $user_phone)
                            {{($key == 0 ? '':'-').$user_phone}}
                        @endforeach
                    </td>
                    <td>{{ $row->updated_at->format('Y-m-d') ?? '' }}</td>

                    <td>{{ $row->today_at ? $row->today_at->format('Y-m-d') : '' }}</td>
                    <td>
                        <a href="javascript:memberLogin();" class="btnSmall btnGrey2 member-login">로그인</a>
                    </td>
                    <td>
                        <a href=" {{ route('member.modify', ['sid' => $row->sid]) }}" class="call_popup" data-popup_name="member-modify" data-width="1450" data-height="1000">
                            <img src="{{asset('assets/image/admin/icon_modify.png')}}" alt="수정">
                        </a>
                        <a href="javascript:void(0);" class="member-del"><img src="{{asset('assets/image/admin/icon_del.png')}}" alt="삭제"></a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="13">등록된 회원이 없습니다.</td>
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
        const dataUrl = '{{ route('member.data') }}';

        $(document).on('change', ".level_change", function() {
            const _case = 'level-change';
            const _target = $(this).find('option:selected').val();

            if (confirm('회원등급을 변경 하시겠습니까?')) {
                callAjax(dataUrl, { case: _case, sid: $(this).closest('tr').data('sid'), target: _target }, true);
            }
        });

        $(document).on('click', '.member-login', function() {
            callAjax(dataUrl, {
                'case': 'member-login',
                'sid': $(this).closest('tr').data('sid'),
            })
        });

        $(document).on('click', '.member-del', function() {
            if( confirm('정말 삭제하시겠습니까?') ){
                callAjax(dataUrl, {
                    'case': 'member-del',
                    'sid': $(this).closest('tr').data('sid'),
                    'type': 'admin'
                })
            }
        });
    </script>
@endsection
