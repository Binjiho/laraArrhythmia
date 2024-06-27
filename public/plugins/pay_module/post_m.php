<?php 
  include_once $_SERVER['DOCUMENT_ROOT']."/lib.php";

  if (function_exists("mb_http_input")) mb_http_input("utf-8"); 

  if (function_exists("mb_http_output")) mb_http_output("utf-8");

?>

<?php  include $_SERVER['DOCUMENT_ROOT']. "/ksnet/mobile/KSPayWebHost.inc"; ?>

<?php 

	$rcid       = $_POST["reCommConId"];

	$rctype     = $_POST["reCommType"];

	$rhash      = $_POST["reHash"];

	$reCnclType  = $_POST["reCnclType"]; /* reCnclType = 1 취소 */

	$payamt       = ""; // 결제창 호출금액과 다른경우 거절.


    //업체에서 추가하신 인자값을 받는 부분입니다

    // 결제 요청일경우 필수 사전등록값 결제모듈에서 불러오기.. 
    if($rcid){ 

        $_POST['sid'] = $_POST["ECHSID"]; 

        $_POST['pay_method'] = $_POST["ECHPAY_METHOD"]; 

        $_POST['url_from'] = $_POST["ECHURL_FROM"]; 
        
    }

	$username	= "";

	$storied	= "";

	$goodname	= "";

	$authyn		= "";

	$trno		= "";

	$trddt		= "";

	$trdtm		= "";

	$amt		= "";

	$authno		= "";

	$msg1		= "";

	$msg2		= "";

	$ordno		= "";

	$isscd		= "";

	$cardno		= "";

	$aqucd		= "";

	$certitype	= "";

	$halbu		= "";

	$cbauthyn	= "";

	$cbtrno		= "";

	$cbauthno	= "";

	$cbmsg1		= "";

	$cbmsg2		= "";

	$result		= "";

	$resultcd	= "";



	$ipg = new KSPayWebHost($rcid, null,$payamt);



	if ($ipg->kspay_send_msg("1"))

	{

		// $username   = $ipg->kspay_get_value("username");

		// $storied   = $ipg->kspay_get_value("storied");

		// $goodname   = $ipg->kspay_get_value("goodname");

		$authyn   = $ipg->kspay_get_value("authyn");

		$trno     = $ipg->kspay_get_value("trno"  );

		$trddt    = $ipg->kspay_get_value("trddt" );

		$trdtm    = $ipg->kspay_get_value("trdtm" );

		$amt      = $ipg->kspay_get_value("amt"   );

		$authno   = $ipg->kspay_get_value("authno");

		$msg1     = $ipg->kspay_get_value("msg1"  );

		$msg2     = $ipg->kspay_get_value("msg2"  );

		$ordno    = $ipg->kspay_get_value("ordno" );

		// $cardno   = $ipg->kspay_get_value("cardno");

		$aqucd    = $ipg->kspay_get_value("aqucd" );

		// $certitype   = $ipg->kspay_get_value("certitype");

		$isscd   = $ipg->kspay_get_value("isscd");

		$result   = $ipg->kspay_get_value("result");

		// $halbu    = $ipg->kspay_get_value("halbu");

		// $cbauthyn   = $ipg->kspay_get_value("cbauthyn");

		// $cbtrno   = $ipg->kspay_get_value("cbtrno");

		// $cbauthno = $ipg->kspay_get_value("cbauthno");

		// $cbmsg1 = $ipg->kspay_get_value("cbmsg1");

		// $cbmsg2 = $ipg->kspay_get_value("cbmsg2");

		$resultcd	 = $ipg->kspay_get_value("resultcd");



		// 정상처리되지 않은경우$ipg->kspay_send_msg("1")를 다시한번 호출하여 응답을 재전송받을수 있습니다.

		if (!empty($msg1)) $msg1 = iconv("EUC-KR", "UTF-8", $msg1);

		if (!empty($msg2)) $msg2 = iconv("EUC-KR", "UTF-8", $msg2);

		if (!empty($cbmsg1)) $msg1 = iconv("EUC-KR", "UTF-8", $cbmsg1);

		if (!empty($cbmsg2)) $msg2 = iconv("EUC-KR", "UTF-8", $cbmsg2);


		$_pay_log_datas = [
			'request_sid' => $_POST['sid'],
			'username' => getNullToSpace($username),
			'storied' => getNullToSpace($storied),
			'goodname' => getNullToSpace($goodname),
			'authyn' => getNullToSpace($authyn),
			'resultcd' => getNullToSpace($resultcd),
			'msg1' => getNullToSpace($msg1),
			'msg2' => getNullToSpace($msg2),
			'trno' => getNullToSpace($trno),
			'trddt' => getNullToSpace($trddt),
			'trdtm' => getNullToSpace($trdtm),
			'amt' => getNullToSpace($amt),
			'ordno' => getNullToSpace($ordno),
			'result' => getNullToSpace($result),
			'certitype' => getNullToSpace($certitype),
			'authno' => getNullToSpace($authno),
			'isscd' => getNullToSpace($isscd),
			'cardno' => getNullToSpace($cardno),
			'aqucd' => getNullToSpace($aqucd),
			'halbu' => getNullToSpace($halbu),
			'cbauthyn' => getNullToSpace($cbauthyn),
			'cbtrno' => getNullToSpace($cbtrno),
			'cbauthno' => getNullToSpace($cbauthno),
			'cbmsg1' => getNullToSpace($cbmsg1),
			'cbmsg2' => getNullToSpace($cbmsg2),

			'rcid' => getNullToSpace($rcid),
			'rctype' => getNullToSpace($rctype),
			'rhash' => getNullToSpace($rhash),
			'payamt' => getNullToSpace($payamt),

		];

		$pay_log_sid = Workshop\Db::insert("ksnet_pay_log", $_pay_log_datas);

		$_POST['rcid'] = $rcid;
		$_POST['ordno'] = $ordno;
		$_POST['cardno'] = $cardno;
		$_POST['authno'] = $authno;
		$_POST['isscd'] = $isscd;
		$_POST['trno'] = $trno;


		if($authyn != "O"){
			\Workshop\Func::form_send_message('/registration/apply.php', ['mode'=>'pay_fail', 'sid'=>$_POST['sid']], "Payment declined [".$resultcd." : ".$msg1."]\\nPlease contact the website administrator.");
			exit;
		}

	}

	/*
     * 파라미터 체크 메소드
     */
    function getNullToSpace($param) 
    {
        return ($param == null) ? "" : trim($param);
    }

    // echo "<pre>";print_r(get_defined_vars());echo "</pre>";exit; 

?>