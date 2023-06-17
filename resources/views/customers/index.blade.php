@extends('layouts.app')

@section('content')

<!-- bootstrap css -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<div class="container">
    <h1>Customers</h1>
    <a href="{{ route('customers.create') }}" class="btn btn-primary mb-3">Add Customer</a>

    <div class="filter-container mb-3">
        <form action="{{ route('customers.index') }}" method="GET" class="form-inline">
            <label for="startDate" class="mr-2">Start Date:</label>
            <input type="date" class="form-control mr-2" id="startDate" name="start_date" value="{{ $startDate ?? '' }}">
            
            <label for="endDate" class="mr-2">End Date:</label>
            <input type="date" class="form-control mr-2" id="endDate" name="end_date" value="{{ $endDate ?? '' }}">

            <label for="paymentType" class="mr-2">Payment Type:</label>
            <select class="form-control mr-2" id="paymentType" name="payment_type">
                <option value="">All</option>
                <option value="cash" @if($paymentType === 'cash') selected @endif>Cash</option>
                <option value="card" @if($paymentType === 'card') selected @endif>Card</option>
            </select>

            <button type="submit" class="btn btn-primary">Apply</button>
        </form>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Phone Number</th>
                <th>Date</th>
                <th>Area</th>
                <th>Price</th>
                <th>Payment Type</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($customers as $customer)
            <tr>
                <td>{{ $customer->name }}</td>
                <td>{{ $customer->phone_number }}</td>
                <td>{{ $customer->date }}</td>
                <td>{{ $customer->area }}</td>
                <td>{{ $customer->price }}</td>
                <td>{{ $customer->payment_type }}</td>
                <td>
                    <a href="{{ route('customers.show', $customer->id) }}" class="btn btn-primary">View</a>
                    <a href="{{ route('customers.edit', $customer->id) }}" class="btn btn-secondary">Edit</a>
                    <form action="{{ route('customers.destroy', $customer->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this customer?')">Delete</button>
                    </form>
                    
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $customers->links() }}
</div>
@endsection
