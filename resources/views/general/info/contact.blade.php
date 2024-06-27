@extends('general.layouts.general-layout')

@section('addStyle')
@endsection

@section('contents')
    <article class="sub-contents">
        <div class="sub-conbox inner-layer">
			<div class="sub-tit-wrap">
                <h3 class="sub-tit">사무국안내</h3>
            </div>
			<div class="sub-contit-wrap">
                <h4 class="sub-contit">담당자</h4>
            </div>
            <div class="table-wrap scroll-x touch-help">
                <table class="cst-table">
                    <caption class="hide">담당자 정보</caption>
                    <colgroup>
                        <col style="width: 25%;">
                        <col style="width: 25%;">
                        <col style="width: 25%;">
                        <col style="width: 25%;">
                    </colgroup>
                    <thead>
                    <tr>
                        <th scope="col">이름</th>
                        <th scope="col">직책</th>
                        <th scope="col">담당업무</th>
                        <th scope="col">이메일</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>이슬기</td>
                        <td>실장</td>
                        <td>총괄, 홍보, 재무, 연구</td>
                        <td><a href="mailto:khrs6@k-hrs.org" target="_blank" class="link">khrs6@k-hrs.org</a></td>
                    </tr>
                    <tr>
                        <td>김효정</td>
                        <td>과장</td>
                        <td>학술, 해외학회</td>
                        <td><a href="mailto:khrs9@k-hrs.org" target="_blank" class="link">khrs9@k-hrs.org</a></td>
                    </tr>
                    <tr>
                        <td>권다영</td>
                        <td rowspan="2">대리</td>
                        <td>해외학회, 재무, 연구</td>
                        <td><a href="mailto:khrs2@k-hrs.org" target="_blank" class="link">khrs2@k-hrs.org</a></td>
                    </tr>
                    <tr>
                        <td>정세빈</td>                        
                        <td>간행, 보험, 정책, 교육</td>
                        <td><a href="mailto:khrs7@k-hrs.org" target="_blank" class="link">khrs7@k-hrs.org</a></td>
                    </tr>
                    <tr>
                        <td>박민영</td>
						<td>사원</td>
                        <td>연구회, 의료정보, 교육, 회원, 중재시술인증</td>
                        <td><a href="mailto:khrs10@k-hrs.org" target="_blank" class="link">khrs10@k-hrs.org</a></td>
                    </tr>
                    </tbody>
                </table>
            </div>
           
            <div class="map-wrap">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3163.1439994164666!2d126.9732103!3d37.551671!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x357ca267ac181593%3A0x10153c71814e7b14!2z7ISc7Jq47Yq567OE7IucIOyaqeyCsOq1rCDtlZzqsJXrjIDroZwgMzcy!5e0!3m2!1sko!2skr!4v1718241260993!5m2!1sko!2skr" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>

            <ul class="map-info-list">
                <li>
                    <img src="/html/general/assets/image/sub/ic_map_info01.png" alt="">
                    <div class="text-wrap">
                        <strong class="tit">주소</strong>
                        <ul class="list-type list-type-dot">
                            <li>
                                <strong>도로명 주소</strong> <br>
                                서울시 용산구 한강대로 372, A동 1604호
                            </li>
                            <li>
                                <strong>지번 주소</strong> <br>
                                서울특별시 용산구 동자동 45, 센트레빌아스테리움서울 A동 1604호
                            </li>
                        </ul>
                    </div>
                </li>
                <li>
                    <img src="/html/general/assets/image/sub/ic_map_info02.png" alt="">
                    <div class="text-wrap">
                        <strong class="tit">오시는 길</strong>
                        <ul class="list-type list-type-dot">
                            <li>
                                <strong>대중교통 이용 시</strong> <br>
                                <span class="mark-subway">4</span> 4호선 서울역 12번 출구
                            </li>
                            <li>
                                <strong>자가용 이용 시</strong> <br>
                                아스테리움 서울 A동 업무동 지하주차장 이용
                            </li>
                        </ul>
                    </div>
                </li>
                <li>
                    <img src="/html/general/assets/image/sub/ic_map_info03.png" alt="">
                    <div class="text-wrap">
                        <strong class="tit">전화</strong>
                        <ul class="list-type list-type-dot">
                            <li>
                                T. <a href="tel:02-318-5416" target="_blank">02-318-5416</a>
                            </li>
                        </ul>

                        <strong class="tit">팩스</strong>
                        <ul class="list-type list-type-dot">
                            <li>
                                F. 02-318-5417
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
            
        </div>
    </article>
@endsection

@section('addScript')
@endsection