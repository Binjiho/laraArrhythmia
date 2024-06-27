@php
    if (function_exists("mb_http_input")) mb_http_input("utf-8");
    if (function_exists("mb_http_output")) mb_http_output("utf-8");
    
    $rcid = $_POST["reCommConId"];
    $rctype = $_POST["reCommType"];
    $rhash = $_POST["reHash"];
    $rcncntype = $_POST["reCnclType"];    // 값이 '1'이면 거래취소

    $p_protocol = "http";
    if (strlen($_SERVER['SERVER_PROTOCOL']) > 4 && "https" == substr($_SERVER['SERVER_PROTOCOL'], 0, 5)) {
        $p_protocol = "https";
    }
@endphp

<title>KSPay({{ $rcid }})</title>

<script language="JavaScript">
    function init() {
        if ("{{ $rcncntype }}" == "1") {
            if (opener == null) {
                parent.mcancel();
                return;
            } else {
                opener.mcancel();
                setTimeout("self.close()", 2000);
                return;
            }
        }

        if (opener == null) {
            parent.eparamSet("{{ $rcid }}", "{{ $rctype }}", "{{ $rhash }}");
            parent.goResult();
        } else {
            opener.eparamSet("{{ $rcid }}", "{{ $rctype }}", "{{ $rhash }}");
            opener.goResult();
            setTimeout("self.close()", 2000);
        }
    }

    init();
</script>
</head>

<body>
<table width="100%" height="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
        <td valign="middle" align="center">
            <table width="280" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td><img src="{{ asset('assets/image/kspay/progress_resouce.jpg') }}" width="280" height="201"></td>
                </tr>
            </table>
        </td>
    </tr>
</table>
</body>
</html>