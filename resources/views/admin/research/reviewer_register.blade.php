@extends('layouts.pop-layout')

@section('addStyle')
@endsection

@section('contents')
<div class="popupWrap" id="popupAdmin" style="width: 100%;">
    <h1>심사 배정</h1>

    <div class="popupCon">
        <div class="formArea">
            <div id="board" class="event-wrap board-wrap">
                <div class="board-write">
                    <div class="write-form-wrap" id="popupPrepare">
                        <form id="board-frm" data-sid="{{ $_GET['research_sid'] ?? 0 }}" data-case="reviewer-regist" onsubmit="return false;">
                            <fieldset>
                                <table class="inputTbl ">
                                <tr>
                                    <th>이름</th>
                                    <th>소속</th>
                                    <th>이메일</th>
                                    <th>선택</th>
                                </tr>
                                @forelse($list as $reviewer)
                                    <tr>
                                        <td>{{ $reviewer->user->name_kr }}</td>
                                        <td>{{ $reviewer->user->sosok_kr }}</td>
                                        <td>{{ $reviewer->user->uid }}</td>
                                        <td>
                                            <input type="checkbox" name="research_reviewer_sid[]" id="research_reviewer_sid{{ $reviewer->user_sid }}" value="{{ $reviewer->user_sid }}" {{ in_array($reviewer->user_sid, ($reviewer_users ?? []) ) ? 'checked' : '' }} >
                                        </td>
                                    </tr>
                                @empty
                                    <tr><td colspan='4'>등록된 심사자가 없습니다.</td></tr>
                                @endforelse
                                </table>

                                <div class="btn-wrap text-center">
                                    <a href="javascript:void(0);" class="btn btn-type1 color-type4" id="board_cancel">취소</a>
                                    <button type="submit" class="btn btn-type1 color-type5">등록</button>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


@section('addScript')
    <script>
        const boardForm = '#board-frm';

        // 게시글 작성 취소
        $(document).on('click', '#board_cancel', function(e) {
            e.preventDefault();

            const msg = ($(boardForm).data('sid') == 0) ?
                '등록을 취소하시겠습니까?' :
                '수정을 취소하시겠습니까?';

            if (confirm(msg)) {
                self.close();
            }
        });


        $('#board-frm').on('submit', function(e) {
            e.preventDefault();

            let research_reviewer_sid = $(":checkbox[name='research_reviewer_sid[]']:checked").map((i, el) => el.value).get();

            if (confirm('등록하시겠습니까?')) {

                let ajaxData = newFormData(boardForm);

                ajaxData.append("research_reviewer_sid", JSON.stringify(research_reviewer_sid));

                callMultiAjax('{{ route("research.data") }}', ajaxData);
            }
        });
    </script>    
@endsection