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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request): object
    {
        $userId = Auth::user()->id;

        $notes = Notes::with('notesSettingsRel')->GetNote($userId, $request->id)->get();

        $notes = $notes->each(function ($note) {
            $content = NotesHelper::decrypt($note->note_content);
            $note->note_content = $content;
            $note->note_word_count = str_word_count($content);
            return $note;
        });
        return response()->json($notes);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, CreateNote $createNote): void
    {
        // Create a note
        $createNote->handle(Auth::user()->id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(NotesUpdateRequest $request, UpdateNote $updateNote): object
    {
        $response = $updateNote->handle(Auth::user()->id, $request->validated());
    
        if ($response) {
            return response()->json(array('success' => true));
        }
        return response()->json(array('success' => false));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(NotesIdRequest $request, DestroyNote $destroyNote): object
    {
        // Destroy note using request
        $response = $destroyNote->handle(Auth::user()->id, $request->validated());
        return response()->json($response);
    }

    public function pin(NotesIdRequest $request, PinNote $pinNote): object
    {

        $response = $pinNote->handle(Auth::user()->id, $request->validated());
        if ($response) {
            return response()->json(array('success' => true, 'action' => 'add'));
        }

        return response()->json(array('success' => true, 'action' => 'delete'));
    }
}
