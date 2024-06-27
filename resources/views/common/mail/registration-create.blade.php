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
                    <th scope="col" style="font-family: 'Malgun Gothic', '맑은고딕', '돋움', 'dotum', sans-serif;font-size: 28px;font-weight: 700;color: #144393;line-height: 1.2;text-align: center;letter-spacing: -0.05em;">
                        {{ $data->custom_subject }}
                    </th>
                </tr>
                <tr>
                    <th scope="col" style="padding-top: 10px;padding-bottom: 10px;font-family: 'Malgun Gothic', '맑은고딕', '돋움', 'dotum', sans-serif;font-size: 22px;font-weight: 700;color: #666c76;line-height: 1.2;text-align: center;letter-spacing: -0.05em;">
                        사전등록 접수가 완료 되었습니다.
                    </th>
                </tr>
                <tr>
                    <td style="padding-top: 10px;padding-bottom: 20px;font-family: 'Malgun Gothic', '맑은고딕', '돋움', 'dotum', sans-serif;font-size: 15px;color: #4d4d4d;line-height: 1.5;letter-spacing: -0.05em;text-align: center;">
                        사전등록비를 입금 해주셔야 사전등록이 최종 완료 됩니다. <br/>
                        <strong style="font-weight: 700;">{{ $data->custom_account }}</strong>
{{--                        <strong style="font-weight: 700;">우리은행 1005-403-444745 (예금주 : 대한부정맥학회)</strong>--}}
                    </td>
                </tr>
                <tr>
                    <td style="padding-top: 30px;">
                        <table style="width: 100%;border-collapse: collapse;border-spacing: 0;">
                            <colgroup>
                                <col style="width: 195px;">
                                <col style="width: 350px;">
                            </colgroup>
                            <tbody>
                            <tr>
                                <th scope="row" style="padding: 10px 15px;background-color: #f4f4f4;border-top: 1px solid #dddddd;border-bottom: 1px solid #dddddd;font-family: 'Malgun Gothic', '맑은고딕', '돋움', 'dotum', sans-serif;font-size: 14px;font-weight: 400;color: #444444;line-height: 1.3;text-align: center;">
                                    ID (E-mail)
                                </th>
                                <td style="padding: 10px 15px;border-top: 1px solid #dddddd;border-bottom: 1px solid #dddddd;border-left: 1px solid #dddddd;font-family: 'Malgun Gothic', '맑은고딕', '돋움', 'dotum', sans-serif;font-size: 14px;color: #444444;line-height: 1.3">
                                    {{ $data->uid ?? '' }}
                                </td>
                            </tr>
                            <tr>
                                <th scope="row" rowspan="2" style="padding: 10px 15px;background-color: #f4f4f4;border-top: 1px solid #dddddd;border-bottom: 1px solid #dddddd;font-family: 'Malgun Gothic', '맑은고딕', '돋움', 'dotum', sans-serif;font-size: 14px;font-weight: 400;color: #444444;line-height: 1.3;text-align: center;">
                                    성명
                                </th>
                                <td style="padding: 10px 15px;border-top: 1px solid #dddddd;border-bottom: 1px solid #dddddd;border-left: 1px solid #dddddd;font-family: 'Malgun Gothic', '맑은고딕', '돋움', 'dotum', sans-serif;font-size: 14px;color: #444444;line-height: 1.3">
                                    국문 : {{ $data->name_kr ?? '' }}
                                </td>
                            </tr>
                            <tr>
                                <td style="padding: 10px 15px;border-top: 1px solid #dddddd;border-bottom: 1px solid #dddddd;border-left: 1px solid #dddddd;font-family: 'Malgun Gothic', '맑은고딕', '돋움', 'dotum', sans-serif;font-size: 14px;color: #444444;line-height: 1.3">
                                    영문 : {{ $data->first_name ?? '' }} {{ $data->last_name ?? '' }}
                                </td>
                            </tr>
                            <tr>
                                <th scope="row" rowspan="2" style="padding: 10px 15px;background-color: #f4f4f4;border-top: 1px solid #dddddd;border-bottom: 1px solid #dddddd;font-family: 'Malgun Gothic', '맑은고딕', '돋움', 'dotum', sans-serif;font-size: 14px;font-weight: 400;color: #444444;line-height: 1.3;text-align: center;">
                                    소속
                                </th>
                                <td style="padding: 10px 15px;border-top: 1px solid #dddddd;border-bottom: 1px solid #dddddd;border-left: 1px solid #dddddd;font-family: 'Malgun Gothic', '맑은고딕', '돋움', 'dotum', sans-serif;font-size: 14px;color: #444444;line-height: 1.3">
                                    국문 : {{ $data->sosok_kr ?? '' }}
                                </td>
                            </tr>
                            <tr>
                                <td style="padding: 10px 15px;border-top: 1px solid #dddddd;border-bottom: 1px solid #dddddd;border-left: 1px solid #dddddd;font-family: 'Malgun Gothic', '맑은고딕', '돋움', 'dotum', sans-serif;font-size: 14px;color: #444444;line-height: 1.3">
                                    영문 : {{ $data->sosok_en ?? '' }}
                                </td>
                            </tr>
                            <tr>
                                <th scope="row" rowspan="2" style="padding: 10px 15px;background-color: #f4f4f4;border-top: 1px solid #dddddd;border-bottom: 1px solid #dddddd;font-family: 'Malgun Gothic', '맑은고딕', '돋움', 'dotum', sans-serif;font-size: 14px;font-weight: 400;color: #444444;line-height: 1.3;text-align: center;">
                                    부서
                                </th>
                                <td style="padding: 10px 15px;border-top: 1px solid #dddddd;border-bottom: 1px solid #dddddd;border-left: 1px solid #dddddd;font-family: 'Malgun Gothic', '맑은고딕', '돋움', 'dotum', sans-serif;font-size: 14px;color: #444444;line-height: 1.3">
                                    국문 : {{ $data->depart_kr ?? '' }}
                                </td>
                            </tr>
                            <tr>
                                <td style="padding: 10px 15px;border-top: 1px solid #dddddd;border-bottom: 1px solid #dddddd;border-left: 1px solid #dddddd;font-family: 'Malgun Gothic', '맑은고딕', '돋움', 'dotum', sans-serif;font-size: 14px;color: #444444;line-height: 1.3">
                                    영문 : {{ $data->depart_en ?? '' }}
                                </td>
                            </tr>
                            <tr>
                                <th scope="row" style="padding: 10px 15px;background-color: #f4f4f4;border-top: 1px solid #dddddd;border-bottom: 1px solid #dddddd;font-family: 'Malgun Gothic', '맑은고딕', '돋움', 'dotum', sans-serif;font-size: 14px;font-weight: 400;color: #444444;line-height: 1.3;text-align: center;">
                                    직책 (직함)
                                </th>
                                <td style="padding: 10px 15px;border-top: 1px solid #dddddd;border-bottom: 1px solid #dddddd;border-left: 1px solid #dddddd;font-family: 'Malgun Gothic', '맑은고딕', '돋움', 'dotum', sans-serif;font-size: 14px;color: #444444;line-height: 1.3">
                                    {{ $data->custom_position ?? '' }}
                                </td>
                            </tr>
                            <tr>
                                <th scope="row" style="padding: 10px 15px;background-color: #f4f4f4;border-top: 1px solid #dddddd;border-bottom: 1px solid #dddddd;font-family: 'Malgun Gothic', '맑은고딕', '돋움', 'dotum', sans-serif;font-size: 14px;font-weight: 400;color: #444444;line-height: 1.3;text-align: center;">
                                    면허번호
                                </th>
                                <td style="padding: 10px 15px;border-top: 1px solid #dddddd;border-bottom: 1px solid #dddddd;border-left: 1px solid #dddddd;font-family: 'Malgun Gothic', '맑은고딕', '돋움', 'dotum', sans-serif;font-size: 14px;color: #444444;line-height: 1.3">
                                    {{ $data->license_number ?? '' }}
                                </td>
                            </tr>
                            <tr>
                                <th scope="row" style="padding: 10px 15px;background-color: #f4f4f4;border-top: 1px solid #dddddd;border-bottom: 1px solid #dddddd;font-family: 'Malgun Gothic', '맑은고딕', '돋움', 'dotum', sans-serif;font-size: 14px;font-weight: 400;color: #444444;line-height: 1.3;text-align: center;">
                                    거주국가
                                </th>
                                <td style="padding: 10px 15px;border-top: 1px solid #dddddd;border-bottom: 1px solid #dddddd;border-left: 1px solid #dddddd;font-family: 'Malgun Gothic', '맑은고딕', '돋움', 'dotum', sans-serif;font-size: 14px;color: #444444;line-height: 1.3">
                                    {{ $data->custom_country ?? '' }}
                                </td>
                            </tr>
                            <tr>
                                <th scope="row" style="padding: 10px 15px;background-color: #f4f4f4;border-top: 1px solid #dddddd;border-bottom: 1px solid #dddddd;font-family: 'Malgun Gothic', '맑은고딕', '돋움', 'dotum', sans-serif;font-size: 14px;font-weight: 400;color: #444444;line-height: 1.3;text-align: center;">
                                    연락처
                                </th>
                                <td style="padding: 10px 15px;border-top: 1px solid #dddddd;border-bottom: 1px solid #dddddd;border-left: 1px solid #dddddd;font-family: 'Malgun Gothic', '맑은고딕', '돋움', 'dotum', sans-serif;font-size: 14px;color: #444444;line-height: 1.3">
                                    {{ $data->tel[0] ?? '' }}-{{ $data->tel[1] ?? '' }}-{{ $data->tel[2] ?? '' }}
                                </td>
                            </tr>
                            <tr>
                                <th scope="row" style="padding: 10px 15px;background-color: #f4f4f4;border-top: 1px solid #dddddd;border-bottom: 1px solid #dddddd;font-family: 'Malgun Gothic', '맑은고딕', '돋움', 'dotum', sans-serif;font-size: 14px;font-weight: 400;color: #444444;line-height: 1.3;text-align: center;">
                                    휴대폰번호
                                </th>
                                <td style="padding: 10px 15px;border-top: 1px solid #dddddd;border-bottom: 1px solid #dddddd;border-left: 1px solid #dddddd;font-family: 'Malgun Gothic', '맑은고딕', '돋움', 'dotum', sans-serif;font-size: 14px;color: #444444;line-height: 1.3">
                                    {{ $data->phone[0] ?? '' }}-{{ $data->phone[1] ?? '' }}-{{ $data->phone[2] ?? '' }}
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td style="padding-top: 30px;">
                        <table style="width: 100%;border-collapse: collapse;border-spacing: 0;">
                            <colgroup>
                                <col style="width: 195px;">
                                <col style="width: 350px;">
                            </colgroup>
                            <tbody>
                            <tr>
                                <th scope="row" style="padding: 10px 15px;background-color: #f4f4f4;border-top: 1px solid #dddddd;border-bottom: 1px solid #dddddd;font-family: 'Malgun Gothic', '맑은고딕', '돋움', 'dotum', sans-serif;font-size: 14px;font-weight: 400;color: #444444;line-height: 1.3;text-align: center;">
                                    결제 수단
                                </th>
                                <td style="padding: 10px 15px;border-top: 1px solid #dddddd;border-bottom: 1px solid #dddddd;border-left: 1px solid #dddddd;font-family: 'Malgun Gothic', '맑은고딕', '돋움', 'dotum', sans-serif;font-size: 14px;color: #444444;line-height: 1.3">
                                    {{ $data->custom_gubun ?? '' }}
                                </td>
                            </tr>
                            <tr>
                                <th scope="row" style="padding: 10px 15px;background-color: #f4f4f4;border-top: 1px solid #dddddd;border-bottom: 1px solid #dddddd;font-family: 'Malgun Gothic', '맑은고딕', '돋움', 'dotum', sans-serif;font-size: 14px;font-weight: 400;color: #444444;line-height: 1.3;text-align: center;">
                                    송금인
                                </th>
                                <td style="padding: 10px 15px;border-top: 1px solid #dddddd;border-bottom: 1px solid #dddddd;border-left: 1px solid #dddddd;font-family: 'Malgun Gothic', '맑은고딕', '돋움', 'dotum', sans-serif;font-size: 14px;color: #444444;line-height: 1.3">
                                    {{ $data->sender ?? '' }}
                                </td>
                            </tr>
                            <tr>
                                <th scope="row" style="padding: 10px 15px;background-color: #f4f4f4;border-top: 1px solid #dddddd;border-bottom: 1px solid #dddddd;font-family: 'Malgun Gothic', '맑은고딕', '돋움', 'dotum', sans-serif;font-size: 14px;font-weight: 400;color: #444444;line-height: 1.3;text-align: center;">
                                    송금 예정일
                                </th>
                                <td style="padding: 10px 15px;border-top: 1px solid #dddddd;border-bottom: 1px solid #dddddd;border-left: 1px solid #dddddd;font-family: 'Malgun Gothic', '맑은고딕', '돋움', 'dotum', sans-serif;font-size: 14px;color: #444444;line-height: 1.3">
                                    {{ $data->sender_date ? $data->sender_date->format('Y-m-d') : '' }}
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td style="padding-top: 30px;">
                        <table style="width: 100%;border-collapse: collapse;border-spacing: 0;">
                            <colgroup>
                                <col style="width: 195px;">
                                <col style="width: 350px;">
                            </colgroup>
                            <tbody>
                            <tr>
                                <th scope="row" style="padding: 10px 15px;background-color: #f4f4f4;border-top: 1px solid #dddddd;border-bottom: 1px solid #dddddd;font-family: 'Malgun Gothic', '맑은고딕', '돋움', 'dotum', sans-serif;font-size: 14px;font-weight: 400;color: #444444;line-height: 1.3;text-align: center;">
                                    총 등록비
                                </th>
                                <td style="padding: 10px 15px;border-top: 1px solid #dddddd;border-bottom: 1px solid #dddddd;border-left: 1px solid #dddddd;font-family: 'Malgun Gothic', '맑은고딕', '돋움', 'dotum', sans-serif;font-size: 14px;color: #444444;line-height: 1.3">
                                    {{ number_format($data->tot_pay) ?? 0 }}원
                                </td>
                            </tr>
                            <tr>
                                <th scope="row" style="padding: 10px 15px;background-color: #f4f4f4;border-top: 1px solid #dddddd;border-bottom: 1px solid #dddddd;font-family: 'Malgun Gothic', '맑은고딕', '돋움', 'dotum', sans-serif;font-size: 14px;font-weight: 400;color: #444444;line-height: 1.3;text-align: center;">
                                    입금 상태
                                </th>
                                <td style="padding: 10px 15px;border-top: 1px solid #dddddd;border-bottom: 1px solid #dddddd;border-left: 1px solid #dddddd;font-family: 'Malgun Gothic', '맑은고딕', '돋움', 'dotum', sans-serif;font-size: 14px;color: #444444;line-height: 1.3">
                                    {{ $data->custom_pay_status ?? '미결제' }}
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td style="padding-top: 30px;padding-bottom: 110px;text-align: center;">
                        <a href="http://k-hrs.m2comm.co.kr/main" target="_blank"><img src="http://k-hrs.m2comm.co.kr/assets/image/mail/btn_mail_home.png" alt="홈페이지 바로가기"></a>
                    </td>
                </tr>
                <tr>
                    <td style="font-family: 'Malgun Gothic', '맑은고딕', '돋움', 'dotum', sans-serif;font-size: 15px;color: #ed1313;line-height: 1.2;">
                        * 본 메일은 발송전용 메일이므로 답장을 받을 수 없습니다.
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