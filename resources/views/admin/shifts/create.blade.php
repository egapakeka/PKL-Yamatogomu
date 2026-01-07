@extends('layouts.app')
@section('content')
<div class="container mt-4">
    <h3>Create Shift</h3>
    <form method="POST" action="{{ route('admin.shifts.store') }}">@csrf
        <div class="mb-3"><label>Name</label><input name="name" class="form-control"></div>
        <div class="mb-3"><label>Start Time</label><input name="start_time" class="form-control" placeholder="HH:MM:SS"></div>
        <div class="mb-3"><label>End Time</label><input name="end_time" class="form-control" placeholder="HH:MM:SS"></div>
        <button class="btn btn-primary">Save</button>
    </form>
</div>
@endsection