<?php

//회원 컨피그
return [
    'directory' => 'research', // 파일 저장 폴더

    //date_type
    'date_type' => [
        'D' => '1년 과제',
    ],

    // 심사 결과
    'result' => [
        'U' => '신청완료',
        'S' => '심사완료',
        'I' => '심사 진행 중',
        'R' => '진행보고',
    ],

    // 심사 state css
    'result_css' => [
        'U' => 'complete',
        'S' => 'success',
        'I' => 'ing',
        'R' => 'text-skyblue',
    ],

    // 심사자 활성여부
    'reviewer_use' => [
        'Y' => '활성',
        'N' => '비활성',
    ],
];
