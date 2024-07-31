<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

// main
Route::controller(\App\Http\Controllers\Admin\Main\MainController::class)->group(function() {
    Route::get('/', 'main')->name('main');
    Route::post('data', 'data')->name('main.data');

    Route::match(['get', 'post'],'logout', 'logout')->name('logout');
});

// 회원관리
Route::controller(\App\Http\Controllers\Admin\Member\MemberController::class)->prefix('member')->group(function() {
    Route::get('/', 'index')->name('member');
    Route::get('/withdrawal', 'withdrawal')->name('member.withdrawal');
    Route::get('/excel', 'excel')->name('member.excel');
    Route::get('/withdrawal/excel', 'withdrawalExcel')->name('member.withdrawal.excel');

    Route::get('/modify', 'modify')->name('member.modify');

    Route::post('data', 'data')->name('member.data');
});

// 회비관리
Route::controller(\App\Http\Controllers\Admin\Fee\FeeController::class)->prefix('fee')->group(function() {
    Route::get('/', 'index')->name('fee');
    Route::get('/register', 'register')->name('fee.register');

    Route::get('/excel', 'excel')->name('fee.excel');

    Route::post('data', 'data')->name('fee.data');
});

//학술대회
Route::prefix('conference')->group(function() {
    Route::controller(\App\Http\Controllers\Admin\Conference\ConferenceController::class)->group(function() {
        Route::get('/', 'index')->name('conference');
        Route::get('modify/{sid}', 'modify')->name('conference.modify');
        Route::post('data', 'data')->name('conference.data');
    });

    // 사전등록
    Route::controller(\App\Http\Controllers\Admin\Conference\RegistrationController::class)->prefix('registration/{csid}')->group(function() {
        Route::get('/', 'index')->name('conference.registration');
        Route::get('withdrawal', 'withdrawal')->name('conference.registration.withdrawal');
        Route::get('modify/{sid}', 'modify')->name('conference.registration.modify');

        Route::get('/excel', 'excel')->name('conference.registration.excel');
        Route::post('data', 'data')->name('conference.registration.data');
    });

    // 초록
    Route::controller(\App\Http\Controllers\Admin\Conference\AbstractController::class)->prefix('abstract/{csid}')->group(function() {
        Route::get('/', 'index')->name('conference.abstract');
        Route::get('withdrawal', 'withdrawal')->name('conference.abstract.withdrawal');
        Route::get('modify/{sid}', 'modify')->name('conference.abstract.modify');

        Route::get('/excel', 'excel')->name('conference.abstract.excel');
        Route::post('data', 'data')->name('conference.abstract.data');
    });
});


//해외학회
Route::controller(\App\Http\Controllers\Admin\Overseas\OverseasController::class)->prefix('overseas')->group(function() {
    Route::get('/', 'index')->name('overseas');
    Route::get('/register', 'register')->name('overseas.register');


        //신청자 추가 등록
        Route::get('/direct', 'direct')->name('direct.overseas.register');


    Route::prefix('detail/{csid}')->group(function () {
        Route::get('/', 'detail')->name('overseas.detail');


        Route::get('/register', 'detail_register')->name('overseas.detail.register');
        Route::get('/modify/{sid}', 'detail_modify')->name('overseas.detail.modify');
        Route::get('/preview/{sid}', 'detail_preview')->name('overseas.detail.preview');
        Route::get('/result_preview/{sid}', 'detail_result_preview')->name('overseas.detail.result.preview');
        Route::get('memo', 'memo')->name('overseas.detail.memo');

        //지원협회 심사
        Route::get('assist', 'assist')->name('overseas.detail.assist');
        Route::get('assist_group', 'assist_group')->name('overseas.detail.assist_group');

        //메일발송
        Route::get('mail', 'mail')->name('overseas.detail.mail');
    });

    Route::get('/excel', 'excel')->name('overseas.excel');

    Route::post('data', 'data')->name('overseas.data');
});

//연구지원
Route::controller(\App\Http\Controllers\Admin\Research\ResearchController::class)->prefix('research')->group(function() {
    Route::get('/', 'index')->name('research');
    Route::get('register', 'register')->name('research.register');
    Route::get('preview', 'preview')->name('research.reviewer.preview');
    Route::get('/register/{research}/reviewer', 'register_reviewer')->name('research.reviewer.register');

    Route::get('/excel', 'excel')->name('research.excel');
    Route::post('data', 'data')->name('research.data');
});

//연구지원심사자
//Route::controller(\App\Http\Controllers\Admin\Research\ResearchReviewerController::class)->prefix('research_reviewer')->group(function() {
//    Route::get('/', 'index')->name('research_reviewer'); //연구지원 - 심사자 리스트
//    Route::get('/register', 'register')->name('research_reviewer.register'); //연구지원 - 심사자 등록
//
//    Route::post('data', 'data')->name('research_reviewer.data');
//});

//심사자
Route::controller(\App\Http\Controllers\Admin\Reviewer\ReviewerController::class)->prefix('reviewer/{code}')->group(function() {
    Route::get('/', 'index')->name('reviewer');
    Route::get('view/{sid}', 'view')->name('reviewer.view');
    Route::get('upsert', 'upsert')->name('reviewer.upsert');

    Route::get('/excel', 'excel')->name('reviewer.excel');

    Route::post('data', 'data')->name('reviewer.data');
});


//중재시술
Route::controller(\App\Http\Controllers\Admin\Surgery\SurgeryController::class)->prefix('surgery')->group(function() {
    Route::get('/', 'index')->name('surgery');
    Route::get('/register', 'register')->name('surgery.register');

    Route::get('/modify/{sid}', 'modify')->name('surgery.modify');
//    Route::get('/career/register', 'career_register')->name('surgery.career.register');
//    Route::get('/case/register', 'case_register')->name('surgery.case.register');

    Route::get('/register/reviewer', 'register_reviewer')->name('surgery.reviewer.register');
    Route::get('result', 'result')->name('surgery.result.preview');

    Route::get('/collective', 'collective')->name('surgery.collective');

     Route::get('/excel', 'excel')->name('surgery.excel');
    Route::post('data', 'data')->name('surgery.data');
});

// 연구회/지회
Route::controller(\App\Http\Controllers\Admin\Group\GroupController::class)->prefix('group')->group(function() {
    Route::get('/', 'index')->name('group');
    Route::get('/upsert/{sid?}', 'upsert')->name('group.upsert');
    Route::post('data', 'data')->name('group.data');

    Route::controller(\App\Http\Controllers\Admin\Group\GroupMemberController::class)->prefix('{g_sid}/member')->group(function() {
        Route::get('/', 'index')->name('group.member');
        Route::get('/upsert/{sid?}', 'upsert')->name('group.member.upsert');
        Route::get('/collective', 'collective')->name('group.member.collective');
        Route::post('data', 'data')->name('group.member.data');
    });
});

// 메일관리
Route::prefix('mail')->group(function() {
    Route::controller(\App\Http\Controllers\Admin\Mail\MailController::class)->group(function() {
        Route::get('/', 'index')->name("mail");
        Route::get('/detail/{ml_sid}', 'detail')->name("mail.detail");
        Route::get('/detail/excel/{ml_sid}', 'detailExcel')->name("mail.detail.excel");

        Route::get('/popup/edit', 'edit')->name("mail.edit");
        Route::get('/popup/preview/{sid}', 'preview')->name("mail.preview");
        Route::get('/popup/resend', 'resend')->name("mail.resend");
        Route::post('data', 'data')->name("mail.data");
    });

    // 주소록관리
    Route::prefix('address')->group(function() {
        Route::controller(\App\Http\Controllers\Admin\Mail\MailAddressController::class)->group(function() {
            Route::get('/', 'address')->name("mail.address");
            Route::get('/popup/edit', 'edit')->name("mail.address.edit");
            Route::post('data', 'data')->name("mail.address.data");
        });

        Route::controller(\App\Http\Controllers\Admin\Mail\MailAddressListController::class)->prefix('list')->group(function() {
            Route::get('/{ma_sid}', 'list')->name("mail.address.list");
            Route::get('/popup/{type}-upload/{ma_sid}', 'upload')->where('type', 'individual|collective')->name("mail.address.list.upload");
            Route::post('{ma_sid}/data', 'data')->name("mail.address.list.data");
        });
    });

});


// 접속통계
Route::controller(\App\Http\Controllers\Admin\Status\StatusController::class)->prefix('status')->group(function() {
    Route::get('/stat', 'stat')->name("status.stat");
    Route::get('/referer', 'referer')->name("status.referer");
});

require __DIR__ . '/common.php';
