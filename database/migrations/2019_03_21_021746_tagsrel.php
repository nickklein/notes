<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Tagsrel extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('tags_rel', function (Blueprint $table) {
            $table->bigIncrements('tagrel_id');
            $table->mediumInteger('tag_id')->unsigned();
            $table->mediumInteger('note_id')->unsigned();
            $table->smallInteger('user_id')->unsigned();
            $table->unique('tag_id', 'user_id');
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
       Schema::dropIfExists('tags_rel');
    }
}
