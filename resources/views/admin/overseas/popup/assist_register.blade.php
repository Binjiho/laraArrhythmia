@extends('layouts.pop-layout')

@section('addStyle')
@endsection

@section('contents')
    <div class="popup-wrap full" style="display: block;">
        <div class="popup-contents">
            <div class="popup-conbox popup-research-conbox">
                <h1>{{ $user->name_kr ?? '' }} 심사 상태 변경</h1>
                <div id="board" class="event-wrap board-wrap">
                    <div class="board-write">
                        <div class="write-form-wrap">
                            <form id="board-frm" data-sid="{{ $overseas->sid ?? 0 }}" data-case="change-assist" onsubmit="return false;">
                                <input type="hidden" name="user_sid" id="user_sid" value="{{ empty($overseas->sid) ? '' : ($overseas->user->sid ?? '') }}">
                                <fieldset>
                                    <legend class="hide">심사자 등록</legend>
                                    <div class="write-wrap">
                                        <dl>
                                            <dt>심사 상태</dt>
                                            <dd>
                                                <div class="radio-wrap cst">
                                                    @foreach($overseasConfig['result'] as $key => $val)
                                                        <div class="radio-group">
                                                            <input type="radio" name="result" id="result_{{$key}}" value="{{$key}}" {{ ( ($overseas->result ?? '') == $key) ? 'checked' : '' }}>
                                                            <label for="result_{{$key}}">{{$val}}</label>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </dd>
                                        </dl>

                                        <dl>
                                            <dt>지원협회</dt>
                                            <dd>
                                                <div class="radio-wrap cst">
                                                    @foreach($overseasConfig['assistant'] as $key => $val)
                                                        <div class="radio-group">
                                                            <input type="radio" name="assistant" id="assistant_{{$key}}" value="{{$key}}" {{ ( ($overseas->assistant ?? '') == $key) ? 'checked' : '' }}>
                                                            <label for="assistant_{{$key}}">{{$val}}</label>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </dd>
                                        </dl>


                                    </div>

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
        const dataUrl = '{{ route('overseas.data') }}';
        {{--const reviewerConfig = @json($reviewerConfig);--}}

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

        defaultVaildation();

        // 폼 체크
        $(boardForm).validate({
            rules: {
                result: {
                    isEmpty: true,
                },
                assistant: {
                    isEmpty: true,
                },

            },
            messages: {
                result: {
                    isEmpty: '심사상태를 선택해주세요.',
                },
                assistant: {
                    isEmpty: '지원협회를 선택해주세요.',
                },

            },
            submitHandler: function() {
                formSubmit();
            }
        });

        const formSubmit = () => {
            let ajaxData = newFormData(boardForm);
            // ajaxData.case = 'change-result';

            callMultiAjax("{{ route('overseas.data') }}", ajaxData);
        }
    </script>
@endsection