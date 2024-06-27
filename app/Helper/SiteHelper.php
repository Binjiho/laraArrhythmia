<?php

use App\Models\Country;
use App\Models\Affiliation;

use Illuminate\Support\Facades\Cookie;

// check Url
if (!function_exists('checkUrl')) {
    function checkUrl(): string
    {
        $uri = str_replace('//www.', '//', request()->getUri());

        if (strpos($uri, config('site.app.api.url')) !== false) {
            return 'api';
        }

        if (strpos($uri, config('site.app.admin.url')) !== false) {
            return 'admin';
        }

//        if (strpos($uri, config('site.app.general.url')) !== false) {
//            return 'general';
//        }

        return 'web';
    }
}

// get App Name
if (!function_exists('getAppName')) {
    function getAppName(): string
    {
        return config('site.app.' . checkUrl() . '.app_name');
    }
}

// get default url
if (!function_exists('getDefaultUrl')) {
    function getDefaultUrl($auth = false): string
    {
        if ($auth) {
            if (checkUrl() == 'admin') {
                return thisAuth()->check()
                    ? getDefaultUrl()
                    : env('APP_URL');
            }

            return thisAuth()->check()
                ? getDefaultUrl()
                : route('login');
        }
        return route('main');
    }
}

// loginCheck
if (!function_exists('loginCheck')) {
    function loginCheck()
    {
        return thisAuth()->check()
            ? true
            : route('login');

    }
}

// get user Level
if (!function_exists('getLevel')) {
    function getLevel()
    {
        return thisUser()->level ?? 'B';
    }
}

// thisLevel
if (!function_exists('thisLevel')) {
    function thisLevel(): string
    {
        return thisUser()->level ?? '';
    }
}

// isAdmin()
if (!function_exists('isAdmin')) {
    function isAdmin(): bool
    {
        return (thisLevel() === 'M');
    }
}

// 금액 표기
if (!function_exists('priceKo')) {
    function priceKo($price = 0)
    {
        if ($price <= 0) {
            return $price;
        }

        $result = '';
        $expUnit = 10000;
        $priceUnit = ['만원', '억', '조', '경'];
        $resultArray = [];

        foreach ($priceUnit as $key => $val) {
            $unitResult = ($price % pow($expUnit, $key + 1)) / (pow($expUnit, $key));
            $unitResult = floor($unitResult);

            if ($unitResult > 0) {
                $resultArray[$key] = $unitResult;
            }
        }

        if (count($resultArray) > 0) {
            foreach ($resultArray as $k => $v) {
                if (!empty($v)) {
                    $result = number_format($v) . $priceUnit[$k] . ' ' . $result;
                }
            }
        }

        return $result;
    }
}

// 외부 접속 IP 접근 금지 Master 제외
if (!function_exists('externalConnection')) {
    function externalConnection(): bool
    {
        $CERTIFIED_IP = env('CERTIFIED_IP');
        return (!isAdmin() && !empty($CERTIFIED_IP) && (request()->ip() !== $CERTIFIED_IP));
    }
}

// 국가 목록
if (!function_exists('getCountry')) {
    function getCountry()
    {
        $country = Country::orderBy('ci')->get();
//        $country[count($country)] = (object)['ci' => 9999, 'country' => '기타'];

        return $country;
    }
}
//국가 명
if (!function_exists('getCountryNm')) {
    function getCountryNm()
    {
        $country = Country::orderBy('ci')->get();
        $result = array();
        foreach ($country as $val){
            $result[$val['ci']] = $val['cn'];
        }
        return $result;
    }
}
//국가명 영문
if (!function_exists('getCountryCn')) {
    function getCountryCn($ci)
    {
        $result = Country::where('ci',$ci)->first();
        return $result['cn'];
    }
}


// 소속 목록
if (!function_exists('getAffi')) {
    function getAffi()
    {
        $affi = Affiliation::orderBy('sid')->get();
        return $affi;
    }
}

//소속 영문명
if (!function_exists('getAffiNm')) {
    function getAffiNm()
    {
        $affi = Affiliation::orderBy('sid')->get();
        $result = array();
        foreach ($affi as $val){
            $result[$val['sid']] = $val['office_e'];
        }
        return $result;
    }
}

//소속 국문명
if (!function_exists('getAffiKnm')) {
    function getAffiKnm($sid)
    {
        $affi = Affiliation::where('sid',$sid)->first();
        return $affi['office_k'];
    }
}

// check Url
if (!function_exists('isValidTimestamp')) {
    function isValidTimestamp($timestamp)
    {
        try {
            $date = new DateTime($timestamp);
            return $date && $date->format('Y-m-d') !== '-0001-11-30';
        } catch (Exception $e) {
            return false;
        }
    }
}