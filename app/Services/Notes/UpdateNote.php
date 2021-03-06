<?php

namespace notes\Services\Notes;

use notes\Models\Notes;
use notes\Src\NotesHelper;
use notes\Services\Encryption;

class UpdateNote
{
    public function handle(int $userId, array $fields): bool
    {
        $note = Notes::NotesRel()
                    ->where([
                        ['notes_rel.note_id','=',$fields['page_id']],
                        ['notes_rel.user_id','=', $userId]
                    ])
                    ->first();
                    
        $note->note_title = Encryption::encrypt($this->shorten($fields['title'], 30));
        if ($fields['caption']) {
            $note->note_caption = Encryption::encrypt($this->shorten($fields['caption'], 60));
        }
        $note->note_content = Encryption::encrypt($fields['content']);
    
        if ($note->save()) {
            return true;
        }
        return false;
    }
    private static function shorten(string $data, int $length): string
    {
        return substr(strip_tags($data), 0, $length) . '..';
    }
}