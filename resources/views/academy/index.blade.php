@extends($extends_str)

@section('addStyle')
@endsection

@section('contents')
    <article class="sub-contents">
        <div class="sub-conbox inner-layer">

            @include('layouts.include.subTit')
            
            <div class="journal-conbox">
                <div class="img-wrap">
                    <img src="/assets/image/sub/img_journal_book.png" alt="International Journal of Arrhythmia">
                </div>
                <div class="text-wrap">
                    <p>
                        <span class="text-red">'International Journal of Arrhythmia'</span>는 부정맥과 관련된 새로운 임상 연구, 진료지침, 증례 등을 소개하여 부정맥연구회 회원 및 개원의의 지속적인 의학교육에 이바지하고자 발행되는 학술지입니다. <br>
                        부정맥의 진단과 치료, 임상 연구와 관련된 원저, 종설, 논평, 증례 보고 등의 원고를 공모하며, 제출된 원고는 편집위원회의 검토를 거쳐 게재됩니다. <br><br>

                        본 지는 1년 4회의 주기로 3월, 6월, 9월, 12월의 마지막 날에 국문 혹은 영문(종설 원고)과 영문(원저, 증례보고)으로 발행하며, 인쇄 출판물과 공식 홈페이지를 통해 온라인 출판물로 발행됩니다.
                    </p>
                    <div class="btn-wrap cf">
                        <a href="https://www.e-arrhythmia.org/" class="btn btn-journal" target="_blank">국문 홈페이지 바로가기</a>
                        <a href="https://arrhythmia.biomedcentral.com/" class="btn btn-journal btn-line" target="_blank">영문 홈페이지 바로가기</a>
                    </div>
                </div>
            </div>
        </div>
    </article>

@endsection

@section('addScript')

@endsection