<?php

namespace notes\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use notes\Models\TagsRel;


class Notes extends Model
{
    //
    protected $table = 'notes';
    protected $primaryKey = 'note_id';
    
    public function notesSettingsRel()
    {
        return $this->hasMany('notes\Models\NotesSettingsRel', 'note_id', 'note_id');
    }

    public function scopeNotesRel(Builder $query)
    {
        //return $this->belongsTo('\notes\Models\NotesRel', 'note_id', 'note_id');
        return $query->join('notes_rel', 'notes_rel.note_id', 'notes.note_id');
    }

    public function scopeRelationshipFilter(Builder $query, int $userId, $search) 
    {

        return $query
            ->leftJoin('notes_rel', 'notes_rel.note_id', 'notes.note_id')
            ->where('user_id', $userId)
            ->where(function($query) use ($search, $userId) {
                $query->when((!empty($search)), function($query) use ($search, $userId) {

                    // Search tags for matches
                    $tagsRel = TagsRel::join('tags', 'tags_rel.tag_id', 'tags.tag_id')
                                        ->where('tags_rel.user_id', $userId)
                                        ->where('tag_name', 'like', '%' . $search . '%')
                                        ->get();
                    $noteIds = $tagsRel->pluck('note_id')->toArray();

                    $query->where('notes.note_title', 'like', '%' . $search . '%')
                        ->orWhereIn('notes.note_id', $noteIds);
                });
            });
    }
    public function scopeGetNote(Builder $query, $user_id, $note_id)
    {
        return $query
            ->join('notes_rel', 'notes.note_id', 'notes_rel.note_id')
            ->where('notes_rel.user_id', $user_id)
            ->where('notes.note_id', $note_id);
    }
    public function scopeSettingsRel(Builder $query, $setting_id)
    {
        return $query
            ->leftJoin('notes_settings_rel', 'notes_settings_rel.note_id', 'notes.note_id')
            ->when($setting_id, function($query) use ($setting_id) {
                if ($setting_id) {
                    $query->where('notes_settings_rel.nsetting_id', $setting_id);
                }
            });
    }
}
