@extends('layouts.app')

@section('content')
<!-- bootstrap css -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <div class="container">
        <h1>Müştəri Detalları</h1>
        <table class="table">
            <tbody>
                <tr>
                    <th>Ad</th>
                    <td>{{ $customer->name }}</td>
                </tr>
                <tr>
                    <th>Telefon Nömrəsi</th>
                    <td>{{ $customer->phone_number }}</td>
                </tr>
                <tr>
                    <th>Tarix</th>
                    <td>{{ $customer->date }}</td>
                </tr>
                <tr>
                    <th>Nahiyə</th>
                    <td>{{ $customer->area }}</td>
                </tr>
                <tr>
                    <th>Qiymət</th>
                    <td>{{ $customer->price }}</td>
                </tr>
                <tr>
                    <th>Seans Növü</th>
                    <td>{{ $customer->session_type }}</td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection
