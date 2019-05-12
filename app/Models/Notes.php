<?php

namespace notes\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Notes extends Model
{
    //
    protected $table = 'notes';
    protected $primaryKey = 'note_id';

    public function scopeNotesRel(Builder $query)
    {
        //return $this->belongsTo('\notes\Models\NotesRel', 'note_id', 'note_id');
        return $query->join('notes_rel', 'notes_rel.note_id', 'notes.note_id');
    }

    public function scopeRelationshipFilter(Builder $query, $user_id, $search) 
    {
        return $query
                ->join('notes_rel', 'notes_rel.note_id', 'notes.note_id')
                ->where('user_id', $user_id)
                ->where(function($query) use ($search) {
                        $query->when((!empty($search)), function($query) use ($search) {
                            $query->where('notes.note_title', 'like', '%' . $search . '%')
                                ->orWhere('notes.note_content', 'like', '%' . $search . '%');
                        });
                })
                ->orderby('notes.updated_at', 'DESC');
    }
    public function scopeGetNote(Builder $query, $user_id, $note_id)
    {
        return $query
                ->join('notes_rel', 'notes.note_id', 'notes_rel.note_id')
                ->where('notes_rel.user_id', $user_id)
                ->where('notes.note_id', $note_id);
    }
}
