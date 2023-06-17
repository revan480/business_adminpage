@extends('layouts.app')

@section('content')
<!-- bootstrap css -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <div class="container">
        <h1>Add Customer</h1>
        <form action="{{ route('customers.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="phone_number">Phone Number</label>
                <input type="text" class="form-control" id="phone_number" name="phone_number" required>
            </div>
            <div class="form-group">
                <label for="date">Date</label>
                <input type="date" class="form-control" id="date" name="date" required>
            </div>
            <div class="form-group">
                <label for="area">Area</label>
                <input type="text" class="form-control" id="area" name="area" required>
            </div>
            <div class="form-group">
                <label for="price">Price:</label>
                <input type="text" name="price" id="price" class="form-control" required>
            </div>
            <!-- create payment type by dropdown as name Cash and Card -->
            <div class="form-group">
                <label for="payment_type">Payment Type:</label>
                <select name="payment_type" id="payment_type" class="form-control" required>
                    <option value="Cash">Cash</option>
                    <option value="Card">Card</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Add</button>
        </form>
    </div>
@endsection
