@extends($extends_str)

@section('addStyle')
@endsection

@section('contents')
    <article class="sub-contents">
        <div class="sub-conbox inner-layer">

            @include('layouts.include.subTit')

            <ul class="box-list n3 insurance-list">
                <li>
                    <a href="/assets/file/Device_201903.pdf" target="_blank">
                        <strong class="tit">Device 사전 심의 방법 (2019.03)</strong>
                        <span class="btn btn-down">
                                    Download
                                </span>
                    </a>
                </li>
            </ul>
        </div>
    </article>
@endsection

@section('addScript')

@endsection