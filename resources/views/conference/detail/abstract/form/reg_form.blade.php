<form id="register-frm" name="register-frm" data-sid="{{ $abstract->sid ?? 0 }}" data-case="abstract-{{ empty($abstract->sid) ? 'regist' : 'update' }}" onsubmit="return false;">
    <input type="hidden" name="csid" id="csid" value="{{ $conference->sid ?? 0 }}" readonly>
    <input type="hidden" name="tab" id="tab" value="{{ $tab ?? 4 }}" readonly>
    <fieldset>
        <legend class="hide">등록</legend>

        <div class="sub-contit-wrap">
            <h4 class="sub-contit">접수자 정보</h4>
        </div>
        <div class="write-wrap">
            <dl>
                <dt><strong class="required">*</strong> ID (E-mail)</dt>
                <dd>
                    <input type="text" name="uid" id="uid" style="width: {{ empty($abstract->sid) ? '80':'100' }}%" class="form-item uidChk" data-chk="N" value="{{ empty($abstract->sid) ? ($user->uid ?? '') : ($abstract->uid ?? '') }}" {{ empty($abstract->sid) ? '':'disabled' }}>
                    @if(empty($abstract->sid))
                        <a href="javascript:void(0);" class="btn btn-small color-type2" id="uid_chk">중복확인</a>
                    @endif
                </dd>
            </dl>
            <dl>
                <dt><strong class="required">*</strong> 성명 (국문)</dt>
                <dd>
                    <input type="text" name="name_kr" id="name_kr" class="form-item" value="{{ empty($abstract->sid) ? ($user->name_kr ?? '') : ($abstract->name_kr ?? '') }}" onlyKo>
                </dd>
            </dl>
        </div>

        <div class="write-wrap">
            <dl>
                <dt><strong class="required">*</strong> 희망발표형식</dt>
                <dd>
                    <div class="radio-wrap cst">
                        @foreach($conferenceConfig['abs_type'] as $key => $val)
                            <div class="radio-group">
                                <input type="radio" name="type" id="type{{$key}}" value="{{ $key }}" {{ ($abstract->type ?? '') == $key ? 'checked': '' }}>
                                <label for="type{{$key}}">{{ $val }}</label>
                            </div>
                        @endforeach
                    </div>
                </dd>
            </dl>
            <dl>
                <dt><strong class="required">*</strong> 구분</dt>
                <dd>
                    <div class="radio-wrap cst">
                        @foreach($conferenceConfig['abs_gubun'] as $key => $val)
                            @continue( !in_array($key, ($conference->abs_gubun ?? []) ))
                            <div class="radio-group">
                                <input type="radio" name="gubun" id="gubun{{$key}}" value="{{ $key }}" {{ ($abstract->gubun ?? '') == $key ? 'checked': '' }}>
                                <label for="gubun{{$key}}">{{ $val }}</label>
                            </div>
                        @endforeach
                            @if(in_array('99', ($conference->abs_gubun ?? [])) )
                            <div class="radio-group">
                                <input type="text" name="gubun_etc" id="gubun_etc" value="{{ $abstract->gubun_etc ?? '' }}" class="form-item" {{ ($abstract->gubun ?? '') == '99' ? '' : 'disabled' }}>
                            </div>
                            @endif
                    </div>
                </dd>
            </dl>
            <dl>
                <dt><strong class="required">*</strong> 제목</dt>
                <dd>
                    <div class="form-group form-group-text">
                        <span class="text">국문 : </span>
                        <input type="text" name="title_kr" id="title_kr" value="{{ $abstract->title_kr ?? '' }}" class="form-item" onlyKo>
                    </div>
                    <div class="form-group form-group-text mt-10">
                        <span class="text">영문 : </span>
                        <input type="text" name="title_en" id="title_en" value="{{ $abstract->title_en ?? '' }}" class="form-item" onlyEn>
                    </div>
                </dd>
            </dl>
            <dl>
                <dt><strong class="required">*</strong> 연구자</dt>
                <dd>
                    <div class="form-group form-group-text">
                        <span class="text">국문 : </span>
                        <input type="text" name="research_kr" id="research_kr" value="{{ $abstract->research_kr ?? '' }}" class="form-item" onlyKo>
                    </div>
                    <div class="form-group form-group-text mt-10">
                        <span class="text">영문 : </span>
                        <input type="text" name="research_en" id="research_en" value="{{ $abstract->research_en ?? '' }}" class="form-item" onlyEn>
                    </div>
                </dd>
            </dl>
            <dl>
                <dt><strong class="required">*</strong> 소속</dt>
                <dd>
                    <div class="form-group form-group-text">
                        <span class="text">국문 : </span>
                        <input type="text" name="sosok_kr" id="sosok_kr" value="{{ $abstract->sosok_kr ?? '' }}" class="form-item" onlyKo>
                    </div>
                    <div class="form-group form-group-text mt-10">
                        <span class="text">영문 : </span>
                        <input type="text" name="sosok_en" id="sosok_en" value="{{ $abstract->sosok_en ?? '' }}" class="form-item" onlyEn>
                    </div>
                </dd>
            </dl>
            <dl>
                <dt>첨부파일</dt>
                <dd>
                    <div class="filebox">
                        <input class="upload-name form-item" id="fileName1" name="fileName1" value="{{ $abstract->thumb_file ?? '' }}" placeholder="파일 업로드" readonly="readonly">
                        <label for="thumb_file">파일 업로드</label>
                        <input type="file" id="thumb_file" name="thumb_file" class="file-upload" onchange="fileCheck(this,$('#fileName1'))">
                        @if (!empty($abstract->thumb_file))
                            <div class="attach-file">
                                <a href="{{ $abstract->downloadFileUrl('thumb_realfile', 'thumb_file') }}" target="_blank" class="link">{{$abstract->thumb_file}}</a>
                                <a href="javascript:void(0);" class="file_del" data-type="thumb" data-path="{{ $abstract->thumb_realfile }}"><img src="{{ asset('assets/image/icon/icon_del.png') }}" alt="삭제"></a>
                            </div>
                        @endif
                    </div>
                </dd>
            </dl>
        </div>

        <div class="sub-contit-wrap">
            <h4 class="sub-contit">초록 본문</h4>
        </div>

        <input type="hidden" name="tot_byte" id="tot_byte" value="{{ $abstract->tot_byte ?? '0' }}" class="form-item w-10p" readonly>

        <div class="write-wrap otype" style="{{ ($abstract->type ?? 'O') == 'O' ? '' : 'display:none' }}">
            <div class="write-tit text-right">
                <input type="text" name="tot_byte_o" id="tot_byte_o" value="{{ $abstract->tot_byte ?? '0' }}" class="form-item w-10p" readonly> / 최대 300 단어
            </div>
            <dl>
                <dt><strong class="required">*</strong> 서론</dt>
                <dd>
                    <textarea wrap="o_intro" name="o_intro" id="o_intro" >{!! $abstract->o_intro ?? '' !!}</textarea>
                    <script type="text/javascript">
                        //<![CDATA[
                        //table row 바이트 체크 플러그인
                        // CKEDITOR.replace('title', {fullPage: true, allowedContent: true, "width":"100%","height":"120px","maxByte":300,"check_mode":"table"});

                        var editor = CKEDITOR.replace('o_intro', {startupFocus : false, "width":"100%","height":"120px","maxByte":3000});
                        editor.on( 'change', function( evt ) {
                            if (!isSettingData) {
                                cal_bytes('O', 'o_intro');
                            }
                        });
                        //]]>
                    </script>
                </dd>
            </dl>
            <dl>
                <dt><strong class="required">*</strong> 증례</dt>
                <dd>
                    <textarea name="o_case" id="o_case" >{!! $abstract->o_case ?? '' !!}</textarea>
                    <script type="text/javascript">
                        //<![CDATA[
                        //table row 바이트 체크 플러그인
                        // CKEDITOR.replace('title', {fullPage: true, allowedContent: true, "width":"100%","height":"120px","maxByte":300,"check_mode":"table"});

                        var editor = CKEDITOR.replace('o_case', {startupFocus : false, "width":"100%","height":"120px","maxByte":3000});
                        editor.on( 'change', function( evt ) {
                            if (!isSettingData) {
                                cal_bytes('O', 'o_case');
                            }
                        });
                        //]]>
                    </script>
                </dd>
            </dl>
            <dl>
                <dt><strong class="required">*</strong> 결론</dt>
                <dd>
                    <textarea name="o_result" id="o_result" >{!! $abstract->o_result ?? '' !!}</textarea>
                    <script type="text/javascript">
                        //<![CDATA[
                        //table row 바이트 체크 플러그인
                        // CKEDITOR.replace('title', {fullPage: true, allowedContent: true, "width":"100%","height":"120px","maxByte":300,"check_mode":"table"});

                        var editor = CKEDITOR.replace('o_result', {startupFocus : false, "width":"100%","height":"120px","maxByte":3000});
                        editor.on( 'change', function( evt ) {
                            if (!isSettingData) {
                                cal_bytes('O', 'o_result');
                            }
                        });
                        //]]>
                    </script>
                </dd>
            </dl>
        </div>

        <div class="write-wrap ptype" style="{{ ($abstract->type ?? 'O') == 'P' ? '' : 'display:none' }}">
            <div class="write-tit text-right">
                <input type="text" name="tot_byte_p" id="tot_byte_p" value="{{ $abstract->tot_byte ?? '0' }}" class="form-item w-10p" readonly/> / 최대 300 단어
            </div>
            <dl>
                <dt><strong class="required">*</strong> 목적</dt>
                <dd>
                    <textarea name="p_object" id="p_object" >{!! $abstract->p_object ?? '' !!}</textarea>
                    <script type="text/javascript">
                        //<![CDATA[
                        //table row 바이트 체크 플러그인
                        // CKEDITOR.replace('title', {fullPage: true, allowedContent: true, "width":"100%","height":"120px","maxByte":300,"check_mode":"table"});

                        var editor = CKEDITOR.replace('p_object', {startupFocus : false, "width":"100%","height":"120px","maxByte":3000});
                        editor.on( 'change', function( evt ) {
                            if (!isSettingData) {
                                cal_bytes('P', 'p_object');
                            }
                        });
                        //]]>
                    </script>
                </dd>
            </dl>
            <dl>
                <dt><strong class="required">*</strong> 대상 및 방법</dt>
                <dd>
                    <textarea name="p_method" id="p_method" >{!! $abstract->p_method ?? '' !!}</textarea>
                    <script type="text/javascript">
                        //<![CDATA[
                        //table row 바이트 체크 플러그인
                        // CKEDITOR.replace('title', {fullPage: true, allowedContent: true, "width":"100%","height":"120px","maxByte":300,"check_mode":"table"});

                        var editor = CKEDITOR.replace('p_method', {startupFocus : false, "width":"100%","height":"120px","maxByte":3000});
                        editor.on( 'change', function( evt ) {
                            if (!isSettingData) {
                                cal_bytes('P', 'p_method');
                            }
                        });
                        //]]>
                    </script>
                </dd>
            </dl>
            <dl>
                <dt><strong class="required">*</strong> 결과</dt>
                <dd>
                    <textarea name="p_result" id="p_result" >{!! $abstract->p_result ?? '' !!}</textarea>
                    <script type="text/javascript">
                        //<![CDATA[
                        //table row 바이트 체크 플러그인
                        // CKEDITOR.replace('title', {fullPage: true, allowedContent: true, "width":"100%","height":"120px","maxByte":300,"check_mode":"table"});

                        var editor = CKEDITOR.replace('p_result', {startupFocus : false, "width":"100%","height":"120px","maxByte":3000});
                        editor.on( 'change', function( evt ) {
                            if (!isSettingData) {
                                cal_bytes('P', 'p_result');
                            }
                        });
                        //]]>
                    </script>
                </dd>
            </dl>
            <dl>
                <dt><strong class="required">*</strong> 결론</dt>
                <dd>
                    <textarea name="p_conclusion" id="p_conclusion" >{!! $abstract->p_conclusion ?? '' !!}</textarea>
                    <script type="text/javascript">
                        //<![CDATA[
                        //table row 바이트 체크 플러그인
                        // CKEDITOR.replace('title', {fullPage: true, allowedContent: true, "width":"100%","height":"120px","maxByte":300,"check_mode":"table"});

                        var editor = CKEDITOR.replace('p_conclusion', {startupFocus : false, "width":"100%","height":"120px","maxByte":3000});
                        editor.on( 'change', function( evt ) {
                            if (!isSettingData) {
                                cal_bytes('P', 'p_conclusion');
                            }
                        });
                        //]]>
                    </script>
                </dd>
            </dl>
        </div>


        <div class="sub-contit-wrap">
            <h4 class="sub-contit">발표자 정보</h4>
        </div>
        <div class="write-wrap">
            <dl>
                <dt><strong class="required">*</strong> 발표자 성명</dt>
                <dd>
                    <input type="text" name="p_name" id="p_name" value="{{ $abstract->p_name ?? '' }}" class="form-item">
                </dd>
            </dl>
            <dl>
                <dt><strong class="required">*</strong> 소속</dt>
                <dd>
                    <input type="text" name="p_sosok" id="p_sosok" value="{{ $abstract->p_sosok ?? '' }}" class="form-item">
                </dd>
            </dl>
            <dl>
                <dt><strong class="required">*</strong> 직위</dt>
                <dd>
                    <div class="radio-wrap cst">
                        @foreach($conferenceConfig['p_position'] as $key => $val)
                            <div class="radio-group">
                                <input type="radio" name="p_position" id="p_position{{$key}}" value="{{ $key }}"{{ ($abstract->p_position ?? '') == $key ? 'checked': '' }}>
                                <label for="p_position{{$key}}">{{ $val }}</label>
                            </div>
                        @endforeach

                        <div class="radio-group">
                            <input type="text" name="p_position_etc" id="p_position_etc" class="form-item small" value="{{ $abstract->p_position_etc ?? '' }}" {{ empty($abstract->p_position_etc ) ? 'disabled=disabled' : '' }}>
                        </div>
                    </div>
                </dd>
            </dl>
            <dl>
                <dt><strong class="required">*</strong> 이메일</dt>
                <dd>
                    <input type="text" name="p_email" id="p_email" value="{{ $abstract->p_email ?? '' }}" class="form-item">
                </dd>
            </dl>
            <dl>
                <dt><strong class="required">*</strong> 휴대폰번호</dt>
                <dd>
                    <div class="form-group form-group-text n3">
                        <select name="p_phone[]" id="phone_first" class="form-item">
                            @foreach($userConfig['phone_first'] as $key => $val)
                                <option value="{{ $key }}" {{ ($abstract->p_phone[0] ?? '') == $key ? 'selected': '' }} >
                                    {{ $val }}</option>
                            @endforeach
                        </select>
                        <span class="text">-</span>
                        <input type="text" name="p_phone[]" id="" class="form-item" value="{{ $abstract->p_phone[1] ?? '' }}" onlyNumber maxlength="4">
                        <span class="text">-</span>
                        <input type="text" name="p_phone[]" id="" class="form-item" value="{{ $abstract->p_phone[2] ?? '' }}" onlyNumber maxlength="4">
                    </div>
                </dd>
            </dl>
        </div>

        <div class="btn-wrap text-center">
            @if(checkUrl() == 'admin')
                <a href="javascript:window.close();" class="btn btn-type1 color-type4">취소</a>
                <button type="submit" class="btn btn-type1 color-type5">수정</button>
            @else
                <a href="{{ route('conference.detail',['sid'=>$conference->sid]) }}" class="btn btn-type1 color-type4">취소</a>
                <button type="submit" class="btn btn-type1 color-type5">{{ ($abstract->status ?? 'N') == 'N' ? '미리보기':'수정하기' }}</button>
            @endif

        </div>
    </fieldset>
</form>

@section('abs-script')
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

        window.CKEDITOR_BASEPATH='{{ asset('plugins/ckeditor/') }}';

        $(document).on('click', $("input[name='type']"), function() {
            const _type = $("input[name='type']:checked").val();
            if(_type == 'P'){
                $(".otype").hide();
                $(".ptype").show();
            }else{
                $(".otype").show();
                $(".ptype").hide();
            }
        });

        $(document).on('click', 'input[name="gubun"]', function() {
            if($(this).val() == '99') {
                $('#gubun_etc').attr('disabled', false);
            }else {
                $('#gubun_etc').attr('disabled', 'disabled');
                $('#gubun_etc').val('');
            }
        });

        $(document).on('click', 'input[name="p_position"]', function() {
            if($(this).val() == '99') {
                $('#p_position_etc').attr('disabled', false);
            }else {
                $('#p_position_etc').attr('disabled', 'disabled');
                $('#p_position_etc').val('');
            }
        });

        function get_split_length(str)
        {
            var splits = "";
            if(str.length > 0){
                splits = str.split(" ");
            }
            return splits.length;
        }

        function get_target_str(target){
            var o_intro = CKEDITOR.instances.o_intro.getData();
            var o_case = CKEDITOR.instances.o_case.getData();
            var o_result = CKEDITOR.instances.o_result.getData();

            var p_object = CKEDITOR.instances.p_object.getData();
            var p_method = CKEDITOR.instances.p_method.getData();
            var p_result = CKEDITOR.instances.p_result.getData();
            var p_conclusion = CKEDITOR.instances.p_conclusion.getData();

            var _change_str = "";
            if (target == 'o_intro') _change_str+= o_intro;
            if (target == 'o_case') _change_str+= o_case;
            if (target == 'o_result') _change_str+= o_result;
            if (target == 'p_object') _change_str+= p_object;
            if (target == 'p_method') _change_str+= p_method;
            if (target == 'p_result') _change_str+= p_result;
            if (target == 'p_conclusion') _change_str+= p_conclusion;

            return _change_str;
        }

        let isSettingData = false;
        function cal_bytes(type, target)
        {
            isSettingData = true;
            let _tot_byte = 0;

            if(type == 'O'){
                var o_intro_cnt = get_split_length(CKEDITOR.instances.o_intro.getData());
                var o_case_cnt = get_split_length(CKEDITOR.instances.o_case.getData());
                var o_result_cnt = get_split_length(CKEDITOR.instances.o_result.getData());
                _tot_byte += ( o_intro_cnt+o_case_cnt+o_result_cnt );

            }else{
                var p_object_cnt = get_split_length(CKEDITOR.instances.p_object.getData());
                var p_method_cnt = get_split_length(CKEDITOR.instances.p_method.getData());
                var p_result_cnt = get_split_length(CKEDITOR.instances.p_result.getData());
                var p_conclusion_cnt = get_split_length(CKEDITOR.instances.p_conclusion.getData());
                _tot_byte += ( p_object_cnt+p_method_cnt+p_result_cnt+p_conclusion_cnt );

            }

            var _last_str = get_target_str(target);
            _change_str = _last_str.slice(0, -1);

            if(_tot_byte >= 300){
                alert('최대 300단어 이상 작성하실 수 없습니다.');

                if (target == 'o_intro') {
                    CKEDITOR.instances.o_intro.setData(_change_str);
                }else if (target == 'o_case') {
                    CKEDITOR.instances.o_case.setData(_change_str);
                }else if (target == 'o_result') {
                    CKEDITOR.instances.o_result.setData(_change_str);
                }else if (target == 'p_object') {
                    CKEDITOR.instances.p_object.setData(_change_str);
                }else if (target == 'p_method') {
                    CKEDITOR.instances.p_method.setData(_change_str);
                }else if (target == 'p_result') {
                    CKEDITOR.instances.p_result.setData(_change_str);
                }else if (target == 'p_conclusion') {
                    CKEDITOR.instances.p_conclusion.setData(_change_str);
                }
                isSettingData = false;
                return false;
            }

            if(type == 'O'){
                $("#tot_byte_o").val(_tot_byte);
            }else{
                $("#tot_byte_p").val(_tot_byte);
            }
            $("#tot_byte").val(_tot_byte);
            isSettingData = false;
        }


        // 게시글 작성 취소
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
                            return $("#register-frm").data('case')==='abstract-regist';
                        }
                    }
                },
                @endif
                name_kr: {
                    isEmpty: true,
                },
                type: {
                    checkEmpty: true,
                },
                gubun: {
                    checkEmpty: true,
                },
                gubun_etc: {
                    isEmpty: {
                        depends: function(element) {
                            return $("input[name='gubun']:checked").val()==='99';
                        }
                    }
                },
                title_kr: {
                    isEmpty: true,
                },
                title_en: {
                    isEmpty: true,
                },
                research_kr: {
                    isEmpty: true,
                },
                research_en: {
                    isEmpty: true,
                },
                sosok_kr: {
                    isEmpty: true,
                },
                sosok_en: {
                    isEmpty: true,
                },

                o_intro: {
                    isEmpty: {
                        depends: function(element) {
                            return $("input[name='type']:checked").val()==='O' && CKEDITOR.instances.o_intro.getData().length < 1;
                        }
                    }
                },
                o_case: {
                    isEmpty: {
                        depends: function(element) {
                            return $("input[name='type']:checked").val()==='O' && CKEDITOR.instances.o_case.getData().length < 1;
                        }
                    }
                },
                o_result: {
                    isEmpty: {
                        depends: function(element) {
                            return $("input[name='type']:checked").val()==='O' && CKEDITOR.instances.o_result.getData().length < 1;
                        }
                    }
                },

                p_object: {
                    isEmpty: {
                        depends: function(element) {
                            return $("input[name='type']:checked").val()==='P' && CKEDITOR.instances.p_object.getData().length < 1;
                        }
                    }
                },
                p_method: {
                    isEmpty: {
                        depends: function(element) {
                            return $("input[name='type']:checked").val()==='P' && CKEDITOR.instances.p_method.getData().length < 1;
                        }
                    }
                },
                p_result: {
                    isEmpty: {
                        depends: function(element) {
                            return $("input[name='type']:checked").val()==='P' && CKEDITOR.instances.p_result.getData().length < 1;
                        }
                    }
                },
                p_conclusion: {
                    isEmpty: {
                        depends: function(element) {
                            return $("input[name='type']:checked").val()==='P' && CKEDITOR.instances.p_conclusion.getData().length < 1;
                        }
                    }
                },
                // etc_result: {
                //     isEmpty: {
                //         depends: function(element) {
                //             return $("input[name='type']:checked").val()==='P' && CKEDITOR.instances.p_conclusion.getData().length < 2;
                //         }
                //     }
                // },

                p_name: {
                    isEmpty: true,
                },
                p_sosok: {
                    isEmpty: true,
                },
                p_position: {
                    checkEmpty: true,
                },
                p_position_etc: {
                    isEmpty: {
                        depends: function(element) {
                            return $("input[name='p_position']:checked").val()==='99';
                        }
                    }
                },
                p_email: {
                    isEmpty: true,
                },
                'p_phone[]': {
                    isEmpty: true,
                },


            },
            messages: {
                uid: {
                    isEmpty: '아이디를 입력해주세요.',
                    emailRegExp: '아이디 이메일 형식에 맞춰서 입력해주세요.',
                    uidChk: '아이디를 중복확인 해주세요.',
                },
                name_kr: {
                    isEmpty: '이름 (국문)을 입력해주세요.',
                },
                type: {
                    checkEmpty: '희망발표형식을 선택해주세요.',
                },
                gubun: {
                    checkEmpty: '구분을 선택해주세요.',
                },
                gubun_etc: {
                    isEmpty: '구분 기타를 입력해주세요.',
                },
                title_kr: {
                    isEmpty:'제목(국문)을 입력해주세요.',
                },
                title_en: {
                    isEmpty:'제목(영문)을 입력해주세요.',
                },
                research_kr: {
                    isEmpty:'연구자(국문)을 입력해주세요.',
                },
                research_en: {
                    isEmpty:'연구자(영문)을 입력해주세요.',
                },
                sosok_kr: {
                    isEmpty:'소속(국문)을 입력해주세요.',
                },
                sosok_en: {
                    isEmpty:'소속(영문)을 입력해주세요.',
                },

                o_intro: {
                    isEmpty:'서론을 입력해주세요.',
                },
                o_case: {
                    isEmpty:'증례를 입력해주세요.',
                },
                o_result: {
                    isEmpty:'결론을 입력해주세요.',
                },

                p_object: {
                    isEmpty: '목적을 입력해주세요.',
                },
                p_method: {
                    isEmpty: '대상 및 방법을 입력해주세요.',
                },
                p_result: {
                    isEmpty: '결과를 입력해주세요.',
                },
                p_conclusion: {
                    isEmpty: '결론을 입력해주세요.',
                },

                // etc_result: {
                //     isEmpty: '본문을 입력해주세요.',
                // },

                p_name: {
                    isEmpty: '발표자 성명을 입력해주세요.',
                },
                p_sosok: {
                    isEmpty: '소속을 입력해주세요.',
                },
                p_position: {
                    checkEmpty: '직위를 선택해주세요.',
                },
                p_position_etc: {
                    isEmpty: '직위 기타를 입력해주세요.',
                },
                p_email: {
                    isEmpty: '이메일을 입력해주세요.',
                },
                'p_phone[]': {
                    isEmpty: '휴대폰번호를 입력해주세요.',
                },

            },
            submitHandler: function() {
                if($("input[name='type']:checked").val()==='O' && CKEDITOR.instances.o_intro.getData().length > 1){
                    $("textarea[name='o_intro']").val(CKEDITOR.instances.o_intro.getData());
                }
                if($("input[name='type']:checked").val()==='O' && CKEDITOR.instances.o_case.getData().length > 1){
                    $("textarea[name='o_case']").val(CKEDITOR.instances.o_case.getData());
                }
                if($("input[name='type']:checked").val()==='O' && CKEDITOR.instances.o_result.getData().length > 1){
                    $("textarea[name='o_result']").val(CKEDITOR.instances.o_result.getData());
                }
                if($("input[name='type']:checked").val()==='P' && CKEDITOR.instances.p_object.getData().length > 1){
                    $("textarea[name='p_object']").val(CKEDITOR.instances.p_object.getData());
                }
                if($("input[name='type']:checked").val()==='P' && CKEDITOR.instances.p_method.getData().length > 1){
                    $("textarea[name='p_method']").val(CKEDITOR.instances.p_method.getData());
                }
                if($("input[name='type']:checked").val()==='P' && CKEDITOR.instances.p_result.getData().length > 1){
                    $("textarea[name='p_result']").val(CKEDITOR.instances.p_result.getData());
                }
                if($("input[name='type']:checked").val()==='P' && CKEDITOR.instances.p_conclusion.getData().length > 1){
                    $("textarea[name='p_conclusion']").val(CKEDITOR.instances.p_conclusion.getData());
                }
                registerSubmit();
            }
        });

        const registerSubmit = () => {
            let ajaxData = newFormData($(form));
            callMultiAjax(dataUrl, ajaxData);
        }
    </script>
@endsection