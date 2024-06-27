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
    'main' => [
        'M1' => [
            'name' => '전문가 자료실',
            'class' => '',
            'route' => '',
            'param' => [],
            'url' => 'javascript:void(0)',
            'continue' => false,
        ],

        'M2' => [
            'name' => '학술행사',
            'class' => '',
            'route' => '',
            'param' => [],
            'url' => 'javascript:void(0)',
            'continue' => false,
        ],

        'M3' => [
            'name' => '학회지',
            'class' => '',
            'route' => '',
            'param' => [],
            'url' => 'javascript:void(0)',
            'continue' => false,
        ],

        'M4' => [
            'name' => '회원공간',
            'class' => '',
            'route' => '',
            'param' => [],
            'url' => 'javascript:void(0)',
            'continue' => false,
        ],

        'M5' => [
            'name' => '해외학회신청',
            'class' => '',
            'route' => '',
            'param' => [],
            'url' => 'javascript:void(0)',
            'continue' => false,
        ],

        'M6' => [
            'name' => '연구지원',
            'class' => '',
            'route' => '',
            'param' => [],
            'url' => 'javascript:void(0)',
            'continue' => false,
        ],

        'M7' => [
            'name' => '학회 소개',
            'class' => '',
            'route' => '',
            'param' => [],
            'url' => 'javascript:void(0)',
            'continue' => false,
        ],
    ],

    'sub' => [
        'M1' => [ // 전문가 자료실
            'S1' => [
                'name' => '부정맥 진료지침',
                'class' => '',
                'route' => '',
                'param' => [],
                'url' => 'javascript:void(0)',
            ],

            'S2' => [
                'name' => '팩트시트',
                'class' => '',
                'route' => '',
                'param' => [],
                'url' => 'javascript:void(0)',
            ],

            'S3' => [
                'name' => '부정맥과 심전도 동영상 강의',
                'class' => '',
                'route' => '',
                'param' => [],
                'url' => 'javascript:void(0)',
                'depth' => [
                    'D1' => [
                        'name' => '부정맥 기초',
                        'class' => '',
                        'route' => '',
                        'param' => [],
                        'url' => 'javascript:void(0)',
                        'depth2' => [
                            'DD1' => [
                                'name' => '부정맥이란',
                                'class' => '',
                                'route' => '',
                                'param' => [],
                                'url' => 'javascript:void(0)',
                            ],

                            'DD2' => [
                                'name' => '부정맥의 종류',
                                'class' => '',
                                'route' => '',
                                'param' => [],
                                'url' => 'javascript:void(0)',
                            ],

                            'DD3' => [
                                'name' => '부정맥 진단방법',
                                'class' => '',
                                'route' => '',
                                'param' => [],
                                'url' => 'javascript:void(0)',
                            ],

                            'DD4' => [
                                'name' => '부정맥 진단방법',
                                'class' => '',
                                'route' => '',
                                'param' => [],
                                'url' => 'javascript:void(0)',
                            ],
                        ],
                    ],

                    'D2' => [
                        'name' => '부정맥 전문가편',
                        'class' => '',
                        'route' => '',
                        'param' => [],
                        'url' => 'javascript:void(0)',
                        'depth2' => [
                            'DD1' => [
                                'name' => '부정맥의 종류',
                                'class' => '',
                                'route' => '',
                                'param' => [],
                                'url' => 'javascript:void(0)',
                            ],

                            'DD2' => [
                                'name' => '부정맥 진단방법',
                                'class' => '',
                                'route' => '',
                                'param' => [],
                                'url' => 'javascript:void(0)',
                            ],

                            'DD3' => [
                                'name' => '부정맥 치료 - 약물치료',
                                'class' => '',
                                'route' => '',
                                'param' => [],
                                'url' => 'javascript:void(0)',
                            ],

                            'DD4' => [
                                'name' => '부정맥 치료 - 전극도자절제술',
                                'class' => '',
                                'route' => '',
                                'param' => [],
                                'url' => 'javascript:void(0)',
                            ],

                            'DD5' => [
                                'name' => '부정맥 치료 - 심장전기장치',
                                'class' => '',
                                'route' => '',
                                'param' => [],
                                'url' => 'javascript:void(0)',
                            ],
                        ],
                    ],

                    'D3' => [
                        'name' => '심전도',
                        'class' => '',
                        'route' => '',
                        'param' => [],
                        'url' => 'javascript:void(0)',
                        'depth2' => [
                            'DD1' => [
                                'name' => '총론',
                                'class' => '',
                                'route' => '',
                                'param' => [],
                                'url' => 'javascript:void(0)',
                            ],

                            'DD2' => [
                                'name' => '서맥',
                                'class' => '',
                                'route' => '',
                                'param' => [],
                                'url' => 'javascript:void(0)',
                            ],

                            'DD3' => [
                                'name' => '빈맥',
                                'class' => '',
                                'route' => '',
                                'param' => [],
                                'url' => 'javascript:void(0)',
                            ],

                            'DD4' => [
                                'name' => '기타',
                                'class' => '',
                                'route' => '',
                                'param' => [],
                                'url' => 'javascript:void(0)',
                            ],

                            'DD5' => [
                                'name' => 'Clinical Case',
                                'class' => '',
                                'route' => '',
                                'param' => [],
                                'url' => 'javascript:void(0)',
                            ],
                        ],
                    ],
                ]
            ],

            'S4' => [
                'name' => '보험정보',
                'class' => '',
                'route' => '',
                'param' => [],
                'url' => 'javascript:void(0)',
                'depth' => [
                    'D1' => [
                        'name' => '보험기준',
                        'class' => '',
                        'route' => '',
                        'param' => [],
                        'url' => 'javascript:void(0)',
                        'depth2' => [
                            'DD1' => [
                                'name' => 'CIED',
                                'class' => '',
                                'route' => '',
                                'param' => [],
                                'url' => 'javascript:void(0)',
                            ],

                            'DD2' => [
                                'name' => '이식형 사건기록기',
                                'class' => '',
                                'route' => '',
                                'param' => [],
                                'url' => 'javascript:void(0)',
                            ],

                            'DD3' => [
                                'name' => 'RFCA & Cryoablation',
                                'class' => '',
                                'route' => '',
                                'param' => [],
                                'url' => 'javascript:void(0)',
                            ],

                            'DD4' => [
                                'name' => 'Device 사전 심의 방법',
                                'class' => '',
                                'route' => '',
                                'param' => [],
                                'url' => 'javascript:void(0)',
                            ],
                        ],
                    ],

                    'D2' => [
                        'name' => '보험심사사례',
                        'class' => '',
                        'route' => '',
                        'param' => [],
                        'url' => 'javascript:void(0)',
                        'depth2' => [
                            'DD1' => [
                                'name' => '고주파 전극도자절제술',
                                'class' => '',
                                'route' => '',
                                'param' => [],
                                'url' => 'javascript:void(0)',
                            ],

                            'DD2' => [
                                'name' => '인공심박동기',
                                'class' => '',
                                'route' => '',
                                'param' => [],
                                'url' => 'javascript:void(0)',
                            ],

                            'DD3' => [
                                'name' => 'ICD/CRT',
                                'class' => '',
                                'route' => '',
                                'param' => [],
                                'url' => 'javascript:void(0)',
                            ],
                        ],
                    ],
                ]
            ],
        ],

        'M2' => [ // 학술행사
            'S1' => [
                'name' => '국내외 학술행사',
                'class' => '',
                'route' => '',
                'param' => [],
                'url' => 'javascript:void(0)',
                'depth' => [
                    'D1' => [
                        'name' => 'KHRS 학술대회',
                        'class' => '',
                        'route' => '',
                        'param' => [],
                        'url' => 'javascript:void(0)',
                    ],

                    'D2' => [
                        'name' => '연관확회 학술대회',
                        'class' => '',
                        'route' => '',
                        'param' => [],
                        'url' => 'javascript:void(0)',
                    ],

                    'D3' => [
                        'name' => '해외 학술대회',
                        'class' => '',
                        'route' => '',
                        'param' => [],
                        'url' => 'javascript:void(0)',
                    ],
                ]
            ],

            'S2' => [
                'name' => '학술행사 자료',
                'class' => '',
                'route' => '',
                'param' => [],
                'url' => 'javascript:void(0)',
                'depth' => [
                    'D1' => [
                        'name' => 'KHRS',
                        'class' => '',
                        'route' => '',
                        'param' => [],
                        'url' => 'javascript:void(0)',
                        'depth2' => [
                            'DD1' => [
                                'name' => 'KHRS scientific session',
                                'class' => '',
                                'route' => '',
                                'param' => [],
                                'url' => 'javascript:void(0)',
                            ],

                            'DD2' => [
                                'name' => 'KHRS 추계학술대회',
                                'class' => '',
                                'route' => '',
                                'param' => [],
                                'url' => 'javascript:void(0)',
                            ],

                            'DD3' => [
                                'name' => 'KHRS live',
                                'class' => '',
                                'route' => '',
                                'param' => [],
                                'url' => 'javascript:void(0)',
                            ],

                            'DD4' => [
                                'name' => 'KHRS complex ECG',
                                'class' => '',
                                'route' => '',
                                'param' => [],
                                'url' => 'javascript:void(0)',
                            ],

                            'DD5' => [
                                'name' => 'Korean interventional EP curriculum',
                                'class' => '',
                                'route' => '',
                                'param' => [],
                                'url' => 'javascript:void(0)',
                            ],

                            'DD6' => [
                                'name' => 'Virtual workshop',
                                'class' => '',
                                'route' => '',
                                'param' => [],
                                'url' => 'javascript:void(0)',
                            ],

                            'DD7' => [
                                'name' => 'CDRC',
                                'class' => '',
                                'route' => '',
                                'param' => [],
                                'url' => 'javascript:void(0)',
                            ],
                        ],
                    ],

                    'D2' => [
                        'name' => 'ERC',
                        'class' => '',
                        'route' => '',
                        'param' => [],
                        'url' => 'javascript:void(0)',
                    ],

                    'D3' => [
                        'name' => '개원의 연수강좌',
                        'class' => '',
                        'route' => '',
                        'param' => [],
                        'url' => 'javascript:void(0)',
                    ],

                    'D4' => [
                        'name' => '부정맥지회',
                        'class' => '',
                        'route' => '',
                        'param' => [],
                        'url' => 'javascript:void(0)',
                        'depth2' => [
                            'DD1' => [
                                'name' => '호남지회',
                                'class' => '',
                                'route' => '',
                                'param' => [],
                                'url' => 'javascript:void(0)',
                            ],

                            'DD2' => [
                                'name' => '부울경지회',
                                'class' => '',
                                'route' => '',
                                'param' => [],
                                'url' => 'javascript:void(0)',
                            ],

                            'DD3' => [
                                'name' => '대경지회',
                                'class' => '',
                                'route' => '',
                                'param' => [],
                                'url' => 'javascript:void(0)',
                            ],
                        ],
                    ],

                    'D5' => [
                        'name' => '부정맥연구회',
                        'class' => '',
                        'route' => '',
                        'param' => [],
                        'url' => 'javascript:void(0)',
                        'depth2' => [
                            'DD1' => [
                                'name' => 'KSHNE (심전도신호연구회)',
                                'class' => '',
                                'route' => '',
                                'param' => [],
                                'url' => 'javascript:void(0)',
                            ],

                            'DD2' => [
                                'name' => 'VT symposium (심실부정맥연구회)',
                                'class' => '',
                                'route' => '',
                                'param' => [],
                                'url' => 'javascript:void(0)',
                            ],

                            'DD3' => [
                                'name' => 'SPRINT (뇌졸중예방중재술연구회)',
                                'class' => '',
                                'route' => '',
                                'param' => [],
                                'url' => 'javascript:void(0)',
                            ],

                            'DD4' => [
                                'name' => '스포츠심장연구회',
                                'class' => '',
                                'route' => '',
                                'param' => [],
                                'url' => 'javascript:void(0)',
                            ],
                        ],
                    ],
                ]
            ],
        ],

        'M3' => [ // 학회지
            'S1' => [
                'name' => '학회지 관련 안내',
                'class' => '',
                'route' => '',
                'param' => [],
                'url' => 'javascript:void(0)',
            ],

            'S2' => [
                'name' => '온라인 논문 투고',
                'class' => '',
                'route' => '',
                'param' => [],
                'url' => 'javascript:void(0)',
            ],

            'S3' => [
                'name' => '논문 투고 규정',
                'class' => '',
                'route' => '',
                'param' => [],
                'url' => 'javascript:void(0)',
                'depth' => [
                    'D1' => [
                        'name' => '목적과개요/윤리규정/원고범위/집필규정/원고형식/원고접수',
                        'class' => '',
                        'route' => '',
                        'param' => [],
                        'url' => 'javascript:void(0)',
                    ],
                ]
            ],

            'S4' => [
                'name' => '편집 윤리',
                'class' => '',
                'route' => '',
                'param' => [],
                'url' => 'javascript:void(0)',
                'depth' => [
                    'D1' => [
                        'name' => '생명윤리/연구윤리/연구출판윤리',
                        'class' => '',
                        'route' => '',
                        'param' => [],
                        'url' => 'javascript:void(0)',
                    ],
                ]
            ],

            'S5' => [
                'name' => '편집위원회 규정',
                'class' => '',
                'route' => '',
                'param' => [],
                'url' => 'javascript:void(0)',
            ],
        ],

        'M4' => [ // 회원공간
            'S1' => [
                'name' => '전문회원 가입안내',
                'class' => '',
                'route' => '',
                'param' => [],
                'url' => 'javascript:void(0)',
            ],

            'S2' => [
                'name' => '공지사항',
                'class' => '',
                'route' => '',
                'param' => [],
                'url' => 'javascript:void(0)',
            ],

            'S3' => [
                'name' => '중재시술전문의 신청',
                'class' => '',
                'route' => '',
                'param' => [],
                'url' => 'javascript:void(0)',
            ],

            'S4' => [
                'name' => '포토갤러리',
                'class' => '',
                'route' => '',
                'param' => [],
                'url' => 'javascript:void(0)',
            ],
        ],

        'M5' => [ // 해외학회신청
            'S1' => [
                'name' => '안내 및 신청',
                'class' => '',
                'route' => '',
                'param' => [],
                'url' => 'javascript:void(0)',
            ],

            'S2' => [
                'name' => '자주하는 질문',
                'class' => '',
                'route' => '',
                'param' => [],
                'url' => 'javascript:void(0)',
            ],
        ],

        'M6' => [ // 연구지원
            'S1' => [
                'name' => '연구지원 프로그램',
                'class' => '',
                'route' => '',
                'param' => [],
                'url' => 'javascript:void(0)',
            ],

            'S2' => [
                'name' => '연구비 신청',
                'class' => '',
                'route' => '',
                'param' => [],
                'url' => 'javascript:void(0)',
                'depth' => [
                    'D1' => [
                        'name' => '안내 및 신청',
                        'class' => '',
                        'route' => '',
                        'param' => [],
                        'url' => 'javascript:void(0)',
                    ],

                    'D2' => [
                        'name' => '자주하는 질문',
                        'class' => '',
                        'route' => '',
                        'param' => [],
                        'url' => 'javascript:void(0)',
                    ],
                ]
            ],

            'S3' => [
                'name' => '현황 및 결과',
                'class' => '',
                'route' => '',
                'param' => [],
                'url' => 'javascript:void(0)',
            ],
        ],

        'M7' => [ // 학회 소개
            'S1' => [
                'name' => '인사말',
                'class' => '',
                'route' => '',
                'param' => [],
                'url' => 'javascript:void(0)',
            ],

            'S2' => [
                'name' => '미션/비젼',
                'class' => '',
                'route' => '',
                'param' => [],
                'url' => 'javascript:void(0)',
            ],

            'S3' => [
                'name' => '임원진/위원회',
                'class' => '',
                'route' => '',
                'param' => [],
                'url' => 'javascript:void(0)',
                'depth' => [
                    'D1' => [
                        'name' => '인원진 및 위원회(위원회 명단 추가)',
                        'class' => '',
                        'route' => '',
                        'param' => [],
                        'url' => 'javascript:void(0)',
                    ],

                    'D2' => [
                        'name' => '역대임원',
                        'class' => '',
                        'route' => '',
                        'param' => [],
                        'url' => 'javascript:void(0)',
                    ],
                ]
            ],

            'S4' => [
                'name' => '사무국 안내',
                'class' => '',
                'route' => '',
                'param' => [],
                'url' => 'javascript:void(0)',
            ],

            'S5' => [
                'name' => 'KHRS 로고',
                'class' => '',
                'route' => '',
                'param' => [],
                'url' => 'javascript:void(0)',
            ],

            'S6' => [
                'name' => '연구회',
                'class' => '',
                'route' => '',
                'param' => [],
                'url' => 'javascript:void(0)',
            ],

            'S7' => [
                'name' => '지회',
                'class' => '',
                'route' => '',
                'param' => [],
                'url' => 'javascript:void(0)',
            ],
        ],
    ],
];