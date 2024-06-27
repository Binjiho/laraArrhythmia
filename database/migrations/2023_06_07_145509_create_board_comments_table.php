<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBoardCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('board_comments', function (Blueprint $table) {
            $table->id('sid');
            $table->bigInteger('b_sid')->index()->unsigned()->comment('boards.sid');
            $table->bigInteger('u_sid')->index()->unsigned()->default(0)->comment('작성자');
            $table->string('writer')->comment('작성자');
            $table->longText('comment')->comment('댓글 내용');
            $table->timestamps();
        });

        \Illuminate\Support\Facades\DB::statement("ALTER TABLE board_comments comment '게시판 댓글'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('board_comments');
    }
}
