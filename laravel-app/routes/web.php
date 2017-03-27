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

Route::get('/', function() {
	return view('welcome');
});

Route::get('/noun/{id}/{fromLng}', 'WordsController@showNoun');
Route::get('/noun/new', 'WordsController@newNoun');
Route::post('/noun', 'WordsController@createNoun');

Route::get('/verb/{id}/{from}', 'WordsController@showVerb');


Route::get('/practice/start', 'PracticeController@showForm');
Route::post('/practice/start', 'PracticeController@start');
Route::get('/practice/{types}/{fromLng}/{bookId}/{fromLesson}/{toLesson}', 'PracticeController@showWord');
Route::get('/practice/{types}/{fromLng}/{bookId}', 'PracticeController@showWord');


	
