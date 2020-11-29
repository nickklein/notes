<?php

namespace notes\Models;

use Illuminate\Database\Eloquent\Model;

class Tags extends Model
{
    //
    protected $table = 'tags';
    protected $primaryKey = 'tag_id';
    public $timestamps = false;

    public function scopefindTag($query, $tagName) {
    	return $query->where('tag_name', '=', $tagName);
    }
}
