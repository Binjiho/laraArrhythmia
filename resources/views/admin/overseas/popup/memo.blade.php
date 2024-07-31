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
                            <form id="board-frm" data-sid="{{ $overseas->sid ?? 0 }}" data-case="overseas-memo" onsubmit="return false;">
                                <fieldset>
                                    <legend class="hide">관리자 메모</legend>
                                    <div class="write-wrap">
                                        <dl>
                                            <dt>관리자 메모</dt>
                                            <dd>
                                                <textarea name="memo" id="memo" cols="30" rows="10" class="form-item">{{ $overseas->memo ?? '' }}</textarea>
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

            self.close();
        });

        defaultVaildation();

        // 폼 체크
        $(boardForm).validate({
            rules: {
                memo: {
                    isEmpty: true,
                },
            },
            messages: {
                memo: {
                    isEmpty: '메모를 입력해주세요.',
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