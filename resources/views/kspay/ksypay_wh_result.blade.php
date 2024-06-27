<?php
if (function_exists("mb_http_input")) mb_http_input("utf-8");
if (function_exists("mb_http_output")) mb_http_output("utf-8");
?>
@include('kspay.KSPayWebHost-inc')
<?php
$rcid       = $_POST['reCommConId'];
$rctype     = $_POST['reCommType'];
$rhash      = $_POST['reHash'];

$authyn   = "";
$trno     = "";
$trddt		= "";
$trdtm		= "";
$amt      = "";
$authno   = "";
$msg1     = "";
$msg2     = "";
$ordno		= "";
$isscd		= "";
$aqucd		= "";
$temp_v		= "";
$result		= "";
$halbu		= "";
$cbtrno   = "";
$cbauthno = "";
$resultcd = "";

//업체에서 추가하신 인자값을 받는 부분입니다
//$a = $_POST["a"];
//$b = $_POST["b"];
//$c = $_POST["c"];
//$d = $_POST["d"];
$payamt      = $_POST["sndAmount"];
$ipg = new KSPayWebHost($rcid, null,$payamt);

if ($ipg->kspay_send_msg("1"))
{
    $authyn   = $ipg->kspay_get_value("authyn");
    $trno     = $ipg->kspay_get_value("trno"  );
    $trddt    = $ipg->kspay_get_value("trddt" );
    $trdtm    = $ipg->kspay_get_value("trdtm" );
    $amt      = $ipg->kspay_get_value("amt"   );
    $authno   = $ipg->kspay_get_value("authno");
    $msg1     = $ipg->kspay_get_value("msg1"  );
    $msg2     = $ipg->kspay_get_value("msg2"  );
    $ordno    = $ipg->kspay_get_value("ordno" );
    $isscd    = $ipg->kspay_get_value("isscd" );
    $aqucd    = $ipg->kspay_get_value("aqucd" );
    $temp_v   = "";
    $result   = $ipg->kspay_get_value("result");
    $halbu    = $ipg->kspay_get_value("halbu");
    $cbtrno   = $ipg->kspay_get_value("cbtrno");
    $cbauthno = $ipg->kspay_get_value("cbauthno");

    if (!empty($msg1)) $msg1 = iconv("EUC-KR", "UTF-8", $msg1);
    if (!empty($msg2)) $msg2 = iconv("EUC-KR", "UTF-8", $msg2);

    if (!empty($authyn) && 1 == strlen($authyn))
    {
        if ($authyn == "O") {
            // 정상승인
            $resultcd = "0000";
        }
        else {
            // 승인실패
            $resultcd = trim($authno);
        }
    }
}
?>
<html>
<head>
    <meta http-equiv="Cache-Control" content="no-cache">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>*** KSNET WebHost 결과 [PHP] ***</title>
    <link href="https://kspay.ksnet.to/store/KSPayFlashV1.3/mall/css/pgstyle.css" rel="stylesheet" type="text/css" charset="euc-kr">
</head>
<script language="javascript">
    // 현금영수증 출력 스크립트
    function CashreceiptView(tr_no)
    {
        receiptWin = "https://pgims.ksnet.co.kr/pg_infoc/src/bill/ps2.jsp?s_pg_deal_numb="+tr_no;
        window.open(receiptWin , "" , "scrollbars=no,width=434,height=580");
    }
    
    // 신용카드 영수증 출력 스크립트
    function receiptView(tr_no)
    {
        receiptWin = "https://pgims.ksnet.co.kr/pg_infoc/src/bill/credit_view.jsp?tr_no="+tr_no;
        window.open(receiptWin , "" , "scrollbars=no,width=434,height=700");
    }
</script>

<body>
<table width="560" border="0" cellspacing="0" cellpadding="0">
    <tr>
        <td height="50" align="right" background="./imgs/bg_top.gif" class="txt_pd1">KSNET WebHost 결과 [PHP]</td>
    </tr>
    <tr>
        <td height="530" valign="top" background="./imgs/bg_man.gif">
            <table width="560" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td width="25">&nbsp;</td>
                    <td width="505" align="center">
                        <table width="500" border="0" align="center" cellpadding="0" cellspacing="0">
                            <tr>
                                <td height="40" style="padding:0px 0px 0px 15px; "><img src="./imgs/ico_tit5.gif" width="30" height="30" align="absmiddle"> <strong>결과항목</strong></td>
                            </tr>
                            <tr>
                                <td align="center"><table width="400" border="0" cellspacing="0" cellpadding="0">
                                        <tr bgcolor="#FFFFFF">
                                            <td width="120"><img src="./imgs/ico_right.gif" width="11" height="11" align="absmiddle"> 결제방법</td>
                                            <td width="280">
                                                <?php
                                                if (empty($result) || 4 != strlen($result)) {
                                                    echo("(???)");
                                                }
                                                else {
                                                    switch (substr($result,0,1)) {
                                                        case '1' : echo("신용카드"); break;
                                                        case 'I' : echo("신용카드"); break;
                                                        case '2' : echo("실시간계좌이체"); break;
                                                        case '6' : echo("가상계좌발급"); break;
                                                        case 'M' : echo("휴대폰결제"); break;
                                                        case 'G' : echo("상품권"); break;
                                                        default  : echo("(????)"); break;
                                                    }
                                                }
                                                ?>
                                            </td>
                                        </tr>
                                        <tr bgcolor="#E3E3E3"> <td height="1" colspan="2"></td> </tr>

                                        <tr bgcolor="#FFFFFF">
                                            <td width="120"><img src="./imgs/ico_right.gif" width="11" height="11" align="absmiddle"> 성공여부</td>
                                            <td width="280"><?php echo($authyn)?>(<?php if(!empty($authyn) && "O" == $authyn) echo("승인성공"); else echo("승인거절"); ?>) <font color=red> :성공여부값은 영어 대문자 O,X입니다. </font></td>
                                        </tr>
                                        <tr bgcolor="#E3E3E3"> <td height="1" colspan="2"></td> </tr>
                                        <tr bgcolor="#FFFFFF">
                                            <td width="120"><img src="./imgs/ico_right.gif" width="11" height="11" align="absmiddle"> 응답코드</td>
                                            <td width="280"><?php echo($resultcd)?></td>
                                        </tr>
                                        <tr bgcolor="#E3E3E3"> <td height="1" colspan="2"></td> </tr>
                                        <tr bgcolor="#FFFFFF">
                                            <td width="120"><img src="./imgs/ico_right.gif" width="11" height="11" align="absmiddle"> 주문번호</td>
                                            <td width="280"><?php echo($ordno)?></td>
                                        </tr>
                                        <tr bgcolor="#E3E3E3"> <td height="1" colspan="2"></td> </tr>
                                        <tr bgcolor="#FFFFFF">
                                            <td width="120"><img src="./imgs/ico_right.gif" width="11" height="11" align="absmiddle"> 금액</td>
                                            <td width="280"><?php echo($amt)?></td>
                                        </tr>
                                        <tr bgcolor="#E3E3E3"> <td height="1" colspan="2"></td> </tr>
                                        <tr bgcolor="#FFFFFF">
                                            <td width="120"><img src="./imgs/ico_right.gif" width="11" height="11" align="absmiddle"> 거래번호</td>
                                            <td width="280"><?php echo($trno)?> <font color=red>:KSNET에서 부여한 고유번호입니다. </font></td>
                                        </tr>
                                        <tr bgcolor="#E3E3E3"> <td height="1" colspan="2"></td> </tr>
                                        <tr bgcolor="#FFFFFF">
                                            <td width="120"><img src="./imgs/ico_right.gif" width="11" height="11" align="absmiddle"> 거래일자</td>
                                            <td width="280"><?php echo($trddt)?></td>
                                        </tr>
                                        <tr bgcolor="#E3E3E3"> <td height="1" colspan="2"></td> </tr>
                                        <tr bgcolor="#FFFFFF">
                                            <td width="120"><img src="./imgs/ico_right.gif" width="11" height="11" align="absmiddle"> 거래시간</td>
                                            <td width="280"><?php echo($trdtm)?></td>
                                        </tr>
                                        <tr bgcolor="#E3E3E3"> <td height="1" colspan="2"></td> </tr>
                                        <?php if (!empty($authyn) && "O" == $authyn) { ?>
                                        <tr bgcolor="#FFFFFF">
                                            <td width="120"><img src="./imgs/ico_right.gif" width="11" height="11" align="absmiddle"> 카드사 승인번호/은행 코드번호</td>
                                            <td width="280"><?php echo($authno)?><font color=red>:카드사에서 부여한 번호로 고유한값은 아닙니다. </font></td>
                                        </tr>
                                        <tr bgcolor="#E3E3E3"> <td height="1" colspan="2"></td> </tr>
                                        <?php } ?>
                                        <tr bgcolor="#FFFFFF">
                                            <td width="120"><img src="./imgs/ico_right.gif" width="11" height="11" align="absmiddle"> 발급사코드/가상계좌번호/계좌이체번호</td>
                                            <td width="280"><?php echo($isscd)?></td>
                                        </tr>
                                        <tr bgcolor="#E3E3E3"> <td height="1" colspan="2"></td> </tr>
                                        <tr bgcolor="#FFFFFF">
                                            <td width="120"><img src="./imgs/ico_right.gif" width="11" height="11" align="absmiddle"> 매입사코드</td>
                                            <td width="280"><?php echo($aqucd)?></td>
                                        </tr>
                                        <tr bgcolor="#E3E3E3"> <td height="1" colspan="2"></td> </tr>
                                        <tr bgcolor="#FFFFFF">
                                            <td width="120"><img src="./imgs/ico_right.gif" width="11" height="11" align="absmiddle"> 메시지1</td>
                                            <td width="280"><?php echo($msg1)?></td>
                                        </tr>
                                        <tr bgcolor="#E3E3E3"> <td height="1" colspan="2"></td> </tr>
                                        <tr bgcolor="#FFFFFF">
                                            <td width="120"><img src="./imgs/ico_right.gif" width="11" height="11" align="absmiddle"> 메시지2</td>
                                            <td width="280"><?php echo($msg2)?></td>
                                        </tr>
                                        <tr bgcolor="#E3E3E3"> <td height="1" colspan="2"></td> </tr>

                                        <?php if (!empty($authyn) && "O" == $authyn && "1" == substr($trno,0,1)) { ?> <!-- 정상승인의 경우만 영수증출력: 신용카드의 경우만 제공 -->
                                        <tr bgcolor="#FFFFFF">
                                            <td width="400" colspan="2" align="center"> <input type="button" value="영수증출력" onClick="javascript:receiptView('<?php echo($trno)?>')"> </td>
                                        </tr>
                                        <tr bgcolor="#E3E3E3"> <td height="1" colspan="2"></td> </tr>
                                        <?php } ?>
                                        <?php if (!empty($authyn) && "O" == $authyn && "2" == substr($trno,0,1)) { ?> <!-- 정상승인의 경우만 영수증출력: 계좌이체의 경우만 제공 -->
                                        <tr bgcolor="#FFFFFF">
                                            <td width="400" colspan="2" align="center"> <input type="button" value="현금영수증출력" onClick="javascript:CashreceiptView('<?php echo($cbtrno)?>')"> </td>
                                        </tr>
                                        <tr bgcolor="#E3E3E3"> <td height="1" colspan="2"></td> </tr>
                                        <?php } ?>
                                    </table></td>
                            </tr>
                        </table>
                    </td>
                    <td width="30">&nbsp;</td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td height="37" background="{{ asste('assets/images/kspay/bg_bot.gif') }}">&nbsp;</td>
    </tr>
</table>
</body>
</html>
