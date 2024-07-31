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
                        초록접수가 완료 되었습니다.
                    </th>
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
                                    초록 접수 번호
                                </th>
                                <td style="padding: 10px 15px;border-top: 1px solid #dddddd;border-bottom: 1px solid #dddddd;border-left: 1px solid #dddddd;font-family: 'Malgun Gothic', '맑은고딕', '돋움', 'dotum', sans-serif;font-size: 14px;color: #444444;line-height: 1.3">
                                    {{ $data->regnum ?? '' }}
                                </td>
                            </tr>
                            <tr>
                                <th scope="row" style="padding: 10px 15px;background-color: #f4f4f4;border-top: 1px solid #dddddd;border-bottom: 1px solid #dddddd;font-family: 'Malgun Gothic', '맑은고딕', '돋움', 'dotum', sans-serif;font-size: 14px;font-weight: 400;color: #444444;line-height: 1.3;text-align: center;">
                                    희망발표형식
                                </th>
                                <td style="padding: 10px 15px;border-top: 1px solid #dddddd;border-bottom: 1px solid #dddddd;border-left: 1px solid #dddddd;font-family: 'Malgun Gothic', '맑은고딕', '돋움', 'dotum', sans-serif;font-size: 14px;color: #444444;line-height: 1.3">
                                    {{ $data->custom_type ?? '' }}
                                </td>
                            </tr>
                            <tr>
                                <th scope="row" rowspan="2" style="padding: 10px 15px;background-color: #f4f4f4;border-top: 1px solid #dddddd;border-bottom: 1px solid #dddddd;font-family: 'Malgun Gothic', '맑은고딕', '돋움', 'dotum', sans-serif;font-size: 14px;font-weight: 400;color: #444444;line-height: 1.3;text-align: center;">
                                    제목
                                </th>
                                <td style="padding: 10px 15px;border-top: 1px solid #dddddd;border-bottom: 1px solid #dddddd;border-left: 1px solid #dddddd;font-family: 'Malgun Gothic', '맑은고딕', '돋움', 'dotum', sans-serif;font-size: 14px;color: #444444;line-height: 1.3">
                                    국문 : {{ $data->title_kr ?? '' }}
                                </td>
                            </tr>
                            <tr>
                                <td style="padding: 10px 15px;border-top: 1px solid #dddddd;border-bottom: 1px solid #dddddd;border-left: 1px solid #dddddd;font-family: 'Malgun Gothic', '맑은고딕', '돋움', 'dotum', sans-serif;font-size: 14px;color: #444444;line-height: 1.3">
                                    영문 : {{ $data->title_en ?? '' }}
                                </td>
                            </tr>
                            <tr>
                                <th scope="row" rowspan="2" style="padding: 10px 15px;background-color: #f4f4f4;border-top: 1px solid #dddddd;border-bottom: 1px solid #dddddd;font-family: 'Malgun Gothic', '맑은고딕', '돋움', 'dotum', sans-serif;font-size: 14px;font-weight: 400;color: #444444;line-height: 1.3;text-align: center;">
                                    연구자
                                </th>
                                <td style="padding: 10px 15px;border-top: 1px solid #dddddd;border-bottom: 1px solid #dddddd;border-left: 1px solid #dddddd;font-family: 'Malgun Gothic', '맑은고딕', '돋움', 'dotum', sans-serif;font-size: 14px;color: #444444;line-height: 1.3">
                                    국문 : {{ $data->research_kr ?? '' }}
                                </td>
                            </tr>
                            <tr>
                                <td style="padding: 10px 15px;border-top: 1px solid #dddddd;border-bottom: 1px solid #dddddd;border-left: 1px solid #dddddd;font-family: 'Malgun Gothic', '맑은고딕', '돋움', 'dotum', sans-serif;font-size: 14px;color: #444444;line-height: 1.3">
                                    영문 : {{ $data->research_en ?? '' }}
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
                            </tbody>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td style="padding-top: 30px;font-family: 'Malgun Gothic', '맑은고딕', '돋움', 'dotum', sans-serif;font-size: 14px;font-weight: 700;color: #444444;line-height: 1.3;">
                        <strong>초록 본문</strong>
                    </td>
                </tr>
                <tr>
                    <td style="padding-top: 10px;">
                        <table style="width: 100%;border-collapse: collapse;border-spacing: 0;">
                            <colgroup>
                                <col style="width: 195px;">
                                <col style="width: 350px;">
                            </colgroup>
                            <tbody>
                            @if($data->type == 'O')
                                <tr>
                                    <th scope="row" style="padding: 10px 15px;background-color: #f4f4f4;border-top: 1px solid #dddddd;border-bottom: 1px solid #dddddd;font-family: 'Malgun Gothic', '맑은고딕', '돋움', 'dotum', sans-serif;font-size: 14px;font-weight: 400;color: #444444;line-height: 1.3;text-align: center;">
                                        서론
                                    </th>
                                    <td style="padding: 10px 15px;border-top: 1px solid #dddddd;border-bottom: 1px solid #dddddd;border-left: 1px solid #dddddd;font-family: 'Malgun Gothic', '맑은고딕', '돋움', 'dotum', sans-serif;font-size: 14px;color: #444444;line-height: 1.3">
                                        {!! $data->o_intro ?? '' !!}
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row" style="padding: 10px 15px;background-color: #f4f4f4;border-top: 1px solid #dddddd;border-bottom: 1px solid #dddddd;font-family: 'Malgun Gothic', '맑은고딕', '돋움', 'dotum', sans-serif;font-size: 14px;font-weight: 400;color: #444444;line-height: 1.3;text-align: center;">
                                        증례
                                    </th>
                                    <td style="padding: 10px 15px;border-top: 1px solid #dddddd;border-bottom: 1px solid #dddddd;border-left: 1px solid #dddddd;font-family: 'Malgun Gothic', '맑은고딕', '돋움', 'dotum', sans-serif;font-size: 14px;color: #444444;line-height: 1.3">
                                        {!! $data->o_case ?? '' !!}
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row" style="padding: 10px 15px;background-color: #f4f4f4;border-top: 1px solid #dddddd;border-bottom: 1px solid #dddddd;font-family: 'Malgun Gothic', '맑은고딕', '돋움', 'dotum', sans-serif;font-size: 14px;font-weight: 400;color: #444444;line-height: 1.3;text-align: center;">
                                        결론
                                    </th>
                                    <td style="padding: 10px 15px;border-top: 1px solid #dddddd;border-bottom: 1px solid #dddddd;border-left: 1px solid #dddddd;font-family: 'Malgun Gothic', '맑은고딕', '돋움', 'dotum', sans-serif;font-size: 14px;color: #444444;line-height: 1.3">
                                        {!! $data->o_result ?? '' !!}
                                    </td>
                                </tr>
                            @elseif($data->type == 'P')
                            <tr>
                                <th scope="row" style="padding: 10px 15px;background-color: #f4f4f4;border-top: 1px solid #dddddd;border-bottom: 1px solid #dddddd;font-family: 'Malgun Gothic', '맑은고딕', '돋움', 'dotum', sans-serif;font-size: 14px;font-weight: 400;color: #444444;line-height: 1.3;text-align: center;">
                                    목적
                                </th>
                                <td style="padding: 10px 15px;border-top: 1px solid #dddddd;border-bottom: 1px solid #dddddd;border-left: 1px solid #dddddd;font-family: 'Malgun Gothic', '맑은고딕', '돋움', 'dotum', sans-serif;font-size: 14px;color: #444444;line-height: 1.3">
                                    {!! $data->p_object ?? '' !!}
                                </td>
                            </tr>
                            <tr>
                                <th scope="row" style="padding: 10px 15px;background-color: #f4f4f4;border-top: 1px solid #dddddd;border-bottom: 1px solid #dddddd;font-family: 'Malgun Gothic', '맑은고딕', '돋움', 'dotum', sans-serif;font-size: 14px;font-weight: 400;color: #444444;line-height: 1.3;text-align: center;">
                                    대상 및 방법
                                </th>
                                <td style="padding: 10px 15px;border-top: 1px solid #dddddd;border-bottom: 1px solid #dddddd;border-left: 1px solid #dddddd;font-family: 'Malgun Gothic', '맑은고딕', '돋움', 'dotum', sans-serif;font-size: 14px;color: #444444;line-height: 1.3">
                                    {!! $data->p_method ?? '' !!}
                                </td>
                            </tr>
                            <tr>
                                <th scope="row" style="padding: 10px 15px;background-color: #f4f4f4;border-top: 1px solid #dddddd;border-bottom: 1px solid #dddddd;font-family: 'Malgun Gothic', '맑은고딕', '돋움', 'dotum', sans-serif;font-size: 14px;font-weight: 400;color: #444444;line-height: 1.3;text-align: center;">
                                    결과
                                </th>
                                <td style="padding: 10px 15px;border-top: 1px solid #dddddd;border-bottom: 1px solid #dddddd;border-left: 1px solid #dddddd;font-family: 'Malgun Gothic', '맑은고딕', '돋움', 'dotum', sans-serif;font-size: 14px;color: #444444;line-height: 1.3">
                                    {!! $data->p_result ?? '' !!}
                                </td>
                            </tr>
                            <tr>
                                <th scope="row" style="padding: 10px 15px;background-color: #f4f4f4;border-top: 1px solid #dddddd;border-bottom: 1px solid #dddddd;font-family: 'Malgun Gothic', '맑은고딕', '돋움', 'dotum', sans-serif;font-size: 14px;font-weight: 400;color: #444444;line-height: 1.3;text-align: center;">
                                    결론
                                </th>
                                <td style="padding: 10px 15px;border-top: 1px solid #dddddd;border-bottom: 1px solid #dddddd;border-left: 1px solid #dddddd;font-family: 'Malgun Gothic', '맑은고딕', '돋움', 'dotum', sans-serif;font-size: 14px;color: #444444;line-height: 1.3">
                                    {!! $data->p_conclusion ?? '' !!}
                                </td>
                            </tr>
                            @endif
                            </tbody>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td style="padding-top: 30px;font-family: 'Malgun Gothic', '맑은고딕', '돋움', 'dotum', sans-serif;font-size: 14px;font-weight: 700;color: #444444;line-height: 1.3;">
                        <strong>발표자 정보</strong>
                    </td>
                </tr>
                <tr>
                    <td style="padding-top: 10px;">
                        <table style="width: 100%;border-collapse: collapse;border-spacing: 0;">
                            <colgroup>
                                <col style="width: 195px;">
                                <col style="width: 350px;">
                            </colgroup>
                            <tbody>
                            <tr>
                                <th scope="row" style="padding: 10px 15px;background-color: #f4f4f4;border-top: 1px solid #dddddd;border-bottom: 1px solid #dddddd;font-family: 'Malgun Gothic', '맑은고딕', '돋움', 'dotum', sans-serif;font-size: 14px;font-weight: 400;color: #444444;line-height: 1.3;text-align: center;">
                                    발표자 성명
                                </th>
                                <td style="padding: 10px 15px;border-top: 1px solid #dddddd;border-bottom: 1px solid #dddddd;border-left: 1px solid #dddddd;font-family: 'Malgun Gothic', '맑은고딕', '돋움', 'dotum', sans-serif;font-size: 14px;color: #444444;line-height: 1.3">
                                    {{ $data->p_name ?? '' }}
                                </td>
                            </tr>
                            <tr>
                                <th scope="row" style="padding: 10px 15px;background-color: #f4f4f4;border-top: 1px solid #dddddd;border-bottom: 1px solid #dddddd;font-family: 'Malgun Gothic', '맑은고딕', '돋움', 'dotum', sans-serif;font-size: 14px;font-weight: 400;color: #444444;line-height: 1.3;text-align: center;">
                                    소속
                                </th>
                                <td style="padding: 10px 15px;border-top: 1px solid #dddddd;border-bottom: 1px solid #dddddd;border-left: 1px solid #dddddd;font-family: 'Malgun Gothic', '맑은고딕', '돋움', 'dotum', sans-serif;font-size: 14px;color: #444444;line-height: 1.3">
                                    {{ $data->p_sosok ?? '' }}
                                </td>
                            </tr>
                            <tr>
                                <th scope="row" style="padding: 10px 15px;background-color: #f4f4f4;border-top: 1px solid #dddddd;border-bottom: 1px solid #dddddd;font-family: 'Malgun Gothic', '맑은고딕', '돋움', 'dotum', sans-serif;font-size: 14px;font-weight: 400;color: #444444;line-height: 1.3;text-align: center;">
                                    직위
                                </th>
                                <td style="padding: 10px 15px;border-top: 1px solid #dddddd;border-bottom: 1px solid #dddddd;border-left: 1px solid #dddddd;font-family: 'Malgun Gothic', '맑은고딕', '돋움', 'dotum', sans-serif;font-size: 14px;color: #444444;line-height: 1.3">
                                    {{ $data->custom_p_position ?? '' }}
                                </td>
                            </tr>
                            <tr>
                                <th scope="row" style="padding: 10px 15px;background-color: #f4f4f4;border-top: 1px solid #dddddd;border-bottom: 1px solid #dddddd;font-family: 'Malgun Gothic', '맑은고딕', '돋움', 'dotum', sans-serif;font-size: 14px;font-weight: 400;color: #444444;line-height: 1.3;text-align: center;">
                                    이메일
                                </th>
                                <td style="padding: 10px 15px;border-top: 1px solid #dddddd;border-bottom: 1px solid #dddddd;border-left: 1px solid #dddddd;font-family: 'Malgun Gothic', '맑은고딕', '돋움', 'dotum', sans-serif;font-size: 14px;color: #444444;line-height: 1.3">
                                    {{ $data->p_email ?? '' }}
                                </td>
                            </tr>
                            <tr>
                                <th scope="row" style="padding: 10px 15px;background-color: #f4f4f4;border-top: 1px solid #dddddd;border-bottom: 1px solid #dddddd;font-family: 'Malgun Gothic', '맑은고딕', '돋움', 'dotum', sans-serif;font-size: 14px;font-weight: 400;color: #444444;line-height: 1.3;text-align: center;">
                                    휴대폰번호
                                </th>
                                <td style="padding: 10px 15px;border-top: 1px solid #dddddd;border-bottom: 1px solid #dddddd;border-left: 1px solid #dddddd;font-family: 'Malgun Gothic', '맑은고딕', '돋움', 'dotum', sans-serif;font-size: 14px;color: #444444;line-height: 1.3">
                                    {{ $data->p_phone[0] ?? '' }}-{{ $data->p_phone[1] ?? '' }}-{{ $data->p_phone[2] ?? '' }}
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>

                <tr>
                    <td style="padding-top: 30px;padding-bottom: 110px;text-align: center;">
                        <a href="{{ env('APP_URL') }}" target="_blank"><img src="{{ asset('assets/image/mail/btn_mail_home.png') }}" alt="홈페이지 바로가기"></a>
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