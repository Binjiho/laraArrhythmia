@extends('admin.layouts.pop-layout')

@section('addStyle')

@endsection

@section('contents')
    <div class="popupWrap" id="popupAdmin" style="width: 100%;">
        <div class="popupCon">
            <div class="formArea">
                <form method="post" action="{{ route('mail.data') }}" id="mail-frm" data-sid="{{ $data->sid ?? 0 }}" data-case="mail-customResend" onsubmit="return false;">
                    <input type="hidden" name="template" id="template" value="{{ $template ?? '' }}">
                    <fieldset>
                        <table class="inputTbl" style="width:650px;max-width:650px;margin: 0 auto;padding:0;border:1px solid #ddd; border-collapse: collapse;border-spacing:0;">
                            <tbody>

                            <tr>
                                <td style="padding: 45px 20px 0;font-family: 'Malgun Gothic', '맑은고딕', '돋움', 'dotum', sans-serif;font-size:22px;font-weight: bold;line-height:1.2;text-align: center;color:#282828;letter-spacing: -1px;">
                                    {!! $data->subject !!}
                                </td>
                            </tr>

                            <tr>
                                <td style="padding: 40px;color: #2a2a66;font-size: 14px;line-height: 25px;font-family: 'Malgun Gothic', '맑은고딕', '돋움', 'dotum', sans-serif;">
                                    {!! $data->contents !!}
                                </td>
                            </tr>

                            </tbody>
                        </table>

                        발송이메일: <input type="text" name="test_email" id="test_email" value="{{ $mail->test_email ?? '' }}">

                        <div class="btnArea btn">
{{--                            발송이메일: <input type="text" name="test_email" id="test_email" value="{{ $mail->test_email ?? '' }}">--}}
                            <input type="submit" value="메일발송" data-use_send="Y" class="btnDef">
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('addScript')
    <script>
        const form = '#mail-frm';
        const dataUrl = '{{ route('mail.data') }}';

        defaultVaildation();

        $(form).validate({
            ignore: ['contents'],
            rules: {
                test_email: {
                    isEmpty: true,
                },
            },
            messages: {
                test_email: {
                    isEmpty: '발송이메일을 입력해주세요.',
                },
            },
            submitHandler: function () {
                let ajaxData = newFormData(form);
                ajaxData.append('template', $("input[name='template']").val());

                callMultiAjax(dataUrl, ajaxData);
            }
        });
    </script>
@endsection
