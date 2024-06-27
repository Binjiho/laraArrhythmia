<?

return [
    'code' => 'research', // 게시판 코드
    'skin' => 'research', // 게시판 스킨
    'name' => '자주하는 질문(FAQ)', // 게시판 명
    'subject' => '타이틀', // 게시판 Subject 명
    'directory' => 'research', // 파일 저장 폴더

    'options' => [
        'hide' => ['N' => '공개', 'Y' => '비공개'], // 공개여부
    ],

    'key' => [
        'main' => 'M6',
        'sub' => 'SM3'
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
        'level' => true,

    ],
    
    'level' => [
        'A' => '심사위원장',
        'B' => '심사위원',
    ],

    // 심사자 활성여부
    'reviewer_use' => [
        'Y' => '활성',
        'N' => '비활성',
    ],

    'search' => [ // 검색 정보
        'subject' => '제목',
        'contents' => '내용',
    ],


];
