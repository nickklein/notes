<?php

namespace notes\Http\Controllers\api;

use Illuminate\Http\Request;
use notes\Http\Controllers\Controller;
use notes\Models\Tags;
use notes\Models\TagsRel;
use notes\Http\Resources\initTags as initTags;
use Auth;


class TagsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function single(Request $request)
    {
        //
        $user_id = Auth::user()->id;
        $tag_rel = TagsRel::with('tags')
                    ->where('user_id', $user_id)
                    ->Where('note_id', $request->id)
                    ->get();
        return initTags::collection($tag_rel);

    }

    public function getMyTags()
    {
        $user_id = Auth::user()->id;
        $tag_rel = TagsRel::with('tags')
                    ->where('user_id', $user_id)
                    ->get();
        return initTags::collection($tag_rel);

    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //$request->tagName
         $id = Auth::user()->id;

        // Check to make sure request wasn't empty
        if (!empty($request->tag_name)) {
            $tag = Tags::checkTags($request->tag_name)->first();

            if (empty($tag)) {
                // If Tag needs to be added to the Database
                $tags = new Tags;
                $tags->tag_name = $request->tag_name;
                $tags->save();
                $tagID = $tags->tag_id;
            } else {
                // If Tag is already saved in the Database
                $tagID = $tag->tag_id;
            }
         
            // Add tagID and user to table
            $rel = new TagsRel;
            $rel->tag_id = $tagID;
            $rel->note_id = $request->page_id;
            $rel->user_id = $id;

            if ($rel->save()) {
                ##return new responseTags($rel);
            }
        }


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        dd($id);
    }
}
