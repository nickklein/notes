<?php

namespace notes\Services\Notes;

use notes\Models\Notes;
use notes\Src\NotesHelper;
use notes\Services\Encryption;

class GetNote
{
    
    public function handle(int $userId, $fields)
    {

        $notes = Notes::with('notesSettingsRel')->GetNote($userId, $fields['page_id'])->get();

        $notes = $notes->each(function ($note) {
            $note->created_at_formated = date("F d, Y, H:i:s", strtotime($note->created_at));
            $content = NotesHelper::decrypt($note->note_content);
            $note->note_content = $content;
            $note->note_word_count = str_word_count($content);
            return $note;
        });
        return $notes;
    }
}