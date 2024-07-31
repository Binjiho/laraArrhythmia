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
        <td style="padding: 50px 50px 30px;font-size: 26px;line-height: 1.7;font-family: 'Malgun Gothic', '맑은고딕', '돋움', 'dotum', sans-serif;box-sizing:border-box;">
            <table style="width: 100%;border-collapse: collapse;border-spacing: 0;">
                <tbody>
                <tr>
                    <td style="font-family: 'Malgun Gothic', '맑은고딕', '돋움', 'dotum', sans-serif;font-size: 15px;font-weight: 400;color: #4d4d4d;line-height: 1.9;text-align: left;letter-spacing: -0.04em;">
                        안녕하세요, <br/>
                        {{ env('APP_NAME') }}입니다. <br/><br/>

                        <strong>{{ $data->conference_name ?? ''}}</strong> 참가지원 신청에 대한 심의 결과를 안내드립니다.<br/><br/>

                        금번에 많은 분께서 신청해주시어 사무국에서는 최대한 신청하신 모든 선생님을 지원하고자 노력하였으나 인원 제한으로 어려움이 있었습니다.<br/>
                        총 {{ $data->regist_person ?? 0 }}분 중 {{ $data->limit_person ?? 0 }}분께만 지원이 가능하게 되어 일부 선생님께는 지원 기회를 드리지 못하게 되었음을 너른 양해 부탁드립니다. <br/><br/>

                        선정 기준은 신청서 내에 안내된 우선순위 항목 외에도, 직전 해외학회 지원 선정 여부 및 1편의 초록에 신청한 2인 중 발표자가 아닌 경우 등을 고려하였습니다. <br/><br/>

                        <u>이에 해당 이메일을 받으신 선생님께서는 금번 <strong style="font-family: 'Malgun Gothic', '맑은고딕', '돋움', 'dotum', sans-serif;">{{ $data->conference_name ?? ''}} 참가지원 대상자</strong>로 <strong style="font-family: 'Malgun Gothic', '맑은고딕', '돋움', 'dotum', sans-serif;font-size: 15px;color: #0000ff;">미선정</strong>되었음을 알려드립니다. </u><br/><br/>

                        기다리고 있으셨을 답변을 드리지 못해 송구하며,
                        다시 한번 선생님의 너른 양해 부탁드립니다. <br/><br/>

                        관련하여 문의사항 있으실 경우 편히 말씀 주십시오.
                        감사합니다. <br/><br/>

                        {{ env('APP_NAME') }} <br/>
                        {{ env('APP_ALT') }} 배상
                    </td>
                </tr>
                </tbody>
            </table>
        </td>
    </tr>
    <tr>
        <td>
            <img src="{{ asset('assets/image/mail/mail_footer.jpg') }}" alt="(우)04323 서울시 용산구 한강대로 372 센트레빌아스테리움 서울 A동 1604호.
                    TEL. 02-318-5416 | FAX. 02-318-5417 |E-mail. khrs@k-hrs.org. 대표자. 차태준 | 사업자등록번호. 227-82-66511. Copyright © 대한부정맥학회. All Rights Reserved." style="display: inline-block;border:0 none;vertical-align: top;" />
        </td>
    </tr>
    </tbody>
</table>
</body>
</html>