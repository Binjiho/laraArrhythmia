<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/
Route::prefix('/')->group(function () {
    Route::middleware('session.check')->controller(\App\Http\Controllers\Main\MainController::class)->group(function() {
        //인트로 페이지
        Route::get('/', 'index')->name('intro');

        //전문가 홈페이지
        Route::get('/main', 'main')->name('main');
        Route::post('data', 'data')->name('main.data');

        //일반인 홈페이지
        Route::get('/general', 'general')->name('general');

        //영문 홈페이지
        Route::get('/eng', 'eng')->name('eng');

        //전문기술인 홈페이지
        Route::get('/pro', 'pro')->name('pro');
    });

    /*
    |--------------------------------------------------------------------------
    | 전문가 자료실
    |--------------------------------------------------------------------------
    */
    Route::prefix('expert')->group(function () {

        //부정맥 진료지침
        Route::controller(\App\Http\Controllers\Guide\GuideController::class)->prefix('/guide')->group(function() {
            Route::get('atrial', 'atrial')->name('guide.atrial');
            Route::get('ventricular', 'ventricular')->name('guide.ventricular');
            Route::get('sudden', 'sudden')->name('guide.sudden');
            Route::get('sangseong', 'sangseong')->name('guide.sangseong');
            Route::get('cied', 'cied')->name('guide.cied');
            Route::get('faint', 'faint')->name('guide.faint');
        });

        //팩트시트
        Route::controller(\App\Http\Controllers\Fact\FactController::class)->prefix('/fact')->group(function() {
            Route::get('part1', 'part1')->name('fact.part1');
            Route::get('part2', 'part2')->name('fact.part2');
            Route::get('part3', 'part3')->name('fact.part3');
        });
    });


    /*
    |--------------------------------------------------------------------------
    | 전문가 자료실 - 보험정보
    |--------------------------------------------------------------------------
    */
    Route::prefix('insure')->group(function () {
        Route::controller(\App\Http\Controllers\Insure\InsureController::class)->group(function () {
            Route::get('standard', 'standard')->name('insure.standard');
            Route::get('s2', 's2')->name('insure.s2');
            Route::get('s3', 's3')->name('insure.s3');
            Route::get('s4', 's4')->name('insure.s4');
        });
    });

    /*
    |--------------------------------------------------------------------------
    | 학술행사
    |--------------------------------------------------------------------------
    */
    Route::prefix('conference')->group(function () {
        Route::controller(\App\Http\Controllers\Conference\ConferenceController::class)->group(function () {
            Route::get('/', 'index')->name('conference');
            Route::get('upsert', 'upsert')->name('conference.upsert');
            Route::get('view', 'view')->name('conference.view');
            Route::get('detail', 'detail')->name('conference.detail');

            Route::prefix('registration')->group(function () {
                Route::get('upsert', 'registration_upsert')->name('conference.registration.upsert');
                Route::get('preview', 'registration_preview')->name('conference.registration.preview');
                Route::get('complete', 'registration_complete')->name('conference.registration.complete');
            });
            Route::prefix('abstract')->group(function () {
                Route::get('upsert', 'abstract_upsert')->name('conference.abstract.upsert');
                Route::get('preview', 'abstract_preview')->name('conference.abstract.preview');
                Route::get('complete', 'abstract_complete')->name('conference.abstract.complete');
            });
            Route::get('confirm', 'confirm')->name('conference.confirm');


            Route::post('data', 'data')->name('conference.data');
        });
    });

    /*
    |--------------------------------------------------------------------------
    | 학회지
    |--------------------------------------------------------------------------
    */
    Route::prefix('academy')->group(function () {
        Route::controller(\App\Http\Controllers\Academy\AcademyController::class)->group(function () {
            Route::get('/', 'index')->name('academy');
            Route::get('paperSubmission', 'paperSubmission')->name('academy.paperSubmission');
            Route::get('paperRule', 'paperRule')->name('academy.paperRule');
            Route::get('editSubmission', 'editSubmission')->name('academy.editSubmission');
            Route::get('editRule', 'editRule')->name('academy.editRule');
        });
    });

    /*
    |--------------------------------------------------------------------------
    | 중재시술인증 - 회원공간
    |--------------------------------------------------------------------------
    */
    Route::prefix('surgery')->group(function () {
        Route::controller(\App\Http\Controllers\Surgery\SurgeryController::class)->group(function () {
            Route::get('/', 'info')->name('surgery');
            Route::get('guide', 'guide')->name('surgery.guide');
            Route::middleware('auth.check')->group(function() {
                Route::get('register', 'register')->name('surgery.register');
//                Route::get('/career/register', 'career_register')->name('surgery.career.register');
//                Route::get('/case/register', 'case_register')->name('surgery.case.register');

                Route::get('judge', 'judge')->name('surgery.judge');
            });

            Route::post('data', 'data')->name('surgery.data');
        });
    });

    /*
    |--------------------------------------------------------------------------
    | 해외학회
    |--------------------------------------------------------------------------
    */
    Route::prefix('overseas')->group(function () {
        Route::controller(\App\Http\Controllers\Overseas\OverseasController::class)->group(function () {
            Route::get('info', 'info')->name('overseas.info');
            Route::get('list', 'list')->name('overseas.list');
            Route::middleware('auth.check')->group(function() {
                Route::get('register', 'register')->name('overseas.register');
                Route::get('preview', 'preview')->name('overseas.preview');
                Route::get('complete', 'complete')->name('overseas.complete');
            });
            Route::post('data', 'data')->name('overseas.data');
        });
    });

    /*
    |--------------------------------------------------------------------------
    | 연구지원
    |--------------------------------------------------------------------------
    */
    Route::prefix('research')->group(function () {
        Route::controller(\App\Http\Controllers\Research\ResearchController::class)->group(function () {
//            Route::get('/', 'index')->name('introduce');
            Route::get('program', 'program')->name('research.program');
            Route::get('info', 'info')->name('research.info');
            Route::get('result', 'result')->name('research.result');
            Route::middleware('auth.check')->group(function() {
                Route::get('register', 'register')->name('research.register');
                Route::get('report', 'report')->name('research.report');
                Route::get('preview', 'preview')->name('research.preview');
            });
            Route::post('data', 'data')->name('research.data');
        });
    });

    /*
    |--------------------------------------------------------------------------
    | 대한부정맥학회
    |--------------------------------------------------------------------------
    */
    Route::prefix('introduce')->group(function () {
        Route::controller(\App\Http\Controllers\Introduce\IntroduceController::class)->group(function () {
            Route::get('/', 'index')->name('introduce');
            Route::get('vision', 'vision')->name('introduce.vision');
            Route::get('committee', 'committee')->name('introduce.committee');
            Route::get('info', 'info')->name('introduce.info');
            Route::get('logo', 'logo')->name('introduce.logo');
        });

        /*
        |--------------------------------------------------------------------------
        | 연구회/지회
        |--------------------------------------------------------------------------
        */
        Route::controller(\App\Http\Controllers\Introduce\Group\GroupControllr::class)->prefix('group')->group(function () {
            Route::get('list', 'list')->name('introduce.group.list');
            Route::get('branch', 'branch')->name('introduce.group.branch');
            Route::get('guide', 'guide')->name('introduce.group.guide');
            Route::get('join', 'join')->name('introduce.group.join');
            Route::get('detail/{sid}', 'detail')->name('introduce.group.detail');
            Route::get('upsert/{sid?}', 'upsert')->name('introduce.group.upsert');


            //연구회/지회 학술행사
            Route::get('conference/upsert/{sid?}', 'conference_upsert')->name('introduce.group.conference.upsert');
            Route::get('conference/view/{sid?}', 'conference_view')->name('introduce.group.conference.view');

            Route::post('data', 'data')->name('introduce.group.data');
        });
    });
    
    /*
    |--------------------------------------------------------------------------
    | 회원 메뉴
    |--------------------------------------------------------------------------
    */
    Route::prefix('auth')->group(function () {
        Route::controller(\App\Http\Controllers\Auth\AuthController::class)->group(function () {
            Route::middleware('guest:web')->group(function() {
                Route::get('info','info')->name('auth.info');
                Route::get('forgot', 'forgot')->name('forgot');
                Route::get('forgot_pw', 'forgot_pw')->name('forgot_pw');
                Route::match(['get', 'post'], 'login', 'login')->name("login");
                Route::match(['get', 'post'], '/register/{step}', 'register')->where('step', 'step1|step2|step3')->name('register');
            });

            Route::middleware('auth.check')->group(function() {
                Route::match(['get', 'post'],'logout', 'logout')->name('logout');

                // 마이페이지
                Route::controller(\App\Http\Controllers\Auth\MypageController::class)->prefix('/mypage')->group(function() {
                    Route::get('/', 'intro')->name('mypage.intro');
                    Route::match(['get', 'post'],'confirm', 'confirm')->name('mypage.confirm');
                    Route::get('modify', 'modify')->name('mypage.modify');
                    Route::match(['get', 'post'],'confirmPw', 'confirmPw')->name('mypage.confirmPw');
                    //비밀번호변경
                    Route::get('changePw', 'changePw')->name('mypage.changePw');
                    //회비납부
                    Route::get('fee', 'fee')->name('mypage.fee');
                    Route::get('feePopup', 'feePopup')->name('mypage.feePopup');
                    //학술행사
                    Route::get('conference', 'conference')->name('mypage.conference');
                    Route::get('overseas', 'overseas')->name('mypage.overseas');
                    Route::get('overseas_report', 'overseas_report')->name('mypage.overseas_report');
                    Route::get('overseas_preview', 'overseas_preview')->name('mypage.overseas_preview');
                    Route::get('overseas_complete', 'overseas_complete')->name('mypage.overseas_complete');
                    //연구회/지회
                    Route::get('group', 'myGroup')->name('mypage.group');
                    //연구지원
                    Route::get('research', 'myResearch')->name('mypage.research');
                    Route::get('researchReviewRegist', 'researchReviewRegist')->name('mypage.research.reviewer.regist');
                    //중재시술인증
                    Route::get('surgery', 'mySurgery')->name('mypage.surgery');
                    Route::get('withdrawal', 'withdrawal')->name('mypage.withdrawal');
                    //data
                    Route::post('data', 'data')->name('mypage.data');
                });
            });

            Route::get('privacy', 'privacy')->name('auth.privacy');
            Route::get('email', 'email')->name('auth.email');
            Route::post('data', 'data')->name('auth.data');

            //Route::middleware('guest:web')->match(['get', 'post'], 'special/auth/login', 'login')->name("login.special");
        });
    });
});


/*
|--------------------------------------------------------------------------
| General Routes
|--------------------------------------------------------------------------
*/
Route::prefix('/general')->group(function () {

    /*
    |--------------------------------------------------------------------------
    | 부정맥 상식
    |--------------------------------------------------------------------------
    */
    Route::controller(\App\Http\Controllers\General\Know\KnowController::class)->prefix('know')->group(function() {
        Route::get('/', 'index')->name('general.know');
        Route::get('/kind', 'kind')->name('general.know.kind');
        Route::get('/diagnosis', 'diagnosis')->name('general.know.diagnosis');
        Route::get('/therapy', 'therapy')->name('general.know.therapy');
    });

    /*
    |--------------------------------------------------------------------------
    | 부정맥 전문가 찾기
    |--------------------------------------------------------------------------
    */
    Route::controller(\App\Http\Controllers\General\Search\SearchController::class)->prefix('search')->group(function() {
        Route::get('/', 'index')->name('general.search');

        Route::post('data', 'data')->name('general.search.data');
    });

    /*
    |--------------------------------------------------------------------------
    | 하트 리듬의날 캠패인
    |--------------------------------------------------------------------------
    */
    Route::controller(\App\Http\Controllers\General\Heart\HeartController::class)->prefix('heart')->group(function() {
        Route::get('/', 'index')->name('general.heart');

    });

    /*
    |--------------------------------------------------------------------------
    | 대한부정맥학회(일반인)
    |--------------------------------------------------------------------------
    */
    Route::controller(\App\Http\Controllers\General\Info\InfoController::class)->prefix('info')->group(function() {
        Route::get('/greeting', 'greeting')->name('general.info.greeting');
        Route::get('/mission', 'mission')->name('general.info.mission');
        Route::get('/contact', 'contact')->name('general.info.contact');
        Route::get('/committee', 'committee')->name('general.info.committee');

    });
});

/*
|--------------------------------------------------------------------------
| Eng Routes
|--------------------------------------------------------------------------
*/
Route::prefix('/eng')->group(function () {

    /*
    |--------------------------------------------------------------------------
    | About KHRS
    |--------------------------------------------------------------------------
    */
    Route::controller(\App\Http\Controllers\Eng\About\AboutController::class)->prefix('about')->group(function() {
        Route::get('/', 'index')->name('eng.about');
        Route::get('/history', 'history')->name('eng.about.history');
        Route::get('/committees', 'committees')->name('eng.about.committees');
        Route::get('/info', 'info')->name('eng.about.info');
    });

    /*
    |--------------------------------------------------------------------------
    | KHRS Journal
    |--------------------------------------------------------------------------
    */
    Route::controller(\App\Http\Controllers\Eng\Journal\JournalController::class)->prefix('journal')->group(function() {
        Route::get('/', 'index')->name('eng.journal');
        Route::get('/submission', 'submission')->name('eng.journal.submission');
        Route::get('/instruction', 'instruction')->name('eng.journal.instruction');
    });

});

/*
|--------------------------------------------------------------------------
| Pro Routes
|--------------------------------------------------------------------------
*/
Route::prefix('/pro')->group(function () {
    /*
    |--------------------------------------------------------------------------
    | 소개
    |--------------------------------------------------------------------------
    */
    Route::controller(\App\Http\Controllers\Pro\About\AboutController::class)->prefix('about')->group(function() {
        Route::get('/', 'index')->name('pro.greeting');
        Route::get('/history', 'history')->name('pro.history');
        Route::get('/committee', 'committee')->name('pro.committee');
        Route::get('/register', 'register')->name('pro.register');
        Route::get('/mission', 'mission')->name('pro.mission');
        Route::get('/guide', 'guide')->name('pro.guide');
    });
    /*
    |--------------------------------------------------------------------------
    | 마이페이지
    |--------------------------------------------------------------------------
    */
    Route::controller(\App\Http\Controllers\Pro\Auth\MypageController::class)->prefix('mypage')->group(function() {
        Route::get('/', 'index')->name('pro.mypage');
    });
});

require __DIR__ . '/common.php';
