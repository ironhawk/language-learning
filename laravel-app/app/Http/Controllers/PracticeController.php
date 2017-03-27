<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PracticeController extends Controller
{
	
	private static $typeViews = [
		'nouns' => 'words.noun',
		'verbs' => 'words.verb',
		'adjectives' => 'words.adjective',
		'others' => 'words.other',
	];
	private static $typeNames = [
		'nouns' => 'főnév',
		'verbs' => 'ige',
		'adjectives' => 'melléknév',
		'others' => 'kifejezés',
	];
	
	public function showForm() {
		return view('practice.practice');
	}

	public function start() {
	
		//dd(request()->all());
		
		$urlParts = ['/practice'];
		
		$types = [];
		if(request('nouns'))
			$types[] = 'nouns';
		if(request('verbs'))
			$types[] = 'verbs';
		if(request('adjs'))
			$types[] = 'adjectives';
		if(request('others'))
			$types[] = 'others';
		$urlParts[] = implode('-', $types);
		
		$urlParts[] = 'rndLang';
		
		$urlParts[] = request('bookId');
		
		if( request('fromSection') || request('toSection')) {
			$urlParts[] = request('fromSection') ? request('fromSection') : '1';
			$urlParts[] = request('toSection') ? request('toSection') : '1000';
		}
			
		return redirect(implode('/', $urlParts));
	}

	
	public function showWord($types, $fromLng = 'rndLang', $bookId = null, $fromLesson = null, $toLesson = null) {

		$types = explode('-', $types);
		// kell egy tipus veletlenszeruen
		$typeIdx = mt_rand(1, count($types));
		$type = $types[$typeIdx-1];
		
		//dd($type);
		
		// veletlen nyelvvalasztas?
		if($fromLng == 'rndLang') {
			$rndNum = mt_rand(0, 100);
			if($rndNum < 50) {
				$fromLng = 'hu';
			} else {
				$fromLng = 'foreign';
			}
		}
		
		$query = DB::table($type)
		->join('books', $type.'.book_id', '=', 'books.id');
		if(!is_null($bookId)) {
			$query = $query->where($type.'.book_id', '=', $bookId);
		}
		
		if(!is_null($fromLesson)) {
			$query = $query->where($type.'.lesson', '>=', $fromLesson);
		}
		if(!is_null($toLesson)) {
			$query = $query->where($type.'.lesson', '<=', $toLesson);
		}
		
		$words = $query		
		->select($type.'.*', 'books.title as bookTitle')
		->get();

		if(count($words) > 0) {
			$word = $words[mt_rand(1, count($words))-1];
			$count = request('count');
			if(is_null($count))
				$count = 1;
				$nextUri = '/' . request()->path() . '?count='.($count+1);
					
					
				$template = static::$typeViews[$type];
				return view($template, [
						'word' => $word,
						'type' => static::$typeNames[$type],
						'count' => $count,
						'from' => $fromLng,
						'next' => $nextUri
				]);
		}
		
		// ejjjh nincs szó!
		return view('practice.oops-empty');
		
	
	}
	
	
}
