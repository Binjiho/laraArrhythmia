<?

return [
    'code' => 'notice', // 게시판 코드
    'skin' => 'notice', // 게시판 스킨
    'name' => '공지사항', // 게시판 명
    'subject' => '제목', // 게시판 Subject 명
    'directory' => 'bbs/notice', // 파일 저장 폴더

    'key' => [
        'main' => 'M8',
        'sub' => 'SM2',
        'low' => null,
        'small' => null,
    ],

    'options' => [
        'hide' => ['N' => '공개', 'Y' => '비공개'], // 공개여부
        'main' => ['N' => '미노출', 'Y' => '노출'], // 메인노출
        'notice' => ['N' => '미사용', 'Y' => '사용'], // 상단공지
        'secret' => ['N' => '미사용', 'Y' => '사용'], // 비밀글
        'date_type' => ['D' => '하루', 'L' => '장기'], // 기간 타입
        'popup_content' => ['1' => '공지 내용과 동일', '2' => '팝업 내용 새로 작성'], // 팝업내용
        'popup_detail' => ['N' => '설정안함', 'Y' => '설정함'], // 팝업 상세보기 링크 사용여부
        'popup_skin' => ['0' => '없음'], // 팝업 스킨
        'popup_yn' => ['N' => '미사용', 'Y' => '사용'], // 팝업 사용여부
    ],

    'permission' => [ // 권한 빈값은 전체 접근, 값이있을경우 해당 level 만 접근가능
        'list' => [], // 리스트 권한
        'view' => [], // 상세보기 권한
        'write' => [], // 글쓰기 권한
        'reply' => [], // 답글 쓰기 권한
        'comment' => [], // 댓글 권한
    ],

    'use' => [ // 사용 유무
        'login' => false, // 로그인
        'writer' => true, // 리스트에 작성자 노출
        'main' => true, // 메인노출
        'link' => true, // 상세링크
        'hide' => true, // 공개옵션
        'date' => true, // 기간설정
        'popup' => true, // 팝업
        'place' => true, // 장소
        'reply' => true, // 답글
        'notice' => true, // 공지
        'secret' => true, // 비밀글
        'comment' => true, // 댓글
        'category' => true, // 카테고리
        'category2' => true, // 카테고리2
        'file' => true, // 파일업로드 (단일파일)
        'plupload' => true, // 파일업로드 (plupload) 사용
    ],

    'category' => [
        'name' => '카테고리', // 카테고리 명칭
        'type' => 'radio', // radio or checkbox or select
        'item' => [ // 게시판 카테고리 ex) key => value
            '1' => 'c1',
            '2' => 'c2',
        ],
    ],

    'category2' => [
        'name' => '카테고리2', // 카테고리2 명칭
        'type' => 'select', // radio or checkbox or select
        'item' => [ // 게시판 카테고리 ex) key => value
            '1' => 'c1',
            '2' => 'c2',
        ],
    ],

    'file' => [
        'name' => '썸네일' // 단일 파일 명칭
    ],

    'date' => [
        'name' => '행사일정' // 일정 사용시 일정명
    ],



    'search' => [ // 검색 정보
        'subject' => '제목',
        'content' => '내용',
    ],
];
