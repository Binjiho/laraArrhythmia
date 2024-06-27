@extends('admin.layouts.pop-layout')

@section('addStyle')
@endsection

@section('contents')
    @include('overseas.form.reg')
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

        defaultVaildation();

        $(form).validate({
            rules: {
                title: {
                    isEmpty: true,
                },
                author: {
                    isEmpty: true,
                },
                submission_date: {
                    isEmpty: true,
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
                // 'registration_status[]': {
                //     checkEmpty: true,
                // },
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
                first: {
                    isEmpty: '1순위를 선택해주세요.',
                },
                second: {
                    isEmpty: '2순위를 선택해주세요.',
                },
                third: {
                    isEmpty: '3순위를 선택해주세요.',
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
