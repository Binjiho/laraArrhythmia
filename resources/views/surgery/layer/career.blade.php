
<div id="layerArea" style="position:relative;">
    <div class="popup-wrap full" id="layer_pop" style="display: block;">

        <div class="popup-contents">
            <div class="popup-conbox">
                <div class="sub-contit-wrap mt-0">
                    <h4 class="sub-contit">경력 추가</h4>
                </div>
                <div class="write-form-wrap">
                    <form id="career-frm" data-sid="{{ $career->sid ?? 0 }}" data-case="career-{{ empty($career->sid) ? 'create' : 'update' }}" onsubmit="return false;">
{{--                        <input type="hidden" name="surgery_sid" value="{{ $career->surgery_sid ?? 0 }}">--}}
                        <fieldset>
                            <legend class="hide">경력 추가 등록</legend>
                            <div class="write-wrap">
                                <dl>
                                    <dt>구분</dt>
                                    <dd>
                                        <div class="radio-wrap cst">
                                            @foreach($surgeryConfig['career_gubun'] as $key => $val)
                                                <div class="radio-group">
                                                    <input type="radio" name="gubun" id="gubun_{{$key}}" value="{{$key}}" {{ ($career->gubun ?? '')==$key ? 'checked':'' }}>
                                                    <label for="gubun_{{$key}}">{{$val}}</label>
                                                </div>
                                            @endforeach
                                        </div>
                                    </dd>
                                </dl>
                                <dl>
                                    <dt>기간</dt>
                                    <dd>
                                        <div class="form-group form-group-text n2">
                                            <input type="text" name="sdate" id="sdate" class="form-item" value="{{ $career->sdate ?? '' }}" readonly datepicker>
                                            <span class="text">~</span>
                                            <input type="text" name="edate" id="edate" class="form-item" value="{{ $career->edate ?? '' }}" readonly datepicker>
                                        </div>
                                    </dd>
                                </dl>
                                <dl>
                                    <dt>기관명</dt>
                                    <dd>
                                        <input type="text" name="title" id="title" value="{{ $career->title ?? '' }}" class="form-item">
                                    </dd>
                                </dl>
                                <dl>
                                    <dt>내용</dt>
                                    <dd>
                                        <textarea name="content" id="content" cols="30" rows="10" class="form-item">{{ $career->content ?? '' }}</textarea>
                                    </dd>
                                </dl>
                            </div>

                            <div class="btn-wrap text-center">

                                <a href="javascript:void(0);" class="btn btn-type1 color-type4" onclick="careerClose()">닫기</a>
                                <button type="submit" id="career_submit" class="btn btn-type1 color-type18">{{ empty($career->sid) ? '등록' : '수정' }}</button>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        callDatePicker();

        const careerForm = '#career-frm';

        // 게시글 작성 취소
        function careerClose(){
            const msg = ($(careerForm).data('sid') == 0) ?
                '등록을 취소하시겠습니까?' :
                '수정을 취소하시겠습니까?';

            if (confirm(msg)) {
                $('#layerArea').remove();
            }
        }
        
        $(careerForm).validate({
            rules: {
                gubun: {
                    checkEmpty: true,
                },
                sdate: {
                    isEmpty: true,
                },
                edate: {
                    isEmpty: true,
                },
                title: {
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
                sdate: {
                    isEmpty: '기간 시작일을 입력해주세요.',
                },
                edate: {
                    isEmpty: '기간 마감일을 입력해주세요.',
                },
                title: {
                    isEmpty: '기관명을 입력해주세요.',
                },
                content: {
                    isEmpty: '내용을 입력해주세요.',
                },
            },
            submitHandler: function () {
                careerSubmit();
            }
        });

        const careerSubmit = () => {
            let ajaxData = newFormData(careerForm);
            callMultiAjax(dataUrl, ajaxData);
        }
    </script>

</div>