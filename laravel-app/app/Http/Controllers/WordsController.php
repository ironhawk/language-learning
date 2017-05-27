<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Noun;
use Illuminate\Support\Facades\App;
use App\Verb;
use App\Adjective;
use App\OtherWord;
use Illuminate\Http\Response;

class WordsController extends Controller
{
    
	public function showNoun($id, $fromLng, $count = 1) {
	
		$word = DB::table('nouns')
		->join('books', 'nouns.book_id', '=', 'books.id')
		->where('nouns.id', '=', $id)
		->select('nouns.*', 'books.title as bookTitle', 'books.language as foreignlangcode')
		->first();
	
		if(is_null($word)) {
			App::abort(404);
		}
		
		return view('words.noun', [
				'word' => $word,
				'type' => 'főnév',
				'count' => $count,
				'from' => $fromLng,
				'editUrl' => '/edit/noun/'.$word->id
		]);
	}
	
	
	public function newNoun(Request $request) {
		$word = new Noun();

		$this->retrieveAndPrePopulateFromCookieValues($request, $word);
		
		return view('words.noun-form', ['word'=>$word, 'title' => 'Új főnév rögzítése', 'selectedBookId' => $word->book_id]);
	}

	public function editNoun($id) {
		$word = Noun::find($id);
		if(is_null($word)) {
			App::abort(404);
		}
		//dd($word);
		return view('words.noun-form', ['word'=>$word, 'title' => 'Főnév módosítása', 'selectedBookId' => $word->book_id]);
	}
	
	
	public function saveNoun() {

		$oneMore = false;
		
		if(empty(request('id'))) {
			$word = $this->createNoun();
			$oneMore = !empty(request('one-more'));
		} else {
			$word = Noun::find(request('id'));
			if(is_null($word)) {
				App::abort(404);
			}
			
			$word->definite_article = request('definite_article');
			$word->indefinite_article = request('indefinite_article');
			$word->plural = request('plural');
			$word->hu = request('hu');
			$word->foreign = request('foreign');
			$word->specialties = request('specialties');
			$word->book_id = request('book_id');
			$word->lesson = request('lesson');
			$word->level = request('level');
			$word->comment = request('comment');
			$word->save();
				
		}

		if($oneMore) {
			$response = redirect('/new/noun');
		} else {
			$response = redirect('/view/noun/'.$word->id.'/hu');
		}
		
		// save some values to cookies
		$this->saveSomeFieldsInCookies($response, $word);
		
		return $response;
	}
	

	/**
	 * Takes the Word and saves some of the fields into cookies - so next time the Form values could be pre-populated speeds
	 * up the upload process
	 */
	private function saveSomeFieldsInCookies($response, $word) {
		$response->withCookie(cookie('lastBookId', $word->book_id, 0));
		$response->withCookie(cookie('lastLesson', $word->lesson, 0));
		$response->withCookie(cookie('lastLevel', $word->level, 0));
	}
	
	/**
	 * Pair of the saveSomeFieldsInCookies() - retrieves values back from cookies and injects into the word
	 */
	private function retrieveAndPrePopulateFromCookieValues(Request $request, $word) {
		$word->book_id = $request->cookie('lastBookId');
		$word->lesson = $request->cookie('lastLesson');
		$word->level = $request->cookie('lastLevel');
	}
	
	private function createNoun() {
	
		// dd(request()->all());
		
		$word = Noun::create(request([
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
		
		return $word;
		
	}

	
	public function showVerb($id, $fromLng, $count = 1) {
	
		$word = DB::table('verbs')
		->join('books', 'verbs.book_id', '=', 'books.id')
		->where('verbs.id', '=', $id)
		->select('verbs.*', 'books.title as bookTitle', 'books.language as foreignlangcode')
		->first();
	
		if(is_null($word)) {
			App::abort(404);
		}
	
	
		return view('words.verb', [
				'word' => $word,
				'type' => 'ige',
				'count' => $count,
				'from' => $fromLng,
				'editUrl' => '/edit/verb/'.$word->id
		]);
	}
	
	public function newVerb(Request $request) {
		$word = new Verb();
		$this->retrieveAndPrePopulateFromCookieValues($request, $word);
		return view('words.verb-form', ['word'=>$word, 'title' => 'Új ige rögzítése', 'selectedBookId' => $word->book_id]);
	}
	
	public function editVerb($id) {
		$word = Verb::find($id);
		if(is_null($word)) {
			App::abort(404);
		}
		//dd($word);
		return view('words.verb-form', ['word'=>$word, 'title' => 'Ige módosítása', 'selectedBookId' => $word->book_id]);
	}
	
	
	public function saveVerb() {
	
		$oneMore = false;
		
		if(empty(request('id'))) {
			$word = $this->createVerb();
			$oneMore = !empty(request('one-more'));
		} else {
			$word = Verb::find(request('id'));
			if(is_null($word)) {
				App::abort(404);
			}
			
			$word->s1 = request('s1');
			$word->s2 = request('s2');
			$word->s3 = request('s3');
			$word->m1 = request('m1');
			$word->m2 = request('m2');
			$word->m3 = request('m3');
			$word->hu = request('hu');
			$word->foreign = request('foreign');
			$word->specialties = request('specialties');
			$word->book_id = request('book_id');
			$word->lesson = request('lesson');
			$word->level = request('level');
			$word->comment = request('comment');
			$word->save();
		}
		
		if($oneMore) {
			$response = redirect('/new/verb');
		} else {
			$response = redirect('/view/verb/'.$word->id.'/hu');
		}
		
		// save some values to cookies
		$this->saveSomeFieldsInCookies($response, $word);
		
		return $response;
	}
	
	private function createVerb() {
	
		// dd(request()->all());
	
		$word = Verb::create(request([
				's1',
				's2',
				's3',
				'm1',
				'm2',
				'm3',
				'foreign',
				'hu',
				'specialties',
				'book_id',
				'lesson',
				'level',
				'comment'
		]));
		
		return $word;
	}
	
	
	public function showAdjective($id, $fromLng, $count = 1) {
	
		$word = DB::table('adjectives')
		->join('books', 'adjectives.book_id', '=', 'books.id')
		->where('adjectives.id', '=', $id)
		->select('adjectives.*', 'books.title as bookTitle', 'books.language as foreignlangcode')
		->first();
	
		if(is_null($word)) {
			App::abort(404);
		}
	
		return view('words.adjective', [
				'word' => $word,
				'type' => 'melléknév',
				'count' => $count,
				'from' => $fromLng,
				'editUrl' => '/edit/adjective/'.$word->id
		]);
	}
	
	
	public function newAdjective(Request $request) {
		$word = new Adjective();
		$this->retrieveAndPrePopulateFromCookieValues($request, $word);
		return view('words.adjective-form', ['word'=>$word, 'title' => 'Új melléknév rögzítése', 'selectedBookId' => $word->book_id]);
	}
	
	public function editAdjective($id) {
		$word = Adjective::find($id);
		if(is_null($word)) {
			App::abort(404);
		}
		//dd($word);
		return view('words.adjective-form', ['word'=>$word, 'title' => 'Melléknév módosítása', 'selectedBookId' => $word->book_id]);
	}
	
	
	public function saveAdjective() {
	
		$oneMore = false;
		
		if(empty(request('id'))) {
			$word = $this->createAdjective();
			$oneMore = !empty(request('one-more'));
		} else {
			$word = Adjective::find(request('id'));
			if(is_null($word)) {
				App::abort(404);
			}
				
			$word->hu = request('hu');
			$word->foreign = request('foreign');
			$word->specialties = request('specialties');
			$word->book_id = request('book_id');
			$word->lesson = request('lesson');
			$word->level = request('level');
			$word->comment = request('comment');
			$word->save();
	
		}
	
		if($oneMore) {
			$response = redirect('/new/adjective');
		} else {
			$response = redirect('/view/adjective/'.$word->id.'/hu');
		}
		
		// save some values to cookies
		$this->saveSomeFieldsInCookies($response, $word);
		
		return $response;
	}
	
	private function createAdjective() {
	
		// dd(request()->all());
	
		$word = Adjective::create(request([
				'foreign',
				'hu',
				'specialties',
				'book_id',
				'lesson',
				'level',
				'comment'
		]));
	
		return $word;
	
	}
	

	public function showOther($id, $fromLng, $count = 1) {
	
		$word = DB::table('other_words')
		->join('books', 'other_words.book_id', '=', 'books.id')
		->where('other_words.id', '=', $id)
		->select('other_words.*', 'books.title as bookTitle', 'books.language as foreignlangcode')
		->first();
	
		if(is_null($word)) {
			App::abort(404);
		}
	
		return view('words.other_word', [
				'word' => $word,
				'type' => 'szó, '.$word->type,
				'count' => $count,
				'from' => $fromLng,
				'editUrl' => '/edit/other/'.$word->id
		]);
	}
	
	
	public function newOther(Request $request) {
		$word = new OtherWord();
		$this->retrieveAndPrePopulateFromCookieValues($request, $word);
		return view('words.other_word-form', ['word'=>$word, 'title' => 'Új egyéb szó/kifejezés rögzítése', 'selectedBookId' => $word->book_id]);
	}
	
	public function editOther($id) {
		$word = OtherWord::find($id);
		if(is_null($word)) {
			App::abort(404);
		}
		//dd($word);
		return view('words.other_word-form', ['word'=>$word, 'title' => 'Egyéb szó/kifejezés módosítása', 'selectedBookId' => $word->book_id]);
	}
	
	
	public function saveOther() {
	
		$oneMore = false;
		
		if(empty(request('id'))) {
			$word = $this->createOther();
			$oneMore = !empty(request('one-more'));
		} else {
			$word = OtherWord::find(request('id'));
			if(is_null($word)) {
				App::abort(404);
			}
	
			$word->type = request('type');
			$word->hu = request('hu');
			$word->foreign = request('foreign');
			$word->specialties = request('specialties');
			$word->book_id = request('book_id');
			$word->lesson = request('lesson');
			$word->level = request('level');
			$word->comment = request('comment');
			$word->save();
	
		}
	
		if($oneMore) {
			$response = redirect('/new/other');
		} else {
			$response = redirect('/view/other/'.$word->id.'/hu');
		}
		
		// save some values to cookies
		$this->saveSomeFieldsInCookies($response, $word);
		
		return $response;
	}
	
	private function createOther() {
	
		// dd(request()->all());
	
		$word = OtherWord::create(request([
				'type',
				'foreign',
				'hu',
				'specialties',
				'book_id',
				'lesson',
				'level',
				'comment'
		]));
	
		return $word;
	
	}
	
	
	
	
}
