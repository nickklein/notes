<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:api')->group(function () {
    Route::get('/tag/{id}', 'api\TagsController@fetchSingle');
    Route::post('/tags/remove', 'api\TagsController@destroy');
    Route::post('/tags/create', 'api\TagsController@create');
    Route::get('/tags/feed', 'api\TagsController@fetchAll');

    // Fetch Notes
    Route::get('/note/{id}', 'api\NotesController@fetchSingle');
    Route::get('/notes/feed/', 'api\NotesController@fetchSidebar')->name('notesFeed');
    Route::get('/notes/feed/{search}', 'api\NotesController@fetchSidebar')->name('notesFeedFilter');

    Route::post('/notes/create', 'api\NotesController@create');
    Route::post('/notes/remove', 'api\NotesController@destroy');
    Route::post('/notes/pin', 'api\NotesController@pin');
    Route::post('/notes/update', 'api\NotesController@update');
});