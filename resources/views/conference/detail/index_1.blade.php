@extends($extends_str)

@section('addStyle')
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

                @if($conference->invite_text)
                <div class="sub-contit-wrap mt-0">
                    <h4 class="sub-contit">초대의 글</h4>
                </div>
                <div class="view-contents editor-contents">
                    {!! $conference->invite_text ?? ''  !!}
                </div>
                @endif

            </div>
        </div>
    </article>
@endsection

@section('addScript')
    <script>
        $(document).on('change', "#abyear", function() {
            const url = '{{ route('board', ['code' => 'conference', 'category' => request()->category ?? '1']) }}'
            location.replace(url + '&abyear=' + $(this).val());
        });

        $(document).on('click', '.btn-delete', function() {
            const _case = $(this).hasClass('reply') ? 'reply-delete' : 'board-delete';

            if (confirm('정말로 삭제 하시겠습니까?')) {
                callAjax(dataUrl, { case: _case, sid: $(this).closest('li').data('sid') });
            }
        });

        $(document).on('change', ".hidesel", function() {
            const _case = 'board-hide';
            const _hide = $(this).find('option:selected').val();

            if (confirm('게시글 공개 여부를 변경 하시겠습니까?')) {
                callAjax(dataUrl, { case: _case, sid: $(this).closest('li').data('sid'), hide: _hide }, true);
            }
        });
    </script>
@endsection
