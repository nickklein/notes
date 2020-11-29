<?php

namespace notes\Models;

use Illuminate\Database\Eloquent\Model;

class NotesSettings extends Model
{
    //
    protected $table = 'notes_settings';
    protected $primaryKey = 'nsetting_id';
    public $timestamps = false;
}
