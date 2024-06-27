@extends('layouts.web-layout')

@section('addStyle')
@endsection

@section('contents')
    <article class="sub-contents">
        <div class="sub-conbox inner-layer">
            <div class="sub-contit-wrap mt-0">
                <h4 class="sub-contit">결과보고서 및 서류 제출</h4>
            </div>
            <div class="write-form-wrap">
                @include('mypage.conference.form.report_form')
            </div>
        </div>
    </article>
@endsection

@section('addScript')
    <script src="{{ asset('plugins/jquery-validation/jquery.validate.min.js') }}"></script>
    <script>
        const form = '#register-frm';
        const dataUrl = '{{ route('mypage.data') }}';

        function cancle(){
            if(confirm('결과보고 페이지를 나가시겠습니까? 저장하지 않은 내용은 모두 사라집니다.')){
                location.href='{{route('mypage.overseas')}}';
            }else{
                return false;
            }
        }

        $(document).on('keyup', $("input[priceFormat]"), function() {
            let price = 0;
            console.log('price '+price);

            $("input[priceFormat]").each(function(index, item) {
                const pay = $(item).val();
                console.log('pay '+pay);

                if (!isEmpty(pay) && pay != 0) {
                    price += parseInt(uncomma(pay));
                }
            })

            console.log('price '+price);

            $('#tot_pay').val(comma(price));
        });

        defaultVaildation();

        $(form).validate({
            rules: {
                fileName1: {
                    isEmpty: true,
                },
                fileName2: {
                    isEmpty: true,
                },
                fileName3: {
                    isEmpty: true,
                },
                fileName4: {
                    isEmpty: true,
                },
                fileName5: {
                    isEmpty: true,
                },
                pay1: {
                    isEmpty: true,
                },
                fileName6: {
                    isEmpty: true,
                },
                pay2: {
                    isEmpty: true,
                },
                fileName7: {
                    isEmpty: true,
                },
                pay3: {
                    isEmpty: true,
                },
                fileName8: {
                    isEmpty: true,
                },
                pay4: {
                    isEmpty: true,
                },
                fileName9: {
                    isEmpty: true,
                },
                pay5: {
                    isEmpty: true,
                },
                fileName10: {
                    isEmpty: true,
                },
            },
            messages: {
                fileName1: {
                    isEmpty: '참가결과 보고서를 업로드 해주세요.',
                },
                fileName2: {
                    isEmpty: '초록채택메일 또는 초청장을 업로드 해주세요.',
                },
                fileName3: {
                    isEmpty: '상세지출내역서를 업로드 해주세요.',
                },
                fileName4: {
                    isEmpty: '영수증을 업로드 해주세요.',
                },
                fileName5: {
                    isEmpty: '사유서를 업로드 해주세요.',
                },
                pay1: {
                    isEmpty: '등록비를 입력해주세요.',
                },
                fileName6: {
                    isEmpty: '등록비 pdf파일을 업로드 해주세요.',
                },
                pay2: {
                    isEmpty: '항공료를 입력해주세요.',
                },
                fileName7: {
                    isEmpty: '항공료 pdf파일을 업로드 해주세요.',
                },
                pay3: {
                    isEmpty: '숙박비를 입력해주세요.',
                },
                fileName8: {
                    isEmpty: '숙박비 pdf파일을 업로드 해주세요.',
                },
                pay4: {
                    isEmpty: '식비를 입력해주세요.',
                },
                fileName9: {
                    isEmpty: '식비 pdf파일을 업로드 해주세요.',
                },
                pay5: {
                    isEmpty: '기타 교통비를 입력해주세요.',
                },
                fileName10: {
                    isEmpty: '기타 교통비 pdf파일을 업로드 해주세요.',
                },
            },
            submitHandler: function () {
                registerSubmit();
            }
        });

        const registerSubmit = () => {
            let ajaxData = newFormData(form);
            // ajaxData.case = 'overseas-mypage-update';
            callMultiAjax(dataUrl, ajaxData);
        }

        const tempSubmit = () => {
            if(confirm('임시 저장 하시겠습니까?')){
                let ajaxData = newFormData(form);
                ajaxData.append('temp','Y');
                callMultiAjax(dataUrl, ajaxData);
            }else{
                return false;
            }
        }
    </script>
@endsection