@extends($extends_str)

@section('addStyle')
    <script src="{{ asset('plugins/ckeditor/ckeditor.js') }}"></script>
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
                @include('conference.detail.abstract.form.reg_form')
            </div>
        </div>
    </div>
</article>
@endsection

@section('addScript')
    <script>
        const form = '#register-frm';
        const dataUrl = '{{ route('conference.data') }}';
    </script>
    @yield('abs-script')
@endsection
