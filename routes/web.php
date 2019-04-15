<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/app', 'HomeController@index')->name('home');
Route::get('/app/{id}', 'HomeController@index')->name('home');

Route::get('/tags/all-tags', 'TagsController@getMyTags');

// Fetch Notes
Route::get('/note/{id}', 'NotesController@getNote');
Route::get('/notes/feed/', 'NotesController@getUserNotes')->name('notesFeed');
Route::get('/notes/feed/{search}', 'NotesController@getUserNotes')->name('notesFeedFilter');
