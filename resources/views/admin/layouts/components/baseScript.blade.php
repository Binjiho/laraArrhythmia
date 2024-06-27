{{-- Scripts --}}
<script src="/assets/js/jquery-1.12.4.min.js"></script>
<script src="/assets/js/jquery-ui.min.js"></script>
<script src="/assets/js/slick.min.js"></script>
<script src="/assets/js/common.js"></script>
<script src="/script/user_admin.js"></script>
<script src="{{ asset('plugins/moment/js/moment.min.js') }}"></script>
<script src="{{ asset('plugins/crypto-js/crypto-js.min.js') }}"></script>
<script src="{{ asset('plugins/flatpickr/js/flatpickr.min.js') }}"></script>

{{--<script src="{{ asset('plugins/flatpickr/js/flatpickr-ko.min.js') }}"></script>--}}
{{--<script src="https://cdn.jsdelivr.net/npm/flatpickr@latest/dist/l10n/ko.js"></script>--}}
<script src="{{ asset('plugins/jquery-validation/jquery.validate.min.js') }}"></script>
{{--<script src="{{ asset('plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>--}}
<script src="{{ asset('script/app.common.js') }}?v={{ config('site.app.asset_version') }}"></script>
<script src="{{ asset('script/handsontable.full.min.js') }}"></script>
@if(Session::has('msg') && !empty(Session::get('msg')))
    <script>
        alert('{!! Session::pull("msg") !!}');
    </script>
@endif

<script>


    const logout = () => {
        if (confirm('로그아웃 하시겠습니까?')) {
            callAjax("{{ route('logout') }}")
        }
    }
</script>