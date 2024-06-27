@extends($extends_str)

@section('addStyle')
@endsection

@section('contents')
    <article class="sub-contents">
        <div class="sub-conbox inner-layer">
            @include('layouts.include.subTit')
            
            <div class="bg-box bg-info-box">
                <img src="/assets/image/sub/img_submission.png" alt="">
                <div class="text-wrap">
                    <p>
                        International Journal of Arrhythmia는 부정맥의 진단과 치료, 임상 연구와 관련된 원저, 종설, 논평, 증례 보고 등의 원고를 공모하며, <br class="no-br">
                        제출된 원고는 편집위원회의 검토 및 전문가의 심사를 거쳐 게재됩니다. 모든 원고는 온라인 시스템을 통해 등록되어야 합니다. <br>
                        온라인 투고시스템으로 진행하기 전 원고가 'International Journal of Arrhythmia 투고 및 윤리 규정'에 알맞게 작성되었는지 확인하시기 바랍니다.
                    </p>
                </div>
                <div class="btn-wrap text-center">
                    <a href="https://www.editorialmanager.com/ijoa/default.aspx" target="_blank" class="btn btn-type1 color-type17">온라인 논문 투고 <span class="arrow">&gt;</span></a>
                </div>
            </div>
        </div>
    </article>

@endsection

@section('addScript')

@endsection