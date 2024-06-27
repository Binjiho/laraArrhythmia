<div id="kspay-div">
    <!-----------------------------------------<Part 1. KSPayWeb Form: 결과페이지주소 설정 > ---------------------------------------->
    <!--결제 완료후 결과값을 받아처리할 결과페이지의 주소-->
    <form name=KSPayWeb method=post>
        <!----------------------------------------------- <Part 1. 설정항목>  ----------------------------------------------->

        <input type="hidden" name="sndStoreid" value="{{ $sndStoreid }}">
        <input type="hidden" name="sndPaymethod" value="{{ $sndPaymethod }}">

        <input type="hidden" name="sndAmount" value="{{ $sndAmount }}">
        <input type="hidden" name="sndGoodname" value="{{ $sndGoodname }}">
        <input type="hidden" name="sndOrdernumber" value="{{ $sndOrdernumber }}">

        <input type="hidden" name="sndOrdername" value="{{ $sndOrdername }}">
        <input type="hidden" name="sndMobile" value="{{ $sndMobile ?? '' }}">
        <input type="hidden" name="sndEmail" value="{{ $sndEmail ?? '' }}">

        <!----------------------------------------------- <Part 2. 추가설정항목(메뉴얼참조)>  ----------------------------------------------->

        <!-- 0. 공통 환경설정 -->
        <input type="hidden" name="sndReply">
        <input type="hidden" name="sndCharSet" value="UTF-8">    <!-- 가맹점 CharSet 환경 EUC-KR, UTF-8-->
        <input type="hidden" name="sndGoodType" value="1">    <!-- 상품유형: 실물(1),디지털(2) -->

        <!-- 1. 신용카드 관련설정 -->

        <!-- 신용카드 결제방법  -->
        <!-- 일반적인 업체의 경우 ISP,안심결제만 사용하면 되며 다른 결제방법 추가시에는 사전에 협의이후 적용바랍니다 -->
        <input type="hidden" name="sndShowcard" value="C">

        <!-- 신용카드(해외카드) 통화코드: 해외카드결제시 달러결제를 사용할경우 변경 -->
        <input type="hidden" name="sndCurrencytype" value="WON"> <!-- 원화(WON), 달러(USD) -->
        <input type="hidden" name="iframeYn" value="Y"> <!-- 원화(WON), 달러(USD) -->

        <!-- 할부개월수 선택범위 -->
        <!--상점에서 적용할 할부개월수를 세팅합니다. 여기서 세팅하신 값은 결제창에서 고객이 스크롤하여 선택하게 됩니다 -->
        <!--아래의 예의경우 고객은 0~12개월의 할부거래를 선택할수있게 됩니다. -->
        <input type="hidden" name="sndInstallmenttype" value="ALL(0:2:3:4:5:6:7:8:9:10:11:12)">

        <!-- 가맹점부담 무이자할부설정 -->
        <!-- 카드사 무이자행사만 이용하실경우  또는 무이자 할부를 적용하지 않는 업체는  "NONE"로 세팅  -->
        <!-- 예 : 전체카드사 및 전체 할부에대해서 무이자 적용할 때는 value="ALL" / 무이자 미적용할 때는 value="NONE" -->
        <!-- 예 : 전체카드사 3,4,5,6개월 무이자 적용할 때는 value="ALL(3:4:5:6)" -->
        <!-- 예 : 삼성카드(카드사코드:04) 2,3개월 무이자 적용할 때는 value="04(3:4:5:6)"-->
        <!-- <input type="hidden"	name=sndInteresttype value="10(02:03),05(06)"> -->
        <input type="hidden" name="sndInteresttype" value="NONE">

        <!-- 카카오페이 사용시 필수 세팅 값 -->
        <input type="hidden" name="sndStoreCeoName" value="">  <!--  카카오페이용 상점대표자명 -->
        <input type="hidden" name="sndStorePhoneNo" value="">  <!--  카카오페이 연락처 -->
        <input type="hidden" name="sndStoreAddress" value="">  <!--  카카오페이 주소 -->

        <!-- 2. 온라인입금(가상계좌) 관련설정 -->
        <input type="hidden" name="sndEscrow" value="0">                    <!-- 에스크로사용여부 (0:사용안함, 1:사용) -->

        <!-- 3. 계좌이체 현금영수증발급여부 설정 -->
        <input type="hidden" name="sndCashReceipt" value="0">          <!--계좌이체시 현금영수증 발급여부 (0: 발급안함, 1:발급) -->


        <!----------------------------------------------- <Part 3. 승인응답 결과데이터>  ----------------------------------------------->
        <!-- 결과데이타: 승인이후 자동으로 채워집니다. (*변수명을 변경하지 마세요) -->

        <input type="hidden" name="reCommConId" value="">
        <input type="hidden" name="reCommType" value="">
        <input type="hidden" name="reHash" value="">
    </form>
</div>