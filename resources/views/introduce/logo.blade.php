@extends($extends_str)

@section('addStyle')
@endsection

@section('contents')
    <article class="sub-contents">
        <div class="sub-conbox inner-layer">

            @include('layouts.include.subTit')
            
            <ul class="box-list n2 logo-list">
                <li>
                    <div class="img-wrap">
                        <img src="../../assets/image/sub/img_logo_kor.png" alt="대한부정맥학회 Korean Heart Rhythm Society">
                    </div>
                    <span class="tit kor">
                        국문 로고
                    </span>
                </li>
                <li>
                    <div class="img-wrap">
                        <img src="../../assets/image/sub/img_logo_eng.png" alt="Korean Heart Rhythm Society">
                    </div>
                    <span class="tit eng">
                        영문 로고
                    </span>
                </li>
            </ul>
        </div>
    </article>
@endsection

@section('addScript')

@endsection