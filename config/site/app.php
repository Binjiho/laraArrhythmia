<?php

return [
    // ================== asset version ==================
    'asset_version' => '20230605',

    // ================= api =================
    'api' => [
        'url' => env('APP_URL') . '/api',
    ],

    // ================= admin =================
    'admin' => [
        'app_name' => env('APP_NAME') . ' | 관리자',
        'url' => env('APP_URL') . '/admin',
    ],

    // ================= web =================
    'web' => [
        'app_name' => env('APP_NAME'),
        'url' => env('APP_URL'),
    ],

    // ================= general =================
    'general' => [
        'app_name' => env('APP_NAME') . ' | 일반인',
        'url' => env('APP_URL') . '/general',
    ],

    // ================= device =================
    'device' => [
        'P' => 'PC',
        'T' => 'Tablet',
        'M' => 'Mobile',
    ],

    // ================= error =================
    'error' => [
        'auth' => '로그인이 필요합니다.',
        'deny' => '접근 권한이 없습니다.',
        'pw' => '비밀번호가 일치하지 않습니다.',
        'nFile' => '다운로드 가능한 파일이 없습니다.',
        '404' => '잘못된 경로 입니다.',
        '500' => '500 ERROR.',
        'db' => 'DB ERROR.',
        'surgery' => '중재시술인증을 이미 등록하였습니다.',
        'registration' => '학술대회 사전등록을 이미 신청하였습니다.',
    ]
];
