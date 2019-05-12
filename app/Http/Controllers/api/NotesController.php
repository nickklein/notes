<?php

namespace notes\Http\Controllers\api;

use Illuminate\Http\Request;
use notes\Http\Controllers\Controller;
use notes\Models\Notes;
use notes\Models\NotesRel;
use notes\Src\NotesHelper;
use Auth;

class NotesController extends Controller
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
    public function index()
    {
        //
    }

    public function getUserNotes(Request $request)
    {
        $user_id = Auth::user()->id;
        $notes = Notes::RelationshipFilter($user_id, $request->search)->get();
        return response()->json($notes);
    }
    
    public function getNote(Request $request)
    {
        $user_id = Auth::user()->id;
        $notes = Notes::GetNote($user_id, $request->id)->get();
        return response()->json($notes);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $user_id = Auth::user()->id;

        $note = new Notes;
        $note->note_title = 'Title your note';
        $note->note_content = '<h1><span style="color: #3598db;">Title your note</span></h1><p>Here\'s your paragraph</p>';
        $note->note_caption = 'Here\'s your paragraph';
        if ($note->save()) {
            $note_rel = new NotesRel;
            $note_rel->note_id = $note->note_id;
            $note_rel->user_id = $user_id;
            $note_rel->permission = 'admin';
            $note_rel->order = 0;
            $note_rel->save();
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
    public function update(Request $request)
    {
        $user_id = Auth::user()->id;
        $note = Notes::NotesRel()
                    ->where([
                        ['notes_rel.note_id','=',$request->page_id],
                        ['notes_rel.user_id','=', $user_id]
                    ])
                    ->first();

        $notes_helper = (new NotesHelper)->processContent($request);
        $note->note_title = $notes_helper['title'];
        $note->note_content = $notes_helper['content'];
        $note->note_caption = $notes_helper['caption'];
        $note->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //
        $note = Notes::find($request->page_id);
        $note->delete();
    }
}
