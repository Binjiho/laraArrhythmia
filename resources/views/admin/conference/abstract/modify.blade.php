@extends('admin.layouts.pop-layout')

@section('addStyle')
    <script src="{{ asset('plugins/ckeditor/ckeditor.js') }}"></script>
@endsection

@section('contents')
    <div class="contents" style="padding: 35px;">
        <div id="board" class="event-wrap board-wrap" data-sid="{{ $conference->sid }}">
            <div class="write-form-wrap">
                @include('conference.detail.abstract.form.reg_form')
            </div>
        </div>
    </div>
@endsection

@section('addScript')
    <script>
        const form = '#register-frm';
        const dataUrl = '{{ route('conference.abstract.data', ['csid' => request()->csid]) }}';
    </script>
    @yield('abs-script')
@endsection

