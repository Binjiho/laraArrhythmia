@extends('admin.layouts.pop-layout')

@section('addStyle')
    <script src="{{ asset('plugins/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ asset('script/plupload-tinymce.common.js') }}?v={{ config('site.app.asset_version') }}"></script>
    <script src="//t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>
@endsection

@section('contents')
    <article class="sub-contents">
        <div class="sub-conbox inner-layer">

            <div id="board" class="event-wrap board-wrap">
                <div class="board-write">
                    <div class="write-form-wrap">
                        @include('conference.form.reg_form')
                    </div>
                </div>
            </div>
        </div>
    </article>
@endsection

@section('addScript')
    <script>
        const form = '#board-frm';
        const dataUrl = '{{ route('conference.data') }}';

        $(document).on('click', '.post-code', function() {
            callPostCode($(this).data('target'));
        });

        $(document).on('click', '.file_del', function() {
            let ajaxData = {};
            ajaxData.case = 'file-delete';
            ajaxData.fileType = $(this).data('type');
            ajaxData.filePath = $(this).data('path');

            actionConfirmAlert('삭제 하시겠습니까?', {'ajax': actionAjax(dataUrl, ajaxData)});
        });

        //선착순등록
        $(document).on('click', 'input[name="limit_yn"]', function() {
            if( $(this).val() == 'Y') {
                $('#limit_person').attr('disabled', false);
            }else{
                $('#limit_person').attr('disabled', 'disabled');
                $('#limit_person').val('');
            }
        });
        //신청권한 - 연구회회원전용
        $(document).on('click', 'input:radio[name="res_authority"]', function() {
            if( $(this).val() == '4'/*연구회회원전용*/) {
                $('#res_authority_etc').attr('disabled', false);
            }else{
                $('#res_authority_etc').attr('disabled', 'disabled');
                $('#res_authority_etc').val('');
            }
        });

        function change_tr(el, mode){
            if(mode == 'add'){
                var _html = "";
                _html += "<tr>";
                _html += "<td class=\"text-left\">";
                _html += "<input type=\"text\" name=\"regist_gubun[]\" class=\"form-item\">";
                _html += "</td>";
                _html += "<td class=\"text-left\">";
                _html += "<input type=\"text\" name=\"regist_early[]\" class=\"form-item\" priceFormat>";
                _html += "</td>";
                _html += "<td class=\"text-left\">";
                _html += "<input type=\"text\" name=\"regist_onsite[]\" class=\"form-item\" priceFormat>";
                _html += "</td>";
                _html += "<td>";
                _html += "<div class=\"btn-admin\">";
                _html += "<a href=\"javascript:;\" onclick=\"change_tr(this,'add');\" class=\"btn btn-board btn-modify\">추가</a>";
                _html += "<a href=\"javascript:;\" onclick=\"change_tr(this,'del');\" class=\"btn btn-board btn-delete\">삭제</a>";
                _html += "</div>";
                _html += "</td>";
                _html += "</tr>";

                $("#fee_tbl").append(_html);
            }else{
                if($("#fee_tbl").find("tr").length < 2){
                    alert('최소 한개 이상은 입력해주세요.');
                    return false;
                }else{
                    $(el).parent().parent().parent().remove();
                }
            }
        }

        // 게시글 작성 취소
        $(document).on('click', '#board_cancel', function(e) {
            e.preventDefault();

            const msg = ($(form).data('sid') == 0) ?
                '등록을 취소하시겠습니까?' :
                '수정을 취소하시겠습니까?';

            if (confirm(msg)) {
                self.close();
            }
        });

        //등록비 체크
        $.validator.addMethod('registGubunCheck', function (value, element) {
            let res = true;
            $("input[name='regist_gubun[]']").each(function(key, item) {
                if(isEmpty($(item).val())) {
                    res = false;
                    return res;
                }
            });
            return res;
        });
        $.validator.addMethod('registEarlyCheck', function (value, element) {
            let res = true;
            $("input[name='regist_early[]']").each(function(key, item) {
                if(isEmpty($(item).val())) {
                    res = false;
                    return res;
                }
            });
            return res;
        });
        $.validator.addMethod('registOnsiteCheck', function (value, element) {
            let res = true;
            $("input[name='regist_onsite[]']").each(function(key, item) {
                if(isEmpty($(item).val())) {
                    res = false;
                    return res;
                }
            });
            return res;
        });

        defaultVaildation();

        // 게시판 폼 체크
        $(form).validate({
            ignore: ['content', 'popup_content'],
            rules: {
                hide: {
                    checkEmpty: true,
                },
                detail: {
                    checkEmpty: true,
                },
                category: {
                    isEmpty: true,
                },
                subject: {
                    isEmpty: true,
                },
                event_sdate: {
                    isEmpty: true,
                },
                event_edate: {
                    isEmpty: true,
                },
                place: {
                    isEmpty: true,
                },
                contact_name: {
                    isEmpty: true,
                },
                contact_tel: {
                    isEmpty: true,
                },
                contact_email: {
                    isEmpty: true,
                },
                invite_text: {
                    isTinyEmpty: true,
                },
                schedule_text: {
                    isTinyEmpty: true,
                },
                //사전등록 사용유무
                regist_yn: {
                    checkEmpty: true,
                },
                regist_sdate: {
                    required: {
                        depends: function(element) {
                            return $("input[name='regist_yn']:checked").val()==='Y';
                        }
                    },
                },
                limit_yn: {
                    required: {
                        depends: function(element) {
                            return $("input[name='regist_yn']:checked").val()==='Y';
                        }
                    },
                },
                limit_person: {
                    required: {
                        depends: function(element) {
                            return $("input[name='limit_yn']:checked").val()==='Y';
                        }
                    },
                },
                res_authority: {
                    required: {
                        depends: function(element) {
                            return $("input[name='regist_yn']:checked").val()==='Y';
                        }
                    },
                },
                res_authority_etc: {
                    required: {
                        depends: function(element) {
                            return $("input[name='res_authority']:checked").val()==='4';
                        }
                    },
                },
                "regist_gubun[]" : {
                    registGubunCheck: {
                        depends: function(element) {
                            return $("input[name='regist_yn']:checked").val()==='Y';
                        }
                    },
                },
                "regist_early[]" : {
                    registEarlyCheck: {
                        depends: function(element) {
                            return $("input[name='regist_yn']:checked").val()==='Y';
                        }
                    },
                },
                "regist_onsite[]" : {
                    registOnsiteCheck: {
                        depends: function(element) {
                            return $("input[name='regist_yn']:checked").val()==='Y';
                        }
                    },
                },
                account: {
                    required: {
                        depends: function(element) {
                            return $("input[name='regist_yn']:checked").val()==='Y';
                        }
                    },
                },

                //초록접수 사용유무
                abs_yn: {
                    checkEmpty: true,
                },
                abs_sdate: {
                    required: {
                        depends: function(element) {
                            return $("input[name='abs_yn']:checked").val()==='Y';
                        }
                    },
                },
                abs_authority: {
                    checkEmpty: {
                        depends: function(element) {
                            return $("input[name='abs_yn']:checked").val()==='Y';
                        }
                    },
                },
                "abs_gubun[]": {
                    checkEmpty: {
                        depends: function(element) {
                            return $("input[name='abs_yn']:checked").val()==='Y';
                        }
                    },
                },
            },
            messages: {
                hide: {
                    checkEmpty: '공개여부를 체크해주세요.',
                },
                detail: {
                    checkEmpty: '상세보기여부를 체크해주세요.',
                },
                category: {
                    isEmpty: '행사구분을 선택해주세요.',
                },
                subject: {
                    isEmpty: '행사명을 입력해주세요.',
                },
                event_sdate: {
                    isEmpty: '행사 기간 시작일을 입력해주세요.',
                },
                event_edate: {
                    isEmpty: '행사 기간 마감일을 입력해주세요.',
                },
                place: {
                    isEmpty: '행사 장소를 입력해주세요.',
                },
                contact_name: {
                    isEmpty: '문의처 이름을 입력해주세요.',
                },
                contact_tel: {
                    isEmpty: '문의처 TEL를 입력해주세요.',
                },
                contact_email: {
                    isEmpty: '문의처 E-mail를 입력해주세요.',
                },
                invite_text: {
                    isTinyEmpty: '초대의 글을 입력해주세요.',
                },
                schedule_text: {
                    isTinyEmpty: '행사 일정을 입력해주세요.',
                },
                regist_yn: {
                    checkEmpty: '사전등록 사용을 선택해주세요.',
                },
                regist_sdate: {
                    required: '사전등록 시작일을 입력해주세요.',
                },
                limit_yn: {
                    required: '선착순 등록 사용유무를 선택해주세요.',
                },
                limit_person: {
                    required: '선착순 등록 제한 인원을 입력해주세요.',
                },
                res_authority: {
                    required: '사전등록 신청권한을 선택해주세요.',
                },
                res_authority_etc: {
                    required: '사전등록 신청권한 연구회 회원 전용등록을 입력해주세요.',
                },
                "regist_gubun[]" : {
                    registGubunCheck: '등록 구분을 입력해주세요.',
                },
                "regist_early[]" : {
                    registEarlyCheck: '사전 등록비를 입력해주세요.',
                },
                "regist_onsite[]" : {
                    registOnsiteCheck: '현장 등록비를 입력해주세요.',
                },
                account: {
                    required: '입금계좌를 입력해주세요.',
                },

                abs_yn: {
                    checkEmpty: '초록접수 사용을 선택해주세요.',
                },
                abs_sdate: {
                    required: '초록접수 시작일을 입력해주세요.',
                },
                abs_authority: {
                    checkEmpty: '초록접수 신청 권한을 체크해주세요.',
                },
                "abs_gubun[]": {
                    checkEmpty: '초록접수 구분을 체크해주세요.',
                },
            },
            submitHandler: function() {

                registerSubmit();
            }
        });

        const registerSubmit = () => {
            let ajaxData = newFormData($(form));
            ajaxData.append('invite_text', tinymce.get('invite_text').getContent());
            // ajaxData.append('plupload_file', JSON.stringify(plupladFile));

            callMultiAjax(dataUrl, ajaxData);
        }
    </script>
@endsection
