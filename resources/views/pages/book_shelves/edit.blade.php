@extends('layouts.main')

@section('content')
<div class="container">
    <h1>Edit BookShelf</h1>
    <form action="{{ route('book_shelves.update', $bookShelf->id) }}" method="POST">
        @csrf
        @method('PATCH')
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $bookShelf->name }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
