@extends('layouts.pop-layout')

@section('addStyle')
@endsection

@section('contents')
    <div class="popupWrap" id="popupAdmin" style="width: 100%;">
        <h1>※ 지원 협회 선택 후 선정 된 참가자를 선택하여 [심사] 버튼을 클릭해주셔야 완료 됩니다.</h1>

        <div class="popupCon">
            <div class="formArea">
                <div id="board" class="event-wrap board-wrap">
                    <div class="board-write">
                        <div class="write-form-wrap" id="popupPrepare">
                            <form id="board-frm" data-sid="{{ $_GET['csid'] ?? 0 }}" data-case="change-group-assist" onsubmit="return false;">
                                <fieldset>

                                    <div class="write-wrap">
                                        <dl>
                                            <dt>지원협회</dt>
                                            <dd>
                                                <div class="radio-wrap cst">
                                                    @foreach($overseasConfig['assistant'] as $key => $val)
                                                        <div class="radio-group">
                                                            <input type="radio" name="assistant" id="assistant_{{$key}}" value="{{$key}}" >
                                                            <label for="assistant_{{$key}}">{{$val}}</label>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </dd>
                                        </dl>
                                    </div>

                                    <table class="inputTbl" style="margin-top: 10px;">
                                        <tr>
                                            <th>아이디</th>
                                            <th>성명</th>
                                            <th>소속</th>
                                            <th>참가역할</th>

                                            <th>선택</th>
                                        </tr>
                                        @forelse($list as $overseas)
                                            <tr>
                                                <td>{{ $overseas->user->uid }}</td>
                                                <td>{{ $overseas->user->name_kr }}</td>
                                                <td>{{ $overseas->user->sosok_kr }}</td>
                                                <td>{{ $overseasConfig['participant'][$overseas->participant] }}</td>

                                                <td>
                                                    <input type="checkbox" name="overseas_sid[]" id="overseas_sid{{ $overseas->sid }}" value="{{ $overseas->sid }}" {{ in_array($overseas->sid, ($overseas_sid_arr ?? []) ) ? 'checked' : '' }} >
                                                </td>
                                            </tr>
                                        @empty
                                            <tr><td colspan='5'>등록된 참여자가 없습니다.</td></tr>
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

            if (confirm('등록을 취소하시겠습니까?')) {
                self.close();
            }
        });


        $('#board-frm').on('submit', function(e) {
            e.preventDefault();

            let overseas_sid = $(":checkbox[name='overseas_sid[]']:checked").map((i, el) => el.value).get();

            if(!$("input[name='assistant']").is(":checked")){
                alert('지원협회를 선택하여 주세요.');
                return false;
            }
            if(overseas_sid.length < 1){
                alert('회원을 선택하여 주세요.');
                return false;
            }

            if (confirm('등록하시겠습니까?')) {

                let ajaxData = newFormData(boardForm);

                ajaxData.append("overseas_sid", JSON.stringify(overseas_sid));

                callMultiAjax('{{ route("overseas.data") }}', ajaxData);
            }
        });
    </script>
@endsection