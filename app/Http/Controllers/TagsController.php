<?php

namespace notes\Http\Controllers;

use Illuminate\Http\Request;
use notes\Models\TagsRel;
use Auth;

class TagsController extends Controller
{
    //
    public function getMyTags()
    {
        $user_id = Auth::user()->id;
        $tag_rel = TagsRel::with('tags')
                    ->where('user_id', $user_id)
                    ->get();
        return response()->json($tag_rel);
    }

    // Get Tags for specific note
    // Insert Tags from Notes
}
