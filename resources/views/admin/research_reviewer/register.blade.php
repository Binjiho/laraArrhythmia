@extends('layouts.pop-layout')

@section('addStyle')
@endsection

@section('contents')
<div class="popup-wrap full" style="display: block;">
    <div class="popup-contents">
        <div class="popup-conbox popup-research-conbox">
            <div id="board" class="event-wrap board-wrap">
                <div class="board-write">
                    <div class="write-form-wrap">
                        <form id="board-frm" data-sid="{{ $research_reviewer->sid ?? 0 }}" data-case="research_reviewer-{{ empty($research_reviewer->sid) ? 'create' : 'update' }}" onsubmit="return false;">
                            <input type="hidden" name="user_sid" id="user_sid" value="{{ empty($research_reviewer->sid) ? '' : ($research_reviewer->user->sid ?? '') }}">
                            <fieldset>
                                <legend class="hide">글쓰기</legend>
                                <div class="write-wrap">
                                    <dl>
                                        <dt>아이디</dt>
                                        <dd>
                                            <div class="form-group form-group-text n2">
                                                <input type="text" name="uid" id="uid" class="form-item" value="{{ $research_reviewer->user->uid ?? '' }}">
                                                <a href="javascript:void(0);" class="btn btn-small color-type2" id="uid_chk">검색</a>
                                            </div>
                                        </dd>
                                    </dl>

                                    <dl>
                                        <dt>성명</dt>
                                        <dd>
                                            <input type="text" name="name_kr" id="name_kr" class="form-item" value="{{ $research_reviewer->user->name_kr ?? '' }}" readonly>
                                        </dd>
                                    </dl>

                                    <dl>
                                        <dt>활성여부</dt>
                                        <dd>
                                            <div class="radio-wrap cst">
                                                @foreach($researchConfig['reviewer_use'] as $key => $val)
                                                <div class="radio-group">
                                                    <input type="radio" name="use_yn" id="use_yn_{{$key}}" value="{{$key}}" {{ ( ($research_reviewer->use_yn ?? '') == $key) ? 'checked' : '' }}>
                                                    <label for="use_yn_{{$key}}">{{$val}}</label>
                                                </div>
                                                @endforeach
                                            </div>
                                        </dd>
                                    </dl>
                                    <dl>
                                        <dt>메모</dt>
                                        <dd>
                                            <textarea name="memo" id="memo" cols="30" rows="10" class="form-item" >{{ $research_reviewer->memo ?? '' }}</textarea>
                                        </dd>
                                    </dl>

                                    
                                </div>

                                <div class="btn-wrap text-center">
                                    <a href="javascript:void(0);" class="btn btn-type1 color-type4" id="board_cancel">취소</a>
                                    <button type="submit" class="btn btn-type1 color-type5">{{ empty($research_reviewer->sid) ? '등록' : '수정' }}</button>
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

        $(document).on('click', '#uid_chk', function() {
            const uid = $('input[name=uid]').val();

            let obj = {
                'case': true,
                'focus': 'input[name=uid]'
            };

            if(isEmpty(uid)) {
                obj.msg = '아이디를 입력해주세요.';
                actionAlert(obj);
                return;
            }

            callAjax('{{ route('research_reviewer.data') }}', {
                'case': 'uid-check',
                'uid': uid,
            });
        });

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

        defaultVaildation();

        // 폼 체크
        $(boardForm).validate({
            rules: {
                uid: {
                    isEmpty: true,
                },
                name_kr: {
                    isEmpty: true,
                },
                use_yn: {
                    checkEmpty: true,
                },
            },
            messages: {
                uid: {
                    isEmpty: '아이디를 입력해주세요.',
                },
                name_kr: {
                    isEmpty: '아이디를 검색해주세요.',
                },
                use_yn: {
                    checkEmpty: '활성여부를 선택해주세요.',
                },
            },
            submitHandler: function() {
                formSubmit();
            }
        });

        const formSubmit = () => {
            let ajaxData = newFormData(boardForm);
            
            callMultiAjax('{{ route("research_reviewer.data") }}', ajaxData);
        }
    </script>    
@endsection