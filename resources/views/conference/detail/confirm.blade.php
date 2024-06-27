@extends($extends_str)

@section('addStyle')

@endsection

@section('contents')
    <article class="sub-contents">
        <div class="sub-conbox inner-layer">
            <div class="sub-tit-wrap">
                <h3 class="sub-tit">국내외 학술행사</h3>
            </div>

            @include('conference.include.tabArea')

            <div class="confirm-form-wrap">
                <form id="confirm-frm" action="{{ route('conference.data') }}" method="post" data-case="confirm-check">
                    <input type="hidden" name="tab" value="{{ $tab }}" readonly>
                    <input type="hidden" name="csid" value="{{ $conference->sid ?? 0 }}" readonly>
                    <fieldset>
                        <legend class="hide">등록 확인</legend>
                        <div class="confirm-form">
                            <div class="confirm-contop">
                                <img src="/assets/image/sub/ic_confirm.png" alt="">
                                <p>사전등록 정보를 입력해주세요.</p>
                            </div>
                            <div class="write-wrap">
                                <dl>
                                    <dt>성명</dt>
                                    <dd>
                                        <input type="text" name="name_kr" id="name_kr" class="form-item">
                                    </dd>
                                </dl>
                                <dl>
                                    <dt>E-mail</dt>
                                    <dd>
                                        <input type="text" name="uid" id="uid" class="form-item">
                                    </dd>
                                </dl>
                            </div>
                            <div class="btn-wrap text-center">
{{--                                <a href="javascript:;" onclick="checkconfirm();" class="btn btn-type1 color-type15">사전등록 조회</a>--}}
                                <button type="submit" class="btn btn-type1 color-type15">사전등록 조회</button>
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
        const form = '#confirm-frm';
        const dataUrl = '{{ route('conference.data') }}';

            defaultVaildation();

            console.log($(form));

            // 게시판 폼 체크
            $(form).validate({
                ignore: ['content', 'popup_content'],
                rules: {
                    name_kr: {
                        isEmpty: true,
                    },
                    uid:{
                        isEmpty: true,
                    }
                },
                messages: {
                    name_kr: {
                        isEmpty: '성명을 입력해주세요.',
                    },
                    uid:{
                        isEmpty: 'E-mail을 입력해주세요.',
                    }
                },
                submitHandler: function() {
                    registerSubmit();
                }
            });


        const registerSubmit = () => {
            let ajaxData = newFormData($(form));
            callMultiAjax(dataUrl, ajaxData);
        }
    </script>
@endsection
