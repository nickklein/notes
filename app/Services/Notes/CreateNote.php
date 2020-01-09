<?php

namespace notes\Services\Notes;

use notes\Models\Notes;
use notes\Models\NotesRel;
use notes\Services\Encryption;

class CreateNote
{
    /**
     * Creates a note, and its relationships
     *
     */
    public function handle(int $userId): void
    {
        $title = 'This is your note';
        $content = 'Here\'s your paragraph';

        $note = new Notes;
        $note->note_title = Encryption::encrypt($title);
        $note->note_caption = Encryption::encrypt($content);
        $note->note_content = Encryption::encrypt('<h1>' . $title . '</h1><p>' . $content . '</p>');
        if ($note->save()) {
            $note_rel = new NotesRel;
            $note_rel->note_id = $note->note_id;
            $note_rel->user_id = $userId;
            $note_rel->permission = 'admin';
            $note_rel->save();
        }
    }
}