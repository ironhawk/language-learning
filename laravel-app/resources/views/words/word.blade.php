@extends('index')

@section('content')

	
	<h1 class="jumbotron-heading">{{ $word->bookTitle }}</h1>
	<h2 class="jumbotron-heading">{{ $count }}. szó ({{ $type }})</h2>

	<p>Lecke: {{ $word->lesson }} - szint: {{ $word->level }}</p>

	@yield('word')

	@if( !empty($word->comment) )
		<p class="hidden comment" id="comment">
			Megjegyzés:<br/>
			{{ $word->comment }}
		</p>
	@endif

	<p class="links">Generikus linkek:<br/>
		@if($word->foreignlangcode == 'de')
		<a class="external" href="https://dictzone.com/nemet-magyar-szotar/{{ $word->foreign }}" target="_blank">német szótár kiejtéssel - idegen szóval linkelve</a><br/>
		<a class="external" href="https://dictzone.com/magyar-nemet-szotar/{{ $word->hu }}" target="_blank">német szótár kiejtéssel - magyar szóval linkelve</a>
		@endif
	</p>

	
	<div class="buttons">
		<input type="button" class="btn btn-primary" value="Mutasd!" id="showButton-{{ $word->id }}" onclick="show(['to-{{ $word->id }}', 'comment', 'hideButton-{{ $word->id }}']); hide('showButton-{{ $word->id }}')" />
		<input type="button" class="btn hidden" value="Elrejt" id="hideButton-{{ $word->id }}" onclick="hide(['to-{{ $word->id }}', 'comment', 'hideButton-{{ $word->id }}']); show('showButton-{{ $word->id }}')" />
		<input type="button" class="btn" value="Szerkesztés" onclick="document.location.href = '{{ $editUrl }}';" />
		@if (isset($next))
		<input type="button" _focus="1" class="btn btn-primary" value=">> Következő >>" onclick="window.location.href = '{{ $next }}';" />
		@endif
	</div>

@endsection

