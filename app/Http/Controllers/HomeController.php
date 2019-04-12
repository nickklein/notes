<?php

namespace notes\Http\Controllers;

use Illuminate\Http\Request;

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
    public function index()
    {
        return view('app');
    }
    
    public function getHomeFeed()
    {
        $data = [
            'sidebar' => array(
                'notes' => array(
                    1 => array(
                        'title' => 'Lorem ipsum dolor sit amet',
                        'caption' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.'
                    ),
                    2 => array(
                        'title' => 'Lorem ipsum dolor sit amet',
                        'caption' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.'
                    ),
                    3 => array(
                        'title' => 'Lorem ipsum dolor sit amet',
                        'caption' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.'
                    ),
                    4 => array(
                        'title' => 'Lorem ipsum dolor sit amet',
                        'caption' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.'
                    ),
                    5 => array(
                        'title' => 'Lorem ipsum dolor sit amet',
                        'caption' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.'
                    ),
                    6 => array(
                        'title' => 'Lorem ipsum dolor sit amet',
                        'caption' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.'
                    ),
                    7 => array(
                        'title' => 'Lorem ipsum dolor sit amet',
                        'caption' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.'
                    ),
                    8 => array(
                        'title' => 'Lorem ipsum dolor sit amet',
                        'caption' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.'
                    ),





                )
            )
        ];
        return response()->json($data);
    }
}
