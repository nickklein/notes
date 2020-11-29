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
    Route::get('/tag/{id}', 'api\TagsController@index');
    Route::post('/tags/remove', 'api\TagsController@destroy');
    Route::post('/tags/create', 'api\TagsController@store');

    // Fetch Notes
    Route::get('/note/{page_id}', 'api\NotesController@show')->where('id', '[0-9]+');
    Route::get('/notes/feed/', 'api\NotesController@index')->name('notesFeed');
    Route::get('/notes/feed/{search}', 'api\NotesController@index')->name('notesFeedFilter');

    Route::post('/notes/create', 'api\NotesController@store');
    Route::post('/notes/remove', 'api\NotesController@destroy');
    Route::post('/notes/pin', 'api\NotesController@pin');
    Route::post('/notes/update', 'api\NotesController@update');
});