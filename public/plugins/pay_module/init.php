<!-- <script language="javascript" src="/ksnet/pc/js/kspay_web_ssl.js"></script> -->
<script language="javascript" src="https://kspay.ksnet.to/store/KSPayWebV1.4/js/kspay_web_ssl.js"></script>

<script language="javascript">
            
	function _submit(_frm)
	{
		_frm.sndReply.value = getLocalUrl("/ksnet/pc/kspay_wh_rcv.php") ;

		_pay(_frm);
	}
	function getLocalUrl(mypage) 
	{ 
		// var myloc = location.href; 
		// return myloc.substring(0, myloc.lastIndexOf('/')) + '/' + mypage;
		return 'https://abstract-hrs.org' + mypage;
	} 
	// goResult() - 함수설명 : 결재완료후 결과값을 지정된 결과페이지(kspay_wh_result.php)로 전송합니다.
	function goResult(){
		document.KSPayWeb.target = "";
		// document.KSPayWeb.action = "./kspay_wh_result.php";
		// document.KSPayWeb.action = "./handler/POST.php";
		console.log(document.registration_payment_form.action);
		document.KSPayWeb.action = document.registration_payment_form.action;
		document.KSPayWeb.submit();
	}
	// eparamSet() - 함수설명 : 결재완료후 (kspay_wh_rcv.php로부터)결과값을 받아 지정된 결과페이지(kspay_wh_result.php)로 전송될 form에 세팅합니다.
	function eparamSet(rcid, rctype, rhash){
		document.KSPayWeb.reCommConId.value 	= rcid;
		document.KSPayWeb.reCommType.value 		= rctype  ;
		document.KSPayWeb.reHash.value 			= rhash  ;
	}
	function mcancel()
	{
		// 취소
		closeEvent();
	}
</script>


<!-----------------------------------------<Part 1. KSPayWeb Form: 결과페이지주소 설정 > ---------------------------------------->
	
	<form name=KSPayWeb method=post action="">	
	<!--결제 완료후 결과값을 받아처리할 결과페이지의 주소-->

<!--------------------------------------------------------------------------------------------------------------------------->

		<!-- <select name=sndPaymethod>
			<option value="1000000000">신용카드</option>
			<option value="0100000000">가상계좌</option>
			<option value="0010000000">계좌이체</option>
			<option value="0000010000">휴대폰결제</option>
		</select> -->
		<input type="hidden" name="sndPayMethod" value="1000000000">							<!-- 결제수단 : 신용카드/가상계좌/계좌이체/월드패스카드/포인트/휴대폰결제/상품권--> <!--신용카드인 경우-->
		<input type="hidden" name='sndStoreid' value='2001106393' size='15' maxlength='10'>		<!-- 상점아이디 : 테스트용 아이디: 2999199999 (테스트이후 실제발급아이디로 변경)-->
		<input type="hidden" name='sndOrdernumber' value='<?="ORDER_" . date('YmdHis') . rand(0, 2000000000);?>' size='30'>	 				<!-- 주문번호 : 주문번호는 50Byte(한글 25자) 입니다. ' " ` 는 사용하실수 없습니다. 따옴표,쌍따옴표,백쿼테이션 -->

		<!--옵션정보 : 옵션 사항 입니다. 설정 안하거나 값을 보내지 않을경우 default 값으로 설정됩니다.-->
		<input type="hidden" name='sndGoodname' value='KHRS 2024 Registration' size='30'>						 <!-- 상품명 : 상품명 50Byte(한글 25자) 입니다. ' " ` 는 사용하실수 없습니다. 따옴표,쌍따옴표,백쿼테이션 -->
		<input type="hidden" name='sndAmount' value='<?=$hidden_total_price?>' size='15' maxlength='9'>				<!-- 금액 : 금액은 ,없이 입력 -->
		<input type="hidden" name='sndOrdername' value='<?=$registration->first_name?> <?=$registration->last_name?>' size='30'>						  <!-- 주문자명 -->
		<input type="hidden" name='sndEmail' value='<?=$registration->email?>' size='30'>				<!-- 전자우편 : KSPAY에서 결제정보를 메일로 보내줍니다.(신용카드거래에만 해당)-->
		<input type="hidden" name='sndMobile' value='' size='12' maxlength='12'>		<!-- 이동전화: 전화번호 value 값에 숫자만 넣게 해주시길 바랍니다. : '-' 가 들어가면 안됩니다.-->

		<input type="hidden" value="결 제" onClick="javascript:_submit(document.KSPayWeb);">	 <!-- 결제 : 트리거 -->

<!----------------------------------------------- <Part 2. 추가설정항목(메뉴얼참조)>  ----------------------------------------------->

		<!-- 0. 공통 환경설정 -->
		<input type="hidden"	name=sndReply value="">
		<input type="hidden"	name=sndCharSet value="UTF-8">	<!-- 가맹점 CharSet 환경 EUC-KR, UTF-8--> 
		<input type="hidden"  name=sndGoodType value="1"> 	<!-- 상품유형: 실물(1),디지털(2) -->
		
		<!-- 1. 신용카드 관련설정 -->
		
		<!-- 신용카드 결제방법  -->
		<!-- 일반적인 업체의 경우 ISP,안심결제만 사용하면 되며 다른 결제방법 추가시에는 사전에 협의이후 적용바랍니다 -->
		<input type="hidden"  name=sndShowcard value="C"> 
		
		<!-- 신용카드(해외카드) 통화코드: 해외카드결제시 달러결제를 사용할경우 변경 -->
		<input type="hidden"	name=sndCurrencytype value="<?=$hidden_lang=='KOR'?'WON':'USD'?>"> <!-- 원화(WON), 달러(USD) -->

		<input type="hidden"	name=iframeYn value="Y">
		
		<!-- 할부개월수 선택범위 -->
		<!--상점에서 적용할 할부개월수를 세팅합니다. 여기서 세팅하신 값은 결제창에서 고객이 스크롤하여 선택하게 됩니다 -->
		<!--아래의 예의경우 고객은 0~12개월의 할부거래를 선택할수있게 됩니다. -->
		<input type="hidden"	name=sndInstallmenttype value="ALL(0:2:3:4:5:6:7:8:9:10:11:12)">
		
		<!-- 가맹점부담 무이자할부설정 -->
		<!-- 카드사 무이자행사만 이용하실경우  또는 무이자 할부를 적용하지 않는 업체는  "NONE"로 세팅  -->
		<!-- 예 : 전체카드사 및 전체 할부에대해서 무이자 적용할 때는 value="ALL" / 무이자 미적용할 때는 value="NONE" -->
		<!-- 예 : 전체카드사 3,4,5,6개월 무이자 적용할 때는 value="ALL(3:4:5:6)" -->
		<!-- 예 : 삼성카드(카드사코드:04) 2,3개월 무이자 적용할 때는 value="04(3:4:5:6)"-->
		<!-- <input type="hidden"	name=sndInteresttype value="10(02:03),05(06)"> -->
		<input type="hidden"	name=sndInteresttype value="NONE">
		
		<!-- 카카오페이 사용시 필수 세팅 값 -->
		<input type="hidden" name=sndStoreCeoName value="">  <!--  카카오페이용 상점대표자명 --> 
		<input type="hidden" name=sndStorePhoneNo value="">  <!--  카카오페이 연락처 --> 
		<input type="hidden" name=sndStoreAddress value="">  <!--  카카오페이 주소 --> 
		
		<!-- 2. 온라인입금(가상계좌) 관련설정 -->
		<input type="hidden"	name=sndEscrow value="0"> 			        <!-- 에스크로사용여부 (0:사용안함, 1:사용) -->
		
		<!-- 3. 계좌이체 현금영수증발급여부 설정 -->
		<input type="hidden"  name=sndCashReceipt value="0">          <!--계좌이체시 현금영수증 발급여부 (0: 발급안함, 1:발급) -->

<!----------------------------------------------- <Part 3. 승인응답 결과데이터>  ----------------------------------------------->

		<!-- 결과데이타: 승인이후 자동으로 채워집니다. (*변수명을 변경하지 마세요) -->
		<input type="hidden" name=reCommConId 	value="">
		<input type="hidden" name=reCommType 		value="">
		<input type="hidden" name=reHash 	    	value="">

<!--------------------------------------------------------------------------------------------------------------------------->

		<!--업체에서 추가하고자하는 임의의 파라미터를 입력하면 됩니다.-->
		<!--이 파라메터들은 지정된결과 페이지(kspay_result.php)로 전송됩니다.-->
		<!-- <input type=hidden name=a        value="a1"> -->
		<!-- <input type=hidden name=b        value="b1"> -->
		<!-- <input type=hidden name=c        value="c1"> -->
		<!-- <input type=hidden name=d        value="d1"> -->
		<input type="hidden" name=ECHSID        	   value="<?= $hidden_sid ?>">
		<input type="hidden" name=ECHPAY_METHOD        value="C">
		<input type="hidden" name=ECHURL_FROM          value="<?= $hidden_url_from ?>">

<!--------------------------------------------------------------------------------------------------------------------------->

	</form>

<!--------------------------------------------------------------------------------------------------------------------------->