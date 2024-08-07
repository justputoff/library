@extends('layouts.main')

@section('content')
<div class="container">
    <h1>Create BookShelf</h1>
    <form action="{{ route('book_shelves.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <button type="submit" class="btn btn-primary">Create</button>
    </form>
</div>
@endsection
