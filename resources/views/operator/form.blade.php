@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h3>Input Produksi</h3>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form method="POST" action="{{ route('productions.store') }}">
        @csrf
        <div class="mb-3">
            <label>Produk</label>
            <select name="product_id" class="form-select">
                @foreach($products as $p)
                    <option value="{{ $p->id }}">{{ $p->code }} - {{ $p->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label>Shift</label>
            <select name="shift_id" class="form-select">
                @foreach($shifts as $s)
                    <option value="{{ $s->id }}">{{ $s->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label>Qty OK</label>
            <input type="number" name="qty_ok" class="form-control" min="0" value="0">
        </div>
        <div class="mb-3">
            <label>Qty NG</label>
            <input type="number" name="qty_ng" class="form-control" min="0" value="0">
        </div>
        <input type="hidden" name="production_date" value="{{ now()->format('Y-m-d') }}">
        <button class="btn btn-primary">Simpan</button>
    </form>

</div>
@endsection