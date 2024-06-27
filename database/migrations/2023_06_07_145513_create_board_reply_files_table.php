<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBoardReplyFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('board_reply_files', function (Blueprint $table) {
            $table->id('sid');
            $table->bigInteger('br_sid')->unsigned()->index()->comment('board_replies.sid');
            $table->bigInteger('u_sid')->index()->unsigned()->default(0)->comment('작성자');
            $table->string('file_path')->comment('파일경로');
            $table->string('file_name')->comment('원본 파일명');
            $table->integer('download')->unsigned()->default(0)->comment('다운로드 수');
            $table->timestamps();
        });

        \Illuminate\Support\Facades\DB::statement("ALTER TABLE board_files comment '게시판 답글에 첨부파일'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('board_reply_files');
    }
}
