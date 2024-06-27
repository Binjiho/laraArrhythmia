@extends('layouts.web-layout')

@section('addStyle')
@endsection

@section('contents')
    <article class="sub-contents">
        <div class="sub-conbox signup-intro inner-layer">
			<div class="sub-tit-wrap">
                <h3 class="sub-tit">연구회/지회</h3>
            </div>

            @include('introduce.group.include.tab')
            
            <div class="sub-contit-wrap">
                <h4 class="sub-contit">신청 방법</h4>
            </div>
            <p>
                회원가입 신청서 작성 후 이메일(<a href="mailto:khrs10@k-hrs.org" target="_blank" class="link">khrs10@k-hrs.org</a>) 송부 후 연구회 임원진 승인 후 가입완료
            </p>
            <div class="btn-wrap text-center">
                <a href="/assets/file/signup_form.docx" class="btn btn-type1 color-type16" target="_blank">대한부정맥학회 산하연구회 회원가입 신청서 다운로드 <img src="/assets/image/sub/ic_download.png" alt="" class="ic-down"></a>
            </div>

            <div class="sub-contit-wrap">
                <h4 class="sub-contit">문의 및 연락처</h4>
            </div>
            <div class="inquiry-conbox">
                <ul>
                    <li>
                        <img src="/assets/image/sub/ic_email.png" alt="">
                        <p>
                            <strong>E-mail</strong>
                            <a href="mailto:khrs10@k-hrs.org" target="_blank">khrs10@k-hrs.org</a>
                        </p>
                    </li>
                    <li>
                        <img src="/assets/image/sub/ic_tel.png" alt="">
                        <p>
                            <strong>Tel</strong>
                            <a href="tel:02-318-5416" target="_blank">02-318-5416</a>
                        </p>
                    </li>
                </ul>
            </div>
        </div>
    </article>
@endsection

@section('addScript')

@endsection