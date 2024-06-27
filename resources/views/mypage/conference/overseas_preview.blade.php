@extends('layouts.web-layout')

@section('addStyle')
@endsection

@section('contents')
    <article class="sub-contents">
        <div class="sub-conbox inner-layer">
            <div class="sub-contit-wrap mt-0">
                <h4 class="sub-contit">결과보고서 및 서류 제출</h4>
            </div>
            <div class="write-form-wrap">
                @include('mypage.conference.form.preview_form')
            </div>
        </div>
    </article>
@endsection

@section('addScript')
    <script src="{{ asset('plugins/jquery-validation/jquery.validate.min.js') }}"></script>
    <script>
        const form = '#register-frm';
        const dataUrl = '{{ route('mypage.data') }}';

        function cancle(){
            location.href='{{route('mypage.overseas')}}';
        }
    </script>
@endsection