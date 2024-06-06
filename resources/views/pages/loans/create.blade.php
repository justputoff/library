@extends('layouts.main')

@section('content')
<div class="container">
    <h1>Create Loan</h1>
    <form action="{{ route('loans.store') }}" method="POST">
        @csrf
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="member_id" class="form-label">Member</label>
                <select class="form-control" id="member_id" name="member_id" required>
                    @foreach($members as $member)
                        <option value="{{ $member->id }}">{{ $member->user->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-12">
                <label for="books" class="form-label">Books</label>
                <table class="table" id="booksTable">
                    <thead>
                        <tr>
                            <th>Book</th>
                            <th>Loan Date</th>
                            <th>Due Date</th>
                            <th>Quantity</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <select class="form-control" name="books[0][book_id]" required>
                                    @foreach($books as $book)
                                        <option value="{{ $book->id }}">{{ $book->title }}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td><input type="date" class="form-control" name="books[0][loan_date]" value="{{ date('Y-m-d') }}" required></td>
                            <td><input type="date" class="form-control" name="books[0][due_date]" required></td>
                            <td><input type="number" class="form-control" name="books[0][quantity]" required></td>
                            <td><button type="button" class="btn btn-danger btn-sm remove-book">Remove</button></td>
                        </tr>
                    </tbody>
                </table>
                <button type="button" class="btn btn-success btn-sm" id="addBook">Add Book</button>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Create</button>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        let bookIndex = 1;

        document.getElementById('addBook').addEventListener('click', function () {
            const tableBody = document.querySelector('#booksTable tbody');
            const newRow = document.createElement('tr');

            newRow.innerHTML = `
                <td>
                    <select class="form-control" name="books[${bookIndex}][book_id]" required>
                        @foreach($books as $book)
                            <option value="{{ $book->id }}">{{ $book->title }}</option>
                        @endforeach
                    </select>
                </td>
                <td><input type="date" class="form-control" name="books[${bookIndex}][loan_date]" value="{{ date('Y-m-d') }}" required></td>
                <td><input type="date" class="form-control" name="books[${bookIndex}][due_date]" required></td>
                <td><input type="number" class="form-control" name="books[${bookIndex}][quantity]" required></td>
                <td><button type="button" class="btn btn-danger btn-sm remove-book">Remove</button></td>
            `;

            tableBody.appendChild(newRow);
            bookIndex++;
        });

        document.querySelector('#booksTable').addEventListener('click', function (e) {
            if (e.target.classList.contains('remove-book')) {
                e.target.closest('tr').remove();
            }
        });
    });
</script>
@endsection
