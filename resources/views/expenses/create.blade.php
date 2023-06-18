@extends('layouts.app')

@section('content')
<!-- bootstrap css -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Xərc Əlavə Et</div>
                    <div class="card-body">
                        <form action="{{ route('expenses.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="expense_name">Xərc adı</label>
                                <input type="text" name="expense_name" id="expense_name" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="expense_amount">Xərc Miqdarı</label>
                                <input type="number" name="expense_amount" id="expense_amount" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="expense_date">Xərc Tarixi</label>
                                <input type="date" name="expense_date" id="expense_date" class="form-control" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Yarat</button>
                            <a href="{{ route('expenses.index') }}" class="btn btn-secondary">İmtina Et</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
