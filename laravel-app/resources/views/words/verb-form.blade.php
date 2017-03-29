
@extends('index')

@section('content')

	
	<h1 class="jumbotron-heading">{{ $title }}</h1>

	<div class="">

		<form method="POST" action="/save/verb">
		
			{{ csrf_field() }}
	
			<input type="hidden" value="{{ $word->id }}" name="id" />	
	
			<div class="form-group">
				<label>Idegen szó</label>
				<input class="form-control" type="text" value="{{ $word->foreign }}" maxlength="64" name="foreign" />
			</div>
			<div class="form-group">
				<label>Magyarul</label>
				<input class="form-control" type="text" value="{{ $word->hu }}" maxlength="64" name="hu" />
			</div>
			<div class="form-group">
				<label>Ragozás</label>
				<div class="form-control">
					<table>
						<tr>
							<td>E/1 <input type="text" value="{{ $word->s1 }}" maxlength="64" name="s1" /></td>
							<td>E/2 <input type="text" value="{{ $word->s2 }}" maxlength="64" name="s2" /></td>
							<td>E/3 <input type="text" value="{{ $word->s3 }}" maxlength="64" name="s3" /></td>
						</tr>
						<tr>
							<td>T/1 <input type="text" value="{{ $word->m1 }}" maxlength="64" name="m1" /></td>
							<td>T/2 <input type="text" value="{{ $word->m2 }}" maxlength="64" name="m2" /></td>
							<td>T/3 <input type="text" value="{{ $word->m3 }}" maxlength="64" name="m3" /></td>
						</tr>
					</table>
				</div>
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

