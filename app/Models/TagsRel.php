<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TagsRel extends Model
{
    //
    protected $table = 'tags_rel';
    protected $primaryKey = 'tagrel_id';
    public $timestamps = false;
}
