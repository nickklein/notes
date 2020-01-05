<?php

namespace notes\Http\Controllers\api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use notes\Http\Controllers\Controller;
use notes\Models\Notes;
use notes\Models\NotesRel;
use notes\Models\NotesSettingsRel;
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

    public function fetchSidebar(Request $request)
    {
        $excludePinnedIds = [];
        $user_id = Auth::user()->id;

        $pinned = Notes::RelationshipFilter($user_id, $request->search)
                        ->leftJoin('notes_settings_rel', 'notes_settings_rel.note_id', 'notes.note_id')
                        ->where('notes_settings_rel.nsetting_id', 2)
                        ->orderby('notes.updated_at', 'DESC')->get();

        $excludePinnedIds = $pinned->pluck('note_id')->toArray();
        $settingIds = $pinned->pluck('nsetting_id')->toArray();
        // Pin/Unpin items
        $pinned = $pinned->map(function ($pin) {
            $pin->pinned = true;

            // Process Caption
            $content = NotesHelper::decrypt($pin->note_content);
            $pin->note_caption = NotesHelper::decrypt($pin->note_caption);
            
            return $pin;
        });


        $notes = Notes::RelationshipFilter($user_id, $request->search)
                        ->whereNotIn('notes.note_id', $excludePinnedIds)
                        ->orderby('notes.updated_at', 'DESC')
                        ->get();

        // Pin/Unpin items


        $notes = $notes->each(function ($note) {
            $note->pinned = false;

            // Process Caption
            $content = NotesHelper::decrypt($note->note_content);
            $note->note_caption = NotesHelper::decrypt($note->note_caption);

            return $note;
        });
        $notes = $pinned->merge($notes);

        return response()->json($notes);
    }
    
    public function fetchSingle(Request $request)
    {
        $user_id = Auth::user()->id;
        $notes = Notes::GetNote($user_id, $request->id)
                        ->leftJoin('notes_settings_rel', 'notes_settings_rel.note_id', 'notes.note_id')
                        ->get();

        $notes = $notes->each(function ($note) {
            $note->note_content = NotesHelper::decrypt($note->note_content);
            return $note;
        });

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
        $title = 'This is your note';
        $content = 'Here\'s your paragraph';

        $user_id = Auth::user()->id;

        $note = new Notes;
        $note->note_title = $title;
        $note->note_caption = $content;
        $note->note_content = NotesHelper::encrypt('<h1>' . $title . '</h1><p>' . $content . '/p>');
        if ($note->save()) {
            $note_rel = new NotesRel;
            $note_rel->note_id = $note->note_id;
            $note_rel->user_id = $user_id;
            $note_rel->permission = 'admin';
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
    	$this->validate($request, [
            'type' => ["required" , "max:25", "regex:(title|content)"],
            'page_id' => 'required|integer',
        ]);

        $user_id = Auth::user()->id;
        $note = Notes::NotesRel()
                    ->where([
                        ['notes_rel.note_id','=',$request->page_id],
                        ['notes_rel.user_id','=', $user_id]
                    ])
                    ->first();
                    

        $note->note_title = $request->title;
        if ($request->caption) {
            $note->note_caption = NotesHelper::encrypt(NotesHelper::fetchCaption($request->caption));
        }
        $note->note_content = NotesHelper::encrypt($request->content);
    
        if ($note->save()) {
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
    public function destroy(Request $request)
    {
    	$this->validate($request, [
            'page_id' => 'required|integer',
        ]);

        // Check for user
        $user_id = Auth::user()->id;
        $note  = Notes::GetNote($user_id, $request->page_id)->first();
        $count = Notes::RelationshipFilter($user_id, '')->count();
        
        if (!empty($note)) {
            if ($count == 1) {
                return response()->json(array('success' => false, 'action' => 'last note'));
            }
            if ($note->delete()) {
                return response()->json(array('success' => true));
            }
        }

        return response()->json(array('success' => false, 'action' => 'permission denied'));
    }

    public function pin(Request $request)
    {
    	$this->validate($request, [
            'page_id' => 'required|integer',
        ]);

        $user_id = Auth::user()->id;
        $notes = Notes::GetNote($user_id, $request->page_id)->SettingsRel(2)->first();
        if(empty($notes)) {
            $notesSettingsRel = NotesSettingsRel::firstOrCreate(
                ['nsetting_id' => 2, 'note_id' => $request->page_id],
                ['nsetting_id' => 2, 'note_id' => $request->page_id]
            );
            return response()->json(array('success' => true, 'action' => 'add'));
        }
        NotesSettingsRel::find($notes->nsettingrel_id)->delete();
        return response()->json(array('success' => true, 'action' => 'delete'));
    }
}
