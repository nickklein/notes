<?php

namespace notes\Services\Notes;

use notes\Models\Notes;
use notes\Src\NotesHelper;
use notes\Services\Encryption;

class GetNotes
{
    private $userId;
    private $fields;
    
    public function handle(int $userId, $fields)
    {
        $this->userId = $userId;
        $this->fields = $fields;

        // Get Pinned Notes
        $pinned = $this->pinned();

        // Get Notes
        $excludePinnedIds = $pinned->pluck('note_id')->toArray();
        $notes = $this->notes($excludePinnedIds);

        return $pinned->merge($notes);
    }
    private function pinned()
    {
        $pinned = Notes::RelationshipFilter($this->userId, $this->fields['search'])
            ->leftJoin('notes_settings_rel', 'notes_settings_rel.note_id', 'notes.note_id')
            ->where('notes_settings_rel.nsetting_id', 2)
            ->orderby('notes.updated_at', 'DESC')->get();

        return $this->map($pinned, true);
    }
    private function notes(array $excludedIds)
    {
        $notes = Notes::RelationshipFilter($this->userId, $this->fields['search'])
            ->whereNotIn('notes.note_id', $excludedIds)
            ->orderby('notes.updated_at', 'DESC')
            ->get();

        return $this->map($notes, false);
    }
    private function map($items, bool $pin)
    {
        return $items->each(function ($note) use ($pin) {
            $note->pinned = $pin;

            $note->note_caption = Encryption::decrypt($note->note_caption);

            return $note;
        });
    }
}