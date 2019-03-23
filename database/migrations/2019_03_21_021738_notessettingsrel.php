<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Notessettingsrel extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('notes_settings_rel', function (Blueprint $table) {
            $table->bigIncrements('nsettingrel_id');
            $table->mediumInteger('nsetting_id')->unsigned();
            $table->bigInteger('note_id')->unsigned();
            $table->unique('nsetting_id', 'note_id');
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
        Schema::dropIfExists('notes_settings_rel');
    }
}
