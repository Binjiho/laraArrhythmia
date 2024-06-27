{{-- Scripts --}}
<script src="/assets/js/jquery-1.12.4.min.js"></script>
<script src="/assets/js/jquery-ui.min.js"></script>
<script src="/assets/js/slick.min.js"></script>
<script src="/html/general/assets/js/common.js"></script>
<script src="{{ asset('plugins/moment/js/moment.min.js') }}"></script>
<script src="{{ asset('plugins/crypto-js/crypto-js.min.js') }}"></script>
<script src="{{ asset('plugins/flatpickr/js/flatpickr.min.js') }}"></script>
{{--<script src="{{ asset('plugins/flatpickr/js/flatpickr-ko.min.js') }}"></script>--}}
<script src="{{ asset('plugins/jquery-validation/jquery.validate.min.js') }}"></script>
{{--<script src="{{ asset('plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>--}}
<script src="{{ asset('assets/js/jquery-ui.min.js') }}"></script>
<script src="{{ asset('script/app.common.js') }}?v={{ config('site.app.asset_version') }}"></script>

@if(Session::has('msg') && !empty(Session::get('msg')))
    <script>
        alert('{!! Session::pull("msg") !!}');
    </script>
@endif

<script>
    const bxSlider = () => {
        $('.bxslider').bxSlider({
            mode: 'fade', // 슬라이드 효과 설정 (fade, horizontal 등)
            auto: false, // 자동 재생 여부
            captions: false, // 캡션 표시 여부
            adaptiveHeight: true, // 이미지 높이 자동 조정
        });
    }

    $(document).on('click', '#modal-layer-popup .modal-layer-close', function() {
        $('#modal-layer-popup').remove();
    });

    $(document).on('click', '.nav-tabs a.nav-link', function(e) {
        if ($(this).data('toggle') === 'tab') {
            e.preventDefault();
            $(this).tab('show');
        }
    });

    const logout = () => {
        if (confirm('로그아웃 하시겠습니까?')) {
            callAjax("{{ route('logout') }}")
        }
    }
</script>
