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

                        교수님께서는 <strong>{{ $data->conference_name ?? '' }}</strong> 참가자로 선정되셨습니다. <br/>
                        대한부정맥학회 홈페이지 국제학회 참가지원 신청내역 확인 및 결과보고 페이지에서 결과보고를 부탁드립니다.
                    </td>
                </tr>
                <tr>
                    <td style="padding-bottom: 30px;text-align: center;">
                        <img src="{{ asset('assets/image/mail/btn_mail_page.png') }}" alt="신청내역 확인 및 결과보고 페이지 바로가기 >" style="vertical-align: top;">
                    </td>
                </tr>
                <tr>
                    <td style="padding-bottom: 70px;font-family: 'Malgun Gothic', '맑은고딕', '돋움', 'dotum', sans-serif;font-size: 15px;font-weight: 400;color: #4d4d4d;line-height: 1.9;text-align: left;letter-spacing: -0.04em;">
                        번거로우시겠지만, 영수증은 꼭 챙겨 원본을 제출 부탁 드립니다. <br/>
                        또한 <strong>{{ $data->assistant ?? ''}}</strong> 규정 및 보고 시스템 변화로 인해 참고사항 확인하시기 바랍니다. <br/><br/>

                        국제학회 참가지원 신청내역 확인 및 결과보고 페이지에 있는 <strogn>{{ $data->assistant ?? ''}}</strogn> 결과보고서 및 지출내역을 작성하셔서 파일은 먼저 제출하여 주시고, 인쇄 후 영수증 원본과 함께 학회로 <strong><u>{{ $data->result_date ?? ''}}</u></strong>까지 보내주시기 바랍니다.
                    </td>
                </tr>
                <tr>
                    <td style="padding-bottom: 30px;font-size: 14px;">
                        <strong style="color: #224691;">&lt;학술대회 참가자 지원 내역&gt;</strong> <br>
                        <strong style="color: #f11a1a;"><u>항공비, 숙박비, 등록비 지출사항은 개인카드 결제 내역만 인정됩니다(법인카드 지원불가).</u></strong>
                    </td>
                </tr>
                <tr>
                    <td style="padding-bottom: 20px;font-family: 'Malgun Gothic', '맑은고딕', '돋움', 'dotum', sans-serif;font-size: 14px;font-weight: 400;color: #4d4d4d;line-height: 1.9;text-align: left;letter-spacing: -0.04em;">
                        <ul style="padding: 0;padding-left: 15px;margin: 0;list-style: disc;">
                            <li>교통비
                                <ul style="padding: 0;padding-left: 15px;margin: 0;list-style:'- ';">
                                    <li>항공요금: 항공요금(이코노미클래스, Boarding Pass, 영수증 제출) 또는 육상교통비(목적지까지의 최단거리 대중교통실비)</li>
                                    <li><strong><u>보딩패스는 지원을 받지 않더라도 필참(보딩패스 분실시 항공사 발행 탑승확인서 혹은 마일리지 적립내역서, 탑승확인서)</u></strong></li>
                                    <li>해외현지교통비: 공항(기차역 등 도착지)-숙소-행사장소간 교통비(학술대회 기간내, 1인 최대 15만원 이내, 1일 왕복 1회 한정), 이용시간 및 출발지 및 도착지가 명기된 영수증 증빙의 경우에 한함</li>
                                    <li>국내학술대회: 국내항공료(이코노미클래스), KTX(일반석), 우등 고속버스 등 대중교통실비(정산시 여정이 적힌 내역서, 영수증, 보딩패스 제출)</li>
                                </ul>
                            </li>
                            <li>
                                등록비(사전 등록을 원칙): <strong><u>등록 확인증은 지원을 받지 않더라도 필참</u></strong> 날짜 기준환율 적용, 한화 금액 또는 신용카드 청구 영수증의 금액 적용
                            </li>
                            <li>
                                식대: 개인 1일 3식 기준, 식사시간대의 현지 식당에서 개인카드 또는 현금 결제한 영수증(1식, 1장, 5만원이내), <strong><u>학술대회 개최지와 같은 시(City)를 기준함</u></strong>
                            </li>
                            <li>숙박비
                                <ul style="padding: 0;padding-left: 15px;margin: 0;list-style:'- ';">
                                    <li>국내: 1박당 20만원이내, 해외: 1박당 35만원이내(송금 확인증 및 개인카드 결제 영수증), <strong style="color: #f11a1a;"><u>1박당 비용이 표시된 인보이스 필참</u></strong></li>
                                    <li><strong><u>학술대회 개최지와 같은 시(City)를 기준함(행사장에서 1시간 이내)</u></strong></li>
                                    <li>학술대회 개최 1일전, 학술대회 종료일까지의 숙박 지원(미니바, 영화, 세탁, 전화 등 숙박에 부수하는 비용 불포함) 예) 학술대회 기간이 수~금요일인 경우, Check-In: 화/ Check-Out: 토 </li>
                                    <li><strong style="color: #f11a1a;"><u>숙박대행사를 통해서 예약시 숙박비 invoice 발급이 어려울 수 있으니, 가능하면 호텔사이트에서 직접 예약을 부탁드립니다.</u></strong></li>
                                </ul>
                            </li>
                        </ul>
                    </td>
                </tr>
                <tr>
                    <td style="padding-bottom: 30px;font-family: 'Malgun Gothic', '맑은고딕', '돋움', 'dotum', sans-serif;font-size: 12px;font-weight: 400;color: #4d4d4d;line-height: 1.9;text-align: left;letter-spacing: -0.04em;">
                        ※ 정산시 적용환율: 학술대회 시작 전일(휴일일 경우 직전 영업일) KEB 하나은행 현금 매입 최초 고시가
                    </td>
                </tr>
                <tr>
                    <td style="padding-bottom: 10px;">
                        <table style="width: 100%;border-collapse: collapse;border-spacing: 0;table-layout: fixed;">
                            <colgroup>
                                <col style="width: 16.6%;">
                                <col style="width: 16.6%;">
                                <col style="width: 16.6%;">
                                <col style="width: 16.6%;">
                                <col style="width: 16.6%;">
                                <col style="width: 16.6%;">
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
                                <th scope="row" style="padding: 10px 0;background-color: #f4f4f4;border-top: 1px solid #dddddd;border-bottom: 1px solid #dddddd;border-left: 1px solid #dddddd;font-family: 'Malgun Gothic', '맑은고딕', '돋움', 'dotum', sans-serif;font-size: 12px;font-weight: 700;color: #444444;line-height: 1.3;text-align: center;">
                                    숙박비
                                </th>
                                <th scope="row" style="padding: 10px 0;background-color: #f4f4f4;border-top: 1px solid #dddddd;border-bottom: 1px solid #dddddd;border-left: 1px solid #dddddd;font-family: 'Malgun Gothic', '맑은고딕', '돋움', 'dotum', sans-serif;font-size: 12px;font-weight: 700;color: #444444;line-height: 1.3;text-align: center;">
                                    등록비
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td style="padding: 10px 15px;border-top: 1px solid #dddddd;border-bottom: 1px solid #dddddd;font-family: 'Malgun Gothic', '맑은고딕', '돋움', 'dotum', sans-serif;font-size: 12px;color: #444444;line-height: 1.3;text-align: center;word-break: keep-all;">
                                    ⓛ <br/>참가자격 채택메일 (좌장,토론자, 발표자 (발표시간명시))
                                </td>
                                <td style="padding: 10px 15px;border-top: 1px solid #dddddd;border-bottom: 1px solid #dddddd;border-left: 1px solid #dddddd;font-family: 'Malgun Gothic', '맑은고딕', '돋움', 'dotum', sans-serif;font-size: 12px;color: #444444;line-height: 1.3;text-align: center;word-break: keep-all;">
                                    ⓛ <br/>보딩패스
                                </td>
                                <td style="padding: 10px 15px;border-top: 1px solid #dddddd;border-bottom: 1px solid #dddddd;border-left: 1px solid #dddddd;font-family: 'Malgun Gothic', '맑은고딕', '돋움', 'dotum', sans-serif;font-size: 12px;color: #444444;line-height: 1.3;text-align: center;word-break: keep-all;">
                                    ⓛ <br/>실결제 영수증 (출.도착지 명기해서)
                                </td>
                                <td style="padding: 10px 15px;border-top: 1px solid #dddddd;border-bottom: 1px solid #dddddd;border-left: 1px solid #dddddd;font-family: 'Malgun Gothic', '맑은고딕', '돋움', 'dotum', sans-serif;font-size: 12px;color: #444444;line-height: 1.3;text-align: center;word-break: keep-all;">
                                    ⓛ <br/>실결제 영수증 (1일3식/ 1식 1장) <span style="color: #f11a1a;">*</span>
                                </td>
                                <td style="padding: 10px 15px;border-top: 1px solid #dddddd;border-bottom: 1px solid #dddddd;border-left: 1px solid #dddddd;font-family: 'Malgun Gothic', '맑은고딕', '돋움', 'dotum', sans-serif;font-size: 12px;color: #444444;line-height: 1.3;text-align: center;word-break: keep-all;">
                                    ⓛ <br/>일자별 숙박 invoice (호텔 check in/out, 숙박금액) <span style="color: #f11a1a;">**</span>
                                </td>
                                <td style="padding: 10px 15px;border-top: 1px solid #dddddd;border-bottom: 1px solid #dddddd;border-left: 1px solid #dddddd;font-family: 'Malgun Gothic', '맑은고딕', '돋움', 'dotum', sans-serif;font-size: 12px;color: #444444;line-height: 1.3;text-align: center;word-break: keep-all;">
                                    ⓛ <br/>등록확인증 (등록항목 명시된)
                                </td>
                            </tr>
                            <tr>
                                <td style="padding: 10px 15px;border-top: 1px solid #dddddd;border-bottom: 1px solid #dddddd;font-family: 'Malgun Gothic', '맑은고딕', '돋움', 'dotum', sans-serif;font-size: 12px;color: #444444;line-height: 1.3;text-align: center;word-break: keep-all;">
                                    ② <br/>초록사본
                                </td>
                                <td style="padding: 10px 15px;border-top: 1px solid #dddddd;border-bottom: 1px solid #dddddd;border-left: 1px solid #dddddd;font-family: 'Malgun Gothic', '맑은고딕', '돋움', 'dotum', sans-serif;font-size: 12px;color: #444444;line-height: 1.3;text-align: center;word-break: keep-all;">
                                    ② <br/>e-ticket
                                </td>
                                <td style="padding: 10px 15px;border-top: 1px solid #dddddd;border-bottom: 1px solid #dddddd;border-left: 1px solid #dddddd;font-family: 'Malgun Gothic', '맑은고딕', '돋움', 'dotum', sans-serif;font-size: 12px;color: #444444;line-height: 1.3;text-align: center;word-break: keep-all;">

                                </td>
                                <td style="padding: 10px 15px;border-top: 1px solid #dddddd;border-bottom: 1px solid #dddddd;border-left: 1px solid #dddddd;font-family: 'Malgun Gothic', '맑은고딕', '돋움', 'dotum', sans-serif;font-size: 12px;color: #444444;line-height: 1.3;text-align: center;word-break: keep-all;">

                                </td>
                                <td style="padding: 10px 15px;border-top: 1px solid #dddddd;border-bottom: 1px solid #dddddd;border-left: 1px solid #dddddd;font-family: 'Malgun Gothic', '맑은고딕', '돋움', 'dotum', sans-serif;font-size: 12px;color: #444444;line-height: 1.3;text-align: center;word-break: keep-all;">
                                    ② <br/>결제내역 (본인이름확인)
                                </td>
                                <td style="padding: 10px 15px;border-top: 1px solid #dddddd;border-bottom: 1px solid #dddddd;border-left: 1px solid #dddddd;font-family: 'Malgun Gothic', '맑은고딕', '돋움', 'dotum', sans-serif;font-size: 12px;color: #444444;line-height: 1.3;text-align: center;word-break: keep-all;">
                                    ② <br/>결제내역 (본인이름확인)
                                </td>
                            </tr>
                            <tr>
                                <td style="padding: 10px 15px;border-top: 1px solid #dddddd;border-bottom: 1px solid #dddddd;font-family: 'Malgun Gothic', '맑은고딕', '돋움', 'dotum', sans-serif;font-size: 12px;color: #444444;line-height: 1.3;text-align: center;word-break: keep-all;">
                                    ③ <br/>프로그램북 사본 (본인이름 확인)
                                </td>
                                <td style="padding: 10px 15px;border-top: 1px solid #dddddd;border-bottom: 1px solid #dddddd;border-left: 1px solid #dddddd;font-family: 'Malgun Gothic', '맑은고딕', '돋움', 'dotum', sans-serif;font-size: 12px;color: #444444;line-height: 1.3;text-align: center;word-break: keep-all;">
                                    ③ <br/>결제내역 (본인이름확인)
                                </td>
                                <td style="padding: 10px 15px;border-top: 1px solid #dddddd;border-bottom: 1px solid #dddddd;border-left: 1px solid #dddddd;font-family: 'Malgun Gothic', '맑은고딕', '돋움', 'dotum', sans-serif;font-size: 12px;color: #444444;line-height: 1.3;text-align: center;word-break: keep-all;">

                                </td>
                                <td style="padding: 10px 15px;border-top: 1px solid #dddddd;border-bottom: 1px solid #dddddd;border-left: 1px solid #dddddd;font-family: 'Malgun Gothic', '맑은고딕', '돋움', 'dotum', sans-serif;font-size: 12px;color: #444444;line-height: 1.3;text-align: center;word-break: keep-all;">

                                </td>
                                <td style="padding: 10px 15px;border-top: 1px solid #dddddd;border-bottom: 1px solid #dddddd;border-left: 1px solid #dddddd;font-family: 'Malgun Gothic', '맑은고딕', '돋움', 'dotum', sans-serif;font-size: 12px;color: #444444;line-height: 1.3;text-align: center;word-break: keep-all;">

                                </td>
                                <td style="padding: 10px 15px;border-top: 1px solid #dddddd;border-bottom: 1px solid #dddddd;border-left: 1px solid #dddddd;font-family: 'Malgun Gothic', '맑은고딕', '돋움', 'dotum', sans-serif;font-size: 12px;color: #444444;line-height: 1.3;text-align: center;word-break: keep-all;">
                                    ③ <br/>현장등록시 사유서 (서명포함)
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td style="font-family: 'Malgun Gothic', '맑은고딕', '돋움', 'dotum', sans-serif;font-size: 12px;font-weight: 400;color: #4d4d4d;line-height: 1.9;text-align: left;letter-spacing: -0.04em;">
                        *영수증은 겹치지 않도록 부착하여 주세요 <span style="color: #f11a1a;">(금액이 모두 보여야 함)</span>
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