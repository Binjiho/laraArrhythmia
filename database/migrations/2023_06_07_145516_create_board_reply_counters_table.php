<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBoardReplyCountersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('board_reply_counters', function (Blueprint $table) {
            $table->id('sid');
            $table->bigInteger('br_sid')->index()->unsigned()->default(0)->comment('board_replies.sid)');
            $table->string('ip')->comment('접속 ip');
            $table->timestamps();
        });

        \Illuminate\Support\Facades\DB::statement("ALTER TABLE board_counters comment '게시판 답글 카운터'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('board_reply_counters');
    }
}
