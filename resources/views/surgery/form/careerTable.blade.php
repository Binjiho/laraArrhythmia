
<tr id="career_{{ $career->sid }}" data-sid="{{ $career->sid }}">

    <td>{{ $surgeryConfig['career_gubun'][$career->gubun]}}</td>
    <td>{{$career->sdate}} ~ {{$career->edate}}</td>
    <td>{{$career->title}}</td>
    <td>{{$career->content}}</td>
    <td>{{$career->created_at->format('Y-m-d')}}</td>
    <td>
        <div class="btn-admin">
            <a href="javascript:;" data-type="career" data-sid="{{ $career->sid ?? 0 }}" data-surgery_sid="{{ $surgery_sid ?? 0 }}" class="layer btn btn-board btn-modify">수정</a>
            <a href="javascript:;" class="career-delete btn btn-board btn-delete">삭제</a>
        </div>
    </td>

</tr>
