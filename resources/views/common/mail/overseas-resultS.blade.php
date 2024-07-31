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

                        {{ $data->event_date ?? '' }} {{ $data->place ?? '' }}에서 개최되는 <strong>{{ $data->conference_name ?? '' }}</strong>의 참가지원 대상자로 선정되셨음을 알려드립니다. <br/>
                        선생님께서는 <strong>{{ $data->assistant ?? ''}}</strong>의 규정에 따라 심의 및 정산을 받게 되시며, 정산에 필요한 영수증은 꼭 챙겨 원본을 제출 부탁드립니다. <br/>
                        정산 시 불이익이 없도록, 아래 링크를 통해 정산 규정 및 제출 서류 등 전체 내용을 반드시 숙지하시기 바랍니다.
                    </td>
                </tr>
                <tr>
                    <td style="padding-bottom: 30px;text-align: center;">
                        <a href="https://k-hrs.org/board/overseas">
                            <img src="{{ asset('assets/image/mail/btn_mail_page.png') }}" alt="해외학회 참가지원 정산 규정 및 제출 서류 확인 바로가기 >" style="vertical-align: top;">
                        </a>
                    </td>
                </tr>                
                <tr>
                    <td style="padding-bottom: 10px;">
						<strong style="font-family: 'Malgun Gothic', '맑은고딕', '돋움', 'dotum', sans-serif;padding-bottom: 30px;font-size: 14px;color: #224691;">&lt;정산 서류 요약&gt;</strong>
                        <table style="width: 100%;border-collapse: collapse;border-spacing: 0;table-layout: fixed;">
                            <colgroup>
                                <col style="width: 25%;">
                                <col style="width: 25%;">
                                <col style="width: 25%;">
                                <col style="width: 25%;">
                            </colgroup>
                            <thead>
								<tr>
									<th scope="row" style="padding: 10px 0;background-color: #f4f4f4;border-top: 1px solid #dddddd;border-bottom: 1px solid #dddddd;font-family: 'Malgun Gothic', '맑은고딕', '돋움', 'dotum', sans-serif;font-size: 12px;font-weight: 700;color: #444444;line-height: 1.3;text-align: center;">
										참가자격
									</th>
									<th scope="row" style="padding: 10px 0;background-color: #f4f4f4;border-top: 1px solid #dddddd;border-bottom: 1px solid #dddddd;border-left: 1px solid #dddddd;font-family: 'Malgun Gothic', '맑은고딕', '돋움', 'dotum', sans-serif;font-size: 12px;font-weight: 700;color: #444444;line-height: 1.3;text-align: center;">
										항공비
									</th>
									<th scope="row" style="padding: 10px 0;background-color: #f4f4f4;border-top: 1px solid #dddddd;border-bottom: 1px solid #dddddd;border-left: 1px solid #dddddd;font-family: 'Malgun Gothic', '맑은고딕', '돋움', 'dotum', sans-serif;font-size: 12px;font-weight: 700;color: #444444;line-height: 1.3;text-align: center;">
										현지교통비
									</th>
									<th scope="row" style="padding: 10px 0;background-color: #f4f4f4;border-top: 1px solid #dddddd;border-bottom: 1px solid #dddddd;border-left: 1px solid #dddddd;font-family: 'Malgun Gothic', '맑은고딕', '돋움', 'dotum', sans-serif;font-size: 12px;font-weight: 700;color: #444444;line-height: 1.3;text-align: center;">
										식비
									</th>									
								</tr>
                            </thead>
                            <tbody>
								<tr>
									<td style="padding: 10px 15px;border-top: 1px solid #dddddd;border-bottom: 1px solid #dddddd;font-family: 'Malgun Gothic', '맑은고딕', '돋움', 'dotum', sans-serif;font-size: 12px;color: #444444;line-height: 1.3;text-align: center;word-break: keep-all;" rowspan="3">
										초록채택/초청메일 <br>(성함, 역할, 발표장소, 발표시간 명시)
									</td>
									<td style="padding: 10px 15px;border-top: 1px solid #dddddd;border-bottom: 1px solid #dddddd;border-left: 1px solid #dddddd;font-family: 'Malgun Gothic', '맑은고딕', '돋움', 'dotum', sans-serif;font-size: 12px;color: #444444;line-height: 1.3;text-align: center;word-break: keep-all;">
										ⓛ <br/>보딩패스
									</td>
									<td style="padding: 10px 15px;border-top: 1px solid #dddddd;border-bottom: 1px solid #dddddd;border-left: 1px solid #dddddd;font-family: 'Malgun Gothic', '맑은고딕', '돋움', 'dotum', sans-serif;font-size: 12px;color: #444444;line-height: 1.3;text-align: center;word-break: keep-all;" rowspan="3">
										실결제 영수증 <br>(출-도착지 명기)
									</td>
									<td style="padding: 10px 15px;border-top: 1px solid #dddddd;border-bottom: 1px solid #dddddd;border-left: 1px solid #dddddd;font-family: 'Malgun Gothic', '맑은고딕', '돋움', 'dotum', sans-serif;font-size: 12px;color: #444444;line-height: 1.3;text-align: center;word-break: keep-all;" rowspan="3">
										실결제 영수증 <br>(1일 3식/1식 1장)
									</td>									
								</tr>
								<tr>
									<td style="padding: 10px 15px;border-top: 1px solid #dddddd;border-bottom: 1px solid #dddddd;border-left: 1px solid #dddddd;font-family: 'Malgun Gothic', '맑은고딕', '돋움', 'dotum', sans-serif;font-size: 12px;color: #444444;line-height: 1.3;text-align: center;word-break: keep-all;">
										② <br/>e-ticket
									</td>																
								</tr>
								<tr>
									<td style="padding: 10px 15px;border-top: 1px solid #dddddd;border-bottom: 1px solid #dddddd;border-left: 1px solid #dddddd;font-family: 'Malgun Gothic', '맑은고딕', '돋움', 'dotum', sans-serif;font-size: 12px;color: #444444;line-height: 1.3;text-align: center;word-break: keep-all;">
										③ <br/>결제내역 <br>(본인이름확인)
									</td>							
								</tr>
                            </tbody>
							<thead>
								<tr>
									<th scope="row" style="padding: 10px 0;background-color: #f4f4f4;border-top: 1px solid #dddddd;border-bottom: 1px solid #dddddd;font-family: 'Malgun Gothic', '맑은고딕', '돋움', 'dotum', sans-serif;font-size: 12px;font-weight: 700;color: #444444;line-height: 1.3;text-align: center;">
										숙박비
									</th>
									<th scope="row" style="padding: 10px 0;background-color: #f4f4f4;border-top: 1px solid #dddddd;border-bottom: 1px solid #dddddd;border-left: 1px solid #dddddd;font-family: 'Malgun Gothic', '맑은고딕', '돋움', 'dotum', sans-serif;font-size: 12px;font-weight: 700;color: #444444;line-height: 1.3;text-align: center;">
										등록비
									</th>				
									<th scope="row" style="padding: 10px 0;background-color: #f4f4f4;border:1px solid #dddddd;font-family: 'Malgun Gothic', '맑은고딕', '돋움', 'dotum', sans-serif;font-size: 12px;font-weight: 700;color: #444444;line-height: 1.3;text-align: center;">
										결과보고서
									</th>
									<th scope="row" style="padding: 10px 0;background-color: #f4f4f4;border-top: 1px solid #dddddd;border-bottom: 1px solid #dddddd;border-left: 1px solid #dddddd;font-family: 'Malgun Gothic', '맑은고딕', '돋움', 'dotum', sans-serif;font-size: 12px;font-weight: 700;color: #444444;line-height: 1.3;text-align: center;">
										상세지출내역서
									</th>														
								</tr>
							</thead>
							<tbody>
								<tr>	
									<td style="padding: 10px 15px;border-top: 1px solid #dddddd;border-bottom: 1px solid #dddddd;font-family: 'Malgun Gothic', '맑은고딕', '돋움', 'dotum', sans-serif;font-size: 12px;color: #444444;line-height: 1.3;text-align: center;word-break: keep-all;height: 84px;">
										ⓛ <br/>일자별 숙박 invoice <br>(호텔 check-in/out, 숙박금액 확인)
									</td>
									<td style="padding: 10px 15px;border-top: 1px solid #dddddd;border-bottom: 1px solid #dddddd;border-left: 1px solid #dddddd;font-family: 'Malgun Gothic', '맑은고딕', '돋움', 'dotum', sans-serif;font-size: 12px;color: #444444;line-height: 1.3;text-align: center;word-break: keep-all;height: 84px;">
										ⓛ <br/>등록확인증 <br>(등록항목 명시)
									</td>		
									<td style="padding: 10px 15px;border-top: 1px solid #dddddd;border-bottom: 1px solid #dddddd;border-left: 1px solid #dddddd;font-family: 'Malgun Gothic', '맑은고딕', '돋움', 'dotum', sans-serif;font-size: 12px;color: #444444;line-height: 1.3;text-align: center;word-break: keep-all;height: 84px;" rowspan="2">
									결과보고서 작성 및 하단 자필 서명
									</td>
									<td style="padding: 10px 15px;border-top: 1px solid #dddddd;border-bottom: 1px solid #dddddd;border-left: 1px solid #dddddd;font-family: 'Malgun Gothic', '맑은고딕', '돋움', 'dotum', sans-serif;font-size: 12px;color: #444444;line-height: 1.3;text-align: center;word-break: keep-all;height: 84px;" rowspan="2">
									지출내역 정산서 작성 및 하단 자필 서명
									</td>																
								</tr>
								<tr>
									<td style="padding: 10px 15px;border-top: 1px solid #dddddd;border-bottom: 1px solid #dddddd;font-family: 'Malgun Gothic', '맑은고딕', '돋움', 'dotum', sans-serif;font-size: 12px;color: #444444;line-height: 1.3;text-align: center;word-break: keep-all;height: 84px;">
										② <br/>결제내역 <br>(본인이름확인)
									</td>
									<td style="padding: 10px 15px;border-top: 1px solid #dddddd;border-bottom: 1px solid #dddddd;border-left: 1px solid #dddddd;font-family: 'Malgun Gothic', '맑은고딕', '돋움', 'dotum', sans-serif;font-size: 12px;color: #444444;line-height: 1.3;text-align: center;word-break: keep-all;height: 84px;">
										② <br/>결제내역 <br>(본인이름확인)
									</td>
								</tr>
							</tbody>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td style="font-family: 'Malgun Gothic', '맑은고딕', '돋움', 'dotum', sans-serif;font-size: 15px;font-weight: 400;color: #4d4d4d;line-height: 1.9;text-align: left;letter-spacing: -0.04em;">
                        사무국 {{ env('APP_ALT') }} 배상 (<a href="mailto:khrs9@k-hrs.org">khrs9@k-hrs.org</a>, 02-318-5416)
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