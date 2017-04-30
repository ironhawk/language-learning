
@extends('index')

@section('content')

	
	<h1 class="jumbotron-heading">{{ $title }}</h1>

	<div class="">

		<form method="POST" action="/save/noun">
		
			{{ csrf_field() }}
	
			<input type="hidden" value="{{ $word->id }}" name="id" />	
	
			<div class="form-group">
				<label>Határozott névelő</label>
				<input class="form-control" type="text" value="{{ $word->definite_article }}" maxlength="64" name="definite_article"  _focus="1"/>
			</div>
			<div class="form-group">
				<label>Idegen szó</label>
				<input class="form-control" type="text" value="{{ $word->foreign }}" maxlength="64" name="foreign" />
			</div>
			<div class="form-group">
				<label>Magyarul</label>
				<input class="form-control" type="text" value="{{ $word->hu }}" maxlength="64" name="hu" />
			</div>
			<div class="form-group">
				<label>Többesszám</label>
				<input class="form-control" type="text" value="{{ $word->plural }}" maxlength="64" name="plural" />
			</div>
			<div class="form-group">
				<label>Specialitás</label>
				<input class="form-control" type="text" value="{{ $word->specialties }}" maxlength="128"  name="specialties" />
			</div>
			<div class="form-group">
				<label>Könyv</label>
				<select class="form-control" name="book_id">
					@include('helpers.all-books-options')
				</select>
			</div>
			<div class="form-group">
				<label>Lecke</label>
				<input class="form-control" type="number" value="{{ $word->lesson }}" maxlength="3"  name="lesson" />
			</div>
			<div class="form-group">
				<label>Szint</label>
				<input class="form-control" type="number" value="{{ $word->level }}" maxlength="3"  name="level" />
			</div>
			<div class="form-group">
				<label>Komment</label>
				<textarea class="form-control" name="comment">{{ $word->comment }}</textarea>
			</div>
		
			<div class="buttons">
				<input type="submit" class="btn btn-primary" value="Mentés" /> <input type="reset" class="btn" value="Mezők alaphelyzetbe" />
			</div>
		
		
		</form>

	</div>	

@endsection

