<tr id="case_{{ $case->sid }}" data-sid="{{ $case->sid }}">
    <td>{{ $surgeryConfig['case_gubun'][$case->gubun]}}</td>
    <td>{{$case->name}}</td>
    <td>{{$case->age}}</td>
    <td>{{ $surgeryConfig['case_gender'][$case->gender]}}</td>
    <td>{{$case->num}}</td>
    <td>{{$case->title}}</td>
    <td>{{$case->date}}</td>
    <td>
        <div class="btn-admin">
            <a href="javascript:;" data-type="case" data-sid="{{ $case->sid ?? 0 }}" data-surgery_sid="{{ $surgery_sid ?? 0 }}" class="layer btn btn-board btn-modify">수정</a>
{{--            <a href="{{ route('surgery.case.register',['sid' => $case->sid]) }}" class="call_popup btn btn-board btn-modify" data-popup_name="surgery_case_regist" data-width="1000" data-height="800">수정</a>--}}
            <a href="javascript:;" class="case-delete btn btn-board btn-delete">삭제</a>
        </div>
    </td>
</tr>

{{--<tr>--}}
{{--    <td>전극도자절제술</td>--}}
{{--    <td>환자명</td>--}}
{{--    <td>00</td>--}}
{{--    <td>여</td>--}}
{{--    <td>12******</td>--}}
{{--    <td>진단명</td>--}}
{{--    <td>YYY-MM-DD</td>--}}
{{--    <td>--}}
{{--        <div class="btn-admin">--}}
{{--            <a href="#n" class="btn btn-board btn-modify">수정</a>--}}
{{--            <a href="#n" class="btn btn-board btn-delete">삭제</a>--}}
{{--        </div>--}}
{{--    </td>--}}
{{--</tr>--}}