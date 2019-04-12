<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class NotesRel extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('notes_rel', function (Blueprint $table) {
            $table->bigIncrements('note_rel_id');
            $table->bigInteger('note_id')->unsigned();
            $table->smallInteger('user_id')->unsigned();
            $table->string('permission', 50)->default('none');
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
        Schema::dropIfExists('notes_rel');
    }
}
