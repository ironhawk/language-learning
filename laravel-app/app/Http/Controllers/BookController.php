<?php

namespace App\Http\Controllers;

use App\Noun;
use App\Verb;
use App\Adjective;
use App\OtherWord;
use App\Book;
use Illuminate\Support\Facades\App;

class BookController extends Controller
{
	

	public function showWordList($bookId) {
		
		$book = Book::where('id', '=', $bookId)->first();
		if(is_null($book)) {
			App::abort(404);
		}
		
		
		$nouns = Noun::where('book_id', '=', $bookId)->orderBy('lesson')->orderBy('foreign')->get();
		$verbs = Verb::where('book_id', '=', $bookId)->orderBy('lesson')->orderBy('foreign')->get();
		$adjectives = Adjective::where('book_id', '=', $bookId)->orderBy('lesson')->orderBy('foreign')->get();
		$others = OtherWord::where('book_id', '=', $bookId)->orderBy('lesson')->orderBy('foreign')->get();

		//dd($nouns);
		
		
		// organize into lessons
		$lessons = [];
		$this->addToLessons($lessons, "nouns", $nouns);
		$this->addToLessons($lessons, "verbs", $verbs);
		$this->addToLessons($lessons, "adjectives", $adjectives);
		$this->addToLessons($lessons, "others", $others);
		
		return view('list.word-list', [
			'book' => $book,
			'lessons' => $lessons
		]);
	}
	
	
	private function addToLessons(&$lessons, $type, $words) {
		
		foreach($words as $word) {
			$lessonId = "".$word->lesson;
			if($lessonId == 'null') {
				$lessonId = '0';
			}
			
			if(!array_key_exists($lessonId, $lessons)) {
				$lessons[$lessonId] = [];
			}
			if(!array_key_exists($type, $lessons[$lessonId])) {
				$lessons[$lessonId][$type] = [];
			}
			$lessons[$lessonId][$type][] = $word;
		}
		
	}
	
}
