@extends('layouts.app')
@section('content')
<div class="container mt-4">
    <h3>Create Product</h3>
    <form method="POST" action="{{ route('admin.products.store') }}">@csrf
        <div class="mb-3"><label>Code</label><input name="code" class="form-control"></div>
        <div class="mb-3"><label>Name</label><input name="name" class="form-control"></div>
        <div class="mb-3 form-check"><input type="checkbox" name="is_active" class="form-check-input" checked><label class="form-check-label">Active</label></div>
        <button class="btn btn-primary">Save</button>
    </form>
</div>
@endsection