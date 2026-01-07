@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h3>Edit User</h3>

    <form method="POST" action="{{ route('admin.users.update', $user) }}">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label class="form-label">Name</label>
            <input name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Email</label>
            <input name="email" type="email" class="form-control" value="{{ old('email', $user->email) }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Role</label>
            <select name="role" class="form-select">
                @foreach($roles as $r)
                    <option value="{{ $r->name }}" @if($user->roles->pluck('name')->contains($r->name)) selected @endif>{{ $r->name }}</option>
                @endforeach
            </select>
        </div>
        <button class="btn btn-primary">Save</button>
    </form>

</div>
@endsection