	<h2 class="jumbotron-heading">Gyakorlás indítása</h2>
	
	<div class="">

		<form method="POST" action="/practice/start">
		
			{{ csrf_field() }}
	
			<div class="form-group">
				<label>Könyv</label>
				<select class="form-control" name="bookId">
					@include('helpers.all-books-options')
				</select>
			</div>
			<div class="form-group">
				<label>Kezdő lecke</label>
				<input class="form-control" type="number" value="" name="fromSection" />
			</div>
			<div class="form-group">
				<label>Befejező lecke</label>
				<input class="form-control" type="number" value="" name="toSection" />
			</div>
			<div class="form-group">
				<label>Típusok</label>
				<div class="form-control">
					<input type="checkbox" checked id="nouns" name="nouns" /> <label for="nouns">főnevek</label><br/>
					<input type="checkbox" checked id="verbs" name="verbs" /> <label for="verbs">igék</label><br/>
					<input type="checkbox" checked id="adjs" name="adjs" /> <label for="adjs">melléknevek</label><br/>
					<input type="checkbox" checked id="others" name="others" /> <label for="others">kifejezések</label><br/>
				</div>
				
			</div>
		
			<div class="buttons">
				<input type="submit" class="btn btn-primary" value="Indítás" /> <input type="reset" class="btn" value="Mezők ürítése" />
			</div>
		
		
		</form>

	</div>	


