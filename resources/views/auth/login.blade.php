@extends('layouts.web-layout')

@section('addStyle')
@endsection

@section('contents')
{{--        @include('layouts.web.include.subTit')--}}
    <article class="sub-contents">
        <div class="sub-conbox inner-layer">
            <div class="login-form-wrap">
                <form id="login-frm" action="{{ route('login') }}" method="post" onsubmit="return false;">
                    <fieldset>
                        <legend class="hide">로그인</legend>
                        <div class="login-form">
                            <h3 class="login-tit">
                                <img src="/assets/image/sub/img_login.png" alt="">
                                LOGIN
                            </h3>
                            <div class="input-box">
                                <p class="help-text text-red">
                                    비밀번호는 khrs+핸드폰 번호 뒷자리 8개로 초기화 되었습니다. <br>
                                    로그인 후 비밀번호 변경 부탁드립니다.
                                </p>
                                <input type="text" name="uid" id="uid" class="form-item" placeholder="아이디를 입력하세요." noneSpace>
                                <input type="password" name="password" id="password" class="form-item" placeholder="비밀번호를 입력하세요." noneSpace>
                            </div>
                            <p class="text-right">
                                <a href="{{ route('forgot') }}">아이디</a><a href="{{ route('forgot') }}">비밀번호 찾기</a>
                            </p>
                            <div class="btn-wrap">
                                <button type="submit" class="btn btn-type1 color-type6">로그인</button>
                            </div>
                        </div>
                        <div class="login-form login-info">
                            <h3 class="login-info-tit">
                                <img src="/assets/image/sub/login_logo.png" alt="대한부정맥학회 Korean Heart Rhythm Society">
                            </h3>
                            <p>
                                서비스를 이용하시려면 로그인 해주시기 바랍니다. <br>
                                아이디 / 비밀번호를 잊으신 분들은 <br>
                                아이디 / 비밀번호 찾기 버튼을 눌러 확인하시기 바랍니다. <br>
                                대한부정맥학회 홈페이지에 처음 방문하신 분들은 회원가입을 진행해 주세요.
                            </p>
                            <div class="btn-wrap text-center">
                                <a href="{{ route('register', ['step' => 'step1']) }}" class="btn btn-type1 color-type1">회원가입 바로가기 <span class="arrow">&gt;</span></a>
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </article>
@endsection

@section('addScript')
    <script src="{{ asset('plugins/jquery-validation/jquery.validate.min.js') }}"></script>
    <script>
        const form = '#login-frm';

        defaultVaildation();

        $(form).validate({
            rules: {
                uid: {
                    isEmpty: true,
                },
                password: {
                    isEmpty: true,
                },
            },
            messages: {
                uid: {
                    isEmpty: '아이디를 입력해주세요.',
                },
                password: {
                    isEmpty: '비밀번호를 입력해주세요.',
                },
            },
            submitHandler: function () {
                callAjax($(form).attr('action'), formSerialize(form), true);
            }
        });
    </script>
@endsection
