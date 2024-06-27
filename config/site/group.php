<?php

return [
    // ================== 공개여부 ==================
    'hide' => [
        'N' => '공개',
        'Y' => '비공개',
    ],

    'member-search' => [
        'uid' => '아이디',
        'name_kr' => '이름',
    ],

    'code' => 'conference', // 게시판 코드
    'skin' => 'conference', // 게시판 스킨
    'name' => '국내외 학술행사', // 게시판 명
    'subject' => '행사명', // 게시판 Subject 명
    'directory' => 'gruop/conference', // 파일 저장 폴더

    'options' => [
        'hide' => ['N' => '공개', 'Y' => '비공개'], // 공개여부
        'main' => ['N' => '미노출', 'Y' => '노출'], // 메인노출
        'notice' => ['N' => '미사용', 'Y' => '사용'], // 상단공지
        'secret' => ['N' => '미사용', 'Y' => '사용'], // 비밀글
        'date_type' => ['D' => '하루행사', 'L' => '장기행사'], // 기간 타입
        'popup_content' => ['1' => '공지 내용과 동일', '2' => '팝업 내용 새로 작성'], // 팝업내용
        'popup_detail' => ['N' => '설정안함', 'Y' => '설정함'], // 팝업 상세보기 링크 사용여부
        'popup_skin' => ['0' => '없음'], // 팝업 스킨
        'popup_yn' => ['N' => '미사용', 'Y' => '사용'], // 팝업 사용여부
    ],

    'permission' => [ // 권한 빈값은 전체 접근, 값이있을경우 해당 level 만 접근가능
        'list' => [], // 리스트 권한
        'view' => [], // 상세보기 권한
        'write' => ['M'], // 글쓰기 권한
        'reply' => [], // 답글 쓰기 권한
        'comment' => [], // 댓글 권한
    ],

    'use' => [ // 사용 유무
        'login' => false, // 로그인
        'writer' => false, // 리스트에 작성자 노출
        'main' => false, // 메인노출
        'link' => true, // 상세링크
        'hide' => true, // 공개옵션
        'date' => true, // 기간설정

        'place' => true, // 장소

//        'category' => true, // 카테고리
        'gubun' => true, // 카테고리
        'file' => true, // 파일업로드 (단일파일)
        'plupload' => false, // 파일업로드 (plupload) 사용
    ],

    'gubun' => [
        'name' => '구분', // 카테고리 명칭
        'type' => 'radio', // radio or checkbox or select
        'item' => [ // 게시판 카테고리 ex) key => value
            '1' => '국내행사',
            '2' => '학술대회',
            '3' => '기타',
        ],
    ],

    'file' => [
        'name' => '썸네일' // 단일 파일 명칭
    ],

    'date' => [
        'name' => '행사일정' // 일정 사용시 일정명
    ],

    'key' => [
        'main' => 'M6',
        'sub' => 'SM1'
    ],
];
