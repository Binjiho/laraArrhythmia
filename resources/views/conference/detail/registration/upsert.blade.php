@extends($extends_str)

@section('addStyle')
    <script src="{{ asset('plugins/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ asset('script/plupload-tinymce.common.js') }}?v={{ config('site.app.asset_version') }}"></script>
    <script src="//t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>
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
                @include('conference.detail.registration.form.reg_form')
            </div>
        </div>
    </div>
</article>
@endsection

@section('addScript')
    @include('kspay.kspay-script')

    <script>

        const form = '#register-frm';
        const dataUrl = '{{ route('conference.data') }}';
    </script>
    
    @yield('reg-script')
@endsection
