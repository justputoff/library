@extends('layouts.main')

@section('content')
<div class="container">
    <h1>Edit Member</h1>
    <form action="{{ route('members.update', $member->id) }}" method="POST">
        @csrf
        @method('PATCH')
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="user_id" class="form-label">User</label>
                <select class="form-control" id="user_id" name="user_id" required>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}" {{ $member->user_id == $user->id ? 'selected' : '' }}>{{ $user->name }} ({{ $user->email }})</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-6">
                <label for="address" class="form-label">Address</label>
                <input type="text" class="form-control" id="address" name="address" value="{{ $member->address }}" required>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="phone" class="form-label">Phone</label>
                <input type="text" class="form-control" id="phone" name="phone" value="{{ $member->phone }}" required>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
