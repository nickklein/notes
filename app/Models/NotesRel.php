<?php

namespace notes\Models;

use Illuminate\Database\Eloquent\Model;

class NotesRel extends Model
{
    //
    protected $table = 'notes_rel';
    protected $primaryKey = 'note_rel_id';
    public $timestamps = false;

    public function notes() {
        return $this->hasOne('notes\Models\Notes', 'note_id', 'note_id')
                        ->select('note_id', 'note_title', 'note_content', 'published');
    }
}
