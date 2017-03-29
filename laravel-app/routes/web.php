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

Route::get('/view/noun/{id}/{fromLng}', 'WordsController@showNoun');
Route::get('/new/noun', 'WordsController@newNoun');
Route::get('/edit/noun/{id}', 'WordsController@editNoun');
Route::post('save/noun', 'WordsController@saveNoun');

Route::get('/view/verb/{id}/{from}', 'WordsController@showVerb');
Route::get('/new/verb', 'WordsController@newVerb');
Route::get('/edit/verb/{id}', 'WordsController@editVerb');
Route::post('save/verb', 'WordsController@saveVerb');

Route::get('/view/adjective/{id}/{fromLng}', 'WordsController@showAdjective');
Route::get('/new/adjective', 'WordsController@newAdjective');
Route::get('/edit/adjective/{id}', 'WordsController@editAdjective');
Route::post('save/adjective', 'WordsController@saveAdjective');

Route::get('/view/other/{id}/{fromLng}', 'WordsController@showOther');
Route::get('/new/other', 'WordsController@newOther');
Route::get('/edit/other/{id}', 'WordsController@editOther');
Route::post('save/other', 'WordsController@saveOther');


Route::get('/practice/start', 'PracticeController@showForm');
Route::post('/practice/start', 'PracticeController@start');
Route::get('/practice/random/{types}/{fromLng}/{bookId}/{fromLesson}/{toLesson}', 'PracticeController@showWordsRandom');
Route::get('/practice/linear/{types}/{fromLng}/{bookId}/{fromLesson}/{toLesson}', 'PracticeController@showWordsLinear');
Route::get('/practice/random/{types}/{fromLng}/{bookId}', 'PracticeController@showWordsRandom');
Route::get('/practice/linear/{types}/{fromLng}/{bookId}', 'PracticeController@showWordsLinear');


	
