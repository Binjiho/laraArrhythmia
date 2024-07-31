@extends('layouts.pop-layout')

@section('addStyle')
@endsection

@section('contents')
    <div class="popupWrap" id="popupAdmin" style="width: 100%;">
        <h1>{{ $mail_type ?? '' }}</h1>

        <div class="popupCon">
            <div class="formArea">
                <div id="board" class="event-wrap board-wrap">
                    <div class="board-write">
                        <div class="write-form-wrap" id="popupPrepare">
                            <form id="board-frm" data-sid="{{ $_GET['csid'] ?? 0 }}" data-case="mail-send" onsubmit="return false;">
                                <input type="hidden" name="mail_type" value="{{ $mail_type ?? '' }}" >
                                <input type="hidden" name="mail_title" value="{{ $mail_title ?? '' }}" >
                                <input type="hidden" name="template_name" value="{{ $template_name ?? '' }}" >
                                <fieldset>

                                    <table class="inputTbl" style="margin-top: 10px;">
                                        <tr>
{{--                                            <th>선택</th>--}}
                                            <th>
                                                <input type="checkbox" id="all_chk" value="Y" > 선택
                                            </th>
                                            <th>성명</th>
                                            <th>이메일</th>
                                        </tr>
                                        @forelse($list as $overseas)
                                            <tr>
                                                <td>
                                                    <input type="checkbox" name="overseas_sid[]" id="user_sid{{ $overseas->sid }}" value="{{ $overseas->sid }}" >
                                                </td>
                                                <td>{{ $overseas->user->name_kr }}</td>
                                                <td>{{ $overseas->user->uid }}</td>
                                            </tr>
                                        @empty
                                            <tr><td colspan='5'>등록된 참여자가 없습니다.</td></tr>
                                        @endforelse
                                    </table>

                                    <div id="mail_preview" style="margin-top: 20px; margin-bottom: 10px;">
                                        @include("common.mail.$template_name")
                                    </div>

                                    <div class="btn-wrap text-center">
                                        <a href="javascript:void(0);" class="btn btn-type1 color-type4" id="board_cancel">취소</a>
                                        <button type="submit" class="btn btn-type1 color-type5">발송</button>
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

        // 전체 선택
        $(document).on('click', '#all_chk', function(e) {
            console.log($(this).is(':checked'));
            if(!$(this).is(':checked')){
                $(":checkbox[name='overseas_sid[]']").prop('checked',false);
            }else{
                $(":checkbox[name='overseas_sid[]']").prop('checked',true);
            }
        });

        // 게시글 작성 취소
        $(document).on('click', '#board_cancel', function(e) {
            e.preventDefault();

            if (confirm('메일발송을 취소하시겠습니까?')) {
                self.close();
            }
        });


        $('#board-frm').on('submit', function(e) {
            e.preventDefault();

            let overseas_sid = $(":checkbox[name='overseas_sid[]']:checked").map((i, el) => el.value).get();

            if(overseas_sid.length < 1){
                alert('회원을 선택하여 주세요.');
                return false;
            }

            if (confirm('체크 한 모든 메일은 실제 수신인에게 발송 됩니다. 정말 발송 하시겠습니까? 창을 닫지 말고 기다려주세요.')) {

                let ajaxData = newFormData(boardForm);

                ajaxData.append("overseas_sid", JSON.stringify(overseas_sid));

                callMultiAjax('{{ route("overseas.data") }}', ajaxData);
            }
        });
    </script>
@endsection