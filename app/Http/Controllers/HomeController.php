<?php

namespace notes\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use notes\Services\Notes\GetNotes;

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
    public function index(Request $request, GetNotes $getNotes)
    {
        $notes = $getNotes->handle(Auth::user()->id, ['search' => '']);    
        return view('app', ['pageid' => $notes->first()->note_id]);
    }
}
