@extends('layouts.web-layout')

@section('addStyle')
@endsection

@section('contents')
    <article class="sub-contents">
        <div class="sub-conbox inner-layer">
            <div class="find-form-wrap">
                <form action="{{ route('mypage.data') }}" id="withdrawal_check-frm" method="post" onsubmit="return false;" data-case="user-withdrawal-check" data-sid="{{thisUser()->sid}}">
                    <fieldset>
                        <div class="find-form mypage-form resign-form">
                            <div class="bg-box bg-gray bg-img-box">
                                <img src="/assets/image/sub/ic_mypage08.png" alt="">
                                <div class="text-wrap">
                                    <strong class="tit">탈퇴 신청 전 아래 사항을 반드시 확인해 주세요. </strong>
                                    <p>
                                        회원탈퇴 시 대한부정맥학회 모든 정보가 삭제되며, 이후 복구가 불가능 합니다. <br>
                                        본인이 직접 신청하셔야 하며, 회원 DB에 있는 정보와 일치하여야만 탈퇴가 가능합니다.
                                    </p>
                                </div>
                            </div>
                            <div class="write-wrap">
                                <dl>
                                    <dt>아이디</dt>
                                    <dd>
                                        {{ thisUser()->uid }}
                                    </dd>
                                </dl>
                                <dl>
                                    <dt>이름</dt>
                                    <dd>
                                        <input type="text" name="name_kr" id="name_kr" class="form-item" value="">
                                    </dd>
                                </dl>
                                <dl>
                                    <dt>비밀번호</dt>
                                    <dd>
                                        <input type="password" name="password" id="password" class="form-item" value="">
                                    </dd>
                                </dl>
                            </div>
                            <div class="btn-wrap text-center">
                                <button type="submit" class="btn btn-type1 color-type10">회원탈퇴 신청</button>
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </article>
{{--    <form action="{{ route('mypage.data') }}" id="withdrawal-frm" method="post" data-case="user-withdrawal">--}}
{{--        @csrf--}}
{{--        <input type="hidden" name="sid" id="sid" class="form-item" value="{{thisUser()->sid}}">--}}
{{--    </form>--}}
@endsection

@section('addScript')
    <script src="{{ asset('plugins/jquery-validation/jquery.validate.min.js') }}"></script>
    <script>
        const form1 = '#withdrawal_check-frm';
        const dataUrl = '{{route('mypage.data')}}';

        defaultVaildation();

        $(form1).validate({
            rules: {
                name_kr: {
                    isEmpty: true,
                },
                password: {
                    isEmpty: true,
                },
            },
            messages: {
                name_kr: {
                    isEmpty: '이름을 입력해주세요.',
                },
                password: {
                    isEmpty: '비밀번호를 입력해주세요.',
                },
            },
            submitHandler: function () {
                let ajaxData = formSerialize(form1);

                callbackAjax(dataUrl, ajaxData, function(data, error) {
                    if (data) {
                        if (data.res == 'noneUser') {
                            alert('해당 이름을 가진 회원이 존재하지 않습니다.');
                            return false;
                        }

                        if (data.res == 'nonePassword') {
                            alert('비밀번호가 일치하지 않습니다.');
                            return false;
                        }

                        ajaxData.case = 'user-withdrawal';
                        if(confirm("회원 탈퇴 시 모든 정보가 삭제되며, 이후 복구가 불가능합니다. 회원 탈퇴 신청을 하시겠습니까?")){
                            callAjax(dataUrl, ajaxData, true);
                        }else{
                            return false;
                        }

                    }

                }, true);

            }
        });

    </script>
@endsection
