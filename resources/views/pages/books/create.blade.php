@extends('layouts.main')

@section('content')
<div class="container">
    <h1>Create Book</h1>
    <form action="{{ route('books.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" id="title" name="title" required>
            </div>
            <div class="col-md-6">
                <label for="author" class="form-label">Author</label>
                <input type="text" class="form-control" id="author" name="author" required>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="publisher" class="form-label">Publisher</label>
                <input type="text" class="form-control" id="publisher" name="publisher" required>
            </div>
            <div class="col-md-6">
                <label for="year_published" class="form-label">Year Published</label>
                <input type="number" class="form-control" id="year_published" name="year_published" required>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="isbn" class="form-label">ISBN</label>
                <input type="text" class="form-control" id="isbn" name="isbn" required>
            </div>
            <div class="col-md-6">
                <label for="quantity" class="form-label">Quantity</label>
                <input type="number" class="form-control" id="quantity" name="quantity" required>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="book_shelf_id" class="form-label">Book Shelf</label>
                <select class="form-control" id="book_shelf_id" name="book_shelf_id" required>
                    @foreach($bookShelves as $bookShelf)
                        <option value="{{ $bookShelf->id }}">{{ $bookShelf->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-6">
                <label for="cover" class="form-label">Cover</label>
                <input type="file" class="form-control" id="cover" name="cover">
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Create</button>
    </form>
</div>
@endsection
