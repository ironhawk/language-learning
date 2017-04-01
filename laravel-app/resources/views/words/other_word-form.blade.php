
@extends('index')

@section('content')

<script type="text/javascript">
	function copyType(value) {
		var field = document.getElementById('typeField');
		if(field) {
			field.value = value;
		}
	}
</script>
	
	<h1 class="jumbotron-heading">{{ $title }}</h1>

	<div class="">

		<form method="POST" action="/save/other">
		
			{{ csrf_field() }}
	
			<input type="hidden" value="{{ $word->id }}" name="id" />	
	
			<div class="form-group">
				<label>Típus</label>
				<p>
					<select onchange="copyType(this.value);" _focus="1">
						<option value="">-- gyors választás --</option>
						<option value="kérdőszó">kérdőszó</option>
						<option value="kifejezés">kifejezés</option>
						<option value="határozó">határozó</option>
						<option value="képző">képző</option>
						<option value="névmás">névmás</option>
						<option value="kötőszó">kötőszó</option>
						<option value="mennyiség">mennyiség</option>
						<option value="egyéb">egyéb</option>
					</select>
				</p>
				<input class="form-control" type="text" value="{{ $word->type }}" id="typeField" maxlength="16" name="type" />
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

