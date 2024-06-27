<script language="javascript" src="{{ asset('script/kspay_web_ssl.js') }}"></script>
<script language="javascript">
    function _submit(_frm) {
        _frm.sndReply.value = '{{ route('kspay.rcv') }}';
        _pay(_frm);
    }

    // goResult() - 함수설명 : 결재완료후 결과값을 지정된 결과페이지(kspay_wh_result.php)로 전송합니다.
    function goResult() {
        document.KSPayWeb.target = "";
        document.KSPayWeb.action = "{{ route('kspay.result') }}";
        document.KSPayWeb.submit();
    }

    // eparamSet() - 함수설명 : 결재완료후 (kspay_wh_rcv.php로부터)결과값을 받아 지정된 결과페이지(kspay_wh_result.php)로 전송될 form에 세팅합니다.
    function eparamSet(rcid, rctype, rhash) {
        document.KSPayWeb.reCommConId.value = rcid;
        document.KSPayWeb.reCommType.value = rctype;
        document.KSPayWeb.reHash.value = rhash;
    }

    function mcancel() {
        // 취소
        closeEvent();
    }

    function callPayModuel(jsonData) { // 커스텀
        /*
        * type
        * PC or Mobile
        * 모듈 구분
        */

        callbackAjax('{{ route('kspay.module') }}', jsonData, function (data, error) {
            if (data) {
                $('body').append(data.res);
                _submit(document.KSPayWeb)
            } else {
                ajaxErrorData(error);
            }
        });
    }
</script>