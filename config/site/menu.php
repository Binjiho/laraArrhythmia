<?php
//        메인 class="main"
//        회원메뉴 class="sub01"
//        마이페이지 class="sub02"
//        학회소개 class="sub03"
//        공지사항 class="sub04"
//        학회지 class="sub05"
//        학술행사 class="sub06"
//        전공의 class="sub07"
//        체외순환사 class="sub08"
//        학회자료 class="sub09"
//        위원회/분과학회 class="sub10"
//        회원공간 class="sub11"

return [
    // ================= web (전문가) =================
    'web' => [
        'main' => [
            'M1' => [
                'name' => '회원가입',
                'class' => 'sub01',
                'route' => 'auth.info',
                'param' => [],
                'url' => null,
                'continue' => true,
            ],

            'M2' => [
                'name' => '마이페이지',
                'class' => 'sub02',
                'route' => 'mypage.intro',
                'param' => [],
                'url' => null,
                'continue' => true,
            ],

            'M3' => [
                'name' => '전문가 자료실',
                'class' => 'sub03',
                'route' => 'guide.atrial',
                'param' => [],
                'url' => null,
                'continue' => false,
            ],

            'M6' => [
                'name' => '학술행사',
                'class' => 'sub06',
                'route' => 'conference',
                'param' => ['year' => date('Y')],
                'url' => null,
                'continue' => false,
            ],

            'M7' => [
                'name' => '학회지',
                'class' => 'sub07',
                'route' => 'academy',
                'param' => [],
                'url' => null,
                'continue' => false,
            ],

            'M8' => [
                'name' => '회원공간',
                'class' => 'sub08',
                'route' => 'surgery.guide',
                'param' => [],
                'url' => null,
                'continue' => false,
            ],


            'M11' => [
                'name' => '해외학회 참가지원',
                'class' => 'sub06',
                'route' => 'overseas.info',
                'param' => [],
                'url' => null,
                'continue' => false,
            ],

            'M9' => [
                'name' => '연구지원',
                'class' => 'sub09',
                'route' => 'research.program',
                'param' => [],
                'url' => null,
                'continue' => false,
            ],

            'M10' => [
                'name' => '대한부정맥학회',
                'class' => 'sub10',
                'route' => 'introduce',
                'param' => [],
                'url' => null,
                'continue' => false,
            ],
        ],

        'sub' => [
            'M1'/*회원가입*/ => [
                'SM1' => [
                    'name' => '회원가입 안내',
                    'route' => 'auth.info',
                    'url' => '',
                    'param' => ['type' => 'chairman'],
                    'low' => null,
                ],

                'SM2' => [
                    'name' => '회원가입',
                    'route' => 'register',
                    'url' => '',
                    'param' => ['step' => 'step1'],
                    'low' => null,
                ],

                'SM3' => [
                    'name' => '로그인',
                    'route' => 'login',
                    'url' => '',
                    'param' => [],
                    'low' => null,
                ],

                'SM4' => [
                    'name' => '아이디/비밀번호 찾기',
                    'route' => 'forgot',
                    'url' => '',
                    'param' => [],
                    'low' => null,
                ],

                'SM5' => [
                    'name' => '개인정보 취급방침',
                    'route' => 'auth.privacy',
                    'url' => '',
                    'param' => ['type' => 'executive'],
                    'low' => null,
                ],

                'SM6' => [
                    'name' => '이메일 무단수집 거부',
                    'route' => 'auth.email',
                    'url' => '',
                    'param' => [],
                    'low' => null,
                ],
            ],

            // 마이페이지
            'M2' => [
                'SM1' => [
                    'name' => '회원정보 수정',
                    'route' => 'mypage.confirm',
                    'param' => [],
                    'low' => null,
                ],

                'SM2' => [
                    'name' => '비밀번호 변경',
                    'route' => 'mypage.confirmPw',
                    'param' => [],
                    'low' => null,
                ],

                'SM3' => [
                    'name' => '회비납부',
                    'route' => 'mypage.fee',
                    'param' => [],
                    'low' => null,
                ],

                'SM4' => [
                    'name' => '학술행사',
                    'route' => 'mypage.conference',
                    'param' => [],
                    'low' => null,
                ],

                'SM5' => [
                    'name' => '연구회/지회',
                    'route' => 'mypage.group',
                    'param' => [],
                    'low' => null,
                ],

                'SM6' => [
                    'name' => '연구지원',
                    'route' => 'mypage.research',
                    'param' => [],
                    'low' => null,
                ],

                'SM9' => [
                    'name' => '해외학회 참가지원',
                    'route' => 'mypage.overseas',
                    'param' => [],
                    'low' => null,
                ],

                'SM7' => [
                    'name' => '중재시술인증',
                    'route' => 'mypage.surgery',
                    'param' => [],
                    'low' => null,
                ],

                'SM8' => [
                    'name' => '회원탈퇴',
                    'route' => 'mypage.withdrawal',
                    'param' => [],
                    'low' => null,
                ],
            ],

            // 전문가 자료실
            'M3' => [
                'SM1' => [
                    'name' => '부정맥 진료지침',
                    'route' => 'guide.atrial',
                    'param' => [],
                    'low' => [
                        'SL1' => [
                            'name' => '심방세동',
                            'route' => 'guide.atrial',
                            'param' => [],
                            'url' => null,
                            'small' => null,
                        ],

                        'SL2' => [
                            'name' => '심실빈맥',
                            'route' => 'guide.ventricular',
                            'param' => [],
                            'url' => null,
                            'small' => null,
                        ],

                        'SL3' => [
                            'name' => '돌연사',
                            'route' => 'guide.sudden',
                            'param' => [],
                            'url' => null,
                            'small' => null,
                        ],

                        'SL4' => [
                            'name' => '심실상성빈맥',
                            'route' => 'guide.sangseong',
                            'param' => [],
                            'url' => null,
                            'small' => null,
                        ],

                        'SL5' => [
                            'name' => '서맥 및 CIED',
                            'route' => 'guide.cied',
                            'param' => [],
                            'url' => null,
                            'small' => null,
                        ],

                        'SL6' => [
                            'name' => '실신',
                            'route' => 'guide.faint',
                            'param' => [],
                            'url' => null,
                            'small' => null,
                        ],
                    ],
                ],

                'SM2' => [
                    'name' => '팩트시트',
                    'route' => 'board',
                    'param' => ['code' => 'fact', 'category'=>'1' ],
                    'low' => [
                        'SL1' => [
                            'name' => 'Part1',
                            'route' => 'board',
                            'param' => ['code' => 'fact', 'category'=>'1'],
                            'url' => null,
                            'small' => null,
                        ],

                        'SL2' => [
                            'name' => 'Part2',
                            'route' => 'board',
                            'param' => ['code' => 'fact', 'category'=>'2'],
                            'url' => null,
                            'small' => null,
                        ],

                        'SL3' => [
                            'name' => 'Part3',
                            'route' => 'board',
                            'param' => ['code' => 'fact', 'category'=>'3'],
                            'url' => null,
                            'small' => null,
                        ],

                    ],
                ],

                'SM3' => [
                    'name' => '부정맥과 심전도 동영상 강의',
                    'route' => 'board',
                    'param' => ['code' => 'video', 'category'=>'1', 'category2'=>'1'],
                    'low' => [],
//                    'low' => [
//                        'SL1' => [
//                            'name' => '부정맥 기초',
//                            'route' => 'board',
//                            'param' => ['code' => 'video', 'category'=>'1'],
//                            'url' => null,
//                            'small' => null,
//                        ],
//
//                        'SL2' => [
//                            'name' => '부정맥 전문가편',
//                            'route' => 'board',
//                            'param' => ['code' => 'video', 'category'=>'2'],
//                            'url' => null,
//                            'small' => null,
//                        ],
//
//                        'SL3' => [
//                            'name' => '심전도',
//                            'route' => 'board',
//                            'param' => ['code' => 'video', 'category'=>'3'],
//                            'url' => null,
//                            'small' => null,
//                        ],
//
//                    ],
                ],

                'SM4' => [
                    'name' => '보험정보',
                    'route' => 'insure.standard',
                    'param' => [],
                    'low' => [
                        'SL1' => [
                            'name' => '보험기준',
                            'route' => 'insure.standard',
                            'url' => '',
                            'param' => [],
                            'small' => [
                                'SS1' => [
                                    'name' => 'CIED',
                                    'route' => 'insure.standard',
                                    'url' => '',
                                    'param' => [],
                                ],
                                'SS2' => [
                                    'name' => '이식형 사건기록기',
                                    'route' => 'insure.s2',
                                    'url' => '',
                                    'param' => [],
                                ],
                                'SS3' => [
                                    'name' => 'RFCA & Cryoablation',
                                    'route' => 'insure.s3',
                                    'url' => '',
                                    'param' => [],
                                ],
                                'SS4' => [
                                    'name' => 'Device 사전 심의 방법',
                                    'route' => 'insure.s4',
                                    'url' => '',
                                    'param' => [],
                                ],
                            ],
                        ],

                        'SL2' => [
                            'name' => '보험 심사 사례',
                            'route' => 'board',
                            'url' => '',
                            'param' => ['code' => 'judge', 'category' => '1'],
                            'small' => [
                                'SS1' => [
                                    'name' => '고주파 전극도자절제술',
                                    'route' => 'board',
                                    'url' => '',
                                    'param' => ['code' => 'judge', 'category' => '1'],
                                ],
                                'SS2' => [
                                    'name' => '인공심박동기',
                                    'route' => 'board',
                                    'url' => '',
                                    'param' => ['code' => 'judge', 'category' => '2'],
                                ],
                                'SS3' => [
                                    'name' => 'ICD / CRT',
                                    'route' => 'board',
                                    'url' => '',
                                    'param' => ['code' => 'judge', 'category' => '3'],
                                ],
                            ],
                        ],
                    ],

                ],
            ],

            // 학술행사
            'M6' => [
                'SM1' => [
                    'name' => '국내외 학술행사',
                    'route' => 'conference',
                    'param' => ['year' => date('Y')],
                    'url' => '',
                    'low' => null,
                ],

                'SM2' => [
                    'name' => '학술행사 자료',
                    'route' => 'board',
                    'url' => '',
                    'param' => ['code' => 'library', 'category' => '1','category2'=> '1'],
                    'low' => null,
                ],

//                'SM3' => [
//                    'name' => '해외학회신청',
//                    'route' => 'overseas.info',
//                    'url' => '',
//                    'param' => [],
//                    'low' => null,
//                ],
            ],

            // 학회지
            'M7' => [
                'SM1' => [
                    'name' => '학회지 관련 안내',
                    'route' => 'academy', //academy
                    'url' => '',
                    'param' => [],
                    'low' => null,
                ],

                'SM2' => [
                    'name' => '온라인 논문 투고',
                    'route' => 'academy.paperSubmission', //academy
                    'url' => '',
                    'param' => [],
                    'low' => null,
                ],

                'SM3' => [
                    'name' => '온라인 논문 규정',
                    'route' => 'academy.paperRule', //academy
                    'url' => '',
                    'param' => [],
                    'low' => null,
                ],

                'SM4' => [
                    'name' => '편집 윤리',
                    'route' => 'academy.editSubmission', //academy
                    'url' => '',
                    'param' => [],
                    'low' => null,
                ],

                'SM5' => [
                    'name' => '편집위원회 규정',
                    'route' => 'academy.editRule', //academy
                    'url' => '',
                    'param' => [],
                    'low' => null,
                ],
            ],

            // 회원공간
            'M8' => [
                'SM1' => [
                    'name' => '전문회원 가입안내',
                    'route' => 'surgery.guide',
                    'url' => '',
                    'param' => [],
                    'low' => null,
                ],
                'SM2' => [
                    'name' => '공지사항',
                    'route' => 'board',
                    'url' => '',
                    'param' => ['code' => 'notice'],
                    'low' => null,
                ],
                'SM3' => [
                    'name' => '부정맥 중재시술전문의',
                    'route' => 'surgery',
                    'url' => '',
                    'param' => [],
                    'low' => null,
                ],
                'SM4' => [
                    'name' => '포토갤러리',
                    'route' => 'board',
                    'url' => '',
                    'param' => ['code' => 'photo', 'abyear'=>date('Y')],
                    'low' => null,
                ],
            ],

            // 해외학회
            'M11' => [
                'SM1' => [
                    'name' => '안내 및 신청',
                    'route' => 'overseas.info',
                    'url' => '',
                    'param' => [],
                    'low' => null,
                ],

                'SM2' => [
                    'name' => '공지사항',
                    'route' => 'board',
                    'url' => '',
                    'param' => ['code'=>'overseas'],
                    'low' => null,
                ],
            ],

            // 연구지원
            'M9' => [
                'SM1' => [
                    'name' => '연구지원 프로그램',
                    'route' => 'research.program',
                    'url' => '',
                    'param' => [],
                    'low' => null,
                ],

                'SM2' => [
                    'name' => '연구비 신청',
                    'route' => 'research.info',
                    'url' => '',
                    'param' => [],
                    'low' => null,
                ],

                'SM3' => [
                    'name' => '현황 및 결과',
                    'route' => 'research.result',
                    'url' => '',
                    'param' => [],
                    'low' => null,
                ],
            ],

            // 대한부정맥학회
            'M10' => [
                'SM1' => [
                    'name' => '인사말',
                    'route' => 'introduce', //introduce
                    'url' => '',
                    'param' => [],
                    'low' => null,
                ],

                'SM2' => [
                    'name' => '미션/비전',
                    'route' => 'introduce.vision', //introduce
                    'url' => '',
                    'param' => [],
                    'low' => null,
                ],

                'SM3' => [
                    'name' => '임원회/위원회',
                    'route' => 'introduce.committee', //introduce
                    'url' => '',
                    'param' => [],
                    'low' => null,
                ],

                'SM4' => [
                    'name' => '사무국 안내',
                    'route' => 'introduce.info', //introduce
                    'url' => '',
                    'param' => [],
                    'low' => null,
                ],

                'SM5' => [
                    'name' => 'KHRS 로고',
                    'route' => 'introduce.logo',
                    'url' => '',
                    'param' => [],
                    'low' => null,
                ],

                'SM6' => [
                    'name' => '연구회/지회',
                    'route' => 'introduce.group.list', //introduce
                    'url' => '',
                    'param' => [],
                    'low' => null,
                ],
            ],

        ],
    ],

    // ================= admin =================
    'admin' => [
        'main' => [
            'M1' => [
                'name' => '회원관리',
                'route' => 'member',
                'param' => [],
            ],

            'M2' => [
                'name' => '회비관리',
                'route' => 'fee',
                'param' => [],
            ],

            'M3' => [
                'name' => '학술대회 관리',
                'route' => 'conference',
                'param' => [],
            ],

            'M4' => [
                'name' => '해외학회 관리',
                'route' => 'overseas',
                'param' => [],
            ],

            'M5' => [
                'name' => '연구지원 관리',
                'route' => 'research',
                'param' => [],
            ],

            'M6' => [
                'name' => '중재시술인증 관리',
                'route' => 'surgery',
                'param' => [],
            ],

            'M7' => [
                'name' => '연구회 / 지회 관리',
                'route' => 'group',
                'param' => [],
            ],

            'M8' => [
                'name' => '메일관리',
                'route' => 'mail',
                'param' => [],
            ],
        ],

        'sub' => [
            'M1' => [
                'SM1' => [
                    'name' => '- 회원관리',
                    'route' => 'member',
                    'param' => [],
                ],

                'SM2' => [
                    'name' => '- 탈퇴회원관리',
                    'route' => 'member.withdrawal',
                    'param' => [],
                ],
            ],

            //회비관리
            'M2' => [
                'SM1' => [
                    'name' => '- 회비관리',
                    'route' => 'fee',
                    'param' => [],
                ],
            ],

            //학술대회 관리
            'M3' => [
                'SM1' => [
                    'name' => '- 학술대회 관리',
                    'route' => 'conference',
                    'param' => [],
                ],
            ],

            //해외학회
            'M4' => [
                'SM1' => [
                    'name' => '- 해외학회관리',
                    'route' => 'overseas',
                    'param' => [],
                ],
            ],

            //연구지원
            'M5' => [
                'SM1' => [
                    'name' => '- 연구지원 관리',
                    'route' => 'research',
                    'param' => [],
                ],

                'SM2' => [
                    'name' => '- 심사자 관리',
                    'route' => 'reviewer',
                    'param' => ['code'=>'research'],
                ],
            ],

            //중재시술인증
            'M6' => [
                'SM1' => [
                    'name' => '- 중재시술인증 관리',
                    'route' => 'surgery',
                    'param' => [],
                ],

                'SM2' => [
                    'name' => '- 심사자 관리',
                    'route' => 'reviewer',
                    'param' => ['code'=>'surgery'],
//                    'route' => 'research_reviewer',
//                    'param' => [],
                ],
            ],

            //연구회/지회
            'M7' => [
                'SM1' => [
                    'name' => '- 연구회/지회 관리',
                    'route' => 'group',
                    'param' => [],
                ],
            ],

            //메일관리
            'M8' => [
                'SM1' => [
                    'name' => '- 메일발송 관리',
                    'route' => 'mail',
                    'param' => [],
                ],

                'SM2' => [
                    'name' => '- 메일 주소록 관리',
                    'route' => 'mail.address',
                    'param' => [],
                ],
            ],
        ]
    ],

    // ================= general (일반인) =================
    'general' => [
        'main' => [
            'M1' => [
                'name' => '부정맥 상식',
                'class' => 'sub01',
                'route' => 'general.know',
                'param' => [],
                'url' => '',
                'continue' => false,
            ],
            'M2' => [
                'name' => '부정맥 동영상으로 알아보기',
                'class' => 'sub02',
                'route' => 'board',
                'param' => ['code' => 'videoGeneral', 'category'=>'1'],
                'url' => '',
                'continue' => false,
            ],
            'M3' => [
                'name' => '부정맥 전문가찾기',
                'class' => 'sub03',
                'route' => 'general.search',
                'param' => [],
                'url' => '',
                'continue' => false,
            ],
            'M4' => [
                'name' => '하트리듬의날 캠페인',
                'class' => 'sub04',
                'route' => 'general.heart',
                'param' => [],
                'url' => '',
                'continue' => false,
            ],
            'M5' => [
                'name' => '대한부정맥학회',
                'class' => 'sub05',
                'route' => 'general.info.greeting',
                'param' => [],
                'url' => '',
                'continue' => false,
            ],
        ],

        'sub' => [
            'M1' => [
                'SM1' => [
                    'name' => '부정맥이란',
                    'route' => 'general.know',
                    'param' => [],
                    'url' => '',
                    'continue' => false,
                ],
                'SM2' => [
                    'name' => '부정맥의 종류',
                    'route' => 'general.know.kind',
                    'param' => ['category' => '1'],
                    'url' => '',
                    'continue' => false,
                ],
                'SM3' => [
                    'name' => '부정맥 진단 방법',
                    'route' => 'general.know.diagnosis',
                    'param' => [],
                    'url' => '',
                    'continue' => false,
                ],
                'SM4' => [
                    'name' => '부정맥 치료 방법',
                    'route' => 'general.know.therapy',
                    'param' => ['category' => '1'],
                    'url' => '',
                    'continue' => false,
                ],
            ],

            'M2' => [
                'SM1' => [
                    'name' => '부정맥이란',
                    'route' => 'board',
                    'param' => ['code' => 'videoGeneral', 'category' => '1'],
                    'url' => '',
                    'continue' => false,
                ],
                'SM2' => [
                    'name' => '부정맥의 종류',
                    'route' => 'board',
                    'param' => ['code' => 'videoGeneral', 'category' => '2'],
                    'url' => '',
                    'continue' => false,
                ],
                'SM3' => [
                    'name' => '부정맥 진단 방법',
                    'route' => 'board',
                    'param' => ['code' => 'videoGeneral', 'category' => '3'],
                    'url' => '',
                    'continue' => false,
                ],
                'SM4' => [
                    'name' => '부정맥 치료 - 전극도자절제술',
                    'route' => 'board',
                    'param' => ['code' => 'videoGeneral', 'category' => '4'],
                    'url' => '',
                    'continue' => false,
                ],
                'SM5' => [
                    'name' => '부정맥 치료 - 심장전기장치',
                    'route' => 'board',
                    'param' => ['code' => 'videoGeneral', 'category' => '5'],
                    'url' => '',
                    'continue' => false,
                ],
            ],

            'M5' => [
                'SM1' => [
                    'name' => '인사말',
                    'route' => 'general.info.greeting',
                    'param' => [],
                    'url' => '',
                    'continue' => false,
                ],
                'SM2' => [
                    'name' => '미션/비젼',
                    'route' => 'general.info.mission',
                    'param' => [],
                    'url' => '',
                    'continue' => false,
                ],
                'SM3' => [
                    'name' => '임원진/위원회',
                    'route' => 'general.info.committee',
                    'param' => [],
                    'url' => '',
                    'continue' => false,
                ],
                'SM4' => [
                    'name' => '사무국 안내',
                    'route' => 'general.info.contact',
                    'param' => [],
                    'url' => '',
                    'continue' => false,
                ],
            ],
        ]
    ],

    // ================= eng (영문) =================
    'eng' => [
        'main' => [
            'M1' => [
                'name' => 'About KHRS',
                'class' => 'sub01',
                'route' => 'eng.about',
                'param' => [],
                'url' => '',
                'continue' => false,
            ],
            'M2' => [
                'name' => 'KHRS Journal',
                'class' => 'sub02',
                'route' => 'eng.journal',
                'param' => [],
                'url' => '',
                'continue' => false,
            ],
        ],

        'sub' => [
            'M1' => [
                'SM1' => [
                    'name' => 'Greetings',
                    'route' => 'eng.about',
                    'param' => [],
                    'url' => '',
                    'continue' => false,
                ],
                'SM2' => [
                    'name' => 'History',
                    'route' => 'eng.about.history',
                    'param' => [],
                    'url' => '',
                    'continue' => false,
                ],
                'SM3' => [
                    'name' => 'Committees',
                    'route' => 'eng.about.committees',
                    'param' => [],
                    'url' => '',
                    'continue' => false,
                ],
                'SM4' => [
                    'name' => 'Secretariat Info',
                    'route' => 'eng.about.info',
                    'param' => [],
                    'url' => '',
                    'continue' => false,
                ],
                'SM5' => [
                    'name' => 'Notice',
                    'route' => 'board',
                    'param' => ['code' => 'noticeEng'],
                    'url' => '',
                    'continue' => false,
                ],
            ],

            'M2' => [
                'SM1' => [
                    'name' => 'About the Journal',
                    'route' => 'eng.journal',
                    'param' => [],
                    'url' => '',
                    'continue' => false,
                ],
                'SM2' => [
                    'name' => 'Online Submission',
                    'route' => 'eng.journal.submission',
                    'param' => [],
                    'url' => '',
                    'continue' => false,
                ],
                'SM3' => [
                    'name' => 'Instruction to Authors',
                    'route' => 'eng.journal.instruction',
                    'param' => [],
                    'url' => '',
                    'continue' => false,
                ],
            ],
        ]
    ],

    // ================= pro (전문기술인) =================
    'pro' => [
        'main' => [
            'M1' => [
                'name' => '소개',
                'class' => 'sub01',
                'route' => 'pro.greeting',
                'param' => [],
                'url' => null,
                'continue' => false,
            ],

            'M2' => [
                'name' => '부정맥과 심전도 동영상 강의',
                'class' => 'sub02',
                'route' => 'board',
                'param' => ['code'=>'video', 'category' => '1', 'category2' => '1'],
                'url' => null,
                'continue' => false,
            ],

            'M3' => [
                'name' => '보험정보',
                'class' => 'sub03',
                'route' => 'insure.standard',
                'param' => [],
                'url' => null,
                'continue' => false,
            ],

            'M6' => [
                'name' => '학술행사',
                'class' => 'sub06',
                'route' => 'conference',
                'param' => ['year' => date('Y')],
                'url' => null,
                'continue' => false,
            ],

            'M7' => [
                'name' => '학회지',
                'class' => 'sub07',
                'route' => 'academy',
                'param' => [],
                'url' => null,
                'continue' => false,
            ],

            'M8' => [
                'name' => '회원공간',
                'class' => 'sub08',
                'route' => 'board',
                'param' => ['code'=>'noticePro'],
                'url' => null,
                'continue' => false,
            ],

            'M10' => [
                'name' => '대한부정맥학회',
                'class' => 'sub10',
                'route' => 'introduce',
                'param' => [],
                'url' => null,
                'continue' => false,
            ],
        ],

        'sub' => [
            'M1'/*소개*/ => [
                'SM1' => [
                    'name' => '인사말',
                    'route' => 'pro.greeting',
                    'url' => '',
                    'param' => [],
                    'low' => null,
                ],

                'SM2' => [
                    'name' => '연혁',
                    'route' => 'pro.history',
                    'url' => '',
                    'param' => [],
                    'low' => null,
                ],

                'SM3' => [
                    'name' => '임원진/위원회',
                    'route' => 'pro.committee',
                    'url' => '',
                    'param' => [],
                    'low' => null,
                ],

                'SM4' => [
                    'name' => '회원가입 안내',
                    'route' => 'pro.register',
                    'url' => '',
                    'param' => [],
                    'low' => null,
                ],

                'SM5' => [
                    'name' => '미션/비전',
                    'route' => 'pro.mission',
                    'url' => '',
                    'param' => [],
                    'low' => null,
                ],

                'SM6' => [
                    'name' => '사무국 안내',
                    'route' => 'pro.guide',
                    'url' => '',
                    'param' => [],
                    'low' => null,
                ],

            ],

            // 부정맥과 심전도 동영상 강의
            'M2' => [
                'SM1' => [
                    'name' => '부정맥 기초',
                    'route' => 'board',
                    'url' => '',
                    'param' => ['code' => 'video', 'category' => '1', 'category2' => '1' ],
                    'low' => null,
                ],
                'SM2' => [
                    'name' => '부정맥 전문가편',
                    'route' => 'board',
                    'url' => '',
                    'param' => ['code' => 'video', 'category' => '2', 'category2' => '1' ],
                    'low' => null,
                ],
                'SM3' => [
                    'name' => '심전도',
                    'route' => 'board',
                    'url' => '',
                    'param' => ['code' => 'video', 'category' => '3', 'category2' => '1' ],
                    'low' => null,
                ],
            ],

            // 보험정보
            'M3' => [
                'SM1' => [
                    'name' => '보험기준',
                    'route' => 'insure.standard',
                    'param' => ['siteType' => 'Pro'],
                    'low' => [
                        'SL1' => [
                            'name' => 'CIED',
                            'route' => 'insure.standard',
                            'param' => [],
                            'url' => null,
                            'small' => null,
                        ],

                        'SL2' => [
                            'name' => '이식형 사건기록기',
                            'route' => 'insure.s2',
                            'url' => '',
                            'param' => [],
                            'small' => null,
                        ],
                        'SL3' => [
                            'name' => 'RFCA & Cryoablation',
                            'route' => 'insure.s3',
                            'url' => '',
                            'param' => [],
                            'small' => null,
                        ],
                        'SL4' => [
                            'name' => 'Device 사전 심의 방법',
                            'route' => 'insure.s4',
                            'url' => '',
                            'param' => [],
                            'small' => null,
                        ],
                    ],
                ],
                'SM2' => [
                    'name' => '보험심사사례',
                    'route' => 'board',
                    'param' => ['code' => 'judge', 'category'=>'1'],
                    'low' => [
                        'SL1' => [
                            'name' => '고주파 전극도자절제술',
                            'route' => 'board',
                            'url' => '',
                            'param' => ['code' => 'judge', 'category' => '1'],
                            'small' => null,
                        ],
                        'SL2' => [
                            'name' => '인공심박동기',
                            'route' => 'board',
                            'url' => '',
                            'param' => ['code' => 'judge', 'category' => '2'],
                            'small' => null,
                        ],
                        'SL3' => [
                            'name' => 'ICD / CRT',
                            'route' => 'board',
                            'url' => '',
                            'param' => ['code' => 'judge', 'category' => '3'],
                            'small' => null,
                        ],
                    ],
                ],
                'SM3' => [
                    'name' => 'Q&A',
                    'route' => 'board',
                    'param' => ['code' => 'atrialQnaPro'],
                    'low' => null,
                ],

            ],

            // 학술행사
            'M6' => [
                'SM1' => [
                    'name' => '국내외 학술행사',
                    'route' => 'conference',
                    'param' => ['year' => date('Y')],
                    'url' => '',
                    'low' => null,
                ],

                'SM2' => [
                    'name' => '학술행사 자료',
                    'route' => 'board',
                    'url' => '',
                    'param' => ['code' => 'library', 'category' => '1','category2'=> '1'],
                    'low' => null,
                ],
            ],

            // 학회지
            'M7' => [
                'SM1' => [
                    'name' => '학회지 관련 안내',
                    'route' => 'academy', //academy
                    'url' => '',
                    'param' => [],
                    'low' => null,
                ],

                'SM2' => [
                    'name' => '온라인 논문 투고',
                    'route' => 'academy.paperSubmission', //academy
                    'url' => '',
                    'param' => [],
                    'low' => null,
                ],

                'SM3' => [
                    'name' => '온라인 논문 규정',
                    'route' => 'academy.paperRule', //academy
                    'url' => '',
                    'param' => [],
                    'low' => null,
                ],

                'SM4' => [
                    'name' => '편집 윤리',
                    'route' => 'academy.editSubmission', //academy
                    'url' => '',
                    'param' => [],
                    'low' => null,
                ],

                'SM5' => [
                    'name' => '편집위원회 규정',
                    'route' => 'academy.editRule', //academy
                    'url' => '',
                    'param' => [],
                    'low' => null,
                ],
            ],

            // 회원공간
            'M8' => [
                'SM1' => [
                    'name' => '공지사항',
                    'route' => 'board',
                    'url' => '',
                    'param' => ['code' => 'noticePro'],
                    'low' => null,
                ],
                'SM2' => [
                    'name' => '포토갤러리',
                    'route' => 'board',
                    'url' => '',
                    'param' => ['code' => 'photoPro', 'abyear'=>date('Y')],
                    'low' => null,
                ],
                'SM3' => [
                    'name' => '마이페이지',
                    'route' => 'pro.mypage',
                    'url' => '',
                    'param' => [],
                    'low' => null,
                ],
                'SM4' => [
                    'name' => '자유게시판',
                    'route' => 'board',
                    'url' => '',
                    'param' => ['code' => 'replyPro'],
                    'low' => null,
                ],
            ],

            // 대한부정맥학회
            'M10' => [
                'SM1' => [
                    'name' => '인사말',
                    'route' => 'introduce', //introduce
                    'url' => '',
                    'param' => [],
                    'low' => null,
                ],

                'SM2' => [
                    'name' => '미션/비전',
                    'route' => 'introduce.vision', //introduce
                    'url' => '',
                    'param' => [],
                    'low' => null,
                ],

                'SM3' => [
                    'name' => '임원회/위원회',
                    'route' => 'introduce.committee', //introduce
                    'url' => '',
                    'param' => [],
                    'low' => null,
                ],

                'SM4' => [
                    'name' => '사무국 안내',
                    'route' => 'introduce.info', //introduce
                    'url' => '',
                    'param' => [],
                    'low' => null,
                ],
            ],

        ],
    ],
];