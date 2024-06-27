<?php

namespace App\Services\Kspay;

use Illuminate\Http\Request;
use App\Services\AppServices;

class KspayServices extends AppServices
{
    public function moduleService(Request $request)
    {
        $moduleType = $request->type;

        $this->data['sndStoreid'] = '2999199999'; // 상점아이디 (TEST 용)
        $this->data['sndPaymethod'] = '1000000000'; // 결제수단 (신용카드: 1000000000, 가상계좌: 0100000000, 계좌이체: 0010000000, 휴대폰결제: 0000010000)

        $this->data['sndAmount'] = '1000'; // 금액
        $this->data['sndGoodname'] = '상품명'; // 상품명
        $this->data['sndOrdernumber'] = time(); // 주문번호

        $this->data['sndOrdername'] = '주문자명'; // 주문자명
        $this->data['sndMobile'] = '01012341234';  // 주문자 휴대폰번호 ('-' 없이 숫자만)
        $this->data['sndEmail'] = 'test@test.com'; // 주문자 이메일

        $this->setJsonData('res', view("kspay.module-{$moduleType}", $this->data)->render());

        return $this->returnJson();
    }
}
