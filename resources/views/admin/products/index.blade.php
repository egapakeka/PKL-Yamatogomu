@extends('layouts.app')
@section('content')
<div class="container mt-4">
    <h3>Products</h3>
    @if(session('success'))<div class="alert alert-success">{{ session('success') }}</div>@endif
    <a href="{{ route('admin.products.create') }}" class="btn btn-primary mb-3">Create Product</a>
    <table class="table">
        <thead><tr><th>Code</th><th>Name</th><th>Active</th><th>Actions</th></tr></thead>
        <tbody>
            @foreach($products as $p)
                <tr>
                    <td>{{ $p->code }}</td>
                    <td>{{ $p->name }}</td>
                    <td>{{ $p->is_active ? 'Yes' : 'No' }}</td>
                    <td>
                        <a href="{{ route('admin.products.edit', $p) }}" class="btn btn-sm btn-secondary">Edit</a>
                        <form action="{{ route('admin.products.destroy', $p) }}" method="POST" class="d-inline">@csrf @method('DELETE')<button class="btn btn-sm btn-danger">Delete</button></form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $products->links() }}
</div>
@endsection