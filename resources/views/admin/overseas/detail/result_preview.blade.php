@extends('admin.layouts.pop-layout')

@section('addStyle')
@endsection

@section('contents')
    @include('mypage.conference.form.preview_form')
@endsection

@section('addScript')
    <script src="{{ asset('plugins/jquery-validation/jquery.validate.min.js') }}"></script>
    <script>
        const form = '#register-frm';
        {{--const dataUrl = '{{ route('mypage.data') }}';--}}

        function cancle(){
            window.close();
        }
    </script>
@endsection
