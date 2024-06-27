@extends($extends_str)

@section('addStyle')
@endsection

@section('contents')
    <article class="sub-contents">
        <div class="sub-conbox inner-layer">

            @include('layouts.include.subTit')
{{--            @if(($extends_str ?? 'main') == 'layouts.web-layout')--}}
{{--                @include('layouts.include.subTit')--}}
{{--            @else--}}
{{--                <div class="tab-wrap cf">--}}
{{--                    <div class="board-cate-wrap sub-tab-wrap">--}}

{{--                        <a href="javascript:;" class="btn-tab-menu js-btn-tab-menu">보험기준</a>--}}

{{--                        <ul class="board-cate sub-tab-menu js-tab-menu n4">--}}
{{--                            <li class="{{ ($small_menu ?? 'SS1') == 'SS1' ? 'on' : '' }}"><a href="{{ route('insure.standard') }}">CIED</a></li>--}}
{{--                            <li class="{{ ($small_menu ?? 'SS1') == 'SS2' ? 'on' : '' }}"><a href="{{ route('insure.s2') }}">이식형 사건기록기</a></li>--}}
{{--                            <li class="{{ ($small_menu ?? 'SS1') == 'SS3' ? 'on' : '' }}"><a href="{{ route('insure.s3') }}">RFCA &amp; Cryoablation</a></li>--}}
{{--                            <li class="{{ ($small_menu ?? 'SS1') == 'SS4' ? 'on' : '' }}"><a href="{{ route('insure.s4') }}">Device 사전 심의 방법</a></li>--}}
{{--                        </ul>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            @endif--}}

            <ul class="box-list n3 insurance-list">
                <li>
                    <a href="/assets/file/ICD_SalaryStandard_20210713_new.pdf" target="_blank">
                        <strong class="tit">CIED 보험기준 (2021.07.13)</strong>
                        <span>ICD 급여기준</span>
                        <span class="btn btn-down">
                            Download
                        </span>
                    </a>
                </li>
                <li>
                    <a href="/assets/file/PM_SalaryStandard_20210713_new.pdf" target="_blank">
                        <strong class="tit">CIED 보험기준 (2021.07.13)</strong>
                        <span>PM 급여기준</span>
                        <span class="btn btn-down">
                                    Download
                                </span>
                    </a>
                </li>
                <li>
                    <a href="/assets/file/CRT_SalaryStandard_20210713_new.pdf" target="_blank">
                        <strong class="tit">CIED 보험기준 (2021.07.13)</strong>
                        <span>CRT 급여기준</span>
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