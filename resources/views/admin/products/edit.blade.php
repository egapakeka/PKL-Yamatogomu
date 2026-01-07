@extends('layouts.app')
@section('content')
<div class="container mt-4">
    <h3>Edit Product</h3>
    <form method="POST" action="{{ route('admin.products.update', $product) }}">@csrf @method('PUT')
        <div class="mb-3"><label>Code</label><input name="code" class="form-control" value="{{ old('code', $product->code) }}"></div>
        <div class="mb-3"><label>Name</label><input name="name" class="form-control" value="{{ old('name', $product->name) }}"></div>
        <div class="mb-3 form-check"><input type="checkbox" name="is_active" class="form-check-input" @if($product->is_active) checked @endif><label class="form-check-label">Active</label></div>
        <button class="btn btn-primary">Save</button>
    </form>
</div>
@endsection