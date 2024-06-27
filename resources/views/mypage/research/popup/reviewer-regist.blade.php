@extends('layouts.pop-layout')

@section('addStyle')
    <link type="text/css" rel="stylesheet" href="{{ asset('plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}"/>
@endsection

@section('contents')
    <div class="popup-wrap full" style="display: block;">
        <div class="popup-contents">
            <div class="popup-conbox popup-research-conbox">
                <div class="write-form-wrap">
                    <form action="{{ route('research.data') }}" method="post" data-sid="{{ $result->sid ?? 0 }}" data-case="research-result-create" id="register-frm" onsubmit="return false;" enctype="multipart/form-data">
                    <input type="hidden" name="tot_score" id="tot_score" value="{{ $result->tot_score ?? 0 }}">
                    <input type="hidden" name="tot_avg" id="tot_avg" value="{{ $result->tot_avg ?? 0 }}">
                    <input type="hidden" name="state" id="state" value="N">

                        <fieldset>
                            <legend class="hide">심사하기</legend>
                            <div class="write-wrap">
                                <dl>
                                    <dt>연구 과제명</dt>
                                    <dd>
                                        {{ $research->subject ?? '' }}
                                    </dd>
                                </dl>
                                <dl>
                                    <dt>책임 연구자</dt>
                                    <dd>
                                        {{ $research->name ?? '' }}
                                    </dd>
                                </dl>
                                <dl>
                                    <dt>연구기간</dt>
                                    <dd>
                                        {{ $research->sdate ?? '' }} - {{ $research->edate ?? '' }}
                                    </dd>
                                </dl>
                                <dl>
                                    <dt>과제구분</dt>
                                    <dd>
                                        1년 과제
                                    </dd>
                                </dl>
                                <dl>
                                    <dt>총연구비</dt>
                                    <dd>
                                        {{ $research->tot_price ?? '' }}
                                    </dd>
                                </dl>
                                <dl>
                                    <dt>내용</dt>
                                    <dd>
                                        {{ $research->content ?? '' }}
                                    </dd>
                                </dl>
                                <dl>
                                    <dt>신청서</dt>
                                    <dd>
                                        @if (!empty($research->file_path1))
                                            <div class="attach-file">
                                                <a href="{{ $research->downloadFileUrl('file_path1', 'file_name1') }}" class="link">{{$research->file_name1}}</a>
                                            </div>
                                        @endif
                                    </dd>
                                </dl>
                                <dl>
                                    <dt>추천서</dt>
                                    <dd>
                                        @if (!empty($research->file_path2))
                                            <div class="attach-file">
                                                <a href="{{ $research->downloadFileUrl('file_path2', 'file_name2') }}" class="link">{{$research->file_name2}}</a>
                                            </div>
                                        @endif
                                    </dd>
                                </dl>
                                <dl>
                                    <dt>이력서</dt>
                                    <dd>
                                        @if (!empty($research->file_path3))
                                            <div class="attach-file">
                                                <a href="{{ $research->downloadFileUrl('file_path3', 'file_name3') }}" class="link">{{$research->file_name3}}</a>
                                            </div>
                                        @endif
                                    </dd>
                                </dl>
                                <dl>
                                    <dt>업무업적</dt>
                                    <dd>
                                        @if (!empty($research->file_path4))
                                            <div class="attach-file">
                                                <a href="{{ $research->downloadFileUrl('file_path4', 'file_name4') }}" class="link">{{$research->file_name4}}</a>
                                            </div>
                                        @endif
                                    </dd>
                                </dl>
                                <dl>
                                    <dt>연구계획서</dt>
                                    <dd>
                                        @if (!empty($research->file_path5))
                                            <div class="attach-file">
                                                <a href="{{ $research->downloadFileUrl('file_path5', 'file_name5') }}" class="link">{{$research->file_name5}}</a>
                                            </div>
                                        @endif
                                    </dd>
                                </dl>
                            </div>

                            <div class="sub-contit-wrap">
                                <h4 class="sub-contit">결과보고</h4>
                            </div>
                            <div class="write-wrap">
                                <dl>
                                    <dt>중간보고</dt>
                                    <dd>
                                        @if (!empty($research->file_path6))
                                            <div class="attach-file">
                                                <a href="{{ $research->downloadFileUrl('file_path6', 'file_name6') }}" class="link">{{$research->file_name6}}</a>
                                            </div>
                                        @endif
                                    </dd>
                                </dl>
                                <dl>
                                    <dt>결과보고</dt>
                                    <dd>
                                        @if (!empty($research->file_path7))
                                            <div class="attach-file">
                                                <a href="{{ $research->downloadFileUrl('file_path7', 'file_name7') }}" class="link">{{$research->file_name7}}</a>
                                            </div>
                                        @endif
                                    </dd>
                                </dl>
                            </div>

                            <div class="sub-contit-wrap">
                                <h4 class="sub-contit">심사내용</h4>
                            </div>
                            <div class="table-wrap write-wrap">
                                <table class="cst-table">
                                    <caption class="hide">심사내용</caption>
                                    <colgroup>
                                        <col style="width: 30%;">
                                        <col>
                                    </colgroup>
                                    <thead>
                                    <tr>
                                        <th scope="col">항목</th>
                                        <th scope="col">점수</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <th scope="row">연구자의 연구력(논문)</th>
                                        <td class="text-left">
                                            <div class="radio-wrap cst">
                                                @for($i=1; $i<=6; $i++)
                                                <div class="radio-group">
                                                    <input type="radio" name="score1" id="score1_{{$i}}" value="{{ 6-$i }}" {{ ($result->score1 ?? '') == 6-$i ? 'checked':'' }}>
                                                    <label for="score1_{{$i}}">{{ (6-$i == 0 ? '점수없음':6-$i) }}</label>
                                                </div>
                                                @endfor
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">연구계획의 실현가능성</th>
                                        <td class="text-left">
                                            <div class="radio-wrap cst">
                                                @for($i=1; $i<=6; $i++)
                                                    <div class="radio-group">
                                                        <input type="radio" name="score2" id="score2_{{$i}}" value="{{ 6-$i }}" {{ ($result->score2 ?? '') == 6-$i ? 'checked':'' }}>
                                                        <label for="score2_{{$i}}">{{ (6-$i == 0 ? '점수없음':6-$i) }}</label>
                                                    </div>
                                                @endfor
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">연구계획의 논리/학문적 중요성</th>
                                        <td class="text-left">
                                            <div class="radio-wrap cst">
                                                @for($i=1; $i<=6; $i++)
                                                    <div class="radio-group">
                                                        <input type="radio" name="score3" id="score3_{{$i}}" value="{{ 6-$i }}" {{ ($result->score3 ?? '') == 6-$i ? 'checked':'' }}>
                                                        <label for="score3_{{$i}}">{{ (6-$i == 0 ? '점수없음':6-$i) }}</label>
                                                    </div>
                                                @endfor
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">연구방법의 적절성/윤리성(IRB)</th>
                                        <td class="text-left">
                                            <div class="radio-wrap cst">
                                                @for($i=1; $i<=6; $i++)
                                                    <div class="radio-group">
                                                        <input type="radio" name="score4" id="score4_{{$i}}" value="{{ 6-$i }}" {{ ($result->score4 ?? '') == 6-$i ? 'checked':'' }}>
                                                        <label for="score4_{{$i}}">{{ (6-$i == 0 ? '점수없음':6-$i) }}</label>
                                                    </div>
                                                @endfor
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">연구비 예산의 적절성</th>
                                        <td class="text-left">
                                            <div class="radio-wrap cst">
                                                @for($i=1; $i<=6; $i++)
                                                    <div class="radio-group">
                                                        <input type="radio" name="score5" id="score5_{{$i}}" value="{{ 6-$i }}" {{ ($result->score5 ?? '') == 6-$i ? 'checked':'' }}>
                                                        <label for="score5_{{$i}}">{{ (6-$i == 0 ? '점수없음':6-$i) }}</label>
                                                    </div>
                                                @endfor
{{--                                                <div class="radio-group">--}}
{{--                                                    <input type="radio" name="score5" id="score5_1">--}}
{{--                                                    <label for="score5_1">5</label>--}}
{{--                                                </div>--}}
{{--                                                <div class="radio-group">--}}
{{--                                                    <input type="radio" name="score5" id="score5_2">--}}
{{--                                                    <label for="score5_2">4</label>--}}
{{--                                                </div>--}}
{{--                                                <div class="radio-group">--}}
{{--                                                    <input type="radio" name="score5" id="score5_3">--}}
{{--                                                    <label for="score5_3">3</label>--}}
{{--                                                </div>--}}
{{--                                                <div class="radio-group">--}}
{{--                                                    <input type="radio" name="score5" id="score5_4">--}}
{{--                                                    <label for="score5_4">2</label>--}}
{{--                                                </div>--}}
{{--                                                <div class="radio-group">--}}
{{--                                                    <input type="radio" name="score5" id="score5_5">--}}
{{--                                                    <label for="score5_5">1</label>--}}
{{--                                                </div>--}}
{{--                                                <div class="radio-group">--}}
{{--                                                    <input type="radio" name="score5" id="score5_6">--}}
{{--                                                    <label for="score5_6">점수없음</label>--}}
{{--                                                </div>--}}
                                            </div>
                                        </td>
                                    </tr>
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th scope="row">총점</th>
                                        <td class="text-center" id="tot_score_html">
                                            {{ $result->tot_score ?? '0' }}점
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">평균</th>
                                        <td class="text-center" id="avg_score_html">
                                            {{ $result->tot_avg ?? '0' }}점
                                        </td>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>

                            <div class="sub-contit-wrap">
                                <h4 class="sub-contit">심사평</h4>
                            </div>
                            <div class="write-wrap">
                                <textarea name="memo" id="memo" cols="30" rows="10" class="form-item">{{ $result->memo ?? '' }}</textarea>
                            </div>

                            <div class="btn-wrap text-center">
                                <a href="javascript:;" onclick="submit_create()" class="btn btn-type1 color-type18">등록</a>
                                <a href="javascript:;" onclick="submit_regist()" class="btn btn-type1 color-type13">심사완료</a>
                                <a href="javascript:;" onclick="self.close();" class="btn btn-type1 color-type4">닫기</a>

                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('addScript')
    <script src="{{ asset('plugins/jquery-validation/jquery.validate.min.js') }}"></script>
    <script>
        const form = '#register-frm';
        const dataUrl = "{{ route('research.data') }}";

        function submit_create(){
            if(confirm("등록 하시겠습니까? 심사 최종 제출을 원하시는 경우 심사완료 버튼을 클릭해 주셔야 심사가 완료됩니다.")){
                $("#state").val('N');
                $("#register-frm").submit();
            }else{
                return false;
            }
        }

        function submit_regist(){
            if(confirm("심사를 완료 하시겠습니까? 이후 심사 내용은 수정하실 수 없습니다.")){
                $("#state").val('Y');
                $("#register-frm").submit();
            }else{
                return false;
            }
        }

        $(document).on('click', $("input[name^='score']"), function() {
            let tot_score = avg_scroe = 0;
            $("input[name^='score']:checked").each(function(index, item) {
                const score = $(item).val();
                tot_score += parseInt(score);
                // if (!isEmpty(pay) && pay != 0) {
                // }
            })
            avg_scroe = tot_score/5;
            $('#tot_score').val(tot_score);
            $('#tot_avg').val(avg_scroe);
            $('#tot_score_html').html(tot_score+'점');
            $('#avg_score_html').html(avg_scroe+'점');
        });

        defaultVaildation();

        $(form).validate({
            rules: {
                score1: {
                    checkEmpty: true,
                },
                score2: {
                    checkEmpty: true,
                },
                score3: {
                    checkEmpty: true,
                },
                score4: {
                    checkEmpty: true,
                },
                score5: {
                    checkEmpty: true,
                },
            },
            messages: {
                score1: {
                    checkEmpty: '점수를 입력해주세요.',
                },
                score2: {
                    checkEmpty: '점수를 입력해주세요.',
                },
                score3: {
                    checkEmpty: '점수를 입력해주세요.',
                },
                score4: {
                    checkEmpty: '점수를 입력해주세요.',
                },
                score5: {
                    checkEmpty: '점수를 입력해주세요.',
                },
            },
            submitHandler: function () {
                registerSubmit();
            }
        });

        const registerSubmit = () => {
            let ajaxData = newFormData(form);
            // if($("input[name='mypage']").val()=='Y'){
            //     ajaxData.case = 'overseas-mypage-update';
            // }
            callMultiAjax(dataUrl, ajaxData);
        }

    </script>
@endsection
