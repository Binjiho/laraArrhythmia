@extends('layouts.pop-layout')

@section('addStyle')
@endsection

@section('contents')
<div class="popup-wrap full" style="display: block;">
    <div class="popup-contents">
        <div class="popup-conbox popup-research-conbox">
            <div id="board" class="event-wrap board-wrap">
                <div class="board-write">
                    <div class="write-form-wrap">
                        <form id="board-frm" data-sid="{{ $conference->sid ?? 0 }}" data-case="conference-{{ empty($conference->sid) ? 'create' : 'update' }}" onsubmit="return false;">
                            <fieldset>
                                <legend class="hide">글쓰기</legend>
                                <div class="write-wrap">

                                    <dl>
                                        <dt>국제학술대회 명</dt>
                                        <dd>
                                            <input type="text" name="subject" id="subject" class="form-item" value="{{ $conference->subject ?? '' }}">
                                        </dd>
                                    </dl>

{{--                                    <dl>--}}
{{--                                        <dt>국가</dt>--}}
{{--                                        <dd>--}}
{{--                                            <div class="form-group form-group-text n2">--}}
{{--                                                <select name="ccode" id="ccode" class="form-item">--}}
{{--                                                    <option value="">선택</option>--}}
{{--                                                    @foreach($country_list as $country)--}}
{{--                                                        <option value="{{ $country->ci }}" {{ ($conference->ccode ?? '') == $country->ci ? 'selected' : '' }}>{{ $country->cn }}</option>--}}
{{--                                                    @endforeach--}}
{{--                                                </select>--}}
{{--                                            </div>--}}
{{--                                        </dd>--}}
{{--                                    </dl>--}}

                                    <dl>
                                        <dt>개최 장소</dt>
                                        <dd>
                                            <input type="text" name="place" id="place" value="{{ $conference->place ?? '' }}" class="form-item">
                                        </dd>
                                    </dl>

                                    <dl>
                                        <dt>선정인원</dt>
                                        <dd>
                                            <input type="text" name="limit_person" id="limit_person" value="{{ $conference->limit_person ?? '' }}" class="form-item" onlyNumber>
                                        </dd>
                                    </dl>

                                    <dl>
                                        <dt>개최 기간</dt>
                                        <dd>
                                            <div class="form-group form-group-text n2">
                                                <input type="text" name="event_sdate" id="event_sdate" class="form-item" value="{{ $conference->event_sdate ?? '' }}" readonly datepicker>
                                                <span class="text">~</span>
                                                <input type="text" name="event_edate" id="event_edate" class="form-item" value="{{ $conference->event_edate ?? '' }}" readonly datepicker>
                                            </div>
                                        </dd>
                                    </dl>

                                    <dl>
                                        <dt>신청 기간</dt>
                                        <dd>
                                            <div class="form-group form-group-text n2">
                                                <input type="text" name="regist_sdate" id="regist_sdate" class="form-item" value="{{ $conference->regist_sdate ?? '' }}" readonly datepicker>
                                                <span class="text">~</span>
                                                <input type="text" name="regist_edate" id="regist_edate" class="form-item" value="{{ $conference->regist_edate ?? '' }}" readonly datepicker>
                                            </div>
                                        </dd>
                                    </dl>

                                    <dl>
                                        <dt>결과보고 기간</dt>
                                        <dd>
                                            <div class="form-group form-group-text n2">
                                                <input type="text" name="result_sdate" id="result_sdate" class="form-item" value="{{ $conference->result_sdate ?? '' }}" readonly datepicker>
                                                <span class="text">~</span>
                                                <input type="text" name="result_edate" id="result_edate" class="form-item" value="{{ $conference->result_edate ?? '' }}" readonly datepicker>
                                            </div>
                                        </dd>
                                    </dl>

                                    <dl>
                                        <dt>결과 발표일</dt>
                                        <dd>
                                            <div class="form-group form-group-text n2">
                                                <input type="text" name="result_date" id="result_date" class="form-item" value="{{ $conference->result_date ?? '' }}" readonly datepicker>
                                            </div>
                                        </dd>
                                    </dl>

{{--                                    <dl>--}}
{{--                                        <dt><strong class="required">*</strong> 공개 여부</dt>--}}
{{--                                        <dd>--}}
{{--                                            <div class="radio-wrap cst">--}}
{{--                                                <div class="radio-group">--}}
{{--                                                    <input type="radio" name="hide" id="hide_Y" value="Y" {{ (($conference->hide ?? 'N') == 'Y') ? 'checked' : '' }}>--}}
{{--                                                    <label for="hide_Y">공개</label>--}}
{{--                                                </div>--}}
{{--                                                <div class="radio-group">--}}
{{--                                                    <input type="radio" name="hide" id="hide_N" value="N" {{ (($conference->hide ?? 'N') == 'N') ? 'checked' : '' }}>--}}
{{--                                                    <label for="hide_N">비공개</label>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </dd>--}}
{{--                                    </dl>--}}
                                </div>

                                <div class="btn-wrap text-center">
                                    <a href="javascript:void(0);" class="btn btn-type1 color-type4" id="board_cancel">취소</a>
                                    <button type="submit" class="btn btn-type1 color-type5">{{ empty($conference->sid) ? '등록' : '수정' }}</button>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('addScript')

{{--    @include("conference.script.default-script")--}}
    <script>
        const boardForm = '#board-frm';

        // //행사기간
        // $(document).on('click', 'input:radio[name="date_type"]', function() {
        //     if( $(this).val() == 'D'/*하루행사*/) {
        //         $('#event_edate').attr('disabled', 'disabled');
        //         $('#event_edate').val('');
        //     }else{
        //         $('#event_edate').attr('disabled', false);
        //     }
        // });

        // 게시글 작성 취소
        $(document).on('click', '#board_cancel', function(e) {
            e.preventDefault();

            const msg = ($(boardForm).data('sid') == 0) ?
                '등록을 취소하시겠습니까?' :
                '수정을 취소하시겠습니까?';

            if (confirm(msg)) {
                self.close();
            }
        });


        defaultVaildation();

        // 게시판 폼 체크
        $(boardForm).validate({
            ignore: ['content', 'popup_content'],
            rules: {
                name: {
                    isEmpty: true,
                },
                subject: {
                    isEmpty: true,
                },
                // category: {
                //     isEmpty: true,
                // },
                year: {
                    isEmpty: true,
                },
                // date_type: {
                //     isEmpty: true,
                // },
                event_sdate: {
                    isEmpty: true,
                },
                event_edate: {
                    isEmpty: true,
                },
                regist_sdate: {
                    isEmpty: true,
                },
                regist_edate: {
                    isEmpty: true,
                },
                result_sdate: {
                    isEmpty: true,
                },
                result_edate: {
                    isEmpty: true,
                },
                result_date: {
                    isEmpty: true,
                },
                // hide: {
                //     checkEmpty: true,
                // },
            },
            messages: {
                name: {
                    isEmpty: '작성자를 입력해주세요.',
                },
                subject: {
                    isEmpty: `국제학술대회명을 입력해주세요.`,
                },
                // category: {
                //     isEmpty: '구분을 선택해주세요.',
                // },
                year: {
                    isEmpty: '연도를 선택해주세요.',
                },
                // date_type: {
                //     isEmpty: '행사기간을 선택해주세요.',
                // },
                event_sdate: {
                    isEmpty: '개최 기간 시작날짜를 선택해주세요.',
                },
                event_edate: {
                    isEmpty: '개최 기간 마감날짜를 선택해주세요.',
                },
                regist_sdate: {
                    isEmpty: '신청기간 시작날짜를 선택해주세요.',
                },
                regist_edate: {
                    isEmpty: '신청기간 마감날짜를 선택해주세요.',
                },
                result_sdate: {
                    isEmpty: '결과보고 기간 시작날짜를 선택해주세요.',
                },
                result_edate: {
                    isEmpty: '결과보고 기간 마감날짜를 선택해주세요.',
                },
                result_date: {
                    isEmpty: '결과발표일 날짜를 선택해주세요.',
                },
                // hide: {
                //     checkEmpty: '공개여부를 체크해주세요.',
                // },
            },
            submitHandler: function() {

                boardSubmit();
            }
        });

        const boardSubmit = () => {
            let ajaxData = newFormData(boardForm);

            ajaxData.append('category','2');

            callMultiAjax('{{ route("overseas.data") }}', ajaxData);
        }
    </script>

@endsection