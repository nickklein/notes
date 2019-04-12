<?php

namespace notes\Http\Controllers;

use Illuminate\Http\Request;
use notes\Models\Notes;
use Auth;

class NotesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    //
    public function getUserNotes(Request $request)
    {
        $user_id = Auth::user()->id;
        $notes = Notes::RelationshipFilter($user_id, $request->search)->get();
        return response()->json($notes);
    }
}
