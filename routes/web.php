<?php

use Illuminate\Support\Facades\Route;

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

// meetings
Route::get('/meetings', 'App\Http\Controllers\MeetingsController@index')->middleware('auth.basic');
Route::get('/meetings/{id}', 'App\Http\Controllers\MeetingsController@show')->middleware('auth.basic');
Route::get('/meetings/{id}/public', 'App\Http\Controllers\MeetingsController@show');
Route::put('/meetings/{id}', 'App\Http\Controllers\MeetingsController@update')->middleware('auth.basic');
// if a front end framework and sending XHR requests,
// this would be a delete request, like this - Route::delete('/meetings/{id}', 'App\Http\Controllers\MeetingsController@delete');
Route::get('/meetings/{id}/delete', 'App\Http\Controllers\MeetingsController@delete');

// meetings rsvps
Route::post('/meetings_users', 'App\Http\Controllers\MeetingsUsersController@create');