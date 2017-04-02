@extends('index')

@section('content')

	<div class="words-list">

		<h1 class="jumbotron-heading">{{ $book->title }}</h1>
		
		<table class="words">
		
		@foreach($lessons as $lessonId => $words)
			
			<tr class="lesson">
				<td colspan="3">
					<h2 class="jumbotron-heading">{{ $lessonId }}. lecke</h2>
				</td>
			</tr>
			
			@foreach($words as $type => $wordList)
			
				<tr class="type">
					<td></td>
					<td colspan="2">
						<h3>{{ $type }}</h3>
					</td>
				</tr>

				@foreach($wordList as $word)
				
					<tr>
						<td class="left"></td>
						
						@if( $type == 'nouns')
							@include('list.noun')
						@elseif( $type == 'verbs')
							@include('list.verb')
						@elseif( $type == 'adjectives')
							@include('list.adjective')
						@else
							@include('list.other')
						@endif
						
					</tr>
					
				
				@endforeach

			
			@endforeach
		
		@endforeach
		
		</table>
	
	</div>

@endsection

