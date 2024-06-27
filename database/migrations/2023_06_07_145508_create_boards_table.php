<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBoardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('boards', function (Blueprint $table) {
            $table->id('sid');
            $table->string('code')->index()->comment('게시판 구분 값');
            $table->bigInteger('u_sid')->index()->unsigned()->default(0)->comment('작성자');
            $table->string('password')->nullable()->comment('비밀글일경우 비밀번호');
            $table->longText('category')->nullable()->comment('게시판 카테고리');
            $table->longText('category2')->nullable()->comment('게시판 카테고리2');
            $table->string('subject')->comment('제목');
            $table->longText('contents')->nullable()->comment('내용');
            $table->string('link_url')->nullable()->comment('링크 url');
            $table->string('notice_sDate')->nullable()->comment('공지 시작일');
            $table->string('notice_eDate')->nullable()->comment('공지 종료일');
            $table->enum('date_type', ['D', 'L'])->default('D')->comment('기간 타입 D: 하루, L: 기간');
            $table->string('event_sDate')->nullable()->comment('행사 시작일');
            $table->string('event_eDate')->nullable()->comment('행사 종료일');
            $table->string('place')->nullable()->comment('장소');
            $table->string('file_path')->nullable()->comment('단일 파일업로드시 파일경로');
            $table->string('file_name')->nullable()->comment('단일 파일업로드시 파일명');
            $table->integer('download')->unsigned()->default(0)->comment('단일 파일 다운로드 수');
            $table->enum('notice', ['Y', 'N'])->default('N')->comment('공지 설정');
            $table->enum('popup', ['Y', 'N'])->default('N')->comment('팝업 설정');
            $table->enum('main', ['Y', 'N'])->default('Y')->comment('메인 설정');
            $table->enum('hide', ['Y', 'N'])->default('N')->comment('숨김 설정');
            $table->enum('secret', ['Y', 'N'])->default('N')->comment('비밀글 설정');
            $table->integer('ref')->unsigned()->default(0)->comment('조회수');
            $table->timestamps();
        });

        \Illuminate\Support\Facades\DB::statement("ALTER TABLE boards comment '게시판 테이블'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('boards');
    }
}
