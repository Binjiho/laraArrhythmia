@extends('layouts.pop-layout')

@section('addStyle')
    <link type="text/css" rel="stylesheet" href="{{ asset('plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}"/>
@endsection

@section('contents')
<div class="popup-wrap full" style="display: block;">
    <div class="popup-contents">
        <div class="popup-conbox popup-research-conbox">
            <div class="write-form-wrap">
                <form action="{{ route('research.data') }}" method="post" data-sid="{{ $research->sid ?? 0 }}" data-case="research-report-file" id="register-frm" onsubmit="return false;" enctype="multipart/form-data">
                    <fieldset>
                        <legend class="hide">연구 지원 자세히보기</legend>

                        <div class="sub-contit-wrap mt-0">
                            <h4 class="sub-contit">결과보고</h4>
                        </div>
                        <div class="write-wrap">
                            <dl>
                                <dt>중간보고</dt>
                                <dd>
                                    <div class="filebox">
                                        <input class="upload-name form-item" id="fileName6" name="fileName6" value="{{ $research->file_name6 ?? '' }}" placeholder="파일첨부" readonly="readonly">
                                        <label for="file6">파일첨부</label>
                                        <input type="file" id="file6" name="file6" class="file-upload" value="" accept=".pdf" data-accept="pdf" onchange="fileCheck(this,$('#fileName6'))">
                                        @if (!empty($research->file_path6))
                                            <div class="attach-file">
                                                <a href="{{ $research->downloadFileUrl('file_path6', 'file_name6') }}" class="link">{{$research->file_name6}}</a>
                                            </div>
                                        @endif
                                    </div>
                                    <a href="{{ route('staticDownload',['file_name'=>'중간보고서.hwp', 'file_path'=>'/assets/file/중간보고서.hwp']) }}" class="btn btn-type1 btn-small color-type13" >중간보고서 양식 다운로드</a>
                                    <a href="/assets/file/사유및변경승인신청서.hwp" class="btn btn-type1 btn-small color-type20" >사유서 및 변경승인신청서</a>
                                </dd>
                            </dl>
                            <dl>
                                <dt>결과보고</dt>
                                <dd>
                                    <div class="filebox">
                                        <input class="upload-name form-item" id="fileName7" name="fileName7" value="{{ $research->file_name7 ?? '' }}" placeholder="파일첨부" readonly="readonly">
                                        <label for="file7">파일첨부</label>
                                        <input type="file" id="file7" name="file7" class="file-upload" value="" accept=".pdf" data-accept="pdf" onchange="fileCheck(this,$('#fileName7'))">
                                        @if (!empty($research->file_path7))
                                            <div class="attach-file">
                                                <a href="{{ $research->downloadFileUrl('file_path7', 'file_name7') }}" class="link">{{$research->file_name7}}</a>
                                            </div>
                                        @endif
                                    </div>
                                    <a href="/assets/file/결과보고서.hwp" class="btn btn-type1 btn-small color-type13" >결과보고서 양식 다운로드</a>
                                    <a href="/assets/file/사유및변경승인신청서.hwp" class="btn btn-type1 btn-small color-type20" >사유서 및 변경승인신청서</a>
                                </dd>
                            </dl>
                        </div>

                        <div class="btn-wrap text-center">
                            <a href="javascript:;" onclick="alert_close();" class="btn btn-type1 color-type4">닫기</a>
                            <button type="button" onclick="alert_post();" class="btn btn-type1 color-type18">등록</button>
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

        function alert_post(){
            if(confirm("등록 하시겠습니까?")){
                $("#register-frm").submit();
            }else{
                return false;
            }
        }

        function alert_close(){
            if(confirm("등록을 취소하시겠습니까?")){
                self.close();
            }else{
                return false;
            }
        }

        defaultVaildation();

        $(form).validate({
            rules: {
                fileName6: {
                    isEmpty: true,
                },
                fileName7: {
                    isEmpty: true,
                },
            },
            messages: {
                fileName6: {
                    isEmpty: '중간보고 파일을 첨부해주세요.',
                },
                fileName7: {
                    isEmpty: '결과보고 파일을 첨부해주세요.',
                },

            },
            submitHandler: function () {
                registerSubmit();
            }
        });

        const registerSubmit = () => {
            let ajaxData = newFormData(form);
            callMultiAjax(dataUrl, ajaxData);
        }

    </script>
@endsection
