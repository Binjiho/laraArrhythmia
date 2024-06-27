@extends('layouts.web-layout')

@section('addStyle')
@endsection

@section('contents')
    <article class="sub-contents">
        <div class="sub-conbox inner-layer">
            <div class="find-form-wrap">
                <form action="{{ route('mypage.data')}}" method="post" id="register-frm" enctype="multipart/form-data" data-case="check_confirm" onsubmit="return false;">
                    <input type="hidden" name="uid" id="uid" value="{{$user->uid}}">
                    <fieldset>
                        <legend class="hide">비밀번호 변경</legend>
                        <div class="find-form mypage-form">
                            <h3 class="find-tit">
                                <img src="/assets/image/sub/ic_mypage02.png" alt="">
                                비밀번호 변경
                            </h3>
                            <div class="bg-box bg-gray">
                                본인확인을 위해 비밀번호를 한 번 더 입력해 주세요.<br>
                                비밀번호는 타인에게 노출되지 않도록 주의해 주세요.
                            </div>
                            <div class="write-wrap">
                                <dl>
                                    <dt>아이디</dt>
                                    <dd>
                                        {{$user->uid}}
                                    </dd>
                                </dl>
                                <dl>
                                    <dt>비밀번호</dt>
                                    <dd>
                                        <input type="password" name="password" id="password" class="form-item" maxlength="12">
                                    </dd>
                                </dl>
                            </div>
                            <div class="btn-wrap text-center">
                                <a href="{{route('mypage.intro')}}" class="btn btn-type1 color-type4">취소</a>
                                <button type="submit" class="btn btn-type1 color-type6">확인</button>
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
        const form = '#register-frm';
        const dataUrl = '{{ route('mypage.data') }}';

        defaultVaildation();

        $(form).validate({
            rules: {
                password: {
                    isEmpty: true,
                },
            },
            messages: {
                password: {
                    isEmpty: '비밀번호를 입력해주세요.',
                },
            },
            submitHandler: function () {
                callAjax($(form).attr('action'), { case: 'check_confirm', toRoute:'mypage.changePw', uid: $("input[name='uid']").val(), password: $("input[name='password']").val()}, true);
                // callMultiAjax($(form).attr('action'), getformData());
                // callAjax(dataUrl, { case: _case, sid: $(this).closest('li').data('sid') });
                // return true;
            }
        });
    </script>
@endsection