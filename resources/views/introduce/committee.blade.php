@extends($extends_str)

@section('addStyle')
@endsection

@section('contents')
    <article class="sub-contents">
        <div class="sub-conbox inner-layer">

            @include('layouts.include.subTit')
            
            <div class="sub-tab-wrap">
                <ul class="sub-tab-menu n3 cf js-tabcon-menu">
                    <li class="on"><a href="#n">임원진</a></li>
					<li><a href="#n">위원회</a></li>
                    <li><a href="#n">역대 임원</a></li>
                </ul>
            </div>
            <!-- s:임원진 -->
            <div class="sub-tab-con js-tab-con" style="display: block;">
                <div class="sub-contit-wrap mt-0">
                    <h4 class="sub-tit-img">임기 2024년 1월 1일 - 12월 31일</h4>
                </div>
                <div class="table-wrap">
                    <table class="cst-table">
                        <caption class="hide">임기 2024년 1월 1일 - 12월 31일</caption>
                        <colgroup>
                            <col style="width: 25%;">
                            <col style="width: 25%;">
                            <col style="width: 50%;">
                        </colgroup>
                        <thead>
							<tr>
								<th scope="col" colspan="2">직책</th>
								<th scope="col">성명(소속)</th>
							</tr>
                        </thead>
                        <tbody>
							<tr>
								<td colspan="2">회장</td>
								<td>허준(성균관의대)</td>
							</tr>
							<tr>
								<td colspan="2">이사장</td>
								<td>차태준(고신의대)</td>
							</tr>
							<tr>
								<td colspan="2">부회장</td>
								<td>오세일(서울의대)</td>
							</tr>
							<tr>
								<td colspan="2">총무이사</td>
								<td>오일영(서울의대)</td>
							</tr>
							<tr>
								<td colspan="2" rowspan="2">재무이사</td>
								<td>박형욱(계명의대)</td>
							</tr>
							<tr>
								<td>이영수(대구가톨릭의대)</td>
							</tr>
							<tr>
								<td rowspan="3">학술이사</td>
								<td>학술대회</td>
								<td>최종일(고려의대)</td>
							</tr>
							<tr>
								<td>Virtual Symposium</td>
								<td>박형섭(계명의대)</td>
							</tr>
							<tr>
								<td>Virtual Live Symposium</td>
								<td>김태훈(연세의대)</td>
							</tr>
							<tr>
								<td colspan="2">홍보이사</td>
								<td>한성욱(강심내과)</td>
							</tr>
							<tr>
								<td colspan="2">의료정보(홈페이지)이사</td>
								<td>이기홍(전남의대)</td>
							</tr>
							<tr>
								<td colspan="2">간행이사</td>
								<td>온영근(성균관의대)</td>
							</tr>
							<tr>
								<td colspan="2">연구이사</td>
								<td>최의근(서울의대)</td>
							</tr>
							<tr>
								<td rowspan="2">보험이사</td>
								<td>Ablation</td>
								<td>김성환(가톨릭의대)</td>
							</tr>
							<tr>
								<td>Device</td>
								<td>심재민(고려의대)</td>
							</tr>
							<tr>
								<td rowspan="3">정책이사</td>
								<td>검사, 상대가치평가</td>
								<td>김진배(경희의대)</td>
							</tr>
							<tr>
								<td>검사, 상대가치평가</td>
								<td>박상원(부천세종병원)</td>
							</tr>
							<tr>
								<td>약제</td>
								<td>장성원(가톨릭의대)</td>
							</tr>
							<tr>
								<td rowspan="2">교육이사</td>
								<td>개원의</td>
								<td>김준(울산의대)</td>
							</tr>
							<tr>
								<td>수련의 및 Fellow</td>
								<td>진은선(경희의대)</td>
							</tr>
							<tr>
								<td colspan="2">국제교류이사</td>
								<td>정보영(연세의대)</td>
							</tr>
							<tr>
								<td colspan="2">Allied Professional 이사</td>
								<td>박승정(성균관의대)</td>
							</tr>
							<tr>
								<td colspan="2">소아-선천성심장병이사</td>
								<td>엄재선(연세의대)</td>
							</tr>
							<tr>
								<td colspan="2" rowspan="2">감사</td>
								<td>남기병(울산의대)</td>
							</tr>
							<tr>
								<td>황교승(아주의대)</td>
							</tr>
							<tr>
								<td colspan="2">진료지침이사</td>
								<td>성정훈(차의대)</td>
							</tr>
							<tr>
								<td colspan="2">Korean Junior Rhythm 이사</td>
								<td>박예민(가천의대)</td>
							</tr>
							<tr>
								<td colspan="2">임원추천위원장</td>
								<td>최기준(울산의대)</td>
							</tr>
							<tr>
								<td colspan="2">부정맥중재시술전문의 자격심사위원장</td>
								<td>이명용(단국의대)</td>
							</tr>
							<tr>
								<td colspan="2">국제봉사위원장</td>
								<td>오용석(가톨릭의대)</td>
							</tr>
							<tr>
								<td colspan="2">윤리위원장</td>
								<td>김남호(원광의대)</td>
							</tr>
							<tr>
								<td colspan="2">급사위원장</td>
								<td>한상진(한림의대)</td>
							</tr>
                        </tbody>
                    </table>
                </div>

                <div class="sub-contit-wrap">
                    <h4 class="sub-tit-img">임기 2023년 1월 1일 - 2024년 12월 31일</h4>
                </div>
                <div class="table-wrap scroll-x touch-help">
                    <table class="cst-table">
                        <caption class="hide">임기 2023년 1월 1일 - 2024년 12월 31일</caption>
                        <colgroup>
                            <col style="width: 20%;">
                            <col style="width: 20%;">
                            <col style="width: 30%;">
                            <col style="width: 30%;">
                        </colgroup>
                        <thead>
                        <tr>
                            <th scope="col" colspan="2">직책</th>
                            <th scope="col">성명</th>
                            <th scope="col">소속</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td colspan="2">이사장</td>
                            <td>차태준</td>
                            <td>고신의대</td>
                        </tr>
                        <tr>
                            <td colspan="2">부회장</td>
                            <td>오세일</td>
                            <td>서울의대</td>
                        </tr>
                        <tr>
                            <td colspan="2">총무이사</td>
                            <td>오일영</td>
                            <td>서울의대</td>
                        </tr>
                        <tr>
                            <td rowspan="2" colspan="2">재무이사</td>
                            <td>박형욱</td>
                            <td>전남의대</td>
                        </tr>
                        <tr>
                            <td>이영수</td>
                            <td>대구가톨릭의대</td>
                        </tr>
                        <tr>
                            <td rowspan="3">학술이사</td>
                            <td>학술대회</td>
                            <td>최종일</td>
                            <td>고려의대</td>
                        </tr>
                        <tr>
                            <td>virtual symposium</td>
                            <td>박형섭</td>
                            <td>계명의대</td>
                        </tr>
                        <tr>
                            <td>virtual live symposium</td>
                            <td>조민수</td>
                            <td>울산의대</td>
                        </tr>
                        <tr>
                            <td colspan="2">홍보이사</td>
                            <td>한성욱</td>
                            <td>계명의대</td>
                        </tr>
                        <tr>
                            <td colspan="2">의료정보(홈페이지)이사</td>
                            <td>이기홍</td>
                            <td>전남의대</td>
                        </tr>
                        <tr>
                            <td colspan="2">간행이사</td>
                            <td>온영근</td>
                            <td>성균관의대</td>
                        </tr>
                        <tr>
                            <td colspan="2">연구이사</td>
                            <td>최의근</td>
                            <td>서울의대</td>
                        </tr>
                        <tr>
                            <td rowspan="2">보험이사</td>
                            <td>ablation</td>
                            <td>김성환</td>
                            <td>가톨릭의대</td>
                        </tr>
                        <tr>
                            <td>device</td>
                            <td>심재민</td>
                            <td>고려의대</td>
                        </tr>
                        <tr>
                            <td rowspan="3">정책이사</td>
                            <td>검사, 상대가치평가</td>
                            <td>김진배</td>
                            <td>경희의대</td>
                        </tr>
                        <tr>
                            <td>검사, 상대가치평가</td>
                            <td>박상원</td>
                            <td>부천세종병원</td>
                        </tr>
                        <tr>
                            <td>약제</td>
                            <td>장성원</td>
                            <td>가톨릭의대</td>
                        </tr>
                        <tr>
                            <td rowspan="2">교육이사</td>
                            <td>개원의</td>
                            <td>김 준</td>
                            <td>울산의대</td>
                        </tr>
                        <tr>
                            <td>수련의 및 fellow</td>
                            <td>진은선</td>
                            <td>경희의대</td>
                        </tr>
                        <tr>
                            <td colspan="2">국제교류이사</td>
                            <td>정보영</td>
                            <td>연세의대</td>
                        </tr>
                        <tr>
                            <td colspan="2">Allied Professional</td>
                            <td>박승정</td>
                            <td>성균관의대</td>
                        </tr>
                        <tr>
                            <td colspan="2">소아-선천성심장병이사</td>
                            <td>엄재선</td>
                            <td>연세의대</td>
                        </tr>
                        <tr>
                            <td colspan="2" rowspan="2">감사</td>
                            <td>남기병</td>
                            <td>울산의대</td>
                        </tr>
                        <tr>
                            <td>황교승</td>
                            <td>아주의대</td>
                        </tr>
                        <tr>
                            <td colspan="2">진료지침이사</td>
                            <td>성정훈</td>
                            <td>차의대</td>
                        </tr>
                        <tr>
                            <td colspan="2">Korean Junior Rhythm</td>
                            <td>박예민</td>
                            <td>가천의대</td>
                        </tr>
                        <tr>
                            <td colspan="2">임원추천위원회 위원장</td>
                            <td>최기준</td>
                            <td>울산의대</td>
                        </tr>
                        <tr>
                            <td colspan="2">부정맥중재시술전문의 자격심사위원장</td>
                            <td>이명용</td>
                            <td>단국의대</td>
                        </tr>
                        <tr>
                            <td colspan="2">국제봉사위원회</td>
                            <td>오용석</td>
                            <td>가톨릭의대</td>
                        </tr>
                        <tr>
                            <td colspan="2">윤리위원회</td>
                            <td>김남호</td>
                            <td>원광의대</td>
                        </tr>
                        <tr>
                            <td colspan="2">급사위원회</td>
                            <td>한상진</td>
                            <td>한림의대</td>
                        </tr>
                        </tbody>
                    </table>
                </div>

                <div class="sub-contit-wrap">
                    <h4 class="sub-tit-img">평의원회</h4>
                </div>
                <div class="table-wrap">
                    <table class="cst-table">
                        <caption class="hide">평의원회</caption>
                        <colgroup>
                            <col style="width: 50%;">
                            <col style="width: 50%;">
                        </colgroup>
                        <tbody>
                        <tr>
                            <th scope="row">평의원회</th>
                            <td>TBD</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- // e:임원진 -->

			<!-- s:위원회 -->
            <div class="sub-tab-con js-tab-con">
                <div class="sub-contit-wrap mt-0">
                    <h4 class="sub-tit-img">임기 2024년 1월 1일 - 12월 31일</h4>
                </div>
                <div class="table-wrap scroll-x touch-help">
                    <table class="cst-table">
                        <caption class="hide">임기 2024년 1월 1일 - 12월 31일</caption>
                        <colgroup>
                            <col style="width: 10%;">
							<col style="width: 15%;">
                            <col style="width: 25%;">
                            <col style="width: 25%;">
							<col style="width: 25%;">
                        </colgroup>
                        <thead>
							<tr>
								<th scope="col" colspan="2">위원회명</th>
								<th scope="col" colspan="3">성명(소속)</th>
							</tr>
                        </thead>
                        <tbody>
							<tr>
								<th rowspan="16" colspan="2">학술위원회</th>
								<td>고점석(원광의대)</td> 
								<td>김동혁(이화의대)</td> 
								<td>김성환(가톨릭의대)</td>
							</tr>
							<tr>
								<td>김유리(전남의대) </td>
								<td>김주연(성균관의대)</td>
								<td> 김진배(경희의대) </td>
							</tr>
							<tr>
								<td>박경민(성균관의대) </td>
								<td>박승정(성균관의대) </td>
								<td>박예민(가천의대) </td>
							</tr>
							<tr>
								<td>박정욱(가톨릭의대) </td>
								<td>박종성(동아의대) </td>
								<td>박준범(이화의대) </td>
							</tr>
								<tr>
								<td>박진규(한양의대) </td>
								<td>박형섭(계명의대) </td>
								<td>백재숙(울산의대) </td>
							</tr>
							<tr>
								<td>송미경(서울의대) </td>
								<td>신승용(고려의대) </td>
								<td>심재민(고려의대) </td>
							</tr>
							<tr>
								<td>안진희(부산의대) </td>
								<td>양필성(차의대)</td>
								<td> 엄재선(연세의대) </td>
							</tr>
							<tr>
								<td>오일영(서울의대) </td>
								<td>윤남식(전남의대) </td>
								<td>이기홍(전남의대) </td>
							</tr>
							<tr>
								<td>이대인(고려의대) </td>
								<td>이소령(서울의대) </td>
								<td>이정명(삼육서울병원) </td>
							</tr>
							<tr>
								<td>이지현(서울의대) </td>
								<td>임성일(고신의대) </td>
								<td>정동섭(성균관의대) </td>
							</tr>
							<tr>								
								<td>조민수(울산의대) </td>
								<td>차명진(울산의대) </td>
								<td>최영(가톨릭의대) </td>
							</tr>
							<tr>								
								<td>최의근(서울의대)</td>
								<td></td>
								<td></td>
							</tr>
							<tr>
								<td colspan="3" style="background-color: #fafbfe;"> 명예위원</td>
							</tr>
							<tr>
								<td>정보영(연세의대) </td>
								<td>장성원(가톨릭의대) </td>
								<td></td>
							</tr>
							<tr>
								<td colspan="3" style="background-color: #fafbfe;">간사</td>
							</tr>
							<tr>
								<td>김윤기(고려의대) </td>
								<td></td>
								<td></td>
							</tr>
						</tbody>
                    </table>
					<table class="cst-table">
						<caption class="hide">임기 2024년 1월 1일 - 12월 31일</caption>
                        <colgroup>
                            <col style="width: 10%;">
							<col style="width: 15%;">
                            <col style="width: 25%;">
                            <col style="width: 25%;">
							<col style="width: 25%;">
                        </colgroup>
						<tbody>
							<tr>
								<th rowspan="3" colspan="2">홍보위원회</th>
								<td>김동혁(이화의대)</td>
								<td> 김민(충북의대) </td>
								<td>김민수(동강병원)</td>
							</tr>
							<tr>
								<td>박예민(가천의대)</td>
								<td> 박형섭(계명의대)</td>
								<td> 신승용(고려의대)</td>
							</tr>
							<tr>
								<td>양필성(차의대)</td>
								<td>차명진(울산의대) </td>
								<td>황종민(계명의대)</td>
							</tr>
						</tbody>
                    </table>
					<table class="cst-table">
						<caption class="hide">임기 2024년 1월 1일 - 12월 31일</caption>
                        <colgroup>
                            <col style="width: 10%;">
							<col style="width: 15%;">
                            <col style="width: 25%;">
                            <col style="width: 25%;">
							<col style="width: 25%;">
                        </colgroup>
						<tbody>
							<tr>
								<th colspan="2" rowspan="3">의료정보(홈페이지)위원회</th>
								<td>김동민(단국의대)</td>
								<td>박예민(가천의대)</td>
								<td> 신승용(고려의대)
							</tr>
							<tr>
								<td>이대인(고려의대)</td>
								<td> 이정명(삼육서울병원)</td>
								<td> 차명진(울산의대)</td>
							</tr>
							<tr>
								<td>황종민(계명의대)</td>
								<td></td>
								<td></td>
							</tr>
						</tbody>
                    </table>
					<table class="cst-table">
						<caption class="hide">임기 2024년 1월 1일 - 12월 31일</caption>
                        <colgroup>
                            <col style="width: 10%;">
							<col style="width: 15%;">
                            <col style="width: 25%;">
                            <col style="width: 25%;">
							<col style="width: 25%;">
                        </colgroup>
						<tbody>
							<tr>
								<th colspan="2" rowspan="4">간행위원회</th>
								<td>김남호(원광의대)</td>
								<td> 김대혁(인하의대)</td>
								<td> 박승정(성균관의대)
							</tr>
							<tr>
								<td> 박준범(이화의대)</td>
								<td> 오세일(서울의대)</td>
								<td> 이영수(대구가톨릭의대)
							</tr>
							<tr>
								<td> 정보영(연세의대) </td>
								<td>최의근(서울의대) </td>
								<td>한성욱(강심내과)
							</tr>
							<tr>
								<td> 황교승(아주의대)</td>
								<td></td>
								<td></td>
							</tr>
						</tbody>
                    </table>
					<table class="cst-table">
						<caption class="hide">임기 2024년 1월 1일 - 12월 31일</caption>
                        <colgroup>
                            <col style="width: 10%;">
							<col style="width: 15%;">
                            <col style="width: 25%;">
                            <col style="width: 25%;">
							<col style="width: 25%;">
                        </colgroup>
						<tbody>
							<tr>
								<th colspan="2" rowspan="7">연구위원회</th>
								<td>김대훈(연세의대)</td>
								<td> 김윤기(고려의대)</td>
								<td> 김주연(성균관의대)</td>
							</tr>
							<tr>
								<td>박종성(동아의대)</td>
								<td> 박준범(이화의대) </td>
								<td>박진규(한양의대)</td>
							</tr>
							<tr>
								<td>박형섭(계명의대)</td>
								<td> 백용수(인하의대) </td>
								<td>안진희(부산의대)</td>
							</tr>
							<tr>
								<td>양필성(차의대) </td>
								<td>이광노(아주의대) </td>
								<td>이기홍(전남의대)</td>
							</tr>
							<tr>
								<td>이성호(성균관의대)</td>
								<td> 이소령(서울의대) </td>
								<td>이정명(삼육서울병원)</td>
							</tr>
							<tr>
								<td>임우현(서울의대) </td>
								<td>조민수(울산의대) </td>
								<td>천광진(강원의대)</td>
							</tr>
							<tr>
								<td>최원석(부천세종병원)</td>
								<td></td>
								<td></td>
							</tr>
						</tbody>
                    </table>
					<table class="cst-table">
						<caption class="hide">임기 2024년 1월 1일 - 12월 31일</caption>
                        <colgroup>
                            <col style="width: 10%;">
							<col style="width: 15%;">
                            <col style="width: 25%;">
                            <col style="width: 25%;">
							<col style="width: 25%;">
                        </colgroup>
						<tbody>
							<tr>
								<th rowspan="4">보험위원회</th>
								<th rowspan="3">Ablation</th>
								<td>김동민(단국의대)</td>
								<td> 이정명(삼육서울병원)</td>
								<td> 정래영(전북의대)</td>
							</tr>
							<tr>
								<td colspan="3" style="background-color: #fafbfe;">간사</td>
							</tr>
							<tr>
								<td>신승용(고려의대)</td>
								<td></td>
								<td></td>
							</tr>
							<tr>
								<th>Device</th>
								<td>김태훈(연세의대)</td>
								<td> 박승정(성균관의대)</td>
								<td> 최영(가톨릭의대)</td>
							</tr>			
						</tbody>
                    </table>
					<table class="cst-table">
						<caption class="hide">임기 2024년 1월 1일 - 12월 31일</caption>
                        <colgroup>
                            <col style="width: 10%;">
							<col style="width: 15%;">
                            <col style="width: 25%;">
                            <col style="width: 25%;">
							<col style="width: 25%;">
                        </colgroup>
						<tbody>
							<tr>
								<th rowspan="3">정책위원회</th>
								<th rowspan="2">검사, 상대가치평가</th>
								<td>김대훈(연세의대)</td>
								<td>김인수(연세의대)</td>
								<td>노승영(고려의대)</td>
							</tr>
							<tr>
								<td>김주연(성균관의대)</td>
								<td>김화중(가톨릭의대)</td>
								<td>황종민(계명의대)</td>
							</tr>
							<tr>
								<th>약제</th>
								<td>김동혁(이화의대) </td>
								<td> 이의재(세종병원)</td>
								<td>조민수(울산의대)</td>
							</tr>
							<tr>
								<th rowspan="4">교육위원회</th>
								<th rowspan="2">개원의</th>
								<td>고점석(원광의대)</td>
								<td> 곽혜빈(성균관의대) </td>
								<td> 김민수(충남의대)</td>
							</tr>
							<tr>								
								<td> 도웅정(동국의대) </td>
								<td> 박환철(한양의대) </td>
								<td> 이성호(성균관의대)</td>
							</tr>
							<tr>
								<th rowspan="2">수련의 및 Fellow</th>
								<td> 이정명(삼육서울병원) </td>
								<td> 이지현(서울의대) </td>
								<td> 임우현(서울의대)</td>
							</tr>
							<tr>
								<td> 차명진(울산의대) </td>
								<td> 황유미(가톨릭의대) </td>
								<td> 황진경(중앙보훈병원)</td>
							</tr>
						</tbody>
                    </table>
					<table class="cst-table">
						<caption class="hide">임기 2024년 1월 1일 - 12월 31일</caption>
                        <colgroup>
                            <col style="width: 10%;">
							<col style="width: 15%;">
                            <col style="width: 25%;">
                            <col style="width: 25%;">
							<col style="width: 25%;">
                        </colgroup>
						<tbody>
							<tr>
								<th colspan="2" rowspan="5">국제교류위원회</th>
								<td>고점석(원광의대)</td>
								<td> 김대훈(연세의대) 
								<td>김동민(단국의대)</td>
							</tr>
							<tr>
								<td>김주연(성균관의대)</td> 
								<td>박준범(이화의대)</td> 
								<td>백용수(인하의대)</td>
							</tr>
							<tr>
								<td>신동금(한림의대)</td> 
								<td>신승용(고려의대) </td>
								<td>안진희(부산의대)</td>
							</tr>
							<tr>
								<td>양필성(차의대) </td>
								<td>이기홍(전남의대) </td>
								<td>이소령(서울의대)</td>
							</tr>
							<tr>
								<td>이정명(삼육서울병원) </td>
								<td>조영진(서울의대) </td>
								<td>황종민(계명의대)</td>
							</tr>
						</tbody>
                    </table>
					<table class="cst-table">
						<caption class="hide">임기 2024년 1월 1일 - 12월 31일</caption>
                        <colgroup>
                            <col style="width: 10%;">
							<col style="width: 15%;">
                            <col style="width: 25%;">
                            <col style="width: 25%;">
							<col style="width: 25%;">
                        </colgroup>
						<tbody>
							<tr>
								<th colspan="2" rowspan="5">소아-선천성심장병위원회</th>
								<td>배은정(서울의대) </td>
								<td>백재숙(울산의대)  </td>
								<td>송미경(서울의대)</td>
							</tr>
							<tr>
								<td>윤자경(연세의대)  </td>
								<td>이주성(고려의대)  </td>
								<td>최원석(부천세종병원)</td>
							</tr>
							<tr>
								<td>허준(성균관의대)</td>
								<td></td>
								<td></td>
							</tr>
							<tr>
								<td colspan="3" style="background-color: #fafbfe;">간사 </td>
							</tr>
							<tr>
								<td>반지은(성균관의대)</td>
								<td></td>
								<td></td>
							</tr>
						</tbody>
                    </table>
					<table class="cst-table">
						<caption class="hide">임기 2024년 1월 1일 - 12월 31일</caption>
                        <colgroup>
                            <col style="width: 10%;">
							<col style="width: 15%;">
                            <col style="width: 25%;">
                            <col style="width: 25%;">
							<col style="width: 25%;">
                        </colgroup>
						<tbody>
							<tr>
								<th colspan="2" rowspan="28">진료지침위원회</th>
								<td>강기운(중앙의대) </td>
								<td>고점석(원광의대) </td>
								<td>곽혜빈(성균관의대)</td>
							</tr>
							<tr>
								<td>권창희(건국의대) </td>
								<td>권희진(충남의대)</td>
								<td> 김대훈(연세의대)</td>
							</tr>
							<tr>
								<td>김동민(단국의대) </td>
								<td>김민(충북의대) </td>
								<td>김민수(동강병원)</td>
							</tr>
							<tr>
								<td>김민수(충남의대) </td>
								<td>김성수(조선의대)</td>
								<td> 김성환(가톨릭의대)</td>
							</tr>
							<tr>
								<td>김유리(전남의대) </td>
								<td>김윤기(고려의대) </td>
								<td>김주연(성균관의대)</td>
							</tr>
							<tr>
								<td>김진배(경희의대) </td>
								<td>김태석(가톨릭의대) </td>
								<td>김태훈(연세의대)</td>
							</tr>
							<tr>
								<td>노승영(고려의대) </td>
								<td>문희선(연세의대) </td>
								<td>박경민(성균관의대)</td>
							</tr>
							<tr>
								<td>박승정(성균관의대) </td>
								<td>박영준(연세원주의대) </td>
								<td>박예민(가천의대)</td>
							</tr>
							<tr>
								<td>박윤정(경북의대) </td>
								<td>박제욱(연세의대) </td>
								<td>박종성(동아의대)</td>
							</tr>
							<tr>
								<td>박준범(이화의대) </td>
								<td>박진규(한양의대) </td>
								<td>박형섭(계명의대)</td>
							</tr>
							<tr>
								<td>반지은(성균관의대) </td>
								<td>백용수(인하의대) </td>
								<td>변경민(중앙의대)</td>
							</tr>
							<tr>
								<td>송미경(서울의대) </td>
								<td>신동금(한림의대) </td>
								<td>신승용(고려의대)</td>
							</tr>
							<tr>
								<td>심재민(고려의대)</td>
								<td> 안민수(연세원주의대) </td>
								<td>안진희(부산의대)</td>
							</tr>
							<tr>
								<td>엄재선(연세의대) </td>
								<td>유가인(경상의대) </td>
								<td>유희태(연세의대)</td>
							</tr>
							<tr>
								<td>윤남식(전남의대) </td>
								<td>이기홍(전남의대)</td>
								<td> 이대인(고려의대)</td>
							</tr>
							<tr>
								<td>이성수(순천향의대) </td>
								<td>이소령(서울의대) </td>
								<td>이영수(대구가톨릭의대)</td>
							</tr>
							<tr>
								<td>이정명(삼육서울병원) </td>
								<td>이주원(서울의대) </td>
								<td>이지현(서울의대)</td>
							</tr>
							<tr>
								<td>이찬희(영남의대) </td>
								<td>임성일(고신의대) </td>
								<td>임우현(서울의대)</td>
							</tr>
							<tr>
								<td>정래영(전북의대) </td>
								<td>조민수(울산의대) </td>
								<td>진무년(이화의대)</td>
							</tr>
							<tr>
								<td>차명진(울산의대) </td>
								<td>천광진(강원의대) </td>
								<td>최의근(서울의대)</td>
							</tr>
							<tr>
								<td>최형오(순천향의대) </td>
								<td>황유미(가톨릭의대) </td>
								<td>황종민(계명의대)</td>
							</tr>
							<tr>
								<td>황진경(중앙보훈병원)</td>
								<td></td>
								<td></td>
							</tr>
							<tr>
								<td colspan="3" style="background-color: #fafbfe;">감수</td>
							</tr>
							<tr>
								<td>김남호(원광의대) </td>
								<td>남기병(울산의대) </td>
								<td>박상원(부천세종병원)</td>
							</tr>
							<tr>
								<td>박형욱(전남의대) </td>
								<td>박희남(연세의대) </td>
								<td>오세일(서울의대)</td>
							</tr>
							<tr>
								<td>온영근(성균관의대) </td>
								<td>정보영(연세의대) </td>
								<td>한성욱(강심내과)</td>
							</tr>
							<tr>
								<td colspan="3" style="background-color: #fafbfe;">간사 </td>
							</tr>
							<tr>							
								<td>김문현(연세의대) </td>
								<td>양필성(차의대)</td>
								<td></td>
								</tr>
							</tr>
						</tbody>
                    </table>
					<table class="cst-table">
						<caption class="hide">임기 2024년 1월 1일 - 12월 31일</caption>
                        <colgroup>
                            <col style="width: 10%;">
							<col style="width: 15%;">
                            <col style="width: 25%;">
                            <col style="width: 25%;">
							<col style="width: 25%;">
                        </colgroup>
						<tbody>
							<tr>
								<th colspan="2" rowspan="27">Korean Junior Rhythm 위원회</th>
								<td>강기운(중앙의대) </td>
								<td>곽혜빈(성균관의대)</td>
								<td> 권창희(건국의대)</td>
							</tr>
							<tr>
								<td>권희진(충남의대)</td>
								<td> 김도영(아주의대) </td>
								<td>김동민(단국의대)</td>
							</tr>
							<tr>
								<td>김동혁(이화의대) </td>
								<td>김민(충북의대)</td>
								<td> 김민수(충남의대)</td>
							</tr>
							<tr>
								<td>김선화(전주예수병원)</td>
								<td>김용균(울산의대)</td>
								<td> 김유리(전남의대)</td>
							</tr>
							<tr>
								<td>김윤기(고려의대)</td>
								<td> 김주연(성균관의대)</td>
								<td> 김태석(가톨릭의대)</td>
							</tr>
							<tr>
								<td>김태훈(연세의대)</td>
								<td> 김혜리(경상의대) </td>
								<td>도웅정(동국의대)</td>
							</tr>
							<tr>
								<td>문희선(연세의대) </td>
								<td>민경진(인천세종병원) </td>
								<td>박규환(대구보훈병원)</td>
							</tr>
							<tr>
								<td>박영아(인제의대) </td>
								<td>박영준(연세원주의대)</td>
								<td> 박윤정(경북의대)</td>
							</tr>
							<tr>
								<td>박제욱(연세의대)</td>
								<td> 박준범(이화의대) </td>
								<td>박진규(한양의대)</td>
							</tr>
							<tr>
								<td>배한준(대구가톨릭의대) </td>
								<td>백용수(인하의대)</td>
								<td> 변경민(중앙의대)</td>
							</tr>
							<tr>
								<td>부기영(제주의대)</td>
								<td> 송미경(서울의대) </td>
								<td>송인걸(백제종합병원)</td>
							</tr>
							<tr>
								<td>신동금(한림의대) </td>
								<td>신승용(고려의대) </td>
								<td>안진희(부산의대)</td>
							</tr>
							<tr>
								<td>양필성(차의대) </td>
								<td>유가인(경상의대) </td>
								<td>유희태(연세의대)</td>
							</tr>
							<tr>
								<td>이광노(아주의대) </td>
								<td>이기홍(전남의대)</td>
								<td> 이대인(고려의대)</td>
							</tr>
							<tr>
								<td>이성수(순천향의대) </td>
								<td>이성호(성균관의대) </td>
								<td>이소령(서울의대)</td>
							</tr>
							<tr>
								<td>이우석(여수제일병원)</td>
								<td> 이의재(부천세종병원)</td>
								<td> 이재혁(명지병원)</td>
							</tr>
							<tr>
								<td>이정명(삼육서울병원) </td>
								<td>이지현(서울의대) </td>
								<td>이찬희(영남의대)</td>
							</tr>
							<tr>
								<td>이한철(국민건강보험 일산병원) </td>
								<td>이혜영(인제의대)</td>
								<td>임성일(고신의대) </td>
							</tr>
							<tr>								
								<td>임영민(순천가를로병원) </td>
								<td>임우현(서울의대)</td>
								<td>정래영(전북의대) </td>
							</tr>
							<tr>								
								<td>정형기(원광의대) </td>
								<td>조민수(울산의대)</td>
								<td>조영진(서울의대) </td>
							</tr>
							<tr>								
								<td>조현준(대구파티마병원) </td>
								<td>진무년(이화의대)</td>
								<td>차명진(울산의대) </td>
							</tr>
							<tr>								
								<td>천광진(강원의대) </td>
								<td>최원석(부천세종병원)</td>
								<td>최지훈(성균관의대) </td>
							</tr>
							<tr>								
								<td>최진희(부산의대) </td>
								<td>최하영(순천향의대)</td>
								<td>황기원(부산의대) </td>
							</tr>
							<tr>								
								<td>황유미(가톨릭의대) </td>
								<td>황종민(계명의대)</td>
								<td>황진경(중앙보훈병원)</td>
							</tr>
							<tr>
								<td colspan="3" style="background-color: #fafbfe;">간사</td>
							</tr>
							<tr>
								<td>곽혜빈(성균관의대)</td>
								<td> 김대훈(연세의대)</td>
								<td> 김성수(조선의대)</td>
							</tr>
							<tr>
								<td>노승영(고려의대)</td>
								<td> 최영(가톨릭의대)</td>
								<td></td>
							</tr>
						</tbody>
                    </table>
					<table class="cst-table">
						<caption class="hide">임기 2024년 1월 1일 - 12월 31일</caption>
                        <colgroup>
                            <col style="width: 10%;">
							<col style="width: 15%;">
                            <col style="width: 25%;">
                            <col style="width: 25%;">
							<col style="width: 25%;">
                        </colgroup>
						<tbody>
							<tr>
								<th colspan="2">임원추천위원회</th>
								<td>오용석(가톨릭의대) </td>
								<td>이문형(연세의대)</td>
								<td></td>
							</tr>
						</tbody>
                    </table>
					<table class="cst-table">
						<caption class="hide">임기 2024년 1월 1일 - 12월 31일</caption>
                        <colgroup>
                            <col style="width: 10%;">
							<col style="width: 15%;">
                            <col style="width: 25%;">
                            <col style="width: 25%;">
							<col style="width: 25%;">
                        </colgroup>
						<tbody>
							<tr>
								<th colspan="2" rowspan="3">부정맥시술전문의 자격심사위원회</th>
								<td>김남호(원광의대)</td>
								<td>김영훈(고려의대)</td>
								<td> 신동구(신동구내과)</td>
							</tr>
							<tr>
								<td>오동진(한림의대)</td>
								<td> 오세일(서울의대)</td>
								<td> 오용석(가톨릭의대)</td>
							</tr>
							<tr>
								<td>이만영(가톨릭의대)</td>
								<td> 이문형(연세의대)</td>
								<td> 차태준(고신의대)</td>								
							</tr>
						</tbody>
                    </table>
					<table class="cst-table">
						<caption class="hide">임기 2024년 1월 1일 - 12월 31일</caption>
                        <colgroup>
                            <col style="width: 10%;">
							<col style="width: 15%;">
                            <col style="width: 25%;">
                            <col style="width: 25%;">
							<col style="width: 25%;">
                        </colgroup>
						<tbody>
							<tr>
								<th colspan="2" rowspan="19">국제봉사위원회</th>
								<td>김도영(한림의대)</td>
								<td> 김민(충북의대)</td>
								<td> 김민수(동강병원)</td>
							</tr>
							<tr>
								<td>김선화(전주예수병원) </td>
								<td>김성환(가톨릭의대) </td>
								<td>김영훈(고려의대) </td>
							</tr>
							<tr>
								<td>김유리(전남의대) </td>
								<td>김주연(성균관의대) </td>
								<td>남기병(울산의대) </td>
							</tr>
							<tr>
								<td>노승영(고려의대) </td>
								<td>문희선(연세의대) </td>
								<td>박영준(연세원주의대) </td>
							</tr>
							<tr>
								<td>박예민(가천의대) </td>
								<td>박형섭(계명의대) </td>
								<td>박형욱(전남의대) </td>
							</tr>
							<tr>
								<td>배은정(서울의대) </td>
								<td>서정욱(인천세종병원) </td>
								<td>이경연(서울의대) </td>
							</tr>
							<tr>
								<td>이광노(아주의대) </td>
								<td>이기홍(전남의대) </td>
								<td>이대인(고려의대) </td>
							</tr>
							<tr>
								<td>이소령(서울의대) </td>
								<td>이우석(여수제일병원) </td>
								<td>이의재(부천세종병원) </td>
							</tr>
							<tr>
								<td>이지현(서울의대) </td>
								<td>이찬희(영남의대) </td>
								<td>이창희(성균관의대) </td>
							</tr>
							<tr>
								<td>임성일(고신의대) </td>
								<td>한성욱(강심내과) </td>
								<td>현대우(안동병원)</td>
							</tr>
							<tr>
								<td>황유미(가톨릭의대)</td>
								<td></td>
								<td></td>
							</tr>
							<tr>
								<td colspan="3" style="background-color: #fafbfe;">고문</td>
							</tr>
							<tr>
								<td>황준(KHRS Executive Advisor for Foreign Developmet)</td>
								<td></td>
								<td></td>
							</tr>
							<tr>
								<td colspan="3" style="background-color: #fafbfe;">총무</td>
							</tr>
							<tr>
								<td>박희남(연세의대)</td>
								<td></td>
								<td></td>
							</tr>
							<tr>							
								<td colspan="3" style="background-color: #fafbfe;">간사</td>
							</tr>
							<tr>
								<td>최영(가톨릭의대)</td>
								<td></td>
								<td></td>
							</tr>
							<tr>
								<td colspan="3" style="background-color: #fafbfe;">감사</td>
							</tr>
							<tr>
								<td>조용근(경북의대)</td>
								<td></td>
								<td></td>
							</tr>
						</tbody>
                    </table>
					<table class="cst-table">
						<caption class="hide">임기 2024년 1월 1일 - 12월 31일</caption>
                        <colgroup>
                            <col style="width: 10%;">
							<col style="width: 15%;">
                            <col style="width: 25%;">
                            <col style="width: 25%;">
							<col style="width: 25%;">
                        </colgroup>
						<tbody>
							<tr>
								<th colspan="2" rowspan="3">윤리위원회</th>
								<td>고점석(원광의대)</td>
								<td> 김선화(전주예수병원)</td>
								<td> 김성수(조선의대)</td>
							</tr>
							<tr>
								<td>박종성(동아의대)</td>
								<td> 이광노(아주의대)</td>
								<td> 이소령(서울의대)</td>
							</tr>
							<tr>
								<td>진무년(이화의대)</td>
								<td></td>
								<td></td>
							</tr>
						</tbody>
                    </table>
					<table class="cst-table">
						<caption class="hide">임기 2024년 1월 1일 - 12월 31일</caption>
                        <colgroup>
                            <col style="width: 10%;">
							<col style="width: 15%;">
                            <col style="width: 25%;">
                            <col style="width: 25%;">
							<col style="width: 25%;">
                        </colgroup>
						<tbody>
							<tr>
								<th colspan="2" rowspan="7">급사위원회</th>
								<td>곽혜빈(성균관의대)</td>
								<td> 김도영(아주의대)</td>
								<td> 신승용(고려의대)</td>
							</tr>
							<tr>
								<td>안진희(부산의대)</td>
								<td> 위진(가천의대)</td>
								<td> 조영진(서울의대)</td>
							</tr>
							<tr>
								<td>천광진(강원의대)</td>
								<td></td>
								<td></td>
							</tr>
							<tr>						
								<td colspan="3" style="background-color: #fafbfe;">간사</td>
							</tr>
							<tr>
								<td>박환철(한양의대)</td>
								<td></td>
								<td></td>
							</tr>
							<tr>
								<td colspan="3" style="background-color: #fafbfe;">고문</td>
							</tr>
							<tr>
								<td>오동진(한림의대)</td>
								<td> 조용근(경북의대)</td>
								<td></td>
							</tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- // e:위원회 -->

            <!-- s:역대 임원 -->
            <div class="sub-tab-con js-tab-con">
                <div class="table-wrap">
                    <table class="cst-table">
                        <caption class="hide">대한부정맥학회 회장</caption>
                        <colgroup>
                            <col style="width: 33.33%;">
                            <col style="width: 33.33%;">
                            <col style="width: 33.33%;">
                        </colgroup>
                        <thead>
                        <tr>
                            <th scope="col" colspan="3">대한부정맥학회 회장</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>초대회장</td>
                            <td>2017 - 2018</td>
                            <td>김영훈</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>2019</td>
                            <td>곽충환</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>2020</td>
                            <td>배은정</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>2021</td>
                            <td>이문형</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>2022</td>
                            <td>현명철</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>2023</td>
                            <td>이명용</td>
                        </tr>
                        </tbody>
                    </table>
                </div>

				<div class="table-wrap">
                    <table class="cst-table">
                        <caption class="hide">대한부정맥학회 이사장</caption>
                        <colgroup>
                            <col style="width: 33.33%;">
                            <col style="width: 33.33%;">
                            <col style="width: 33.33%;">
                        </colgroup>
                        <thead>
                        <tr>
                            <th scope="col" colspan="3">대한부정맥학회 이사장</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>초대이사장</td>
                            <td>2019-2020</td>
                            <td>오용석</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>2021-2022</td>
                            <td>최기준</td>
                        </tr>
                        </tbody>
                    </table>
                </div>

                <div class="table-wrap">
                    <table class="cst-table">
                        <caption class="hide">부정맥연구회 역대 회장</caption>
                        <colgroup>
                            <col style="width: 33.33%;">
                            <col style="width: 33.33%;">
                            <col style="width: 33.33%;">
                        </colgroup>
                        <thead>
                        <tr>
                            <th scope="col" colspan="3">부정맥연구회 역대 회장</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>1대</td>
                            <td>1997 – 1998</td>
                            <td>홍순조</td>
                        </tr>
                        <tr>
                            <td>2대</td>
                            <td>1999 – 2000</td>
                            <td>최윤식</td>
                        </tr>
                        <tr>
                            <td>3대</td>
                            <td>2001 – 2002</td>
                            <td>김성순</td>
                        </tr>
                        <tr>
                            <td>4대</td>
                            <td>2003 – 2004</td>
                            <td>노태호</td>
                        </tr>
                        <tr>
                            <td>5대</td>
                            <td>2005 – 2006</td>
                            <td>김윤년</td>
                        </tr>
                        <tr>
                            <td>6대</td>
                            <td>2007 - 2008</td>
                            <td>김유호</td>
                        </tr>
                        <tr>
                            <td>7대</td>
                            <td>2009 – 2010</td>
                            <td>조정관</td>
                        </tr>
                        <tr>
                            <td>8대</td>
                            <td>2011 – 2012</td>
                            <td>이만영</td>
                        </tr>
                        <tr>
                            <td>9대</td>
                            <td>2013</td>
                            <td>오동진</td>
                        </tr>
                        <tr>
                            <td>10대</td>
                            <td>2014</td>
                            <td>김준수</td>
                        </tr>
                        <tr>
                            <td>11대</td>
                            <td>2015 – 2016</td>
                            <td>신동구</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- // e:역대 임원 -->
        </div>
    </article>
@endsection

@section('addScript')

@endsection