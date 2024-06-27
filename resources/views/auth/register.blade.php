@extends('layouts.web-layout')

@section('addStyle')
    <link type="text/css" rel="stylesheet" href="{{ asset('plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}"/>
@endsection

@section('contents')
    <div class="contents">
        <article class="sub-contents">
            <form action="{{ $step != 'step3' ? route('register', ['step' => $nextStep]) : '' }}" method="post" id="register-frm" enctype="multipart/form-data">
                @csrf
                @include("auth.form.{$step}")
            </form>
        </article>
    </div>
@endsection

@section('addScript')
    <script src="{{ asset('plugins/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="//t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>
    <script>
        const form = '#register-frm';
        const dataUrl = '{{ route('auth.data') }}';
        const userConfig = @json($userConfig);

        @if($step == 'step1')
            $(document).on('submit', form, function() {
                if(!$('#agree').is(':checked')) {
                    alert('개인정보취급방침 및 이용약관에 동의해주세요');
                    return false;
                }
            });
        @endif

        @if($step == 'step2')
            callDatePicker();

            $(document).on('click', '.post-code', function() {
                callPostCode($(this).data('target'));
            });

            $(document).on('keyup', 'input[name=uid]', function() {
                $(this).data('chk', 'N');
            });

            $(document).on('click', '#uid_chk', function() {
                const uid = $('input[name=uid]').val();

                let obj = {
                    'case': true,
                    'focus': 'input[name=uid]'
                };

                if(isEmpty(uid)) {
                    obj.msg = '아이디를 입력해주세요.';
                    // actionAlert(obj);
                    return;
                }

                // if(uid.length < 4 || uid.length > 20) {
                //     obj.msg = '아이디는 4 ~ 20자 이하로 입력해주세요.';
                //     actionAlert(obj);
                //     return;
                // }

                // if(uidRegex()) {
                //     obj.msg = '아이디는 영문소문자, 숫자, 언더바만 사용 가능합니다.';
                //     actionAlert(obj);
                //     return;
                // }

                callAjax(dataUrl, {
                    'case': 'uid-check',
                    'uid': uid,
                });
            });

            //소속 자동선택
            $(document).on('change', '#sosok', function() {
                const affi_sid = $('#sosok').val();

                let obj = {
                    'case': true,
                    'focus': 'input[name=sosok]'
                };

                if(isEmpty(affi_sid)) {
                    obj.msg = '소속을 선택해주세요.';
                    actionAlert(obj);
                    return;
                }

                callAjax(dataUrl, {
                    'case': 'sosok-check',
                    'affi_sid': affi_sid,
                });
            });

            $(document).on('click', 'input:checkbox[name="position[]"]', function() {
                if($(this).data('etc')) {
                    if($(this).is(':checked')) {
                        $('#position_etc').attr('disabled', false);
                    }else {
                        $('#position_etc').attr('disabled', 'disabled');
                        $('#position_etc').val('');
                    }
                }
            });

            $(document).on('click', 'input:radio[name="office"]', function() {
                if($(this).data('etc')) {
                    if($(this).is(':checked')) {
                        $('#office_etc').attr('disabled', false);
                    }else {
                        $('#office_etc').attr('disabled', 'disabled');
                        $('#office_etc').val('');
                    }
                }
            });

            $(document).on('click', 'input:radio[name="category"]', function() {
                if($(this).data('etc')) {
                    if($(this).is(':checked')) {
                        $('#category_etc').attr('disabled', false);
                    }else {
                        $('#category_etc').attr('disabled', 'disabled');
                        $('#category_etc').val('');
                    }
                }
            });

        $(document).on('click', 'input:radio[name="major"]', function() {
            var major_gubun = $("input:radio[name='major']:checked").val();

            let majorEtcArr = userConfig['major_etc'][major_gubun];
            $('#major_etc').empty();
            $('#major_etc').append( "<option value=\'\'>선택</option>" );
            for ( var key in majorEtcArr ) {
                $('#major_etc').append( "<option value=\'"+key+"\'>" + majorEtcArr[ key ] + "</option>" );
            }
        });

            $(document).on('click', 'input:checkbox[name="field[]"]', function() {
                if($(this).data('etc')) {
                    if($(this).is(':checked')) {
                        $('#field_etc').attr('disabled', false);
                    }else {
                        $('#field_etc').attr('disabled', 'disabled');
                        $('#field_etc').val('');
                    }
                }
            });

            $(document).on('click', '#register_cancel', function() {
                actionConfirmAlert('회원가입을 취소 하시겠습니까?\n취소 시, 입력된 데이터가 모두 삭제처리 됩니다. ', {
                    'location': {
                        'case': 'replace',
                        'url': '/main',
                    }
                });
            });

            $(document).on("keyup","#captcha_input", function(){
                const _captcha_input = $(this).val();
                callNoneSpinnerAjax('{{route('check_captcha')}}', {'captcha_input': _captcha_input,});
            });

            // const uidRegex = () => {
            //     const regex = /^[a-z0-9_]{4,20}$/;
            //     return !regex.test($("#uid").val());
            // }

            defaultVaildation();

            // 캡챠 체크
            $.validator.addMethod('captchaChk', function (value, element) {
                return $(element).data('chk') === 'Y';
            });

            // 아이디 중복체크
            $.validator.addMethod('uidChk', function (value, element) {
                return $(element).data('chk') === 'Y';
            });

            // 아이디 regex
            // $.validator.addMethod('uidRegex', function (value, element) {
            //     return !uidRegex();
            // });

            // 라디오버튼 기타 사항 체크시 입력 값 체크
            $.validator.addMethod('etcRadioEmpty', function (value, element) {
                const check_name = $(element).attr('name').replace('_etc', '');

                return $('input[name=' + check_name + ']:checked').hasClass('text_etc')
                    ? !isEmpty(value)
                    : true;
            });

            // 셀렉트박스 기타 선택시 입력 값 체크
            $.validator.addMethod('etcSelectEmpty', function (value, element) {
                const check_name = $(element).attr('name').replace('_etc', '');

                return ($('select[name=' + check_name + ']').val() === '9999')
                    ? !isEmpty(value)
                    : true;
            });

            // 직책(직함) 기타 선택시 입력 값 체크
            $.validator.addMethod('etcPositionEmpty', function (value, element) {
                let etcCheck = false;

                $("input[name='position[]']:checked").each(function(k, v) {
                    if($(v).data('etc')) {
                        etcCheck = true;
                        return;
                    }
                });

                return etcCheck ? !isEmpty(value) : true;
            });

            // 근무처 구분 기타 선택시 입력 값 체크
            $.validator.addMethod('etcOfficeEmpty', function (value, element) {
                let etcCheck = false;

                $("input[name='office']:checked").each(function(k, v) {
                    if($(v).data('etc')) {
                        etcCheck = true;
                        return;
                    }
                });

                return etcCheck ? !isEmpty(value) : true;
            });

            // 가입 구분 기타 선택시 입력 값 체크
            $.validator.addMethod('etcCategoryEmpty', function (value, element) {
                let etcCheck = false;

                $("input[name='category']:checked").each(function(k, v) {
                    if($(v).data('etc')) {
                        etcCheck = true;
                        return;
                    }
                });

                return etcCheck ? !isEmpty(value) : true;
            });

            // 전공 구분 기타 선택시 입력 값 체크
            $.validator.addMethod('etcMajorEmpty', function (value, element) {
                let etcCheck = false;

                $("input[name='major']:checked").each(function(k, v) {
                    if($(v).data('etc')) {
                        etcCheck = true;
                        return;
                    }
                });

                return etcCheck ? !isEmpty(value) : true;
            });

            $(form).validate({
                rules: {
                    uid: {
                        isEmpty: true,
                        minlength: 4,
                        emailRegExp :true,
                        uidChk: true,
                    },
                    @if($isAdminPage)
                    password: {
                        isEmpty: true,
                    },
                    @else
                    password: {
                        isEmpty: true,
                        minlength: 6,
                        maxlength: 12,
                        pwCheck: true,
                    },
                    @endif
                    password_confirm: {
                        isEmpty: true,
                        equalTo: "input[name=password]",
                    },
                    country: {
                        isEmpty: true,
                    },
                    first_name: {
                        isEmpty: true,
                    },
                    last_name: {
                        isEmpty: true,
                    },
                    name_kr: {
                        isEmpty: true,
                    },
                    sosok: {
                        isEmpty: true,
                    },
                    sosok_kr: {
                        isEmpty: true,
                    },
                    sosok_en: {
                        isEmpty: true,
                    },
                    depart_kr: {
                        isEmpty: true,
                    },
                    depart_en: {
                        isEmpty: true,
                    },
                    'position[]': {
                        checkEmpty: true,
                    },
                    position_etc: {
                        etcPositionEmpty: true,
                    },
                    'phone[]': {
                        isEmpty: true,
                    },
                    office_zipcode: {
                        isEmpty: true,
                    },
                    office_addr1: {
                        isEmpty: true,
                    },
                    office_addr2: {
                        isEmpty: true,
                    },
                    office: {
                        checkEmpty: true,
                    },
                    office_etc: {
                        etcOfficeEmpty: true,
                    },
                    category: {
                        checkEmpty: true,
                    },
                    category_etc: {
                        etcCategoryEmpty: true,
                    },
                    major: {
                        checkEmpty: true,
                    },
                    major_etc: {
                        isEmpty: true,
                    },
                    university: {
                        isEmpty: true,
                    },
                    university_year: {
                        isEmpty: true,
                        minlength: 4,
                    },
                    // license_number: {
                    //     isEmpty: true,
                    // },
                    // license_year: {
                    //     isEmpty: true,
                    //     minlength: 4,
                    // },
                    @if(!$isAdminPage)
                    captcha_input: {
                        isEmpty: true,
                        captchaChk: true,
                    },
                    @endif
                },
                messages: {
                    level: {
                        checkEmpty: '회원등급을 선택해주세요.',
                    },
                    level_etc: {
                        etcRadioEmpty: '회원등급(기타)을 입력해주세요.',
                    },
                    uid: {
                        isEmpty: '아이디를 입력해주세요.',
                        emailRegExp: '아이디 이메일 형식에 맞춰서 입력해주세요.',
                        uidChk: '아이디 중복체크를 해주세요.',
                    },
                    @if($isAdminPage)
                    password: {
                        isEmpty: '비밀번호를 입력해주세요.',
                    },
                    @else
                    password: {
                        isEmpty: '비밀번호를 입력해주세요.',
                        minlength: '비밀번호는 6 ~ 12자 이하로 입력해주세요.',
                        pwCheck: '패스워드는 보안수준 강화를 위해 숫자 또는 특수기호가 포함된 6 ~ 12 글자로 설정해주시기 바랍니다.'
                    },
                    @endif
                    password_confirm: {
                        isEmpty: '비밀번호를 한번더 입력해주세요.',
                        equalTo: '비밀번호가 일치하지 않습니다.',
                    },
                    country: {
                        isEmpty: '거주 국가를 선택해주세요.',
                    },
                    first_name: {
                        isEmpty: '이름 (영문 - 이름)을 입력해주세요.',
                    },
                    last_name: {
                        isEmpty: '이름 (영문 - 성)을 입력해주세요.',
                    },
                    name_kr: {
                        isEmpty: '이름 (국문)을 입력해주세요.',
                    },
                    sosok: {
                        isEmpty: '소속을 선택해주세요.',
                    },
                    sosok_kr: {
                        isEmpty: '소속 (국문)을 입력해주세요.',
                    },
                    sosok_en: {
                        isEmpty: '소속 (영문)을 입력해주세요.',
                    },
                    depart_kr: {
                        isEmpty: '부서 (국문)을 입력해주세요.',
                    },
                    depart_en: {
                        isEmpty: '부서 (영문)을 입력해주세요.',
                    },
                    'position[]': {
                        checkEmpty: '직책(직함)을 선택해주세요.',
                    },
                    position_etc: {
                        etcPositionEmpty: '직책(직함)을 입력해주세요.',
                    },

                    'phone[]': {
                        isEmpty: '휴대폰번호를 입력해주세요.',
                    },
                    office_zipcode: {
                        isEmpty: '근무지 주소를 검색해주세요.',
                    },
                    office_addr1: {
                        isEmpty: '근무지 주소를 검색해주세요.',
                    },
                    office_addr2: {
                        isEmpty: '근무지 상세주소를 입력해주세요.',
                    },

                    office: {
                        checkEmpty: '근무처 구분을 선택해주세요.',
                    },
                    office_etc: {
                        etcOfficeEmpty: '근무처 구분을 입력해주세요.',
                    },
                    category: {
                        checkEmpty: '가입 구분을 선택해주세요.',
                    },
                    category_etc: {
                        etcCategoryEmpty: '가입 구분을 입력해주세요.',
                    },
                    major: {
                        checkEmpty: '전공 구분을 선택해주세요.',
                    },
                    major_etc: {
                        isEmpty: '세부전공 구분을 선택해주세요.',
                    },


                    university: {
                        isEmpty: '출신 대학을 입력해주세요.',
                    },
                    university_year: {
                        isEmpty: '출신 대학 졸업연도를 입력해주세요.',
                        minlength: '년도는 4자리로 입력해주세요.',
                    },
                    @if(!$isAdminPage)
                    captcha_input: {
                        isEmpty: '자동화 프로그램 입력 방지 코드를 입력 해주세요.',
                        captchaChk: '자동화 프로그램 입력 방지 코드를 확인 해주세요.',
                    },
                    @endif


                },
                submitHandler: function () {
                    return true;
                }
            });

        @endif
    </script>
@endsection
