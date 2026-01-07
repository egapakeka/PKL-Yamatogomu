@extends('layouts.app')
@section('content')
<div class="container mt-4">
    <h3>Edit Shift</h3>
    <form method="POST" action="{{ route('admin.shifts.update', $shift) }}">@csrf @method('PUT')
        <div class="mb-3"><label>Name</label><input name="name" class="form-control" value="{{ old('name', $shift->name) }}"></div>
        <div class="mb-3"><label>Start Time</label><input name="start_time" class="form-control" value="{{ old('start_time', $shift->start_time) }}"></div>
        <div class="mb-3"><label>End Time</label><input name="end_time" class="form-control" value="{{ old('end_time', $shift->end_time) }}"></div>
        <button class="btn btn-primary">Save</button>
    </form>
</div>
@endsection