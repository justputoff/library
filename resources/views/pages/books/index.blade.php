@extends('layouts.main')

@section('content')
<!-- Content -->
<div class="container-xxl flex-grow-1 container-p-y">
  <div class="card">
    <div class="card-header">
      <a href="{{ route('books.create') }}" class="btn btn-primary btn-sm">Create</a>
    </div>
  </div>
  <div class="card mt-2">
    <h5 class="card-header">Table Books</h5>
    <div class="table-responsive text-nowrap p-3">
      <table class="table" id="example">
        <thead>
          <tr class="text-nowrap table-dark">
            <th class="text-white">No</th>
            <th class="text-white">Title</th>
            <th class="text-white">Author</th>
            <th class="text-white">Publisher</th>
            <th class="text-white">Year Published</th>
            <th class="text-white">ISBN</th>
            <th class="text-white">Quantity</th>
            <th class="text-white">Actions</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($books as $book)
          <tr>
            <th scope="row">{{ $loop->iteration }}</th>
            <td>{{ $book->title }}</td>
            <td>{{ $book->author }}</td>
            <td>{{ $book->publisher }}</td>
            <td>{{ $book->year_published }}</td>
            <td>{{ $book->isbn }}</td>
            <td>{{ $book->quantity }}</td>
            <td>
              <a href="{{ route('books.edit', $book->id) }}" class="btn btn-warning btn-sm">Edit</a>
              <form action="{{ route('books.destroy', $book->id) }}" method="POST" style="display:inline-block;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
              </form>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
<!-- / Content -->
@endsection
