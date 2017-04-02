@extends('index')

@section('content')

	
	<h1 class="jumbotron-heading">Hello!</h1>
	
	<p>Mit szeretnél csinálni? Válassz!</p>

	<h2 class="jumbotron-heading">Szólista</h1>
	<p>
	@foreach(\App\Book::all() as $book)
		<a href="/view/book/{{ $book->id }}">{{ $book->title }} - szavak</a><br/>
	@endforeach
	</p>

	
	<h2 class="jumbotron-heading">Gyakorlás</h1>
	<p>
		<a href="/practice/start">Szavak, kifejezések (szótár) gyakorlása</a>
	</p>

@endsection


