@extends('layouts.main')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card mb-3">
        <div class="card-body">
            <h5 class="card-title">Member: {{ $loan->member->user->name }}</h5>
            <p class="card-text">Loan Status: {{ $loan->status }}</p>
        </div>
    </div>
    <div class="card mt-2">
        <h5 class="card-header">Loaned Books</h5>
        <div class="table-responsive text-nowrap p-3">
            <table class="table" id="example">
                <thead>
                    <tr class="text-nowrap table-dark">
                        <th class="text-white">No</th>
                        <th class="text-white">Book Title</th>
                        <th class="text-white">Loan Date</th>
                        <th class="text-white">Due Date</th>
                        <th class="text-white">Return Date</th>
                        <th class="text-white">Loaned By</th>
                        <th class="text-white">Returned By</th>
                        <th class="text-white">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($loan->loanDetails as $detail)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $detail->book->title }}</td>
                        <td>{{ $detail->loan_date }}</td>
                        <td>{{ $detail->due_date }}</td>
                        <td>{{ $detail->returnDetail->return_date ?? 'Not Returned' }}</td>
                        <td>{{ $detail->user->name ?? 'N/A' }}</td>
                        <td>{{ $detail->returnDetail->user->name ?? 'N/A' }}</td>
                        <td>
                            @if (is_null($detail->returnDetail))
                            <form action="{{ route('loans.return', $detail->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                <button type="submit" class="btn btn-success btn-sm" onclick="return confirm('Are you sure you want to return this book?')">Return</button>
                            </form>
                            @else
                            <span class="badge bg-success">Returned</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
