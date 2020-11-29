<?php

namespace notes\Models;

use Illuminate\Database\Eloquent\Model;

class TagsRel extends Model
{
    //
    protected $table = 'tags_rel';
    protected $primaryKey = 'tagrel_id';
    public $timestamps = false;

    public function tags()
    {
        return $this->hasOne('\notes\Models\Tags', 'tag_id', 'tag_id');
    }
}
