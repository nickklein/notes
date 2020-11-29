<?php

namespace notes\Services\Tags;

use notes\Models\Tags;
use notes\Models\TagsRel;

class CreateTag
{
    /**
     * Create a tag
     *
     * @return object
     */
    public function handle(int $userId, array $fields): array
    {
        // Check to make sure request wasn't empty
        if (!empty($fields['tag_name'])) {
            $tag = Tags::findTag($fields['tag_name'])->first();

            if (empty($tag)) {
                // If Tag needs to be added to the Database
                $tags = new Tags;
                $tags->tag_name = $fields['tag_name'];
                $tags->save();
                $tagID = $tags->tag_id;
            } else {
                // If Tag is already saved in the Database
                $tagID = $tag->tag_id;
            }

            // Add tagID and user to table
            $rel = new TagsRel;
            $rel->tag_id = $tagID;
            $rel->note_id = $fields['page_id'];
            $rel->user_id = $userId;

            if ($rel->save()) {
                return $rel->toArray();
            }
        }

        return [];
    }
}