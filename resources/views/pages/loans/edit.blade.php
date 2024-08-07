@extends('layouts.main')

@section('content')
<div class="container">
    <h1>Edit Loan</h1>
    <form action="{{ route('loans.update', $loan->id) }}" method="POST">
        @csrf
        @method('PATCH')
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="member_id" class="form-label">Member</label>
                <select class="form-control" id="member_id" name="member_id" required>
                    @foreach($members as $member)
                        <option value="{{ $member->id }}" {{ $loan->member_id == $member->id ? 'selected' : '' }}>{{ $member->user->name }}</option>
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
                        @foreach($loan->loanDetails as $index => $detail)
                        <tr>
                            <td>
                                <select class="form-control" name="books[{{ $index }}][book_id]" required>
                                    @foreach($books as $book)
                                        <option value="{{ $book->id }}" {{ $detail->book_id == $book->id ? 'selected' : '' }}>{{ $book->title }}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td><input type="date" class="form-control" name="books[{{ $index }}][loan_date]" value="{{ $detail->loan_date }}" required></td>
                            <td><input type="date" class="form-control" name="books[{{ $index }}][due_date]" value="{{ $detail->due_date }}" required></td>
                            <td><input type="number" class="form-control" name="books[{{ $index }}][quantity]" value="{{ $detail->quantity }}" required></td>
                            <td><button type="button" class="btn btn-danger btn-sm remove-book">Remove</button></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <button type="button" class="btn btn-success btn-sm" id="addBook">Add Book</button>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        let bookIndex = {{ count($loan->loanDetails) }};
        const booksTable = document.getElementById('booksTable').getElementsByTagName('tbody')[0];
        const addBookButton = document.getElementById('addBook');

        addBookButton.addEventListener('click', function () {
            const newRow = booksTable.insertRow();
            newRow.innerHTML = `
                <tr>
                    <td>
                        <select class="form-control" name="books[${bookIndex}][book_id]" required>
                            @foreach($books as $book)
                                <option value="{{ $book->id }}">{{ $book->title }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td><input type="date" class="form-control" name="books[${bookIndex}][loan_date]" required></td>
                    <td><input type="date" class="form-control" name="books[${bookIndex}][due_date]" required></td>
                    <td><input type="number" class="form-control" name="books[${bookIndex}][quantity]" required></td>
                    <td><button type="button" class="btn btn-danger btn-sm remove-book">Remove</button></td>
                </tr>
            `;
            bookIndex++;
        });

        booksTable.addEventListener('click', function (event) {
            if (event.target.classList.contains('remove-book')) {
                event.target.closest('tr').remove();
            }
        });
    });
</script>
@endsection
