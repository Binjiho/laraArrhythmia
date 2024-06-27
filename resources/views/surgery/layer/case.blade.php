<div id="layerArea" style="position:relative;">
    <div class="popup-wrap full" id="layer_pop" style="display: block;">
        <div class="popup-contents">
            <div class="popup-conbox">
                <div class="sub-contit-wrap mt-0">
                    <h4 class="sub-contit">증례 추가</h4>
                </div>
                <div class="write-form-wrap">
                    <form id="case-frm" data-sid="{{ $case->sid ?? 0 }}" data-case="case-{{ empty($case->sid) ? 'create' : 'update' }}" onsubmit="return false;">
{{--                        <input type="hidden" name="surgery_sid" value="{{ $case->surgery_sid ?? 0 }}">--}}
                        <fieldset>
                            <legend class="hide">경력 추가 등록</legend>
                            <div class="write-wrap">
                                <dl>
                                    <dt>구분</dt>
                                    <dd>
                                        <div class="radio-wrap cst">
                                            @foreach($surgeryConfig['case_gubun'] as $key => $val)
                                                <div class="radio-group">
                                                    <input type="radio" name="gubun" id="gubun_{{$key}}" value="{{$key}}" {{ ($case->gubun ?? '')==$key ? 'checked':'' }}>
                                                    <label for="gubun_{{$key}}">{{$val}}</label>
                                                </div>
                                            @endforeach
                                        </div>
                                    </dd>
                                </dl>
                                <dl>
                                    <dt>환자명</dt>
                                    <dd>
                                        <input type="text" name="name" id="name" value="{{ $case->name ?? '' }}" class="form-item">
                                    </dd>
                                </dl>
                                <dl>
                                    <dt>나이</dt>
                                    <dd>
                                        <input type="text" name="age" id="age" value="{{ $case->age ?? '' }}" class="form-item" onlyNumber>
                                    </dd>
                                </dl>
                                <dl>
                                    <dt>성별</dt>
                                    <dd>
                                        <div class="radio-wrap cst">
                                            @foreach($surgeryConfig['case_gender'] as $key => $val)
                                                <div class="radio-group">
                                                    <input type="radio" name="gender" id="gender_{{$key}}" value="{{$key}}" {{ ($case->gender ?? '')==$key ? 'checked':'' }}>
                                                    <label for="gender_{{$key}}">{{$val}}</label>
                                                </div>
                                            @endforeach
                                        </div>
                                    </dd>
                                </dl>
                                <dl>
                                    <dt>병적번호</dt>
                                    <dd>
                                        <input type="text" name="num" id="num" value="{{ $case->num ?? '' }}" class="form-item">
                                    </dd>
                                </dl>
                                <dl>
                                    <dt>진단명</dt>
                                    <dd>
                                        <input type="text" name="title" id="title" value="{{ $case->title ?? '' }}" class="form-item">
                                    </dd>
                                </dl>
                                <dl>
                                    <dt>시술일</dt>
                                    <dd>
                                        <div class="form-group form-group-text">
                                            <input type="text" name="date" id="date" class="form-item" value="{{ $case->date ?? '' }}" datepicker readonly>
                                        </div>
                                    </dd>
                                </dl>
                                <dl>
                                    <dt>내용</dt>
                                    <dd>
                                        <textarea name="content" id="content" cols="30" rows="10" class="form-item">{{ $case->content ?? '' }}</textarea>
                                    </dd>
                                </dl>
                            </div>

                            <div class="btn-wrap text-center">
                                <a href="javascript:void(0);" class="btn btn-type1 color-type4" onclick="caseClose()">닫기</a>
                                <button type="submit" class="btn btn-type1 color-type18">{{ empty($case->sid) ? '등록' : '수정' }}</button>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        callDatePicker();

        const caseForm = '#case-frm';

        // 게시글 작성 취소
        function caseClose(){
            const msg = ($(caseForm).data('sid') == 0) ?
                '등록을 취소하시겠습니까?' :
                '수정을 취소하시겠습니까?';

            if (confirm(msg)) {
                $('#layerArea').remove();
            }
        }

        $(caseForm).validate({
            rules: {
                gubun: {
                    checkEmpty: true,
                },
                name: {
                    isEmpty: true,
                },
                age: {
                    isEmpty: true,
                },
                gender: {
                    checkEmpty: true,
                },
                num: {
                    isEmpty: true,
                },
                title: {
                    isEmpty: true,
                },
                date: {
                    isEmpty: true,
                },
                content: {
                    isEmpty: true,
                },
            },
            messages: {
                gubun: {
                    checkEmpty: '구분을 체크해주세요.',
                },
                name: {
                    isEmpty: '환자명을 입력해주세요.',
                },
                age: {
                    isEmpty: '나이를 입력해주세요.',
                },
                gender: {
                    checkEmpty: '성별을 체크해주세요.',
                },
                num: {
                    isEmpty: '병적번호를 입력해주세요.',
                },
                title: {
                    isEmpty: '진단명을 입력해주세요.',
                },
                date: {
                    isEmpty: '시술일을 입력해주세요.',
                },
                content: {
                    isEmpty: '내용을 입력해주세요.',
                },
            },
            submitHandler: function () {
                registerSubmit();
            }
        });

        const registerSubmit = () => {
            let ajaxData = newFormData(caseForm);
            callMultiAjax(dataUrl, ajaxData);
        }
    </script>

</div>