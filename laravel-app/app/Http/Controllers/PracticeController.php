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
		'other_words' => 'words.other_word',
	];
	private static $typeEditUrls = [
			'nouns' => '/edit/noun/',
			'verbs' => '/edit/verb/',
			'adjectives' => '/edit/adjective/',
			'other_words' => '/edit/other/',
	];
	private static $typeNames = [
		'nouns' => 'főnév',
		'verbs' => 'ige',
		'adjectives' => 'melléknév',
		'other_words' => 'szó/kifejezés',
	];
	
	public function showForm() {
		return view('practice.practice');
	}

	public function start() {
	
		//dd(request()->all());
		
		$urlParts = ['/practice'];
		
		// random vagy linear?
		$urlParts[] = request('mode');
		
		$types = [];
		if(request('nouns'))
			$types[] = 'nouns';
		if(request('verbs'))
			$types[] = 'verbs';
		if(request('adjs'))
			$types[] = 'adjectives';
		if(request('others'))
			$types[] = 'other_words';
		$urlParts[] = implode('-', $types);
		
		$urlParts[] = request('lngMode');
		
		$urlParts[] = request('bookId');
		
		if( request('fromSection') || request('toSection')) {
			$urlParts[] = request('fromSection') ? request('fromSection') : '1';
			$urlParts[] = request('toSection') ? request('toSection') : '1000';
		}
			
		return redirect(implode('/', $urlParts));
	}

	
	public function showWordsRandom($types, $fromLng = null, $bookId = null, $fromLesson = null, $toLesson = null) {

		$wordCounts = $this->getWordCountsMatchingFilter($bookId, $fromLesson, $toLesson);
		
		$types = explode('-', $types);
		
		// olyan típust ne vegyünk be amiben nincs szó
		$typesWithWords = [];
		foreach($types as $type) {
			if($wordCounts[$type] > 0) {
				$typesWithWords[] = $type;
			}
		}
		if(empty($typesWithWords)) {
			return view('practice.oops-empty');
		}
		
		// kell egy tipus veletlenszeruen
		$typeIdx = mt_rand(1, count($typesWithWords));
		$type = $typesWithWords[$typeIdx-1];
		
		$fromLng = $this->getFromLangFromRequest($fromLng);
		
		$query = DB::table($type)
		->join('books', $type.'.book_id', '=', 'books.id');
		$query = $this->addFiltersToQuery($query, $type, $bookId, $fromLesson, $toLesson);
		
		$word = $query
		->select($type.'.*', 'books.title as bookTitle')
		->selectRaw('random() as rnd')
		->orderBy('rnd')
		->first();

		if(!is_null($word)) {
			
			//$word = $words[mt_rand(1, count($words))-1];
			$count = request('count');
			if(is_null($count)) {
				$count = 1;
			}
				
			$nextUri = '/' . request()->path() . '?count='.($count+1);
				
		
			$typeName = static::$typeNames[$type];
			if(isset($word->type)) {
				$typeName .= ", ".$word->type;
			}
				
			$template = static::$typeViews[$type];
			return view($template, [
					'word' => $word,
					'type' => $typeName,
					'count' => $count,
					'from' => $fromLng,
					'next' => $nextUri,
					'editUrl' => static::$typeEditUrls[$type] . $word->id
			]);
		}
		
		// ejjjh nincs szó!
		return view('practice.oops-empty');
	}
	
	private function getFromLangFromRequest($fromLng) {
		// veletlen nyelvvalasztas?
		if(is_null($fromLng) || $fromLng == 'rndLang') {
			$rndNum = mt_rand(0, 100);
			if($rndNum < 50) {
				$fromLng = 'hu';
			} else {
				$fromLng = 'foreign';
			}
		}
		return $fromLng;
	}

	
	public function showWordsLinear($types, $fromLng = null, $bookId = null, $fromLesson = null, $toLesson = null) {
	
		// hanyadik szo kell?
		$desiredIdx = request('idx');
		if(is_null($desiredIdx)) {
			$desiredIdx = 1;
		}
		$idxWithinSelected = $desiredIdx;

		$types = explode('-', $types);
		
		$wordCounts = $this->getWordCountsMatchingFilter($bookId, $fromLesson, $toLesson);
		$totalCount = 0;
		$nonZeroTypes = [];
		$selectedType = null;
		foreach($wordCounts as $type => $count) {
			if(in_array($type, $types)) {

				if($count > 0) {
					$nonZeroTypes[$type] = $count;
					
					$totalCount += $count;
					
					if(is_null($selectedType) && $totalCount >= $desiredIdx) {
						// OK éppen átléptük a cuccot - ez a típus
						$selectedType = $type;
					}
					if(is_null($selectedType)) {
						$idxWithinSelected -= $count;
					}
				}
			}
		}
		//dd("$selectedType, idx: $idxWithinSelected");
		
		// OK kifogytunk?
		if(is_null($selectedType)) {
			return view('practice.nomorewords-empty');
		}
	
		$fromLng = $this->getFromLangFromRequest($fromLng);
	
		$query = DB::table($selectedType)
		->join('books', $selectedType.'.book_id', '=', 'books.id');
		$query = $this->addFiltersToQuery($query, $selectedType, $bookId, $fromLesson, $toLesson);
		
		
		$words = $query
		->select($selectedType.'.*', 'books.title as bookTitle')
		->orderBy($selectedType.'.id')
		->get();
	
		if(count($words) > 0) {
			$word = $words[$idxWithinSelected-1];
				
				$nextUri = '/' . request()->path() . '?idx='.($desiredIdx+1);
					
				$typeName = static::$typeNames[$selectedType];
				if(isset($word->type)) {
					$typeName .= ", ".$word->type;
				}
				
				$template = static::$typeViews[$selectedType];
				return view($template, [
						'word' => $word,
						'type' => $typeName,
						'count' => $desiredIdx,
						'from' => $fromLng,
						'next' => $nextUri,
						'editUrl' => static::$typeEditUrls[$selectedType] . $word->id
				]);
		}
	
		// ejjjh nincs szó! de ide kurvára nem kéne eljutnunk...
		dd("Hoppá! Ide nem kellett volna eljutni...");
		return view('practice.oops-empty');
	}
	
	
	private function addFiltersToQuery($query, $type, $bookId, $fromLesson, $toLesson) {
		if(!is_null($bookId)) {
			$query = $query->where($type.'.book_id', '=', $bookId);
		}
		
		if(!is_null($fromLesson)) {
			$query = $query->where($type.'.lesson', '>=', $fromLesson);
		}
		if(!is_null($toLesson)) {
			$query = $query->where($type.'.lesson', '<=', $toLesson);
		}
		
		return $query;
	}
	
	
	private function getWordCountsMatchingFilter($bookId, $fromLesson, $toLesson) {
		
		$counts = [];
		
		$count = $this->addFiltersToQuery(DB::table('nouns'), 'nouns', $bookId, $fromLesson, $toLesson)
		->selectRaw('count(*)')
		->first()->count;
		$counts['nouns'] = intval($count);

		$count = $this->addFiltersToQuery(DB::table('verbs'), 'verbs', $bookId, $fromLesson, $toLesson)
		->selectRaw('count(*)')
		->first()->count;
		$counts['verbs'] = intval($count);

		$count = $this->addFiltersToQuery(DB::table('adjectives'), 'adjectives', $bookId, $fromLesson, $toLesson)
		->selectRaw('count(*)')
		->first()->count;
		$counts['adjectives'] = intval($count);

		$count = $this->addFiltersToQuery(DB::table('other_words'), 'other_words', $bookId, $fromLesson, $toLesson)
		->selectRaw('count(*)')
		->first()->count;
		$counts['other_words'] = intval($count);
		
		//dd($counts);
		
		return $counts;
	}
	
}
