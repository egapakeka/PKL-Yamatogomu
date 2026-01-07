@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h3>Users</h3>
    @if(session('success'))<div class="alert alert-success">{{ session('success') }}</div>@endif
    <a href="{{ route('admin.users.create') }}" class="btn btn-primary mb-3">Create User</a>
    <table class="table table-sm">
        <thead>
            <tr><th>Name</th><th>Email</th><th>Roles</th><th>Actions</th></tr>
        </thead>
        <tbody>
            @foreach($users as $u)
                <tr>
                    <td>{{ $u->name }}</td>
                    <td>{{ $u->email }}</td>
                    <td>{{ $u->roles->pluck('name')->join(', ') }}</td>
                    <td>
                        <a href="{{ route('admin.users.edit',$u) }}" class="btn btn-sm btn-secondary">Edit</a>
                        <form method="POST" action="{{ route('admin.users.reset', $u) }}" class="d-inline">
                            @csrf
                            <input type="hidden" name="password" value="password">
                            <button class="btn btn-sm btn-warning">Reset PW</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $users->links() }}
</div>
@endsection