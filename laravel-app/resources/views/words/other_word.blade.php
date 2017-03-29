
@extends('words.word')

@section('word')

	@if ($from == 'hu') 
		<p class="word">{{ $word->hu }}<p>
		<div id="to-{{ $word->id }}" class="hidden">
			<p class="word">{{ $word->foreign }} @if(!empty($word->specialties)) ({{ $word->specialties }}) @endif<p>
		</div>
	@else
		<p class="word">{{ $word->foreign }} @if(!empty($word->specialties)) ({{ $word->specialties }}) @endif<p>
		
		<div id="to-{{ $word->id }}" class="hidden">
			<p class="word">{{ $word->hu }}<p>
		</div>
	@endif

@endsection


