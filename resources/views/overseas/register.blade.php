@extends('layouts.web-layout')

@section('addStyle')
@endsection

@section('contents')

    <article class="sub-contents">
        <div class="sub-conbox inner-layer">
            <div class="sub-tit-wrap">
                <h3 class="sub-tit">해외학회 참가지원 신청</h3>
            </div>
            <div class="sub-contit-wrap">
                <h4 class="sub-contit">기본정보</h4>
            </div>
            <div class="write-form-wrap">
                @include('overseas.form.reg')
            </div>
        </div>
    </article>
@endsection

@section('addScript')
    <script>
        const form = '#register-frm';
        const dataUrl = '{{ route('overseas.data') }}';

        $(document).on('click', 'input:checkbox[name="top[]"]', function() {
            if($(this).is(':checked')) {
                $('.top_class').show();
                $('.top_class').attr('disabled', false);
            }else {
                $('.top_class').hide();
                $('.top_class').attr('disabled', 'disabled');
                $('.top_class').val('');
            }
        });

        $(document).on('click', '#register_cancel', function() {
            actionConfirmAlert('페이지를 나가시겠습니까?\n 입력 중이던 내용은 사라집니다.', {
                'location': {
                    'case': 'replace',
                    'url': '{{route('overseas.list')}}',
                }
            });
        });

        defaultVaildation();

        $(form).validate({
            rules: {
                // 'qualification[]': {
                //     checkEmpty: true,
                // },
                // 'top[]': {
                //     checkEmpty: true,
                // },
                title: {
                    isEmpty: true,
                },
                author: {
                    isEmpty: true,
                },
                submission_date: {
                    isEmpty: true,
                },
                "qualification[]": {
                    checkEmpty: true,
                },
                first: {
                    isEmpty: true,
                },
                second: {
                    isEmpty: true,
                },
                third: {
                    isEmpty: true,
                },
                'registration_status[]': {
                    checkEmpty: true,
                },
                participant: {
                    isEmpty: true,
                },
                common_author: {
                    isEmpty: true,
                },
                mail_date: {
                    isEmpty: true,
                },
                mail_title: {
                    isEmpty: true,
                },
                mail_from: {
                    isEmpty: true,
                },
                mail_to: {
                    isEmpty: true,
                },
                mail_content: {
                    isEmpty: true,
                },
                abs_title: {
                    isEmpty: true,
                },
                presenter: {
                    isEmpty: true,
                },
                bank_name: {
                    isEmpty: true,
                },
                account_num: {
                    isEmpty: true,
                },
                account_name: {
                    isEmpty: true,
                },

            },
            messages: {
                title: {
                    isEmpty: '논문제목을 입력해주세요.',
                },
                author: {
                    isEmpty: '저자정보를 선택해주세요.',
                },
                submission_date: {
                    isEmpty: '투고일자를 입력해주세요.',
                },
                "qualification[]": {
                    checkEmpty: '신청자격을 체크해주세요.',
                },
                first: {
                    isEmpty: '1순위를 선택해주세요.',
                },
                second: {
                    isEmpty: '2순위를 선택해주세요.',
                },
                third: {
                    isEmpty: '3순위를 선택해주세요.',
                },
                'registration_status[]': {
                    checkEmpty: '최근 3년간 대한부정맥학회 정기학술대회(KHRS) 등록여부를 체크해주세요.',
                },
                participant: {
                    isEmpty: '참가자격을 선택해주세요.',
                },
                common_author: {
                    isEmpty: '공동 저자 여부를 선택해주세요.',
                },
                mail_date: {
                    isEmpty: '메일 수신 날짜를 입력해주세요.',
                },
                mail_title: {
                    isEmpty: '메일 제목을 입력해주세요.',
                },
                mail_from: {
                    isEmpty: '발신인을 입력해주세요.',
                },
                mail_to: {
                    isEmpty: '수신인을 입력해주세요.',
                },
                mail_content: {
                    isEmpty: '수신한 메일 본문을 입력해주세요.',
                },
                abs_title: {
                    isEmpty: '초록제목을 입력해주세요.',
                },
                presenter: {
                    isEmpty: '발표자를 입력해주세요.',
                },
                bank_name: {
                    isEmpty: '은행명을 입력해주세요.',
                },
                account_num: {
                    isEmpty: '계좌번호를 입력해주세요.',
                },
                account_name: {
                    isEmpty: '예금주를 입력해주세요.',
                },

            },
            submitHandler: function () {
                registerSubmit();
            }
        });

        const registerSubmit = () => {
            let ajaxData = newFormData(form);
            // if($("input[name='mypage']").val()=='Y'){
            //     ajaxData.case = 'overseas-mypage-update';
            // }
            callMultiAjax(dataUrl, ajaxData);
        }
    </script>
@endsection