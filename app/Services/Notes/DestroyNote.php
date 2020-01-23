<?php

namespace notes\Services\Notes;

use notes\Models\Notes;
use notes\Models\NotesSettingsRel;
use notes\Models\NotesRel;
use Illuminate\Support\Facades\Auth;
use notes\Services\Tags\DestroyTag;
use Illuminate\Support\Carbon;
use notes\Services\Notes\GetNotes;

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
            // Check if user owns the note, if they do, then delete it all, if not delete only the guest users entry
            if (!$this->isOwner($note->note_id, Auth::user()->id)) {
                // Delete specific user, not everyone else.
                NotesRel::where(['note_id' => $note->note_id], ['user_id' => Auth::user()->id])->delete();

                // Redirect to first note after deleting it from the guest user
                $notes = (new GetNotes)->handle(Auth::user()->id, ['search' => '']);
                return ['success' => true, 'action' => 'deleted_note', 'type' => 'user', 'page_id' => $notes->first()->note_id];
            }

            // Deletes note if it belongs to the admin
            if ($note->delete()) {
                $notes = (new GetNotes)->handle(Auth::user()->id, ['search' => '']);
                return ['success' => true, 'action' => 'deleted_note', 'type' => 'admin', 'page_id' => $notes->first()->note_id];
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
            // Destroy notes relationships
            NotesRel::where('note_id', $note->note_id)->delete();

            $note->forceDelete();
        }
    }

    private function isOwner(int $noteId, int $userId): bool
    {
        $owner = NotesRel::where([
            ['note_id', $noteId],
            ['user_id', $userId],
            ['permission', 'admin'],
        ])->count();
        if ($owner) {
            return true;
        }
        return false;
    }
}