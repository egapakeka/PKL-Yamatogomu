@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h3>Dashboard Supervisor</h3>

    <div class="row">
        <div class="col-md-8">
            <table class="table table-sm">
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Operator</th>
                        <th>Produk</th>
                        <th>Shift</th>
                        <th>OK</th>
                        <th>NG</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($productions as $p)
                        <tr>
                            <td>{{ $p->production_date->format('Y-m-d') }}</td>
                            <td>{{ $p->operator->name }}</td>
                            <td>{{ $p->product->name }}</td>
                            <td>{{ $p->shift->name }}</td>
                            <td>{{ $p->qty_ok }}</td>
                            <td>{{ $p->qty_ng }}</td>
                            <td>{{ $p->status }}</td>
                            <td>
                                @if($p->status !== 'validated')
                                    <form method="POST" action="{{ route('productions.validate', $p) }}">
                                        @csrf
                                        <button class="btn btn-sm btn-success">Validate</button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            {{ $productions->links() }}
        </div>

        <div class="col-md-4">
            <h5>Summary</h5>
            <ul class="list-group">
                @foreach($summary as $s)
                    <li class="list-group-item">{{ $s->product->name }} — OK: {{ $s->ok }} / NG: {{ $s->ng }}</li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
@endsection