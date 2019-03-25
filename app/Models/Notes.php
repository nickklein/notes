<?php

namespace notes\Models;

use Illuminate\Database\Eloquent\Model;

class Notes extends Model
{
    //
    protected $table = 'notes';
    protected $primaryKey = 'note_id';
    public $timestamps = false;
}
