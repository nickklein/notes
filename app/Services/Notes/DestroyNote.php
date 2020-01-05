<?php

namespace notes\Services\Notes;

use notes\Models\Notes;
use Illuminate\Support\Facades\Auth;
use notes\Services\Tags\DestroyTag;


class DestroyNote
{
    protected $destroyTag;

    public function __construct(DestroyTag $destroyTag) {
        $this->destroyTag = $destroyTag;
    }

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

        // Remove all tags for the specific note
        $this->destroyTag->multiple($userId, $fields['page_id']);

        // TODO: Needs to also delete all the relationships if the user is an admin

        if (!empty($note)) {
            if ($count == 1) {
                return ['success' => false, 'action' => 'last_note'];
            }
            if ($note->delete()) {
                return ['success' => true, 'action' => 'deleted_note'];
            }
        }
        return ['success' => false, 'action' => 'permission_denied'];
    }
}