<?php

//중재시술 컨피그
return [
    'directory' => 'surgery', // 파일 저장 폴더

    //경력 구분
    'career_gubun' => [
        'C' => '경력',
        'O' => '해외연수',
    ],

    //증례 구분
    'case_gubun' => [
        'A' => '전극도자절제술',
        'B' => 'PM+ICD+CRT',
    ],

    //증례 성별
    'case_gender' => [
        'M' => '남',
        'F' => '여',
    ],

    // 심사 결과
    'result' => [
        'U' => '신청완료',
        'S' => '심사완료',
//        'I' => '심사 진행 중',
//        'R' => '진행보고',
    ],

    // 심사 state css
    'result_css' => [
        'U' => 'state',
        'S' => 'state text-skyblue',
        'I' => 'ing',
//        'R' => 'text-skyblue',
    ],

    // 심사자 활성여부
    'reviewer_use' => [
        'Y' => '활성',
        'N' => '비활성',
    ],

];
