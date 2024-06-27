@extends($extends_str)

@section('addStyle')
    <script src="{{ asset('plugins/ckeditor/ckeditor.js') }}"></script>
    {{--    <script src="https://cdn.ckeditor.com/4.4.7/basic/ckeditor.js"></script>--}}
@endsection

@section('contents')

    <article class="sub-contents">
        <div class="sub-conbox inner-layer">
            <div class="sub-tit-wrap">
                <h3 class="sub-tit">국내외 학술행사</h3>
            </div>
            <div id="board" class="event-wrap board-wrap" data-sid="{{ $conference->sid }}">
                <div class="ev-banner">
                    <strong class="ev-tit">{{ $conference->subject }}</strong>
                    <ul>
                        <li>{{ $conference->event_sdate->format('Y-m-d') }} ~ {{ $conference->event_edate->format('Y-m-d') }}</li>
                        <li>{{ $conference->place ?? '' }}</li>
                    </ul>
                </div>

                @include('conference.include.tabArea')

                <div class="write-form-wrap">
                    @include('conference.detail.abstract.form.preview_form')
                </div>
            </div>
        </div>
    </article>
@endsection

@section('addScript')
    <script>
        const form = '#register-frm';
        const dataUrl = '{{ route('conference.data') }}';

        // 게시글 작성 취소
        $(document).on('click', '#board_cancel', function(e) {
            e.preventDefault();

            const msg = ($(form).data('sid') == 0) ?
                '등록을 취소하시겠습니까?' :
                '수정을 취소하시겠습니까?';

            if (confirm(msg)) {
                location.replace('{{ route('board', ['code' => $code]) }}');
            }
        });

        defaultVaildation();

        // 게시판 폼 체크
        $(form).validate({
            ignore: ['content', 'popup_content'],
            rules: {

            },
            messages: {

            },
            submitHandler: function() {

                registerSubmit();
            }
        });

        const registerSubmit = () => {
            let ajaxData = newFormData($(form));
            callMultiAjax(dataUrl, ajaxData);
        }
    </script>
@endsection
