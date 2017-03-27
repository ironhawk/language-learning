
@extends('words.word')

@section('word')

	@if ($from == 'hu') 
		<p class="word">{{ $word->hu }}<p>
		<div id="to-{{ $word->id }}" class="hidden">
			<p class="word">{{ $word->definite_article }} {{ $word->foreign }} ({{ $word->plural }})<p>
		</div>
	@else
		<p class="word">{{ $word->definite_article }} {{ $word->foreign }} ({{ $word->plural }})<p>
		<div id="to-{{ $word->id }}" class="hidden">
		<p class="word">{{ $word->hu }}<p>
		</div>
	@endif

@endsection
