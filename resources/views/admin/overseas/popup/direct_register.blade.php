@extends('admin.layouts.pop-layout')

@section('addStyle')
@endsection

@section('contents')
    <div class="popup-wrap full" style="display: block;">
        <div class="popup-contents">
            <div class="popup-conbox">
                <h1>신청자 추가 등록</h1>
                <div id="board" class="event-wrap board-wrap">
                    <div class="board-write">

                        <div class="search-form-wrap">
                            <form id="board-frm" data-sid="" data-case="" onsubmit="return false;">
                                <input type="hidden" name="user_sid" id="user_sid" value="{{ empty($user->sid) ? '' : $user->sid }}">
                                <input type="hidden" name="csid" id="csid" value="{{ empty($conference->csid) ? request()->csid : $conference->sid }}">
                                <input type="hidden" name="overseas_sid" id="overseas_sid" value="">

                                <fieldset>
                                    <legend class="hide">심사자 등록</legend>
                                    <div class="write-wrap">
                                        <dl>
                                            <dt>아이디</dt>
                                            <dd>
                                                <div class="form-group form-group-text n2">
                                                    <input type="text" name="uid" id="uid" class="form-item" value="{{ empty($user->sid) ? '' : $user->uid }}">
                                                    <a href="javascript:void(0);" class="btn btn-small color-type2" id="uid_chk">검색</a>
                                                </div>
                                            </dd>
                                        </dl>

                                        <dl>
                                            <dt>참가신청 국제학술대회</dt>
                                            <dd>
                                                {{ $conference->subject ?? '' }}
                                            </dd>
                                        </dl>

                                        <dl>
                                            <dt>주관기관</dt>
                                            <dd>

                                            </dd>
                                        </dl>

                                        <dl>
                                            <dt>개최장소</dt>
                                            <dd>
                                                {{ $conference->place ?? '' }}
                                            </dd>
                                        </dl>

                                    </div>

                                </fieldset>
                            </form>
                        </div>

                        <div class="write-form-wrap" style="margin-top: 20px; display: {{ empty($user->sid) ? 'none' : 'block' }}">
                            @include('overseas.form.reg')
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection

@section('addScript')
    <script>
        const form = '#register-frm';
        const dataUrl = '{{ route('overseas.data') }}';

        function closeWindow(){
            if (confirm('취소 하시겠습니까?')) {
                window.close();
            }
        }

        $(document).on('click', '#uid_chk', function() {
            const uid = $('input[name=uid]').val();

            let obj = {
                'case': 'uid-check',
                'uid': uid,
                'csid': $("input[name='csid']").val(),
            };

            if(isEmpty(uid)) {
                obj.msg = '아이디를 입력해주세요.';
                actionAlert(obj);
                return;
            }

            callAjax(dataUrl, obj);
        });

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

        // 게시판 폼 체크
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
            ajaxData.append('user_sid',$("input[name='user_sid']").val());
            // ajaxData.user_sid = $("input[name='user_sid']").val();
            callMultiAjax(dataUrl, ajaxData);
        }
    </script>
@endsection
