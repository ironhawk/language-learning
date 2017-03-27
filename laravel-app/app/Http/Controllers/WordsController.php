<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Noun;

class WordsController extends Controller
{
    
	public function showNoun($id, $fromLng, $count = 1) {
	
		$word = DB::table('nouns')
		->join('books', 'nouns.book_id', '=', 'books.id')
		->where('nouns.id', '=', $id)
		->select('nouns.*', 'books.title as bookTitle')
		->first();
	
		return view('words.noun', [
				'word' => $word,
				'type' => 'főnév',
				'count' => $count,
				'from' => $fromLng
		]);
	}
	
	public function showVerb($id, $fromLng, $count = 1) {
	
		$word = DB::table('verbs')
		->join('books', 'verbs.book_id', '=', 'books.id')
		->where('verbs.id', '=', $id)
		->select('verbs.*', 'books.title as bookTitle')
		->first();
		
		
		
		return view('words.verb', [
				'word' => $word,
				'type' => 'ige',
				'count' => $count,
				'from' => $fromLng
		]);
	}
	
	
	public function newNoun() {
		
		return view('words.noun-create');
	}

	public function createNoun() {
	
		// dd(request()->all());
		
		$noun = Noun::create(request([
				'definite_article',
				'indefinite_article',
				'foreign',
				'hu',
				'plural',
				'specialties',
				'book_id',
				'lesson',
				'level',
				'comment'
				]));
		
		return redirect('/noun/'.$noun->id.'/hu');
		
	}
	
}
