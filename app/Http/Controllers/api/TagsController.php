<?php

namespace notes\Http\Controllers\api;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use notes\Http\Controllers\Controller;
use notes\Http\Requests\Tags\TagsRequest;
use notes\Models\Tags;
use notes\Models\TagsRel;
use notes\Http\Resources\initTags as initTags;
use notes\Http\Resources\responseTags;
use notes\Services\Tags\CreateTag;
use notes\Services\Tags\DestroyTag;


class TagsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @param  Request $request
     */
    public function index(Request $request)
    {
        //
        $userId = Auth::user()->id;
        $tagRel = TagsRel::with('tags')
                    ->where('user_id', $userId)
                    ->Where('note_id', $request->id)
                    ->get();

        return initTags::collection($tagRel);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  TagsRequest  $request
     * @param  CreateTag  $createTag

     */
    public function store(TagsRequest $request, CreateTag $createTag)
    {
        //
        $rel = $createTag->handle(Auth::user()->id, $request->validated());

        return new responseTags($rel);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  TagsRequest  $request
     * @param   DestroyTag $destroyTag
     */
    public function destroy(TagsRequest $request, DestroyTag $destroyTag)
    {
        $rel = $destroyTag->single(Auth::user()->id, $request->validated());

        return new responseTags($rel);
    }
}
