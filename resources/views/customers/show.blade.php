@extends('layouts.app')

@section('content')
<!-- bootstrap css -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <div class="container">
        <h1>Customer Details</h1>
        <table class="table">
            <tbody>
                <tr>
                    <th>Name</th>
                    <td>{{ $customer->name }}</td>
                </tr>
                <tr>
                    <th>Phone Number</th>
                    <td>{{ $customer->phone_number }}</td>
                </tr>
                <tr>
                    <th>Date</th>
                    <td>{{ $customer->date }}</td>
                </tr>
                <tr>
                    <th>Area</th>
                    <td>{{ $customer->area }}</td>
                </tr>
                <tr>
                    <th>Price</th>
                    <td>{{ $customer->price }}</td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection
