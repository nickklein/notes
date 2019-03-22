<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Notes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('notes', function (Blueprint $table) {
            $table->bigIncrements('note_id');
            $table->string('note_title', 255);
            $table->text('content');
            $table->smallInteger('user_id')->unsigned();
            $table->tinyInteger('order')->unsigned()->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
       Schema::dropIfExists('notes');
    }
}
