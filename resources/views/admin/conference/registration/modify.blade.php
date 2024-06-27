@extends('admin.layouts.pop-layout')

@section('addStyle')
@endsection

@section('contents')
    <div class="contents" style="padding: 35px;">
        <div id="board" class="event-wrap board-wrap" data-sid="{{ $conference->sid }}">
            <div class="write-form-wrap">
                @include('conference.detail.registration.form.reg_form')
            </div>
        </div>
    </div>
@endsection

@section('addScript')
    <script>
        const form = '#register-frm';
        const dataUrl = '{{ route('conference.registration.data', ['csid' => request()->csid]) }}';
    </script>

    @yield('reg-script')
@endsection
