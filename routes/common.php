<?php

/*
|--------------------------------------------------------------------------
| Common Routes
|--------------------------------------------------------------------------
*/

Route::controller(\App\Http\Controllers\Controller::class)->prefix('common')->group(function () {

    /*
     * File Download URL
     * type => only: 단일, zip: 일괄다운(zip)
     * tbl => 테이블
     * sid => sid 값 enCryptString(sid) 로 암호화해서 전송
     */
    Route::get('fileDownload/{type}/{tbl}/{sid}', 'fileDownload')->where('type', 'only|zip')->name("download");
    Route::get('staticDownload', 'staticDownload')->name("staticDownload");
    Route::post('/tinyUpload', 'tinyUpload')->name("tinyUpload");
    Route::post('/plUpload', 'plUpload')->name("plUpload");
    Route::match(['get','post'],'refresh_captcha', 'refresh_captcha')->name("refresh_captcha");
    Route::post('check_captcha', 'check_captcha')->name("check_captcha");
});

/*
|--------------------------------------------------------------------------
| Borad Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['board.check','session.check'])->controller(\App\Http\Controllers\Board\BoardController::class)->prefix('board/{code}')->group(function() {
    Route::get('/', 'index')->name('board');
    Route::get('view/{sid}', 'view')->name('board.view');
    Route::get('upsert', 'upsert')->name('board.upsert');

    Route::get('reply/upsert', 'replyUpsert')->name('board.reply.upsert');
    Route::get('reply/view', 'replyView')->name('board.reply.view');
    Route::post('data', 'data')->name('board.data');
});

/*
|--------------------------------------------------------------------------
| Fallback Routes
|--------------------------------------------------------------------------
*/
Route::fallback(\App\Http\Controllers\FallbackController::class);

/*
|--------------------------------------------------------------------------
| test Routes
|--------------------------------------------------------------------------
*/
Route::prefix('test')->group(function () {
    Route::get('/{view_name}', function ($view_name=null) {
        return view('test.'.$view_name,['main_menu'=>'main']);
//      http://k-hrs.m2comm.co.kr/test/reference
    });
});

/*
|--------------------------------------------------------------------------
| kspay
|--------------------------------------------------------------------------
*/
Route::controller(\App\Http\Controllers\Kspay\KspayController::class)->prefix('kspay')->group(function() {
    Route::post('module', 'module')->name('kspay.module');
    Route::post('rcv', 'rcv')->name('kspay.rcv');
    Route::post('result', 'result')->name('kspay.result');
});

/*
|--------------------------------------------------------------------------
| DB 이관용
|--------------------------------------------------------------------------
*/
Route::get('/dbTransfer', [\App\Http\Controllers\DBTransferController::class, 'dbTransfer']);
Route::match(['get', 'post'], '/fileTransfer', [\App\Http\Controllers\DBTransferController::class, 'fileTransfer']);
