@extends('layouts.web-layout')

@section('addStyle')
@endsection

@section('contents')
    <article class="sub-contents">
        <div class="sub-conbox inner-layer">

            @include('layouts.include.subTit')

            <div class="sub-contit-wrap">
                <h4 class="sub-contit">신청기간</h4>
            </div>
            <ul class="list-type list-type-bar">
                <li>매년 9월~10월 (연 1회)</li>
            </ul>

            <div class="sub-contit-wrap">
                <h4 class="sub-contit">자격 및 절차</h4>
            </div>
            <ul class="list-type list-type-text">
                <li>
                    <span>(1)</span>
                    <div>
                        부정맥학회지(IJA) 원저 1편(제1 저자 혹은 교신저자) 제출
                    </div>
                </li>
                <li>
                    <span>(2)</span>
                    <div>
                        <span>투고 인정 기간:</span>
                        <p>
                            (신규) 신청 시점으로부터 최근 2년 이내의 OPEN된 논문 인정 <br>
                            * 전문회원 신청 시 원저 1편을 제출하였으면 면제. (단, 원로 회원 제외) <br>
                            (갱신) 신청 시점으로부터 최근 5년 이내의 OPEN된 논문 인정 <br>
                            * 신규 신청 당시 원저 투고 이력이 없는 갱신 대상자에 한함
                        </p>
                    </div>
                </li>
                <li>
                    <span>(3)</span>
                    <div>
                        증례 수 (신청 페이지에서 입력)
                        <ul class="list-type list-type-bar">
                            <li>전극도자절제술 30례 이상(주 시술자)</li>
                            <li>PM+ICD+CRT 20례 이상(주 시술자로서 10례 이상)</li>
                        </ul>
                    </div>
                </li>
                <li>
                    <span>(4)</span>
                    <div>
                        2인의 추천서를 스캔하여 업로드(추천서 양식 다운로드) *신규 신청자만 해당
                    </div>
                </li>
                <li>
                    <span>(5)</span>
                    <div>
                        중재시술자격 심사위원회에서 심사 진행
                    </div>
                </li>
                <li>
                    <span>(6)</span>
                    <div>
                        자격 심의 통과 후 자격증 교부비 납부 및 정보요청
                    </div>
                </li>
                <li>
                    <span>(7)</span>
                    <div>
                        최초 발급받은 후 5년 뒤 갱신(마찬가지로 증례 제출 및 심의)하며, 이후 평생 자격을 획득함
                    </div>
                </li>
            </ul>

            <div class="sub-contit-wrap">
                <h4 class="sub-contit">신청방법</h4>
            </div>
            <ul class="list-type list-type-bar">
                <li>
                    온라인 신청(이메일, 우편접수 불가)
                </li>
            </ul>

            <div class="btn-wrap text-center">
				 @if(thisUser())
{{--                <a href="{{ route('surgery.register') }}" class="btn btn-type1 color-type1">신청하러 가기 <span class="arrow">&gt;</span></a>--}}
				<a href="javascript:alert('추후 오픈 예정입니다.')" class="btn btn-type1 color-type1">신청하러 가기 <span class="arrow">&gt;</span></a>
				@else
                <a href="javascript:;" onclick="alert('로그인을 진행해주세요.'); location.href='{{ route('login') }}'; return false;" class="btn btn-type1 color-type11">신청하러 가기<span class="arrow">&gt;</span></a>
                @endif
            </div>
        </div>
    </article>
@endsection

@section('addScript')

@endsection