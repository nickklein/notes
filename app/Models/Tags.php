<?php

namespace notes\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tags extends Model
{
    use HasFactory;
    
    protected $table = 'tags';
    protected $primaryKey = 'tag_id';
    public $timestamps = false;

    public function scopefindTag($query, $tagName) {
    	return $query->where('tag_name', '=', $tagName);
    }
}
