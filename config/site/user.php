<?php

//회원 컨피그
return [
    'directory' => 'user', // 파일 저장 폴더

    //회원등급
    'level' => [
        'B' => '가입대기',
        'A' => '회원',
        'S' => '전문회원',
        'D' => '탈퇴회원',
        'M' => '관리자',

        'H' => '보류(회원)',
        'I' => '보류(전문회원)',
        'J' => '보류(일반회원)',
        'G' => '일반회원',
        'T' => '기타',
    ],

    //직책(직함)
    'position' => [
        '1' => 'MD',
        '2' => 'PhD',
        '3' => 'Prof.',
        '4' => 'RN',
        '5' => 'RT',
        '6' => 'MT',
        '7' => 'BS',
        '99' => '기타',
    ],

    //tel(자택)
    'tel_first' => [
        '02' => '02',
        '031' => '031',
        '032' => '032',
        '033' => '033',
        '041' => '041',
        '042' => '042',
        '043' => '043',
        '044' => '044',
        '051' => '051',
        '052' => '052',
        '053' => '053',
        '054' => '054',
        '055' => '055',
        '061' => '061',
        '062' => '062',
        '063' => '063',
        '064' => '064',
        '070' => '070',
    ],
    //phone(휴대폰)
    'phone_first' => [
        '010' => '010',
        '011' => '011',
        '016' => '016',
        '017' => '017',
        '018' => '018',
        '019' => '019',
    ],

    //근무처 구분
    'office' => [
        '1' => '대학병원',
        '2' => '중소병원',
        '3' => '개인병원',
        '99' => '기타',
    ],

    //가입구분
    'category' => [
        '1' => '봉직의',
        '2' => '개원의',
        '3' => '전임의 / 전공의',
        '4' => '방사선사',
        '5' => '임상병리사',
        '6' => '간호사',
        '7' => '연구원',
        '8' => '학생',
        '9' => '일반인',
        '99' => '기타',
    ],

    //전공구분
    'major' => [
        '1' => '전문과목',
        '2' => '기초의학',
        '99' => '기타분야',
    ],

    'major_etc_old' => [
        '1' => '치의학',
        '2' => '약학',
        '3' => '영양학',
        '4' => '간호학',
        '5' => '의료기사',
        '99' => '기타',
    ],

    'major_etc' => [
        '1' => [
            '1' => '내과',
            '2' => '외과',
            '3' => '소아청소년과',
            '4' => '산부인과',
            '5' => '정신건강의학과',
            '6' => '정형외과',
            '7' => '신경외과',
            '8' => '흉부외과',
            '9' => '성형외과',
            '10' => '안과',
            '11' => '이비인후과',
            '12' => '피부과',
            '13' => '비뇨기과',
            '14' => '영상의학과',
            '15' => '방사선종양학과',
            '16' => '마취통증의학과',
            '17' => '신경과',
            '18' => '재활의학과',
            '19' => '결핵과',
            '20' => '진단검사의학과',
            '21' => '병리과',
            '22' => '예방의학과',
            '23' => '가정의학과',
            '24' => '산업의학과',
            '25' => '핵의학과',
            '26' => '응급의학과',
            '99' => '기타',
        ],
        '2' => [
            '1' => '해부학',
            '2' => '생리학',
            '3' => '생화학',
            '4' => '병리학',
            '5' => '약리학',
            '6' => '미생물학',
            '7' => '기생충학',
            '8' => '예방의학',
            '9' => '법의학',
            '10' => '의사학',
            '99' => '기타',
        ],
        '99' => [
            '1' => '치의학',
            '2' => '약학',
            '3' => '영양학',
            '4' => '간호학',
            '5' => '의료기사',
            '99' => '기타',
        ],
    ],

    // 진료분야
    'field' => [
        '1' => '기초',
        '2' => '심전도',
        '3' => '심박동기',
        '4' => '재동기장치',
        '5' => '제세동기',
        '6' => '심전기생리검사',
        '7' => '도자절제',
        '8' => '관동맥중재시술',
        '9' => '심초음파',
        '10' => '심부전',
        '11' => '소아심장',
        '12' => '심폐소생술',
        '99' => '기타',
    ],

    // 가입승인
    'confirm' => [
        'Y' => '승인',
        'N' => '미승인',
    ],

    // 탈퇴 가입승인
    'del_confirm' => [
        'Y' => '탈퇴처리 완료',
        'R' => '탈퇴요청 중',
        'D' => '관리자 삭제',
    ],

    'search' => [
        'name_kr' => '이름',
        'uid' => '아이디',
        'email' => '이메일',
        'phone' => '핸드폰번호',
        'license_number' => '면허번호',
    ]
];
