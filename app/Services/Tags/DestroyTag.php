<?php

namespace notes\Services\Tags;

use notes\Models\Tags;
use notes\Models\TagsRel;

class DestroyTag
{

    /**
     * Destroys a single tag from specific user
     *
     * @return object
     */
    public function single(int $userId, array $fields): object
    {
        if (!empty($fields['tag_name'])) {
            $tag = Tags::checkTags($fields['tag_name'])->first();
            if (!empty($tag)) {
                $tagsRelationships = TagsRel::where([
                    'tag_id' => $tag->tag_id,
                    'user_id' => $userId,
                    'note_id' => $fields['page_id'],
                ]);
                // Get listings in order to clean them up later
                $fetchTagsRelationships = $tagsRelationships->get();
                if ($tagsRelationships->delete()) {
                    // Clean out unused tags, and return tags
                    $this->cleanLastTags($fetchTagsRelationships);
                    return $tagsRelationships->first();
                }
            }
        }
    }

    /**
     * Destroys a all tags from a specific note and user
     *
     */
    public function multiple(int $userId, int $note_id)
    {
        // Delete tags associated to a note_id and user_id
        $tagsRelationships = TagsRel::where([
            'note_id' => $note_id,
            'user_id' => $userId,
        ]);
        $fetchTagsRelationships = $tagsRelationships->get();
        $tagsRelationships->delete();

        // Clean out old tags
        $this->cleanLastTags($fetchTagsRelationships);
    }

    /**
     * Cleans out unused tags inside the Tag table.
     *
     */
    private function cleanLastTags($tagsRelationships): void
    {
        // Check if tags exist inside TagsRel table, if not delete
        $tagIds = $tagsRelationships->pluck('tag_id')->toArray();
        foreach($tagIds as $id) {
            // If it doesn't exist then delete tag from tags table
            $count = TagsRel::where('tag_id', $id)->count();
            if (!$count) {
                Tags::where('tag_id', $id)->delete();
            }
        }

    }
}
