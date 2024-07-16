@extends('layouts.main')

@section('content')
<!-- Content -->
<div class="container-xxl flex-grow-1 container-p-y">
  <div class="card">
    <div class="card-header">
      <a href="{{ route('loans.create') }}" class="btn btn-primary btn-sm">Create</a>
    </div>
  </div>
  <div class="card mt-2">
    <h5 class="card-header">Table Loans</h5>
    <div class="table-responsive text-nowrap p-3">
      <table class="table" id="example">
        <thead>
          <tr class="text-nowrap table-dark">
            <th class="text-white">No</th>
            <th class="text-white">Member</th>
            <th class="text-white">Loan Date</th>
            <th class="text-white">Due Date</th>
            <th class="text-white">Return Date</th>
            <th class="text-white">Books</th>
            <th class="text-white">Status</th>
            <th class="text-white">Actions</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($loans as $loan)
          <tr>
            <th scope="row">{{ $loop->iteration }}</th>
            <td>{{ $loan->member->user->name }}</td>
            <td>{{ $loan->loanDetails->first()->loan_date ?? 'N/A' }}</td>
            <td>{{ $loan->loanDetails->first()->due_date ?? 'N/A' }}</td>
            <td>{{ $loan->returnDetail->return_date ?? 'N/A' }}</td>
            <td>
              <ul>
              @foreach ($loan->loanDetails as $detail)
                <li>{{ $detail->book->title }}</li>
              @endforeach
            </ul>
            </td>
            <td>
              @if ($loan->status == 'completed')
                <span class="badge bg-success">Completed</span>
              @else
                <span class="badge bg-warning">Active</span>
              @endif
            </td>
            <td>
              <a href="{{ route('loans.edit', $loan->id) }}" class="btn btn-warning btn-sm">Edit</a>
              <a href="{{ route('loans.show', $loan->id) }}" class="btn btn-info btn-sm">Details</a>
              <form action="{{ route('loans.destroy', $loan->id) }}" method="POST" style="display:inline-block;">
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
