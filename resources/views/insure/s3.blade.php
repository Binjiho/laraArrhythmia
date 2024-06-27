@extends($extends_str)

@section('addStyle')
@endsection

@section('contents')
    <article class="sub-contents">
        <div class="sub-conbox inner-layer">

            @include('layouts.include.subTit')
            
            <ul class="box-list n3 insurance-list">
                <li>
                    <a href="/assets/file/RFCA_Cryo_SalaryStandard_20210713_new.pdf" target="_blank">
                        <strong class="tit">RFCA and Cryoablation 보험기준(2021.07.13)</strong>
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