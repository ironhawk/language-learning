@extends('index')

@section('content')

	
	<h1 class="jumbotron-heading">{{ $word->bookTitle }}</h1>
	<h2 class="jumbotron-heading">{{ $count }}. szó ({{ $type }})</h2>

	<p>Lecke: {{ $word->lesson }} - szint: {{ $word->level }}</p>

	@yield('word')
	
	<div class="buttons">
		<input type="button" class="btn btn-primary" value="Mutasd!" id="showButton-{{ $word->id }}" onclick="show(['to-{{ $word->id }}', 'hideButton-{{ $word->id }}']); hide('showButton-{{ $word->id }}')" />
		<input type="button" class="btn hidden" value="Elrejt" id="hideButton-{{ $word->id }}" onclick="hide(['to-{{ $word->id }}', 'hideButton-{{ $word->id }}']); show('showButton-{{ $word->id }}')" />
		@if (isset($next))
		<input type="button" class="btn" value=">> Következő >>" onclick="window.location.href = '{{ $next }}';" />
		@endif
	</div>

@endsection
