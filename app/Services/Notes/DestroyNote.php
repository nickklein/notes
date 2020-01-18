<?php

namespace notes\Services\Notes;

use notes\Models\Notes;
use notes\Models\NotesSettingsRel;
use Illuminate\Support\Facades\Auth;
use notes\Services\Tags\DestroyTag;
use Illuminate\Support\Carbon;

class DestroyNote
{
    CONST EXPIRED_DAYS = 1;

    /**
     * Deletes a Note, with its tags
     *
     * @return array
     */
    public function handle(int $userId, array $fields): array
    {
        // Get the user note
        $note  = Notes::GetNote($userId, $fields['page_id'])->first();
        // Check if it's the last one. If it's the last one, then don't delete it.
        $count = Notes::RelationshipFilter($userId, '')->count();

        // TODO: Needs to also delete all the relationships if the user is an admin

        if (!empty($note)) {
            if ($count == 1) {
                return ['success' => false, 'action' => 'last_note'];
            }

            // Deletes the note here
            if ($note->delete()) {
                return ['success' => true, 'action' => 'deleted_note'];
            }
        }
        return ['success' => false, 'action' => 'permission_denied'];
    }

    public function destroyExpired(): void
    {
        $notes = Notes::withTrashed()->NotesRel()
            ->where('deleted_at', '<=', Carbon::now()->subDays(self::EXPIRED_DAYS)->toDateTimeString())
            ->get();
        foreach($notes as $note) {
            // Delete all associated tags

            (new DestroyTag)->multiple($note->user_id, $note->note_id);
            // Delete related settings etc
            NotesSettingsRel::where('note_id', $note->note_id)->delete();
            $note->forceDelete();
        }
    }
}