@extends('layouts.web-layout')

@section('addStyle')
@endsection

@section('contents')
    <article class="sub-contents">
        <div class="sub-conbox inner-layer">
            <div class="sub-tit-wrap">
                <h3 class="sub-tit">해외학회 참가지원 신청 내역</h3>
            </div>
            <div class="sub-contit-wrap">
                <h4 class="sub-contit">기본정보</h4>
            </div>
            @include('overseas.form.preview')
        </div>
    </article>
@endsection

@section('addScript')
    <script>
        const form = '#register-frm';
        const dataUrl = '{{ route('overseas.data') }}';

        defaultVaildation();

        $(form).validate({
            rules: {

            },
            messages: {

            },
            submitHandler: function () {
                registerSubmit();
            }
        });

        const registerSubmit = () => {
            let ajaxData = newFormData(form);
            callMultiAjax(dataUrl, ajaxData);
        }
    </script>
@endsection