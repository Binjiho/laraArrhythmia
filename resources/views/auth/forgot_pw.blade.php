@extends('layouts.web-layout')

@section('addStyle')
@endsection

@section('contents')
    <article class="sub-contents">
        <div class="sub-conbox inner-layer">

            <div class="sub-tab-wrap">
                <ul class="sub-tab-menu n2">
                    <li class=""><a href="{{route('forgot')}}">아이디 찾기</a></li>
                    <li class="on"><a href="{{route('forgot_pw')}}">비밀번호 찾기</a></li>
                </ul>
            </div>

            <div class="find-form-wrap">
                <form id="forgot-uid-frm" action="{{ route('auth.data') }}" method="post" data-case="forgot-password">
                    <fieldset>
                        <legend class="hide">비밀번호 찾기</legend>
                        <div class="find-form">
                            <h3 class="find-tit">
                                <img src="/assets/image/sub/img_find_id.png" alt="">
                                비밀번호 찾기
                            </h3>
                            <p>
                                아이디와 이름을 입력해 주세요. <br>
                                입력하신 정보가 정확히 일치하면, 가입 당시 기재 하셨던 이메일로 아이디를 보내드립니다.
                            </p>
                            <div class="write-wrap">
                                <dl>
                                    <dt>아이디</dt>
                                    <dd>
                                        <input type="text" name="uid" id="uid" class="form-item">
                                    </dd>
                                </dl>
                                <dl>
                                    <dt>이름</dt>
                                    <dd>
                                        <input type="text" name="name_kr" id="name_kr" class="form-item">
                                    </dd>
                                </dl>
                            </div>
                            <div class="btn-wrap text-center">
                                <button type="submit" class="btn btn-type1 color-type7">비밀번호 찾기</button>
                            </div>
                        </div>

                        <div class="find-result-conbox result" style="display: none;">
                            가입한 이메일로 임시 비밀번호가 발급되었습니다.
                        </div>

                        <div class="find-result-conbox noResult" style="display: none;">
                            일치하는 정보가 없습니다. 가입 정보를 다시 확인해 주세요.
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
        // $(document).on('click','.sub-tab-menu li',function(){
        //     var idx = $(this).index();
        //     $('.sub-tab-menu li').removeClass("on");
        //     $('.sub-tab-menu li').eq(idx).addClass("on");
        //     $('.find-form-wrap').eq(idx).show();
        // });

        const uid_frm = '#forgot-uid-frm';
        const password_frm = '#forgot-password-frm';

        defaultVaildation();

        $(document).on('keyup', `${uid_frm} input[name=name_kr], ${uid_frm} input[name=license_number]`, function() {
            resetResultMsg('.find-form-wrap:eq(0)');
        });

        $(document).on('keyup', `${password_frm} input[name=uid], ${password_frm} input[name=name_kr], ${password_frm} input[name=email]`, function() {
            resetResultMsg('.find-form-wrap:eq(1)');
        });

        const resetResultMsg = (target) => {
            $(target).find('.noResult').css('display', 'none');
            $(target).find('.noResult').html('');
            $(target).find('.result').css('display', 'none');
            $(target).find('.result').html('');
        }

        $(uid_frm).validate({
            rules: {
                name_kr: {
                    isEmpty: true,
                },
                license_number: {
                    isEmpty: true,
                },
            },
            messages: {
                name_kr: {
                    isEmpty: '이름을 입력해주세요.',
                },
                license_number: {
                    isEmpty: '의사 면허번호를 입력해주세요.',
                },
            },
            submitHandler: function () {
                callAjax($(uid_frm).attr('action'), formSerialize(uid_frm));
            }
        });

        $(password_frm).validate({
            rules: {
                uid: {
                    isEmpty: true,
                },
                name_kr: {
                    isEmpty: true,
                },
                email: {
                    isEmpty: true,
                    email: true,
                },
            },
            messages: {
                uid: {
                    isEmpty: '아이디를 입력해주세요.',
                },
                name_kr: {
                    isEmpty: '이름을 입력해주세요.',
                },
                email: {
                    isEmpty: '의사 면허번호를 입력해주세요.',
                    email: '올바른 이메일 형식이 아닙니다.',
                },
            },
            submitHandler: function () {
                callAjax($(password_frm).attr('action'), formSerialize(password_frm));
            }
        });
    </script>
@endsection
