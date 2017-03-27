@foreach (\App\Book::orderBy('id')->get() as $book)
    @include('helpers.book-as-select-option', ['book' => $book]);
@endforeach