<form id="register-frm" data-sid="{{ $registration->sid ?? 0 }}" data-case="registration-{{ empty($registration->sid) ? 'create' : 'update' }}" onsubmit="return false;">
    <input type="hidden" name="csid" id="csid" value="{{ $conference->sid ?? 0 }}" readonly>
    <input type="hidden" name="tab" id="tab" value="{{ $tab ?? 3 }}" readonly>
    <input type="hidden" name="tot_pay" id="tot_pay" value="{{ $registration->tot_pay ?? '' }}" readonly>
    <fieldset>
        <legend class="hide">등록</legend>
        <div class="sub-contit-wrap mt-0">
            <h4 class="sub-contit">기본정보</h4>
        </div>
        <div class="write-wrap">
            <dl>
                <dt><strong class="required">*</strong> ID (E-mail)</dt>
                <dd>
                    <input type="text" name="uid" id="uid" style="width: {{ empty($registration->sid) ? '80':'100' }}%" class="form-item uidChk" data-chk="N" value="{{ empty($registration->sid) ? ($user->uid ?? '') : ($registration->uid ?? '') }}" {{ empty($registration->sid) ? '' : 'readonly' }}>
                    @if(empty($registration->sid))
                        <a href="javascript:void(0);" class="btn btn-small color-type2" id="uid_chk">중복확인</a>
                    @endif
                </dd>
            </dl>
            <dl>
                <dt><strong class="required">*</strong> 성명 (영문)</dt>
                <dd>
                    <div class="form-group n2">
                        <input type="text" name="first_name" id="first_name" class="form-item" placeholder="First Name" value="{{ empty($registration->sid) ? ($user->first_name ?? '') : ($registration->first_name ?? '') }}" onlyEn>
                        <input type="text" name="last_name" id="last_name" class="form-item" placeholder="Last Name" value="{{ empty($registration->sid) ? ($user->last_name ?? '') : ($registration->last_name ?? '') }}" onlyEn>
                    </div>
                </dd>
            </dl>
            <dl>
                <dt><strong class="required">*</strong> 성명 (국문)</dt>
                <dd>
                    <input type="text" name="name_kr" id="name_kr" class="form-item" value="{{ empty($registration->sid) ? ($user->name_kr ?? '') : ($registration->name_kr ?? '') }}" onlyKo>
                </dd>
            </dl>
            <dl>
                <dt><strong class="required">*</strong> 소속</dt>
                <dd>
                    <select name="sosok" id="sosok" class="form-item">
                        <option value="">Affiliation Choice</option>
                        @foreach($affi as $affi_key => $affi_val)
                            <option value="{{ $affi_val->sid }}" {{ (empty($registration->sid) ? ($user->sosok ?? '') : ($registration->sosok ?? '')) == $affi_val->sid ? 'selected' : '' }}>{{ $affi_val->office_k }}</option>
                        @endforeach
                    </select>
                    <div class="from-group form-group-text mt-10">
                        <span class="text">국문 : </span>
                        <input type="text" name="sosok_kr" id="sosok_kr" class="form-item" value="{{ empty($registration->sid) ? ($user->sosok_kr ?? '') : ($registration->sosok_kr ?? '') }}" readonly onlyKo>
                    </div>
                    <div class="from-group form-group-text mt-10">
                        <span class="text">영문 : </span>
                        <input type="text" name="sosok_en" id="sosok_en" class="form-item" value="{{ empty($registration->sid) ? ($user->sosok_en ?? '') : ($registration->sosok_en ?? '') }}" readonly onlyEn>
                    </div>
                </dd>
            </dl>
            <dl>
                <dt><strong class="required">*</strong> 부서</dt>
                <dd>
                    <div class="from-group form-group-text">
                        <span class="text">국문 : </span>
                        <input type="text" name="depart_kr" id="depart_kr" class="form-item" value="{{ empty($registration->sid) ? ($user->depart_kr ?? '') : ($registration->depart_kr ?? '') }}" onlyKo>
                    </div>
                    <div class="from-group form-group-text mt-10">
                        <span class="text">영문 : </span>
                        <input type="text" name="depart_en" id="depart_en" class="form-item" value="{{ empty($registration->sid) ? ($user->depart_en ?? '') : ($registration->depart_en ?? '') }}" onlyEn>
                    </div>
                </dd>
            </dl>
            <dl>
                <dt><strong class="required">*</strong> 직책 (직함)</dt>
                <dd>
                    <div class="checkbox-wrap cst">
                        @foreach($userConfig['position'] as $position_key => $position_val)
                            <div class="checkbox-group">
                                <input type="checkbox" name="position[]" id="position_{{$position_key}}" value="{{$position_key}}" {{ $position_key == 99 ? 'data-etc=true' : '' }} {{ in_array($position_key, (empty($registration->sid) ? ($user->position ?? []) : ($registration->position ?? [])) ) ? 'checked':'' }}>
                                <label for="position_{{$position_key}}">{{$position_val}}</label>
                            </div>
                        @endforeach
                        <input type="text" name="position_etc" id="position_etc" class="form-item small" value="{{ empty($registration->sid) ? ($user->position_etc ?? '') : ($registration->position_etc ?? '') }}" {{ empty($registration->position_etc ) ? 'disabled=disabled' : '' }}>
                    </div>
                </dd>
            </dl>
            <dl>
                <dt><strong class="required">*</strong> 면허번호</dt>
                <dd>
                    <input type="text" name="license_number" id="license_number" class="form-item medium" value="{{ empty($registration->sid) ? ($user->license_number ?? '') : ($registration->license_number ?? '') }}" maxlength="10" onlyNumber>
                </dd>
            </dl>
            <dl>
                <dt><strong class="required">*</strong> 거주국가</dt>
                <dd>
                    <select name="country" id="country" class="form-item">
                        <option value="">Country Choice</option>
                        @foreach($country as $country_key => $country_val)
                            <option value="{{ $country_val->ci }}" {{ (empty($registration->sid) ? ($user->country ?? '') : ($registration->country ?? '')) == $country_val->ci ? 'selected' : '' }}>{{ $country_val->cn }}</option>
                        @endforeach
                    </select>
                </dd>
            </dl>
            <dl>
                <dt>연락처</dt>
                <dd>
                    <div class="form-group form-group-text n3">
                        <select name="tel[]" id="tel_first" class="form-item">
                            @foreach($userConfig['tel_first'] as $key => $val)
                            <option value="{{ $key }}" {{ (empty($registration->sid) ? ($user->tel[0] ?? '') : ($registration->tel[0] ?? '')) == $key ? 'selected': '' }} >
                                {{ $val }}</option>
                            @endforeach
                        </select>
                        <span class="text">-</span>
                        <input type="text" name="tel[]" id="" class="form-item" value="{{ (empty($registration->sid) ? ($user->tel[1] ?? '') : ($registration->tel[1] ?? '')) }}" onlyNumber>
                        <span class="text">-</span>
                        <input type="text" name="tel[]" id="" class="form-item" value="{{ (empty($registration->sid) ? ($user->tel[2] ?? '') : ($registration->tel[2] ?? '')) }}" onlyNumber>
                    </div>
                </dd>
            </dl>
            <dl>
                <dt><strong class="required">*</strong> 휴대폰번호</dt>
                <dd>
                    <div class="form-group form-group-text n3">
                        <select name="phone[]" id="phone_first" class="form-item">
                            @foreach($userConfig['phone_first'] as $key => $val)
                                <option value="{{ $key }}" {{ (empty($registration->sid) ? ($user->phone[0] ?? '') : ($registration->phone[0] ?? '')) == $key ? 'selected': '' }} >
                                    {{ $val }}</option>
                            @endforeach
                        </select>
                        <span class="text">-</span>
                        <input type="text" name="phone[]" id="" class="form-item" value="{{ (empty($registration->sid) ? ($user->phone[1] ?? '') : ($registration->phone[1] ?? '')) }}" onlyNumber>
                        <span class="text">-</span>
                        <input type="text" name="phone[]" id="" class="form-item" value="{{ (empty($registration->sid) ? ($user->phone[2] ?? '') : ($registration->phone[2] ?? '')) }}" onlyNumber>
                    </div>
                </dd>
            </dl>
        </div>

        <div class="sub-contit-wrap">
            <h4 class="sub-contit">결제정보</h4>
        </div>
        <div class="write-wrap">
            <dl>
                <dt><strong class="required">*</strong> 구분</dt>
                <dd>
                    <div class="radio-wrap cst">
                        @foreach($conference->res_fee as $key => $val)
                            <div class="radio-group">
                                <input type="radio" name="gubun" id="gubun{{$key}}" value="{{ $val['gubun'] }}" data-money="{{ $val['early'] }}" {{ ($registration->gubun ?? '') == $val['gubun'] ? 'checked': '' }}>
                                <label for="gubun{{$key}}">{{ $val['gubun'] }}</label>
                            </div>
                        @endforeach
                    </div>
                </dd>
            </dl>
            <dl>
                <dt><strong class="required">*</strong> 결제 수단</dt>
                <dd>
                    <div class="radio-wrap cst">
                        @foreach($conferenceConfig['method'] as $key => $val)
                            <div class="radio-group">
                                <input type="radio" name="method" id="method{{$key}}" value="{{ $key }}" {{ ($registration->method ?? '') == $key ? 'checked': '' }}>
                                <label for="method{{$key}}">{{$val}}</label>
                            </div>
                        @endforeach
                    </div>
                </dd>
            </dl>
            <dl>
                <dt><strong class="required">*</strong> 송금인</dt>
                <dd>
                    <input type="text" name="sender" id="sender" class="form-item" value="{{ $registration->sender ?? '' }}">
                </dd>
            </dl>
            <dl>
                <dt><strong class="required">*</strong> 송금예정일</dt>
                <dd>
                    <input type="text" name="sender_date" id="sender_date" class="form-item datepicker" value="{{ ($registration->sender_date ?? '') ? $registration->sender_date->format('Y-m-d') : '' }}" readonly>
                </dd>
            </dl>
        </div>
        <div class="write-wrap">
            <dl>
                <dt>총 등록비</dt>
                <dd id="tot_pay_html">
                    {{ empty($registration->sid) ? '0' : number_format($registration->tot_pay) }} 원
                </dd>
            </dl>
        </div>

        <div class="sub-contit-wrap">
            <h4 class="sub-contit">개인정보 수집 및 활용 동의</h4>
        </div>
        <div class="term-wrap">
            <div class="term-conbox scroll-y view-contents">
                <ol class="list-type list-type-decimal">
                    <li>수집 및 활용처 : 대한부정맥학회</li>
                    <li>이용목적 : 학술행사 사전등록에 관한 사전·사후관리, 공지사항 전달, Q&A 등 커뮤니케이션 및 기타 업무처리에 필요한 동의·철회 등 의사확인, 업무위탁, 법령 등에서 정하는 바에 따른 자료제공, 기타 업무처리</li>
                    <li>이용항목 : 성명, 소속, 연수평점, 의사면허번호, 연락처, 이메일 등 </li>
                    <li>보유 및 이용기간 : 학술행사 사전등록일시부터 본 학회 폐업시까지. 단, 학회가 새로운 조직을 개설 또는 변경 후 개인정보의 파기를 하지 않고 개설자가 보유 이용할 수 있고, 개설자가 개설 또는 변경한 조직으로 개인정보를 이관하여 이용할 수 있습니다.</li>
                    <li>학회는 개인정보를 포함한 학회 내 데이터베이스의 변환 및 복구, 회원관리업무 등 일부 업무를 위탁할 수 있으며, 위탁한 업무의 수행을 위하여 필요한 최소한의 개인정보를 해당 업체나 기관에 제공할 수 있습니다.</li>
                    <li>본 수집 및 활용동의에 미동의하실 경우 사전 등록을 하실 수 없습니다.</li>
                </ol>
            </div>
            <div class="checkbox-wrap cst">
                <div class="checkbox-group">
                    <input type="checkbox" name="agree" id="agree" value="Y" {{ ($registration->agree ?? '') == 'Y' ? 'checked': '' }}><label for="agree"> 본인은 개인정보 수집 및 활용에 동의합니다.</label>
                </div>
            </div>
        </div>

        <div class="btn-wrap text-center">
            @if(checkUrl() == 'admin')
                <a href="javascript:window.close();" class="btn btn-type1 color-type4">취소</a>
                <button type="submit" class="btn btn-type1 color-type5">수정</button>
            @else
                <a href="{{ route('conference.detail',['sid'=>$conference->sid]) }}" class="btn btn-type1 color-type4">취소</a>
                @if(!empty($registration->sid))
                    <button type="submit" class="btn btn-type1 color-type5">수정하기</button>
                @else
                    <button type="submit" class="btn btn-type1 color-type5">등록 완료</button>
                @endif
            @endif
        </div>
    </fieldset>
</form>

@section('reg-script')
    <script>
        $(document).on('click', '#uid_chk', function() {
            let obj = {
                'case': true,
                'focus': 'input[name=uid]'
            };

            if(isEmpty(uid)) {
                obj.msg = '아이디를 입력해주세요.';
                return;
            }

            callAjax(dataUrl, {
                'case': 'uid-check',
                'uid': $('input[name=uid]').val(),
                'tab': $('input[name=tab]').val(),
                'csid': $('input[name=csid]').val(),
            });
        });

        $(document).on('click', 'input:checkbox[name="position[]"]', function() {
            if($(this).val() == '99') {
                if($(this).is(':checked')) {
                    $('#position_etc').attr('disabled', false);
                }else {
                    $('#position_etc').attr('disabled', 'disabled');
                    $('#position_etc').val('');
                }
            }
        });

        $(document).on('click', $("input[name='gubun']"), function() {
            let tot_pay = 0;
            $("input[name='gubun']:checked").each(function(index, item) {
                const money = uncomma($(item).data('money'));
                tot_pay += parseInt(money);
            })
            $('#tot_pay').val(tot_pay);
            $('#tot_pay_html').html(comma(tot_pay)+' 원');
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


        {{--// 게시글 작성 취소--}}
        {{--$(document).on('click', '#board_cancel', function(e) {--}}
        {{--    e.preventDefault();--}}

        {{--    const msg = ($(form).data('sid') == 0) ?--}}
        {{--        '등록을 취소하시겠습니까?' :--}}
        {{--        '수정을 취소하시겠습니까?';--}}

        {{--    if (confirm(msg)) {--}}
        {{--        location.replace('{{ route('board', ['code' => $code]) }}');--}}
        {{--    }--}}
        {{--});--}}

        // 아이디 중복체크
        $.validator.addMethod('uidChk', function (value, element) {
            return $(element).data('chk') === 'Y';
        });

        defaultVaildation();

        // 게시판 폼 체크
        $(form).validate({
            ignore: ['content', 'popup_content'],
            rules: {
                @if(CheckUrl() === 'admin')
                uid: {
                    isEmpty: true,
                },
                @else
                uid: {
                    isEmpty: true,
                    minlength: 4,
                    emailRegExp :true,
                    uidChk: {
                        depends: function(element) {
                            return $("#register-frm").data('case')==='registration-create';
                        }
                    }
                },
                @endif
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

                license_number: {
                    isEmpty: true,
                },
                country: {
                    isEmpty: true,
                },
                'phone[]': {
                    isEmpty: true,
                },
                gubun: {
                    checkEmpty: true,
                },
                method: {
                    checkEmpty: true,
                },
                sender: {
                    isEmpty: {
                        depends: function(element) {
                            return $("input[name='method']:checked").val()==='B';
                        }
                    }
                },
                sender_date: {
                    isEmpty: {
                        depends: function(element) {
                            return $("input[name='method']:checked").val()==='B';
                        }
                    }
                },
                agree: {
                    isEmpty: true,
                },
            },
            messages: {
                @if(CheckUrl() === 'admin')
                uid: {
                    isEmpty: '아이디를 입력해주세요.',
                },
                @else
                uid: {
                    isEmpty: '아이디를 입력해주세요.',
                    emailRegExp: '아이디 이메일 형식에 맞춰서 입력해주세요.',
                    uidChk: '아이디를 중복확인 해주세요.',
                },
                @endif
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

                license_number: {
                    isEmpty: '면허번호를 입력해주세요.',
                },
                country: {
                    isEmpty: '거주 국가를 선택해주세요.',
                },
                'phone[]': {
                    isEmpty: '휴대폰번호를 입력해주세요.',
                },
                gubun: {
                    checkEmpty: '구분을 선택해주세요.',
                },
                method: {
                    checkEmpty: '결제 수단을 선택해주세요.',
                },
                sender: {
                    isEmpty: '송금인을 입력해주세요.',
                },
                sender_date: {
                    isEmpty: '송금예정일을 입력해주세요.',
                },
                agree: {
                    isEmpty: '개인정보 수집 및 활용 동의를 체크해주세요.',
                },
            },
            submitHandler: function() {

                // if ($('input[name=method]:checked').val() == 'C') {
                // callPayModuel({
                //     'type': 'PC' // 필수
                // });
                // return false;
                // }

                registerSubmit();
            }
        });

        const registerSubmit = () => {
            let ajaxData = newFormData($(form));
            // ajaxData.append('invite_text', tinymce.get('invite_text').getContent());
            // ajaxData.append('plupload_file', JSON.stringify(plupladFile));

            callMultiAjax(dataUrl, ajaxData);
        }
    </script>
@endsection