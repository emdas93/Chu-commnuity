<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBoardContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('board_contents', function (Blueprint $table) {
            $table->increments('b_no');
            $table->string('b_title');
            $table->string('b_content', 3000);
            $table->string('b_writer');
            $table->string('b_owner');
            $table->string('b_fileURL');
            $table->string('board_no');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('board_contents');
    }
}
