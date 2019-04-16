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

Route::get('/tag/{id}', 'api\TagsController@single');
Route::get('/tags/feed', 'api\TagsController@getMyTags');

// Fetch Notes
Route::get('/note/{id}', 'NotesController@getNote');
Route::get('/notes/feed/', 'api\NotesController@getUserNotes')->name('notesFeed');
Route::get('/notes/feed/{search}', 'api\NotesController@getUserNotes')->name('notesFeedFilter');