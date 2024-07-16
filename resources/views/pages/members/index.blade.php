@extends('layouts.main')

@section('content')
<!-- Content -->
<div class="container-xxl flex-grow-1 container-p-y">
  <div class="card">
    <div class="card-header">
      <a href="{{ route('members.create') }}" class="btn btn-primary btn-sm">Create</a>
    </div>
  </div>
  <div class="card mt-2">
    <h5 class="card-header">Table Members</h5>
    <div class="table-responsive text-nowrap p-3">
      <table class="table" id="example">
        <thead>
          <tr class="text-nowrap table-dark">
            <th class="text-white">No</th>
            <th class="text-white">Name</th>
            <th class="text-white">Email</th>
            <th class="text-white">Address</th>
            <th class="text-white">Phone</th>
            <th class="text-white">Status</th>
            <th class="text-white">Actions</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($members as $member)
          <tr>
            <th scope="row">{{ $loop->iteration }}</th>
            <td>{{ $member->user->name }}</td>
            <td>{{ $member->user->email }}</td>
            <td>{{ $member->address }}</td>
            <td>{{ $member->phone }}</td>
            <td>
              <form action="{{ route('members.updateStatus', $member->id) }}" method="POST" style="display:inline-block;">
                @csrf
                @method('PATCH')
                <input type="hidden" name="status" value="{{ $member->status == 'active' ? 'inactive' : 'active' }}">
                <button type="submit" class="btn btn-success btn-sm {{ $member->status == 'active' ? 'btn-success' : 'btn-danger' }}">{{ $member->status == 'active' ? 'Boleh Pinjam' : 'Tidak Boleh Pinjam' }}</button>
              </form>
            </td>
            <td>
              <a href="{{ route('members.edit', $member->id) }}" class="btn btn-warning btn-sm">Edit</a>
              <form action="{{ route('members.destroy', $member->id) }}" method="POST" style="display:inline-block;">
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
