@extends('admin.layouts.admin-layout')

@section('addStyle')
@endsection

@section('contents')
    <div class="contents">
        <div class="titArea">
            <h2>탈퇴회원관리</h2>
        </div>

        <form class="searchArea">
            <form id="search-frm" action="{{ route('member.withdrawal') }}" method="get">
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
                    <a href="{{ route('member.withdrawal') }}" class="btnBdNavy">검색초기화</a>
                    <a href="{{ route('member.withdrawal.excel', request()->except(['page'])) }}" class="btnBdBlue">엑셀 백업</a>
                </div>
            </form>
        </form>



        <table class="tblDef listTbl">
            <colgroup>
                <col style="width: *;">
                <col style="width: 8%;">
                <col style="width: 9%;">
                <col style="width: 8%;">
                <col style="width: 8%;">

                <col style="width: 8%;">
                <col style="width: 8%;">
                <col style="width: 8%;">
                <col style="width: 8%;">
                <col style="width: 11%;">
                <col style="width: 8%;">

                <col style="width: 8%;">
            </colgroup>
            <thead>
            <tr>
                <th>No</th>
                <th>회원구분</th>
                <th>이름</th>
                <th>아이디</th>
                <th>면허번호</th>

                <th>소속</th>
                <th>의대</th>
                <th>가입일</th>
                <th>탈퇴 상태</th>
                <th>탈퇴 신청일</th>
                <th>탈퇴 완료일</th>

                <th>관리</th>
            </tr>
            </thead>
            <tbody>
            @forelse($list as $row)
                <tr data-sid="{{ $row->sid }}">
                    <td>{{ $row->seq }}</td>
                    <td>{{ $userConfig['level'][$row->level] }}</td>
                    <td>{{ $row->name_kr }}</td>
                    <td>{{ $row->uid }}</td>l
                    <td>{{ $row->license_number }}</td>

                    <td>{{ $row->sosok_kr ?? '' }} {{ $row->sosok_en ? '('.$row->sosok_en.')' : '' }}</td>
                    <td>{{ $row->school_kr ?? '' }}{{ $row->school_en ? '('.$row->school_en.')' : '' }}</td>
                    <td>{{ $row->created_at->format('Y-m-d') }}</td>
                    <td>{{ $userConfig['del_confirm'][$row->del_confirm] }}</td>
                    <td>{{ $row->del_confirm_date ? $row->del_confirm_date->format('Y-m-d') : '' }}</td>
                    <td>{{ $row->deleted_at ? $row->deleted_at->format('Y-m-d') : '' }}</td>

                    <td>
                        @if( $row->del_confirm == 'D' )
                        <a href="javascript:void(0);" class="member-recovery"><img src="{{asset('assets/image/admin/icon_modify.png')}}" alt="수정"></a>
                        @else
                            @if( !$row->deleted_at )
                            <a href="javascript:void(0);" class="member-recovery"><img src="{{asset('assets/image/admin/icon_modify.png')}}" alt="수정"></a>
                            <a href="javascript:void(0);" class="member-del"><img src="{{asset('assets/image/admin/icon_del.png')}}" alt="삭제"></a>
                            @else
                            탈퇴완료
                            @endif
                        @endif
                        
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="13">탈퇴 처리된 회원이 없습니다.</td>
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

    $(document).on('click', '.member-recovery', function() {
        if( confirm('정말 복구하시겠습니까?') ){    
            callAjax(dataUrl, {
                'case': 'member-recovery',
                'sid': $(this).closest('tr').data('sid'),
            })
        }
    });

    $(document).on('click', '.member-del', function() {
        if( confirm('정말 삭제하시겠습니까?') ){
            callAjax(dataUrl, {
                'case': 'member-del',
                'sid': $(this).closest('tr').data('sid'),
                'type': 'member'
            })
        }
    });
</script>
@endsection
