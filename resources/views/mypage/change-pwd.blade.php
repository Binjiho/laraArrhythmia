@extends('layouts.web-layout')

@section('addStyle')
@endsection

@section('contents')
    <div class="contents">
        <article class="sub-contents">
            <div class="sub-conbox inner-layer">
                <div class="find-form-wrap">
                    <form action="{{ route('mypage.data') }}" id="change-pwd" method="post" onsubmit="return false;" data-case="change-pwd">
                        <fieldset>
                            <legend class="hide">비밀번호 변경</legend>
                            <div class="find-form mypage-form">
                                <h3 class="find-tit">
                                    <img src="/assets/image/sub/ic_mypage02.png" alt="">
                                    비밀번호 변경
                                </h3>
                                <div class="bg-box bg-gray">
                                    {{$user->name_kr}} 회원님의 개인정보보호를 위하여 6개월 이상 비밀번호를 변경하지 않은 경우 비밀번호 변경 안내를 하고 있습니다. <br>
                                    비밀번호 변경을 원하지 않을 경우 <strong class="text-red">[다음에 변경하기]</strong> 버튼 클릭으로 1개월 동안 안내를 받지 않을 수 있습니다. <br>
                                    비밀번호는 숫자, 영문소문자, 특수문자를 조합하여 사용하시는 것이 안전하며, 주기적(최소 6개월)으로 변경 하시기 바랍니다.

                                </div>
                                <div class="write-wrap">
                                    <dl>
                                        <dt>현재 비밀번호</dt>
                                        <dd>
                                            <input type="password" name="password" id="password" class="form-item" noneSpace>
                                        </dd>
                                    </dl>
                                    <dl>
                                        <dt>새 비밀번호</dt>
                                        <dd>
                                            <input type="password" name="new_password" id="new_password" class="form-item" noneSpace>
                                        </dd>
                                    </dl>
                                    <dl>
                                        <dt>비밀번호 확인</dt>
                                        <dd>
                                            <input type="password" name="new_password_confirm" id="new_password_confirm" class="form-item" noneSpace>
                                            <div class="help-text text-red mt-10">입력하신 비밀번호를 다시 한번 입력해 주세요.</div>
                                        </dd>
                                    </dl>
                                </div>
                                <p>
                                    쉬운 비밀번호나 자주 쓰는 사이트의 비밀번호가 같을 경우, 도용되기 쉬우므로 주기적으로 변경하셔서 사용하는 것이 좋습니다. <br>
                                    아이디와 주민등록번호, 생일, 전화번호 등 개인정보와 관련된 숫자, 연속된 숫자, 반복된 문자 등 다른 사람이 쉽게 알아 낼 수 있는 비밀번호는 개인정보 유출의 위험이 높으므로 사용을 자제해 주시기 바랍니다.
                                </p>
                                <div class="btn-wrap text-center">
                                    <a href="{{route('mypage.intro')}}" class="btn btn-type1 color-type4">다음에 변경하기</a>
                                    <button type="submit" class="btn btn-type1 color-type6">변경</button>
                                </div>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </article>
    </div>
@endsection

@section('addScript')
    <script src="{{ asset('plugins/jquery-validation/jquery.validate.min.js') }}"></script>
    <script>
        const form = '#change-pwd';

        defaultVaildation();

        $(form).validate({
            rules: {
                password: {
                    isEmpty: true,
                },
            },
            messages: {
                password: {
                    isEmpty: '현재 비밀번호를 입력해주세요.',
                },
            },
            submitHandler: function () {
                callAjax($(form).attr('action'), formSerialize(form));
            }
        });
    </script>
@endsection
