<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NotesSettingsRel extends Model
{
    //
    protected $table = 'notes_settings';
    protected $primaryKey = 'nsetting_id';
    public $timestamps = false;
}
