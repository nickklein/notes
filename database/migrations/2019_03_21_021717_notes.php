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
            $table->string('note_title', 255)->nullable();
            $table->string('note_caption', 500)->nullable();
            $table->text('note_content')->nullable();
            $table->tinyInteger('published')->unsigned()->default(0);
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
        //
       Schema::dropIfExists('notes');
    }
}
