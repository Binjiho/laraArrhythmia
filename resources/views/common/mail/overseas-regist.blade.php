<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>{{ env('APP_NAME') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>
<body style="margin: 0;padding: 0;">
<table style="width:650px;max-width:650px;margin: 0 auto;padding:0;border:1px solid #ddd;border-collapse: collapse;border-spacing:0;box-sizing:border-box;">
    <tbody>
    <tr>
        <td style="padding: 0;text-align: center;text-align: center;font-family: 'Malgun Gothic', '맑은고딕', '돋움', 'dotum', sans-serif;font-size: 20px;color: #050505;">
            <img src="{{ asset('assets/image/mail/mail_header.jpg') }}" alt="{{ env('APP_NAME') }} Korean Heart Rhythm Society" />
        </td>
    </tr>
    <tr>
        <td style="padding: 50px 50px 60px;font-size: 26px;line-height: 1.7;font-family: 'Malgun Gothic', '맑은고딕', '돋움', 'dotum', sans-serif;box-sizing:border-box;">
            <table style="width: 100%;border-collapse: collapse;border-spacing: 0;">
                <tbody>
                <tr>
                    <td style="font-family: 'Malgun Gothic', '맑은고딕', '돋움', 'dotum', sans-serif;font-size: 15px;font-weight: 400;color: #4d4d4d;line-height: 1.9;text-align: left;letter-spacing: -0.04em;">
                        안녕하세요, <br/>
                        {{ env('APP_NAME') }}입니다. <br/><br/>

                        <strong>{{ $data->conference_name }}</strong> 참가지원 신청이 완료되었습니다. <br/><br/>

                        선정 결과는 {{ $data->conference_result_date }} 에 안내드릴 예정입니다. <br/><br/>

                        학회에서 별도로 해외학술대회 참가지원 운영규정을 두고 객관적인 심사기준에 의거해 지원 대상자를 공정하게 선정하고 있으며,<br/>
                        한정된 재원으로 부득이하게 적은 인원을 선발해야 하는 경우가 있더라도 되도록 모든 회원에게 공평한 기회가 돌아갈 수 있도록 노력하겠습니다.<br/><br/>

                        제출한 서류 중 사실과 다를 경우 선정되더라도 추후에 취소될 수 있음을 미리 알려드리며,<br/>
                        해외학회 참가지원과 관련하여 문의사항이 있으실 경우 학회 사무국 담당자께(khrs9@k-hrs.org) 연락주시기 바랍니다.<br/>
                    </td>
                </tr>
                </tbody>
            </table>
        </td>
    </tr>
    <tr>
        <td>
            <img src="{{ asset('assets/image/mail/mail_footer.jpg') }}" alt="(우)04323 서울시 용산구 한강대로 372 센트레빌아스테리움 서울 A동 1604호.
                    TEL. 02-318-5416 | FAX. 02-318-5417 |E-mail. khrs@k-hrs.org. 대표자. 차태준 | 사업자등록번호. 227-82-66511. Copyright © 대한부정맥학회. All Rights Reserved." style="display: inline-block;border:0 none;vertical-align: top;" />
        </td>
    </tr>
    </tbody>
</table>
</body>
</html>