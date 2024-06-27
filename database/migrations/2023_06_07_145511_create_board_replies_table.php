<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBoardRepliesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('board_replies', function (Blueprint $table) {
            $table->id('sid');
            $table->bigInteger('b_sid')->unsigned()->index()->comment('board.sid');
            $table->bigInteger('u_sid')->index()->unsigned()->default(0)->comment('작성자');
            $table->string('subject')->comment('제목');
            $table->longText('contents')->nullable()->comment('내용');
            $table->string('file_path')->nullable()->comment('단일 파일업로드시 파일경로');
            $table->string('file_name')->nullable()->comment('단일 파일업로드시 파일명');
            $table->integer('download')->unsigned()->default(0)->comment('단일 파일 다운로드 수');
            $table->integer('ref')->unsigned()->default(0)->comment('조회수');
            $table->timestamps();
        });

        \Illuminate\Support\Facades\DB::statement("ALTER TABLE board_replies comment '게시판 답글'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('board_replies');
    }
}
