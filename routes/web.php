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

Route::get('/settings/account', 'AccountController@account')->name('settings/account');
Route::patch('/settings/account/update', 'AccountController@updateAccount')->name('settings/account/update');
Route::post('/settings/account/destroy', 'AccountController@destroyAccount')->name('settings/account/destroy');
Route::get('/settings/password', 'AccountController@password')->name('settings/password');
Route::patch('/settings/password/update', 'AccountController@updatePassword')->name('settings/password/update');

Route::get('/settings/api', 'AccountController@api')->name('settings/api');

