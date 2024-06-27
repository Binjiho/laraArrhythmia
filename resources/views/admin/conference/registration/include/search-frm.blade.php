<form id="search-frm" lass="searchArea" action="{{ route($routeName, ['csid' => request()->csid]) }}" method="get">
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
                <td><input type="text" name="name" value="{{ request()->name ?? '' }}"></td>

                <th>E-Mail</th>
                <td><input type="text" name="email" value="{{ request()->email ?? '' }}"></td>

                <th>면허번호</th>
                <td><input type="text" name="license_number" value="{{ request()->license_number ?? '' }}"></td>
            </tr>

            <tr>
                <th>ID</th>
                <td><input type="text" name="uid" value="{{ request()->uid ?? '' }}"></td>

                <th>가입구분</th>
                <td>
                    <select name="category">
                        <option value="">전체</option>
                        @foreach($userConfig['category'] as $key => $val)
                            <option value="{{ $key  }}" {{ (request()->category ?? '') == $key ? 'selected' : '' }}>{{ $val }}</option>
                        @endforeach
                    </select>
                </td>

                <th>병원명(소속)</th>
                <td><input type="text" name="sosok" value="{{ request()->sosok ?? '' }}"></td>
            </tr>

            <tr>
                <th>휴대폰번호</th>
                <td><input type="text" name="phone" value="{{ request()->phone ?? '' }}"></td>
                {{--                            {{ $feeConfig['pay_status'][$row->fee_status ?? 'A'] }}--}}
                <th>회비 납부 여부</th>
                <td>
                    <select name="fee_pay_status">
                        <option value="">전체</option>
                        @foreach(config('site.fee.pay_status') as $key => $val)
                            <option value="{{ $key  }}" {{ (request()->fee_pay_status ?? '') == $key ? 'selected' : '' }}>{{ $val }}</option>
                        @endforeach
                    </select>
                </td>

                <th>납부상태</th>
                <td>
                    <select name="pay_status">
                        <option value="">전체</option>
                        @foreach($conferenceConfig['pay_status'] as $key => $val)
                            <option value="{{ $key  }}" {{ (request()->pay_status ?? '') == $key ? 'selected' : '' }}>{{ $val }}</option>
                        @endforeach
                    </select>
                </td>
            </tr>
            </tbody>
        </table>
    </fieldset>

    <div class="util btn" style="display: flex; justify-content: center; margin-top: 20px;">
        <input class="btnDel" type="submit" value="검색">
        <a href="{{ route($routeName, ['csid' => request()->csid]) }}" class="btnBdNavy">검색초기화</a>

        @if($routeName == 'conference.registration.withdrawal')
            <a href="{{ route('conference.registration.excel', ['csid' => request()->csid, 'case' => 'withdrawal'] + request()->except(['page'])) }}" class="btnBdBlue">엑셀 백업</a>
        @else
            <a href="{{ route('conference.registration.excel', ['csid' => request()->csid] + request()->except(['page'])) }}" class="btnBdBlue">엑셀 백업</a>
        @endif

        <a href="{{ route('conference') }}" class="btnBdBlue">목록</a>
    </div>
</form>