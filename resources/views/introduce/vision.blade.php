@extends($extends_str)

@section('addStyle')
@endsection

@section('contents')
    <article class="sub-contents">
        <div class="sub-conbox inner-layer">

            @include('layouts.include.subTit')
            
            <div class="mission-conbox">
                <strong class="tit">MISSON</strong>
                <p>심장의 건강한 리듬을 지키기 위해 <br class="m-br">끊임없이 도전하고 헌신한다.</p>
            </div>
            <div class="vision-conbox">
                <strong class="tit">VISION</strong>
                <p>
                    부정맥 극복을 위한 창의적 연구, 인재교육 및 국민인식개선을 통해 의료의 선진화를 주도해 나가는 학회
                </p>
                <ul class="vision-list">
                    <li>
                        <span class="icon"><img src="/assets/image/sub/ic_vision01.png" alt=""></span>
                        <span class="tit">창의적 연구</span>
                    </li>
                    <li>
                        <span class="icon"><img src="/assets/image/sub/ic_vision02.png" alt=""></span>
                        <span class="tit">인재교육</span>
                    </li>
                    <li>
                        <span class="icon"><img src="/assets/image/sub/ic_vision03.png" alt=""></span>
                        <span class="tit">국민인식 개선</span>
                    </li>
                </ul>
                <div class="vision-box">
                    <span class="icon"><img src="/assets/image/sub/ic_vision04.png" alt=""></span>
                    <span class="tit">의료의 선진화</span>
                </div>
            </div>
        </div>
    </article>
@endsection

@section('addScript')

@endsection