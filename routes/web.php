<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::pattern('id', '[0-9]+');

Auth::routes();

Route::get('/', function () {
    return view('index');
});

// Auth middleware (only accessible to loggeed in users)
Route::group(['middleware' => ['auth']], function() {
	// Home
	Route::get('/home', ['as' => 'home', 'uses' => 'NoteController@index']);
	Route::get('/home/{id}', 'NoteController@indexByNotebook');

	// Notes
	Route::get('/note/create', 'NoteController@create');
	Route::post('/note/create', 'NoteController@store');

	Route::get('/note/{id}', ['as' => 'note', 'uses' => 'NoteController@showNote']);

	Route::get('/note/edit/{id}', 'NoteController@edit');
	Route::post('/note/edit/{id}', 'NoteController@update');	

	Route::get('/note/delete/{id}', 'NoteController@destroy');

	// Notebooks
	Route::get('/notebook/create', 'NotebookController@create');
	Route::post('/notebook/create', 'NotebookController@store');

	Route::get('/notebook/edit/{id}', 'NotebookController@edit');
	Route::post('/notebook/edit/{id}', 'NotebookController@update');

	Route::get('/notebook/delete/{id}', 'NotebookController@destroy');

});