
@extends('words.word')

@section('word')

	@if ($from == 'hu') 
		<p class="word">{{ $word->hu }}<p>
		<div id="to-{{ $word->id }}" class="hidden">
			<p class="word">{{ $word->foreign }} ({{ $word->specialties }})<p>
			
			@include('words.verb-ragozas', ['word' => $word])
			
		</div>
	@else
		<p class="word">{{ $word->foreign }} ({{ $word->specialties }})<p>
		
		<div id="to-{{ $word->id }}" class="hidden">
			<p class="word">{{ $word->hu }}<p>
	
			@include('words.verb-ragozas', ['word' => $word])
		</div>
	@endif

@endsection


