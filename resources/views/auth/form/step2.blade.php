@php
    $isAdminPage = (CheckUrl() === 'admin');
    $country = getCountry();
    $affi = getAffi();
@endphp

<div class="sub-conbox inner-layer">

    @if(!session()->has('modify') && !$isAdminPage)
    <input type="hidden" name="sid" value="{{ $user->sid ?? 0 }}">
    <input type="hidden" name="case" value="{{ empty($user->sid) ? 'user_create' : 'user_update' }}">
    <div class="regi-term-wrap">
        <fieldset>
            <legend class="hide">회원가입</legend>
        </fieldset>
    </div>
    <div class="step-list-wrap">
        <ul class="step-list">
            <li class="on">
                <span class="icon"></span>
                <strong>01. 약관 동의</strong>
            </li>
            <li class="on">
                <span class="icon"></span>
                <strong>02. 정보 입력</strong>
            </li>
            <li>
                <span class="icon"></span>
                <strong>03. 가입 완료</strong>
            </li>
        </ul>
    </div>
    @endif

    @if( $isAdminPage )
        @if( !empty($search_display) )
            @if( $search_display == 'Y' )
            <div class="write-form-wrap">
                <fieldset>
                    <div class="write-wrap">
                        <dl>
                            <dt>부정맥 전문가 찾기 노출여부</dt>
                            <dd>
                                <div class="radio-group">
                                    <input type="radio" name="search_yn" id="search_yn_Y" value="Y" {{ ($user->search_yn ?? '') == 'Y' ? 'checked' : '' }}>
                                    <label for="search_yn_Y">노출</label>
                                </div>
                                <div class="radio-group">
                                    <input type="radio" name="search_yn" id="search_yn_N" value="N" {{ ($user->search_yn ?? '') == 'N' ? 'checked' : '' }}>
                                    <label for="search_yn_N">비노출</label>
                                </div>
                            </dd>
                        </dl>
                    </div>
                </fieldset>
            </div>
          @endif
       @endif
    @endif

    <div class="sub-contit-wrap">
        <h4 class="sub-contit">
            회원가입정보
            <span class="fz-small text-red">*표시된 부분은 반드시 기입해주시기 바랍니다.</span>
        </h4>
    </div>
    <div class="write-form-wrap">
        <fieldset>
            <legend class="hide">회원가입</legend>
            <div class="write-wrap">
                <dl>
                    <dt><strong class="required">*</strong> ID (E-mail Address)</dt>
                    <dd>
                        <div class="form-group has-btn">
                            @if(empty($user->uid))
                                <input type="text" class="form-item uidChk" name="uid" id="uid" maxlength="50" data-chk="N">
                                <a href="javascript:void(0);" class="btn btn-small color-type2" id="uid_chk">중복확인</a>
                            @else
                                <span>{{ $user->uid }}</span>
                            @endif
                        </div>
                    </dd>
                </dl>
                @if($isAdminPage)
{{--                    <tr>--}}
{{--                        <th><label class="essen" title="필수">비밀번호</label></th>--}}
{{--                        <td colspan="3">--}}
{{--                            <input type="password" name="password" id="password" maxlength="20" disabled="disabled">--}}
{{--                            <input type="checkbox" name="adminPassword" id="adminPassword" value="Y" style="margin-left: 7px;">--}}
{{--                            <label for="adminPassword">비밀번호 변경시 체크해주세요.</label>--}}
{{--                        </td>--}}
{{--                    </tr>--}}
                    <dl>
                        <dt><strong class="required">*</strong> 비밀번호</dt>
                        <dd>
                            <div class="form-group has-btn">
                                <input type="password" name="password" id="password" maxlength="20" disabled="disabled">
                                <input type="checkbox" name="adminPassword" id="adminPassword" value="Y" style="margin-left: 7px;">
                                <label for="adminPassword">비밀번호 변경시 체크해주세요.</label>
                            </div>
                        </dd>
                    </dl>
                @else
                    @empty($user->password)
                        <dl>
                            <dt><strong class="required">*</strong> 비밀번호</dt>
                            <dd>
                                <input type="password" name="password" id="password" class="form-item" maxlength="12">
                            </dd>
                        </dl>
                        <dl>
                            <dt><strong class="required">*</strong> 비밀번호 확인</dt>
                            <dd>
                                <input type="password" name="password_confirm" id="password_confirm" class="form-item" maxlength="12">
                                <div class="help-text mt-10">
                                    패스워드는 보안수준 강화를 위해 숫자 또는 특수기호가 포함된 6 ~ 12 글자로 설정해주시기 바랍니다. <br>
                                    Set your password between 6 to 12 characters using a combination of letters and 1 or more numbers.
                                </div>
                            </dd>
                        </dl>
                    @endempty
                @endif

                <dl>
                    <dt><strong class="required">*</strong> 거주 국가</dt>
                    <dd>
                        <select name="country" id="country" class="form-item">
                            <option value="">Country Choice</option>
                            @foreach($country as $country_key => $country_val)
                                <option value="{{ $country_val->ci }}" {{ ($user->country ?? '') == $country_val->ci ? 'selected' : '' }}>{{ $country_val->cn }}</option>
                            @endforeach
                        </select>
                    </dd>
                </dl>
                <dl>
                    <dt><strong class="required">*</strong> 성명 (영문)</dt>
                    <dd>
                        <div class="form-group n2">
                            <input type="text" name="first_name" id="first_name" class="form-item" placeholder="First Name" value="{{ $user->first_name ?? '' }}" onlyEn>
                            <input type="text" name="last_name" id="last_name" class="form-item" placeholder="Last Name" value="{{ $user->last_name ?? '' }}" onlyEn>
                        </div>
                    </dd>
                </dl>
                <dl>
                    <dt><strong class="required">*</strong> 성명 (국문)</dt>
                    <dd>
                        <input type="text" name="name_kr" id="name_kr" class="form-item" value="{{ $user->name_kr ?? '' }}" onlyKo>
                    </dd>
                </dl>
                <dl>
                    <dt>증명사진</dt>
                    <dd>
                        <div class="filebox">
                            <input class="upload-name form-item" name="fileName" id="fileName" value="{{ $user->image_name ?? '' }}" placeholder="파일 업로드" readonly>
                            <label for="user_image">파일 업로드</label>
                            <input type="file" id="user_image" name="user_image" class="file-upload"  accept="image/gif, image/jpeg, image/png">
                            <input type="hidden" name="file_del" id="file_del" value="" readonly>
                        </div>
                        @if ($isAdminPage && !empty($user->image_path))
                            @php
//                                if(!File::exists(public_path($user->image_path))){
//                                    $user->image_path = iconv( "UTF-8", "EUC-KR", $user->image_path );
//                                }
                            $image_name = rawurldecode( $user->image_name );
//                            $user->image_path = "/storage/uploads/user/".$image_name;
//                            $user->image_path = "/storage/uploads/user/".$image_name;
//                            $user->image_path = "/storage/uploads/user/Board_kyh.jpg";
                            @endphp
                            <div class="attach" style="margin-top: 10px;">
                                <a href="{{ $user->image_path }}" >
                                    <img src="{{ asset($user->image_path) }}" alt="증명사진" width="150" height="180">
                                </a>
                                <a href="javascript:void(0);" class="file_del"><img src="{{ asset('assets/image/icon/icon_del.png') }}" alt="삭제"></a>
                            </div>
                        @endif
                        <div class="help-text mt-10">
                            * 마이페이지, 부정맥 전문가 찾기에 노출됩니다.
                        </div>
                    </dd>
                </dl>
                <dl>
                    <dt><strong class="required">*</strong> 소속</dt>
                    <dd>
                        <select name="sosok" id="sosok" class="form-item">
                            <option value="">Affiliation Choice</option>
                            @foreach($affi as $affi_key => $affi_val)
                                <option value="{{ $affi_val->sid }}" {{ ($user->sosok ?? '') == $affi_val->sid ? 'selected' : '' }}>{{ $affi_val->office_k }}</option>
                            @endforeach
                        </select>
                        <div class="from-group form-group-text mt-10">
                            <span class="text">국문 : </span>
                            <input type="text" name="sosok_kr" id="sosok_kr" class="form-item" value="{{ $user->sosok_kr ?? '' }}" {{ ($user->sosok ?? '') != '999' ? 'readonly' : '' }}>
                        </div>
                        <div class="from-group form-group-text mt-10">
                            <span class="text">영문 : </span>
                            <input type="text" name="sosok_en" id="sosok_en" class="form-item" value="{{ $user->sosok_en ?? '' }}" {{ ($user->sosok ?? '') != '999' ? 'readonly' : '' }}>
                        </div>
                    </dd>
                </dl>

                <dl>
                    <dt>의대</dt>
                    <dd>
                        <div class="from-group form-group-text mt-10">
                            <span class="text">국문 : </span>
                            <input type="text" name="school_kr" id="school_kr" class="form-item" value="{{ $user->school_kr ?? '' }}" readonly>
                        </div>
                        <div class="from-group form-group-text mt-10">
                            <span class="text">영문 : </span>
                            <input type="text" name="school_en" id="school_en" class="form-item" value="{{ $user->school_en ?? '' }}" readonly>
                        </div>
                    </dd>
                </dl>

                <dl>
                    <dt><strong class="required">*</strong> 부서 (학과명)</dt>
                    <dd>
                        <div class="from-group form-group-text">
                            <span class="text">국문 : </span>
                            <input type="text" name="depart_kr" id="depart_kr" class="form-item" value="{{ $user->depart_kr ?? '' }}" onlyKo>
                        </div>
                        <div class="from-group form-group-text mt-10">
                            <span class="text">영문 : </span>
                            <input type="text" name="depart_en" id="depart_en" class="form-item" value="{{ $user->depart_en ?? '' }}" onlyEn>
                        </div>
                    </dd>
                </dl>
                <dl>
                    <dt><strong class="required">*</strong> 직책 (직함)</dt>
                    <dd>
                        <div class="checkbox-wrap cst">
                        @foreach($userConfig['position'] as $position_key => $position_val)
                            <div class="checkbox-group">
                                <input type="checkbox" name="position[]" id="position_{{$position_key}}" value="{{$position_key}}" {{ $position_key == 99 ? 'data-etc=true' : '' }} {{ in_array($position_key, $user->position ?? []) ? 'checked':'' }}>
                                <label for="position_{{$position_key}}">{{$position_val}}</label>
                            </div>
                        @endforeach
                            <input type="text" name="position_etc" id="position_etc" class="form-item small" value="{{ $user->position_etc ?? '' }}" {{ empty($user->position_etc ) ? 'disabled=disabled' : '' }}>
                        </div>
                    </dd>
                </dl>
                <dl>
                    <dt>연락처</dt>
                    <dd>
                        <div class="form-group form-group-text n3">
                            <select name="tel[]" id="tel_first" class="form-item">
                                @foreach($userConfig['tel_first'] as $key => $val)
                                    <option value="{{ $key }}" {{ ($user->tel[0] ?? '') == $key ? 'selected': '' }} >
                                        {{ $val }}</option>
                                @endforeach
                            </select>
                            <span class="text">-</span>
                            <input type="text" name="tel[]" id="" class="form-item" value="{{ $user->tel[1] ?? '' }}" onlyNumber>
                            <span class="text">-</span>
                            <input type="text" name="tel[]" id="" class="form-item" value="{{ $user->tel[2] ?? '' }}" onlyNumber>
                        </div>
                    </dd>
                </dl>
                <dl>
                    <dt><strong class="required">*</strong> 휴대폰번호</dt>
                    <dd>
                        <div class="form-group form-group-text n3">
                            <select name="phone[]" id="phone_first" class="form-item">
                                @foreach($userConfig['phone_first'] as $key => $val)
                                    <option value="{{ $key }}" {{ ($user->phone[0] ?? '') == $key ? 'selected': '' }} >
                                        {{ $val }}</option>
                                @endforeach
                            </select>
                            <span class="text">-</span>
                            <input type="text" name="phone[]" id="" class="form-item" value="{{ (empty($user->phone) ? '' : $user->phone[1]) }}" onlyNumber>
                            <span class="text">-</span>
                            <input type="text" name="phone[]" id="" class="form-item" value="{{ (empty($user->phone) ? '' : $user->phone[2]) }}" onlyNumber>
                        </div>
                    </dd>
                </dl>
                <dl>
                    <dt><strong class="required">*</strong> 근무지 주소</dt>
                    <dd>
                        <div class="form-group has-btn">
                            <input type="text" name="office_zipcode" id="office_zipcode" class="form-item" value="{{ $user->office_zipcode ?? '' }}" readonly>
                            <a href="javascript:;" class="btn btn-small color-type2 post-code" data-target="office_">우편번호 찾기</a>
                        </div>
                        <div class="form-group n2 mt-10">
                            <input type="text" name="office_addr1" id="office_addr1" class="form-item clear" value="{{ $user->office_addr1 ?? '' }}" readonly>
                            <input type="text" name="office_addr2" id="office_addr2" class="form-item" value="{{ $user->office_addr2 ?? '' }}">
                        </div>
                    </dd>
                </dl>
                <dl>
                    <dt><strong class="required">*</strong> 근무처 구분</dt>
                    <dd>
                        <div class="radio-wrap cst">
                        @foreach($userConfig['office'] as $office_key => $office_val)
                            <div class="radio-group">
                                <input type="radio" name="office" id="office_{{$office_key}}" value="{{$office_key}}" {{ $office_key == 99 ? 'data-etc=true' : '' }} {{ ($user->office ?? '') == $office_key ? 'checked' : '' }}>
                                <label for="office_{{$office_key}}">{{$office_val}}</label>
                            </div>
                        @endforeach
                            <input type="text" name="office_etc" id="office_etc" class="form-item small" value="{{ $user->office_etc ?? '' }}" {{ empty($user->office_etc ) ? 'disabled=disabled' : '' }}>
                        </div>
                    </dd>
                </dl>
                <dl>
                    <dt><strong class="required">*</strong> 가입 구분</dt>
                    <dd>
                        <div class="radio-wrap cst">
                            @foreach($userConfig['category'] as $category_key => $category_val)
                            <div class="radio-group">
                                <input type="radio" name="category" id="category_{{$category_key}}" value="{{$category_key}}" {{ $category_key == 99 ? 'data-etc=true' : '' }} {{ ($user->category ?? '') == $category_key ? 'checked' : '' }}>
                                <label for="category_{{$category_key}}">{{$category_val}}</label>
                            </div>
                            @endforeach
                            <input type="text" name="category_etc" id="category_etc" class="form-item small" value="{{ $user->category_etc ?? '' }}" {{ empty($user->category_etc ) ? 'disabled=disabled' : '' }}>
                        </div>
                    </dd>
                </dl>
                <dl>
                    <dt><strong class="required">*</strong> 전공 구분</dt>
                    <dd>
                        <div class="radio-wrap cst d-block">
                            @foreach($userConfig['major'] as $major_key => $major_val)
                            <div class="radio-group">
                                <input type="radio" name="major" id="major_{{$major_key}}" value="{{$major_key}}" {{ $major_key == 99 ? 'data-etc=true' : '' }} {{ ($user->major ?? '') == $major_key ? 'checked' : '' }}>
                                <label for="major_{{$major_key}}">{{$major_val}}</label>
                            </div>
                            @endforeach

                            <select name="major_etc" id="major_etc" class="form-item small" >
                                <option value="">선택</option>
                                @foreach($userConfig['major_etc'][$user->major ?? 1] as $major_etc_key => $major_etc_val)
                                    <option value="{{$major_etc_key}}" {{ ($user->major_etc ?? '') == $major_etc_key ? 'selected' : '' }}>{{$major_etc_val}}</option>
                                @endforeach
                            </select>

                        </div>
                    </dd>
                </dl>
                <dl>
                    <dt><strong class="required">*</strong> 출신 대학</dt>
                    <dd>
                        <input type="text" name="university" id="university" class="form-item medium" value="{{ $user->university ?? '' }}">
                        <div class="form-group form-group-text">
                            <span class="text">졸업연도</span>
                            <input type="text" name="university_year" id="university_year" class="form-item small" value="{{ $user->university_year ?? '' }}" maxlength="4" onlyNumber>
                        </div>
                    </dd>
                </dl>
                <dl>
                    <dt>최종학위</dt>
                    <dd>
                        <input type="text" name="degree" id="degree" class="form-item medium" value="{{ $user->degree ?? '' }}">
                        <div class="form-group form-group-text">
                            <span class="text">취득연도</span>
                            <input type="text" name="degree_year" id="degree_year" class="form-item small" value="{{ $user->degree_year ?? '' }}" maxlength="4" onlyNumber>
                        </div>
                    </dd>
                </dl>
                <dl>
                    <dt>최정학위 논문 제목</dt>
                    <dd>
                        <input type="text" name="degree_title" id="degree_title" class="form-item medium" value="{{ $user->degree_title ?? '' }}">
                    </dd>
                </dl>
                <dl>
                    <dt>면허번호</dt>
                    <dd>
                        <input type="text" name="license_number" id="license_number" class="form-item medium" value="{{ $user->license_number ?? '' }}" maxlength="10" onlyNumber>
                        <div class="form-group form-group-text">
                            <span class="text">취득연도</span>
                            <input type="text" name="license_year" id="license_year" class="form-item small" value="{{ $user->license_year ?? '' }}" maxlength="4" onlyNumber>
                        </div>
                    </dd>
                </dl>
                <dl>
                    <dt>전문의 1</dt>
                    <dd>
                        <input type="text" name="major1" id="major1" class="form-item medium" value="{{ $user->major1 ?? '' }}">
                        <div class="form-group form-group-text">
                            <span class="text">취득연도</span>
                            <input type="text" name="major1_year" id="major1_year" class="form-item small" value="{{ $user->major1_year ?? '' }}" maxlength="4" onlyNumber>
                        </div>
                    </dd>
                </dl>
                <dl>
                    <dt>전문의 2</dt>
                    <dd>
                        <input type="text" name="major2" id="major2" class="form-item medium" value="{{ $user->major2 ?? '' }}">
                        <div class="form-group form-group-text">
                            <span class="text">취득연도</span>
                            <input type="text" name="major2_year" id="major2_year" class="form-item small" value="{{ $user->major2_year ?? '' }}" maxlength="4" onlyNumber>
                        </div>
                    </dd>
                </dl>
                <dl>
                    <dt>분과 전문의</dt>
                    <dd>
                        <input type="text" name="speciality" id="speciality" class="form-item medium" value="{{ $user->speciality ?? '' }}">
                        <div class="form-group form-group-text">
                            <span class="text">취득연도</span>
                            <input type="text" name="speciality_year" id="speciality_year" class="form-item small" value="{{ $user->speciality_year ?? '' }}" maxlength="4" onlyNumber>
                        </div>
                    </dd>
                </dl>
                <dl>
                    <dt>전공 분야</dt>
                    <dd>
                        <input type="text" name="major_field" id="major_field" class="form-item medium" value="{{ $user->major_field ?? '' }}">
                    </dd>
                </dl>
                <dl>
                    <dt>진료 분야</dt>
                    <dd>
                        부정맥(
                        <div class="checkbox-wrap cst">
                            @foreach($userConfig['field'] as $field_key => $field_val)
                                @if($field_key <= 7)
                                <div class="checkbox-group">
                                    <input type="checkbox" name="field[]" id="field_{{$field_key}}" value="{{$field_key}}" {{ $field_key == 99 ? 'data-etc=true' : '' }} {{ in_array($field_key, $user->field ?? []) ? 'checked':'' }}>
                                    <label for="field_{{$field_key}}">{{$field_val}}</label>
                                </div>
                                @endif
                            @endforeach
                        </div>
                        )
                        <div class="checkbox-wrap cst">
                            @foreach($userConfig['field'] as $field_key => $field_val)
                                @if($field_key > 7)
                                <div class="checkbox-group">
                                    <input type="checkbox" name="field[]" id="field_{{$field_key}}" value="{{$field_key}}" {{ $field_key == 99 ? 'data-etc=true' : '' }} {{ in_array($field_key, $user->field ?? []) ? 'checked':'' }}>
                                    <label for="field_{{$field_key}}">{{$field_val}}</label>
                                </div>
                                @endif
                            @endforeach
                        </div>
                        <input type="text" name="field_etc" id="field_etc" class="form-item small" value="{{$user->field_etc ?? ''}}" {{ empty($user->field_etc ) ? 'disabled=disabled' : '' }}>
                        <div class="help-text mt-10">
                            * 현재 진료하는 분야를 모두 선택해 주세요.
                        </div>
                    </dd>
                </dl>
            </div>

            @if(!$isAdminPage)
            <div class="write-wrap">
                <dl>
                    <dt><strong class="required">*</strong> 자동화 프로그램 입력 방지</dt>
                    <dd>
                        <div class="captcha">
                            <span class="img">
                                <img id="captcha_img" src="{{route('refresh_captcha')}}">
                            </span>
                            <img src="/assets/image/common/ic_refresh.png" class="refresh" id="refresh_captcha">
                            <input type="text" name="captcha_input" id="captcha_input" class="form-item captcha captchaChk" data-chk="N">
                        </div>
                    </dd>
                </dl>
            </div>
            @endif

        </fieldset>
        <div class="btn-wrap text-center">
            @if( session()->has('modify') )
                <a href="javascript:;" id="modify_cancel" class="btn btn-type1 color-type4">취소</a>
                <button type="submit" id="modify_init" class="btn btn-type1 color-type5">수정</button>
            @else
                <a href="javascript:;" id="register_cancel" class="btn btn-type1 color-type4">취소</a>
                <button type="submit" class="btn btn-type1 color-type5">등록</button>
            @endif
        </div>
    </div>
</div>
