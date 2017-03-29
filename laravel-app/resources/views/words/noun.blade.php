
@extends('words.word')

@section('word')

	@if ($from == 'hu') 
		<p class="word">{{ $word->hu }}<p>
		<div id="to-{{ $word->id }}" class="hidden">
			<p class="word">{{ $word->definite_article }} {{ $word->foreign }} @if(!empty($word->plural)) ({{ $word->plural }}) @endif<p>
		</div>
	@else
		<p class="word">{{ $word->definite_article }} {{ $word->foreign }} @if(!empty($word->plural)) ({{ $word->plural }}) @endif<p>
		<div id="to-{{ $word->id }}" class="hidden">
		<p class="word">{{ $word->hu }}<p>
		</div>
	@endif

@endsection
