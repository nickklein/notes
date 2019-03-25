<?php

namespace notes\Models;

use Illuminate\Database\Eloquent\Model;

class NotesSettingsRel extends Model
{
    //
    protected $table = 'notes_settings_rel';
    protected $primaryKey = 'nsettingrel_id';
    public $timestamps = false;
}
