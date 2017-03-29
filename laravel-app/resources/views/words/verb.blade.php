
@extends('words.word')

@section('word')

	@if ($from == 'hu') 
		<p class="word">{{ $word->hu }}<p>
		<div id="to-{{ $word->id }}" class="hidden">
			<p class="word">{{ $word->foreign }} @if(!empty($word->specialties)) ({{ $word->specialties }}) @endif<p>
			
			@include('words.verb-ragozas', ['word' => $word])
			
		</div>
	@else
		<p class="word">{{ $word->foreign }} @if(!empty($word->specialties)) ({{ $word->specialties }}) @endif<p>
		
		<div id="to-{{ $word->id }}" class="hidden">
			<p class="word">{{ $word->hu }}<p>
	
			@include('words.verb-ragozas', ['word' => $word])
		</div>
	@endif
	<p><a href="http://hu.bab.la/igeragoz%C3%A1s/n%C3%A9met/{{ $word->foreign }}" target="_blank">hu.bab.la link</a></p>

@endsection


