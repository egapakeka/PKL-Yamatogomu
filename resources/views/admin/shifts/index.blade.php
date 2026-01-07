@extends('layouts.app')
@section('content')
<div class="container mt-4">
    <h3>Shifts</h3>
    @if(session('success'))<div class="alert alert-success">{{ session('success') }}</div>@endif
    <a href="{{ route('admin.shifts.create') }}" class="btn btn-primary mb-3">Create Shift</a>
    <table class="table">
        <thead><tr><th>Name</th><th>Start</th><th>End</th><th>Actions</th></tr></thead>
        <tbody>
            @foreach($shifts as $s)
                <tr>
                    <td>{{ $s->name }}</td>
                    <td>{{ $s->start_time }}</td>
                    <td>{{ $s->end_time }}</td>
                    <td>
                        <a href="{{ route('admin.shifts.edit', $s) }}" class="btn btn-sm btn-secondary">Edit</a>
                        <form action="{{ route('admin.shifts.destroy', $s) }}" method="POST" class="d-inline">@csrf @method('DELETE')<button class="btn btn-sm btn-danger">Delete</button></form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $shifts->links() }}
</div>
@endsection