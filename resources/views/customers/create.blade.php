@extends('layouts.app')

@section('content')
    <!-- bootstrap css -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <div class="container">
        <h1>Müştəri Əlavə Et</h1>
        <form action="{{ route('customers.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Ad</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="phone_number">Telefon Nömrəsi</label>
                <input type="text" class="form-control" id="phone_number" name="phone_number" required>
            </div>
            <div class="form-group">
                <label for="date">Tarix</label>
                <input type="date" class="form-control" id="date" name="date" required>
            </div>
            <div class="form-group">
                <label for="area">Nahiyə</label>
                <input type="text" class="form-control" id="area" name="area" required>
            </div>
            <div class="form-group">
                <label for="price">Qiymət</label>
                <input type="text" name="price" id="price" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="session_type">Seans Növü</label>
                <select name="session_type" id="session_type" class="form-control" required>
                    <option value="Session">Seans</option>
                    <option value="Correction">Korreksiya</option>
                </select>
            </div>
            <div class="form-group">
                <label for="payment_type">Ödəniş Növü</label>
                <select name="payment_type" id="payment_type" class="form-control" required>
                    <option value="Cash">Nağd</option>
                    <option value="Card">Kart</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Əlavə et</button>
        </form>
    </div>
@endsection
