<?php

namespace notes\Services\Notes;

use notes\Models\Notes;
use notes\Models\NotesSettingsRel;

class PinNote
{
    public function handle(int $userId, array $fields): bool
    {
        $notes = Notes::GetNote($userId, $fields['page_id'])->SettingsRel(2)->first();
        if (empty($notes)) {
            $notesSettingsRel = NotesSettingsRel::firstOrCreate(
                ['nsetting_id' => 2, 'note_id' => $fields['page_id']],
                ['nsetting_id' => 2, 'note_id' => $fields['page_id']]
            );
            // Add pin
            return true;
        }
        // Delete pin
        NotesSettingsRel::find($notes->nsettingrel_id)->delete();
        return false;
    }
}