@extends('pro.layouts.pro-layout')

@section('addStyle')
@endsection

@section('contents')

    <article class="sub-contents">
        <div class="sub-conbox committee-conbox inner-layer">

            @include('layouts.include.subTit')
            
            <div class="table-wrap">
                <table class="cst-table">
                    <caption class="hide">임원진/위원회</caption>
                    <colgroup>
                        <col style="width: 20%;">
                        <col style="width: 20%;">
                        <col>
                    </colgroup>
                    <thead>
                        <tr>
                            <th scope="col">직책</th>
                            <th scope="col">성명</th>
                            <th scope="col">소속</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>회장</td>
                            <td>이창희</td>
                            <td>삼성서울병원</td>
                        </tr>
                        <tr>
                            <td>부회장</td>
                            <td>문성호</td>
                            <td>서울아산병원</td>
                        </tr>
                        <tr>
                            <td>명예회장</td>
                            <td>정진용</td>
                            <td>서울아산병원</td>
                        </tr>
                        <tr>
                            <td>감사</td>
                            <td>박소영</td>
                            <td>서울대학교병원</td>
                        </tr>
                        <tr>
                            <td>총무이사</td>
                            <td>정원영</td>
                            <td>삼성서울병원</td>
                        </tr>
                        <tr>
                            <td>총무부장</td>
                            <td>신현우</td>
                            <td>고려대학교 안암병원</td>
                        </tr>
                        <tr>
                            <td>재무이사</td>
                            <td>장경희</td>
                            <td>한림대성심병원</td>
                        </tr>
                        <tr>
                            <td>재무부장</td>
                            <td>이정호</td>
                            <td>인제대학교 상계백병원</td>
                        </tr>
                        <tr>
                            <td>학술이사</td>
                            <td>유원우</td>
                            <td>신촌세브란스병원</td>
                        </tr>
                        <tr>
                            <td>학술부장</td>
                            <td>박덕우</td>
                            <td>신촌세브란스병원</td>
                        </tr>
                        <tr>
                            <td>국제교류이사</td>
                            <td>박정욱</td>
                            <td>서울성모병원</td>
                        </tr>
                        <tr>
                            <td>국제교류부장</td>
                            <td>하영웅</td>
                            <td>서울성모병원</td>
                        </tr>
                        <tr>
                            <td>홍보이사</td>
                            <td>김형준</td>
                            <td>삼성서울병원</td>
                        </tr>
                        <tr>
                            <td>홍보부장</td>
                            <td>유인오</td>
                            <td>중앙보훈병원</td>
                        </tr>
                        <tr>
                            <td>자문위원</td>
                            <td>이희령</td>
                            <td>경희대학교병원</td>
                        </tr>
                        <tr>
                            <td>자문위원</td>
                            <td>최 옥</td>
                            <td>분당서울대학교병원</td>
                        </tr>
                        <tr>
                            <td>자문위원</td>
                            <td>문홍률</td>
                            <td>동아대학교병원</td>
                        </tr>
                        <tr>
                            <td>Noninvasive</td>
                            <td>김한나</td>
                            <td>서울아산병원</td>
                        </tr>
                        <tr>
                            <td>CIED</td>
                            <td>강나윤</td>
                            <td>단국대학교병원</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </article>

@endsection

@section('addScript')

@endsection