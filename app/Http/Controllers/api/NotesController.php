<?php

namespace notes\Http\Controllers\api;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use notes\Http\Controllers\Controller;
use notes\Models\Notes;
use notes\Src\NotesHelper;
use notes\Services\Notes\CreateNote;
use notes\Http\Requests\Notes\NotesIdRequest;
use notes\Http\Requests\Notes\NotesUpdateRequest;
use notes\Services\Notes\UpdateNote;
use notes\Services\Notes\DestroyNote;
use notes\Services\Notes\PinNote;
use notes\Services\Notes\GetNote;
use notes\Services\Notes\GetNotes;


class NotesController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of notes
     * 
     * @param Request $request
     * @param GetNotes $getNotes
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, GetNotes $getNotes): object
    {

        $notes = $getNotes->handle(Auth::user()->id, $request);

        return response()->json($notes);
    }
    
    /**
     * Shows a single note
     *
     * @param  Request  $request
     * @param GetNotes $getNote
     * 
     */
    public function show(Request $request, GetNote $getNote): object
    {
        $notes = $getNote->handle(Auth::user()->id, ['page_id' => $request->page_id]);

        return response()->json($notes);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, CreateNote $createNote): object
    {
        // Create a note
        $noteId = $createNote->handle(Auth::user()->id);
        if ($noteId) {
            return response()->json(array('success' => true, 'action' => 'created', 'page_id' => $noteId));
        }

        return response()->json(array('success' => false, 'action' => 'not created')); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(NotesUpdateRequest $request, UpdateNote $updateNote, GetNote $getNote): object
    {
        $fields = $request->validated();
        $response = $updateNote->handle(Auth::user()->id, $fields);
    
        if ($response) {
            $notes = $getNote->handle(Auth::user()->id, $request);
            return response()->json($notes);
        }

        return response()->json(array('success' => false));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param NotesIdRequest  $request
     * @param DestroyNote $destroyNote
     * @return object
     */
    public function destroy(NotesIdRequest $request, DestroyNote $destroyNote): object
    {
        // Destroy note using request
        $response = $destroyNote->handle(Auth::user()->id, $request->validated());

        return response()->json($response);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  NotesIdRequest  $request
     * @param  PinNote  $pinNote
     * @return object
     */
    public function pin(NotesIdRequest $request, PinNote $pinNote): object
    {

        $response = $pinNote->handle(Auth::user()->id, $request->validated());
        if ($response) {
            return response()->json(array('success' => true, 'action' => 'add'));
        }

        return response()->json(array('success' => true, 'action' => 'delete'));
    }
}
