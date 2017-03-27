
@extends('index')

@section('content')

	
	<h1 class="jumbotron-heading">Új főnév</h1>

	<div class="">

		<form method="POST" action="/noun">
		
			{{ csrf_field() }}
		
	
			<div class="form-group">
				<label>Határozott névelő</label>
				<input class="form-control" type="text" value="" maxlength="64" name="definite_article" />
			</div>
			<div class="form-group">
				<label>Határozatlan névelő</label>
				<input class="form-control" type="text" value="" maxlength="64" name="indefinite_article" />
			</div>
			<div class="form-group">
				<label>Idegen szó</label>
				<input class="form-control" type="text" value="" maxlength="64" name="foreign" />
			</div>
			<div class="form-group">
				<label>Magyarul</label>
				<input class="form-control" type="text" value="" maxlength="64" name="hu" />
			</div>
			<div class="form-group">
				<label>Többesszám</label>
				<input class="form-control" type="text" value="" maxlength="64" name="plural" />
			</div>
			<div class="form-group">
				<label>Specialitás</label>
				<input class="form-control" type="text" value="" maxlength="128"  name="specialties" />
			</div>
			<div class="form-group">
				<label>Könyv</label>
				<select class="form-control" name="book_id">
					@include('helpers.all-books-options')
				</select>
			</div>
			<div class="form-group">
				<label>Lecke</label>
				<input class="form-control" type="number" value="" maxlength="3"  name="lesson" />
			</div>
			<div class="form-group">
				<label>Szint</label>
				<input class="form-control" type="number" value="" maxlength="3"  name="level" />
			</div>
			<div class="form-group">
				<label>Komment</label>
				<textarea class="form-control" name="comment">
				</textarea>
			</div>
		
			<div class="buttons">
				<input type="submit" class="btn btn-primary" value="Mentés" /> <input type="reset" class="btn" value="Mezők ürítése" />
			</div>
		
		
		</form>

	</div>	

@endsection

