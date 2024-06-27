<script language="javascript">

	function _pay(_frm) 
	{
		// sndReply는 kspay_wh_rcv.php (결제승인 후 결과값들을 본창의 KSPayWeb Form에 넘겨주는 페이지)의 절대경로를 넣어줍니다. 
 		// _frm.sndReply.value = getLocalUrl("kspay_wh_result.php") ;
 		_frm.sndReply.value = getLocalUrl(document.activeElement.getAttribute("formaction")) ;

		var agent = navigator.userAgent;
		var midx		= agent.indexOf("MSIE");
		var out_size	= (midx != -1 && agent.charAt(midx+5) < '7');

		//_frm.target = '_blank';
		_frm.action ='http://kspay.ksnet.to/store/KSPayMobileV1.4/KSPayPWeb.jsp';    //리얼
		// _frm.action ='http://210.181.28.134/store/KSPayMobileV1.4/KSPayPWeb.jsp';  //테스트
		
		_frm.submit();
        }

	function getLocalUrl(mypage) 
	{ 
		var myloc = location.href; 
		// return myloc.substring(0, myloc.lastIndexOf('/')) + '/' + mypage;
		return 'https://abstract-hrs.org' + mypage;

	} 

</script>

<!-----------------------------------------<Part 1. authFrmFrame Form: 결과페이지주소 설정 > ---------------------------------------->
    
    <!--결제 완료후 결과값을 받아처리할 결과페이지의 주소-->
    <form name=authFrmFrame method=post action="" > 
        <!-- 결과값 수신 파라메터, value값을 채우지마십시오. KSPayRcv.asp가 실행되면서 채워주는 값입니다-->
    
<!--------------------------------------------------------------------------------------------------------------------------->
       
        <input type="hidden" value=" 지 불 " onClick="javascript:_pay(document.authFrmFrame);">  <!-- 결제 : 트리거 -->

<!----------------------------------------------- < Part 2. 고객에게 보여지지 않는 항목 > ------------------------------------>
        <!--이부분은 결제를 위해 상점에서 기본정보를 세팅해야 하는 부분입니다.	-->
        <!--단 고객에게는 보여지면 안되는 항목이니 테스트 후 필히 hidden으로 변경해주시길 바랍니다.	-->

        <!-- <select name=sndPaymethod>
            <option value='1000000000'>신용카드</option>
            <option value='0100000000'>가상계좌</option>
            <option value='0010000000'>계좌이체</option>
        </select> -->
        <input type="hidden" name="sndPayMethod" value="1000000000">							<!-- 결제수단 : 신용카드/가상계좌/계좌이체/월드패스카드/포인트/휴대폰결제/상품권--> <!--신용카드인 경우-->
        <input type="hidden" name=sndStoreid size=10 maxlength=10 value="2001106393">               <!-- 상점아이디 : 테스트용 아이디: 2999199999 (테스트이후 실제발급아이디로 변경)-->
        <input type="hidden" name='sndOrdernumber' value='<?="ORDER_" . date('YmdHis') . rand(0, 2000000000);?>' size='30'>	 <!-- 주문번호 : 주문번호는 50Byte(한글 25자) 입니다. ' " ` 는 사용하실수 없습니다. 따옴표,쌍따옴표,백쿼테이션 -->

        <!-- 신용카드(해외카드) 통화코드: 해외카드결제시 달러결제를 사용할경우 변경 -->
        <input type="hidden"	name=sndCurrencytype value="<?=$hidden_lang=='KOR'?'WON':'USD'?>"> <!-- 원화(WON), 달러(USD) -->

        <input type="hidden" name=sndAllregid size=30 maxlength=13 value="">    <!-- 주민등록번호는: 주민등록번호는 필수값이 아닙니다.-->
        
        <!--상점에서 적용할 할부개월수를 세팅합니다. 여기서 세팅하신 값은 KSPAY결재팝업창에서 고객이 스크롤선택하게 됩니다 -->
        <!--아래의 예의경우 고객은 0~12개월의 할부거래를 선택할수있게 됩니다. -->
        <input type="hidden" name=sndInstallmenttype size=30 maxlength=30 value="0:2:3:4:5:6:7:8:9:10:11:12"> <!-- 할부개월수 -->
        <input type="hidden" name=sndInteresttype size=30 maxlength=30 value="NONE"> <!-- 무이자구분 -->
        <input type="hidden" name=sndShowcard size=30 maxlength=30 value="C">  <!-- 신용카드표시구분 -->

<!----------------------------------------------- <Part 3. 고객에게 보여주는 항목 > ----------------------------------------------->
        
        <!--상품명은 30Byte(한글 15자)입니다. 특수문자 ' " - ` 는 사용하실수 없습니다. 따옴표,쌍따옴표,빼기,백쿼테이션 -->
        <input type="hidden" name=sndGoodname size=30 maxlength=30 value="KHRS 2024 Registration"> <!-- 상품명 -->
        <input type="hidden" name=sndAmount size=30 maxlength=9 value="<?=$hidden_total_price?>">  <!-- 가격 -->
        <input type="hidden" name=sndOrdername size=30 maxlength=20 value="<?=$registration->first_name?> <?=$registration->last_name?>"><!-- 성명 -->

        <!--KSPAY에서 결제정보를 메일로 보내줍니다.(신용카드거래에만 해당)-->
        <input type="hidden" name=sndEmail size=30 maxlength=50 value="<?=$registration->email?>"><!-- 전자우편 -->
        
        <!--카드사에 SMS 서비스를 등록하신 고객에 한해서 SMS 문자메세지를 전송해 드립니다.-->
        <!--전화번호 value 값에 숫자만 넣게 해주시길 바랍니다. : '-' 가 들어가면 안됩니다.-->
        <input type="hidden" name=sndMobile size=30 maxlength=12 value=""> <!-- 이동전화 -->

        <input type=hidden name=sndCharSet              value="utf-8">                       <!--  가맹점 CharSet 설정변수 --> 
        <input type=hidden name=sndReply                value="">
        <input type=hidden name=sndEscrow          	value="0">                           <!--에스크로적용여부-- 0: 적용안함, 1: 적용함 -->
        <input type=hidden name=sndVirExpDt             value="">                            <!-- 마감일시 -->
        <input type=hidden name=sndVirExpTm             value="">                            <!-- 마감시간 -->
        <input type=hidden name=sndStoreName       	value="케이에스페이(주)">             <!--회사명을 한글로 넣어주세요(최대20byte)-->
        <input type=hidden name=sndStoreNameEng    	value="kspay">                       <!--회사명을 영어로 넣어주세요(최대20byte)-->
        <input type=hidden name=sndStoreDomain     	value="http://www.kspay_test.co.kr"> <!-- 회사 도메인을 http://를 포함해서 넣어주세요-->
        <input type=hidden name=sndGoodType		value="1">							 <!--실물(1) / 디지털(2) -->
        <input type=hidden name=sndUseBonusPoint        value="">   						 <!-- 포인트거래시 60 -->                                                                                                                                                           
        <input type=hidden name=sndRtApp		value="">							 <!-- 하이브리드APP 형태로 개발시 사용하는 변수 -->
        <input type=hidden name=sndStoreCeoName         value="">                            <!--  카카오페이용 상점대표자명 --> 
        <input type=hidden name=sndStorePhoneNo         value="">                            <!--  카카오페이 연락처 --> 
        <input type=hidden name=sndStoreAddress         value="">                            <!--  카카오페이 주소 --> 

<!--------------------------------------------------------------------------------------------------------------------------->

        <input type="hidden" name=ECHSID                value="<?= $hidden_sid ?>">
        <input type="hidden" name=ECHPAY_METHOD         value="C">
        <input type="hidden" name=ECHURL_FROM           value="<?= $hidden_url_from ?>">

    </form>

<!--------------------------------------------------------------------------------------------------------------------------->

