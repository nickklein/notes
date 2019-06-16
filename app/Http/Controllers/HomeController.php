<?php

namespace notes\Http\Controllers;

use Illuminate\Http\Request;
use notes\Models\Notes;
use Auth;

class HomeController extends Controller
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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $pageid = 0;
        // If id is passed to the route, then use it, if not get the first in users id;
        if ($request->id) {
            $pageid = $request->id;
        } else {
            $user_id = Auth::user()->id;
            $notes = Notes::RelationshipFilter($user_id, '')->first();
            $pageid = $notes->note_id;
        }
        return view('app', ['pageid' => $pageid]);
    }
}
