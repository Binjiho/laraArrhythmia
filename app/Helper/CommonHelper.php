<?php

require_once('SiteHelper.php');

// global auth
if (!function_exists('thisAuth')) {
    function thisAuth()
    {
        return auth(checkUrl());
    }
}

// global user
if (!function_exists('thisUser')) {
    function thisUser()
    {
        return thisAuth()->user();
    }
}

// get user pk
if (!function_exists('thisPk')) {
    function thisPk(): int
    {
        return thisAuth()->id() ?? 0;
    }
}

// set Flash session
if (!function_exists('setFlashData')) {
    function setFlashData(array $data): void
    {
        foreach ($data as $key => $val) {
            request()->session()->flash($key, $val);
        }
    }
}

if (!function_exists('setFlashMessage')) {
    function setFlashMessage(string $code): void
    {
        setFlashData(['msg' => config('site.app.error')[$code] ?? $code]);
    }
}

if (!function_exists('getErrorMessage')) {
    function getErrorMessage(string $code): string
    {
        return config('site.app.error')[$code]['msg'];
    }
}

if (!function_exists('redirectCase')) {
    function redirectCase(string $case1, string $case2 = null): array
    {
        /*
         * $case1 & $case2 값 => replace, reload, back, auth
         * $case1 과 $case2 값이 모두 있을경우 $case1 은 ajax 일경우 $case2는 아닐경우
         * 보통은 $case1 만 쓰지만 접근방법이 ajax와 url 접근 모두 허용할경우 $case2 사용
         */

        return (empty($case2))
            ? ['redirect' => $case1]
            : ['redirect' => request()->ajax() ? $case1 : $case2];
    }
}
if (!function_exists('errorNotFoundRedirect')) {
    function errorNotFoundRedirect(string $case = '')
    {
        if (empty($case)) {
            $case = redirectCase('reload', 'back');
        }

        setFlashMessage('404');
        return callRedirect($case);
    }
}

if (!function_exists('errorServerRedirect')) {
    function errorServerRedirect($case = '')
    {
        if (empty($case)) {
            $case = redirectCase('reload', 'back');
        }

        setFlashMessage('500');
        return callRedirect($case);
    }
}

// error msg
if (!function_exists('errorMsg')) {
    function errorMsg(string $code): string
    {
        return config('site.app.error')[$code] ?? $code;
    }
}

// DB ERROR
if (!function_exists('dbRedirect')) {
    function dbRedirect()
    {
        return errorRedirect('reload', 'db');
    }
}

// 접근권한 없음
if (!function_exists('denyRedirect')) {
    function denyRedirect()
    {
        return errorRedirect('back', 'deny');
    }
}

// 로그인 필요
if (!function_exists('authRedirect')) {
    function authRedirect()
    {
        return errorRedirect('replace', 'auth');
    }
}

// SERVER ERROR
if (!function_exists('serverRedirect')) {
    function serverRedirect()
    {
        return errorRedirect('replace', '500');
    }
}

// 404 not found
if (!function_exists('notFoundRedirect')) {
    function notFoundRedirect()
    {
        return errorRedirect('replace', '404');
    }
}

// 404 not found
if (!function_exists('notFoundRedirect')) {
    function notFoundRedirect()
    {
        return errorRedirect('replace', '404');
    }
}

// custom error redirect
if (!function_exists('errorRedirect')) {
    function errorRedirect(string $redirect, string $code, $url = null)
    {
        /*
         * $redirect 종류
         * back, reload, replace
         * back => 뒤로
         * reload => 새로고침
         * replace => 페이지 이동, (url 변수 필요 없을경우 메인페이지)
         *
         * $code
         * config 에 설정된 app.error 키값이 없을경우 변수값으로 에러메세지 출력
         */

        $referer = request()->headers->get('referer');

        $json = [
            'msg' => errorMsg($code),
            'url' => $url ?? getDefaultUrl($code == 'auth'),
            'redirect' => $redirect,
        ];

//        if ($_SERVER['REMOTE_ADDR'] == "218.235.94.247") {
//            echo "<pre>";
//            print_r($json);
//            echo "</pre>";
//            exit;
//        }

        if (request()->ajax()) {
            unset($json['url']);
            unset($json['redirect']);

            $json['case'] = true;
            $json['location'] = ['case' => 'reload'];
            return response()->json(['alert' => $json]);
        } else {
            // 뒤로가인데 뒤로갈 페이지 없을경우
            if ($redirect === 'back' && empty($referer)) {
                $json['redirect'] = 'replace';
                $json['url'] = $url ?? getDefaultUrl($code == 'auth');
            }

            setFlashData($json);
            return callRedirect();
        }
    }
}

if (!function_exists('callRedirect')) {
    function callRedirect()
    {
        $redirect = request()->session()->pull('redirect');
        $url = request()->session()->pull('url');
        $msg = request()->session()->pull('msg');

        switch ($redirect) {
            case 'back':
                return redirect()->back()->with(['msg' => $msg]);

            case 'reload':
                return redirect()->refresh()->with(['msg' => $msg]);

            case 'replace':
                return redirect($url)->with(['msg' => $msg]);

            default:
                return redirect(getDefaultUrl())->with(['msg' => '허용되지 않은 접근입니다.']);
        }
    }
}

// set seq (paging 없을때)
if (!function_exists('setSeq')) {
    function setSeq(object $data)
    {
        $count = 0;
        $total = count($data);

        // seq 라는 순번 필드를 추가
        foreach ($data as $key => $row) {
            $data[$key]->seq = $total - $count;
            $count++;
        }

        return $data;
    }
}

// set list seq (paging 있을때)
if (!function_exists('setListSeq')) {
    function setListSeq(object $data)
    {
        $count = 0;
        $total = $data->total();
        $perPage = $data->perPage();
        $currentPage = $data->currentPage();

        // seq 라는 순번 필드를 추가
        $data->getCollection()->transform(function ($data) use ($total, $perPage, $currentPage, &$count) {
            $data->seq = ($total - ($perPage * ($currentPage - 1))) - $count;
            $count++;
            return $data;
        });

        return $data;
    }
}

// set array seq (array 형태일때)
if (!function_exists('setArraySeq')) {
    function setArraySeq(array $data)
    {
        $count = 0;
        $total = count($data);

        // seq 라는 순번 필드를 추가
        foreach ($data as $key => $row) {
            $data[$key]['seq'] = $total - $count;
            $count++;
        }

        return $data;
    }
}

// Crypt::encryptString 적용
if (!function_exists('enCryptString')) {
    function enCryptString($string): string
    {
        return \Illuminate\Support\Facades\Crypt::encryptString($string);
    }
}

// Crypt::decryptString 적용
if (!function_exists('deCryptString')) {
    function deCryptString($string): string
    {
        return \Illuminate\Support\Facades\Crypt::decryptString($string);
    }
}

// jsonUnicode 적용
if (!function_exists('jsonUnicode')) {
    function jsonUnicode($aray = [])
    {
        return json_encode($aray, JSON_UNESCAPED_UNICODE);
    }
}

// 숫자 앞에 0 붙이기
if (!function_exists('addZero')) {
    function addZero(int $num, int $len)
    {
        return sprintf("%0{$len}d", $num);
    }
}

// 숫자 콤마 제거
if (!function_exists('unComma')) {
    function unComma(string $num)
    {
        return (int)str_replace(',', '', $num);
    }
}

// 날짜별 요일 YYYY-MM-DD
if (!function_exists('getYoil')) {
    function getYoil(string $date)
    {
        $yoil = array('일', '월', '화', '수', '목', '금', '토');
        return $yoil[date('w', strtotime($date))];
    }
}

// date String
if (!function_exists('isDateEmpty')) {
    function isDateEmpty($date = null)
    {
        return (empty($date)) ? true : (strtotime($date) < 0);
    }
}

// device check
if (!function_exists('device')) {
    function device()
    {
        $agent = new \Jenssegers\Agent\Agent;
        if ($agent->isDesktop()) {
            return "P";
        }

        if ($agent->isTablet()) {
            return "T";
        }

        return "M";
    }
}

// mobile check
if (!function_exists('isMobile')) {
    function isMobile()
    {
        $agent = new \Jenssegers\Agent\Agent;
        return ($agent->isMobile() || $agent->isTablet());
    }
}

// masking
if (!function_exists('masking')) {
    function masking(string $str, int $len)
    {
        $idlen = strlen($str);
        $firid = substr($str, 0, $len);
        $falid = '';

        for ($i = 0; $i < ($idlen - 3); $i++) {
            $falid .= "*";
        }

        return ($firid . $falid);
    }
}

if (!function_exists('customDump')) {
    /**
     * @return never
     */
    function customDump(...$vars)
    {
        if (!in_array(\PHP_SAPI, ['cli', 'phpdbg'], true) && !headers_sent()) {
            header('HTTP/1.1 500 Internal Server Error');
        }

        foreach ($vars as $v) {
            \Symfony\Component\VarDumper\VarDumper::dump($v);
        }
    }
}

// crypto-js decrypt
if (!function_exists('cryptoDecrypt')) {
    function cryptoDecrypt(\Illuminate\Http\Request $request)
    {
        $password = 'secret phrase';

        foreach (request()->all() as $key => $val) {
            if (gettype($val) === 'string') {
                $cipherText = base64_decode($val);

                if (substr($cipherText, 0, 8) != "Salted__") {
                    continue;
                }

                $salt = substr($cipherText, 8, 8);
                $keyAndIV = evpKDF($password, $salt);

                $request[$key] = openssl_decrypt(
                    substr($cipherText, 16),
                    "aes-256-cbc",
                    $keyAndIV["key"],
                    OPENSSL_RAW_DATA, // base64 was already decoded
                    $keyAndIV["iv"]
                );
            }
        }

        return $request;
    }
}

// crypto-js decrypt return key And IV
if (!function_exists('evpKDF')) {
    function evpKDF(string $password, string $salt, $keySize = 8, $ivSize = 4, $iterations = 1, $hashAlgorithm = "md5")
    {
        $targetKeySize = $keySize + $ivSize;
        $derivedBytes = "";
        $numberOfDerivedWords = 0;
        $block = NULL;
        $hasher = hash_init($hashAlgorithm);

        while ($numberOfDerivedWords < $targetKeySize) {
            if (!empty($block)) {
                hash_update($hasher, $block);
            }

            hash_update($hasher, $password);
            hash_update($hasher, $salt);

            $block = hash_final($hasher, true);
            $hasher = hash_init($hashAlgorithm);

            // Iterations
            for ($i = 1; $i < $iterations; $i++) {
                hash_update($hasher, $block);
                $block = hash_final($hasher, true);
                $hasher = hash_init($hashAlgorithm);
            }

            $derivedBytes .= substr($block, 0, min(strlen($block), ($targetKeySize - $numberOfDerivedWords) * 4));
            $numberOfDerivedWords += strlen($block) / 4;
        }

        return [
            "key" => substr($derivedBytes, 0, $keySize * 4),
            "iv" => substr($derivedBytes, $keySize * 4, $ivSize * 4)
        ];
    }
}