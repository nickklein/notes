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
        $pinned = $this->pinned($userId, $fields);

        // Get Notes
        $excludePinnedIds = $pinned->pluck('note_id')->toArray();
        $notes = $this->notes($userId, $fields, $excludePinnedIds);

        return $pinned->merge($notes);
    }

    public function notes(int $userId, $fields, array $excludedIds = [])
    {
        $notes = Notes::RelationshipFilter($userId, $fields['search'])
            ->whereNotIn('notes.note_id', $excludedIds)
            ->orderby('notes.updated_at', 'DESC')
            ->get();

        return $this->map($notes, false);
    }

    private function pinned(int $userId, $fields)
    {

        $pinned = Notes::RelationshipFilter($userId, $fields['search'])
            ->leftJoin('notes_settings_rel', 'notes_settings_rel.note_id', 'notes.note_id')
            ->where('notes_settings_rel.nsetting_id', 2)
            ->orderby('notes.updated_at', 'DESC')->get();

        return $this->map($pinned, true);
    }

    private function map($items, bool $pin)
    {
        return $items->each(function ($note) use ($pin) {
            $note->pinned = $pin;

            $note->note_title = Encryption::decrypt($note->note_title);
            $note->note_caption = Encryption::decrypt($note->note_caption);

            return $note;
        });
    }
}