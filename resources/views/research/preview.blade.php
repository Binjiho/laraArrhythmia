@extends('layouts.web-layout')

@section('addStyle')
@endsection

@section('contents')
    <article class="sub-contents">
        <div class="sub-conbox research-conbox inner-layer">
            @include('layouts.include.subTit')
            
            <div class="write-form-wrap">
                @include('research.form.preview_form')
            </div>
        </div>
    </article>
@endsection

@section('addScript')

@endsection