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
    // ================= admin =================
    'admin' => [
        'main_menu' => [
            'M1' => [
                'name' => '회원관리',
            ],

            'M2' => [
                'name' => '회비관리',
            ],

            'M3' => [
                'name' => '학술대회 관리',
            ],

            'M4' => [
                'name' => '해외학회 관리',
            ],

            'M5' => [
                'name' => '연구지원 관리',
            ],

            'M6' => [
                'name' => '중재시술인증 관리',
            ],

            'M7' => [
                'name' => '연구회 / 지회 관리',
            ],

            'M8' => [
                'name' => '메일관리',
            ],
        ],

        'sub_menu' => [
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

];