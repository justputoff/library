@extends('layouts.main')

@section('content')
<div class="container">
    <h1>Edit Book</h1>
    <form action="{{ route('books.update', $book->id) }}" method="POST">
        @csrf
        @method('PATCH')
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ $book->title }}" required>
            </div>
            <div class="col-md-6">
                <label for="author" class="form-label">Author</label>
                <input type="text" class="form-control" id="author" name="author" value="{{ $book->author }}" required>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="publisher" class="form-label">Publisher</label>
                <input type="text" class="form-control" id="publisher" name="publisher" value="{{ $book->publisher }}" required>
            </div>
            <div class="col-md-6">
                <label for="year_published" class="form-label">Year Published</label>
                <input type="number" class="form-control" id="year_published" name="year_published" value="{{ $book->year_published }}" required>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="isbn" class="form-label">ISBN</label>
                <input type="text" class="form-control" id="isbn" name="isbn" value="{{ $book->isbn }}" required>
            </div>
            <div class="col-md-6">
                <label for="quantity" class="form-label">Quantity</label>
                <input type="number" class="form-control" id="quantity" name="quantity" value="{{ $book->quantity }}" required>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
