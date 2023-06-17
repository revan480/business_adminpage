@extends('layouts.app')

@section('content')
<!-- bootstrap css -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Edit Expense</div>
                    <div class="card-body">
                        <form action="{{ route('expenses.update', $expense) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="expense_name">Expense Name</label>
                                <input type="text" name="expense_name" id="expense_name" class="form-control" value="{{ $expense->expense_name }}" required>
                            </div>
                            <div class="form-group">
                                <label for="expense_amount">Expense Amount</label>
                                <input type="number" name="expense_amount" id="expense_amount" class="form-control" value="{{ $expense->expense_amount }}" required>
                            </div>
                            <div class="form-group">
                                <label for="expense_date">Expense Date</label>
                                <input type="date" name="expense_date" id="expense_date" class="form-control" value="{{ $expense->expense_date }}" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Update</button>
                            <a href="{{ route('expenses.index') }}" class="btn btn-secondary">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
