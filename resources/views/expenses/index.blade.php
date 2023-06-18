@extends('layouts.app')

@section('content')
<!-- bootstrap css -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Xərclər</div>
                    <div class="card-body">
                        <a href="{{ route('expenses.create') }}" class="btn btn-primary mb-3">Xərc Yarat</a>

                        <!-- Filters -->
                        <form action="{{ route('expenses.index') }}" method="GET" class="mb-3">
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="start_date">Başlama Tarixi:</label>
                                    <input type="date" id="start_date" name="start_date" class="form-control" value="{{ request('start_date') }}">
                                </div>
                                <div class="col-md-4">
                                    <label for="end_date">Bitmə Tarixi:</label>
                                    <input type="date" id="end_date" name="end_date" class="form-control" value="{{ request('end_date') }}">
                                </div>
                                <div class="col-md-4" style="margin-top: 30px;">
                                    <button type="submit" class="btn btn-primary">Təsdiqlə</button>
                                    <a href="{{ route('expenses.index') }}" class="btn btn-secondary">Yenilə</a>
                                </div>
                            </div>
                        </form>

                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Ad</th>
                                    <th>Miqdar</th>
                                    <th>Tarix</th>
                                    <th>Əməliyyat</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($expenses as $expense)
                                    <tr>
                                        <td>{{ $expense->id }}</td>
                                        <td>{{ $expense->expense_name }}</td>
                                        <td>{{ $expense->expense_amount }}</td>
                                        <td>{{ $expense->expense_date }}</td>
                                        <td>
                                            <a href="{{ route('expenses.edit', $expense) }}" class="btn btn-sm btn-primary">Redatə Et</a>
                                            <form action="{{ route('expenses.destroy', $expense) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this expense?')">Sil</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $expenses->appends(request()->except('page'))->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
