@extends('layouts.app')

@section('content')
<!-- bootstrap css -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <div class="container">
        <h1>Müştəri Redaktəsi</h1>
        <form action="{{ route('customers.update', $customer->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Ad</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $customer->name }}" required>
            </div>
            <div class="form-group">
                <label for="phone_number">Telefon Nömrəsi</label>
                <input type="text" class="form-control" id="phone_number" name="phone_number"
                    value="{{ $customer->phone_number }}" required>
            </div>
            <div class="form-group">
                <label for="date">Tarix</label>
                <input type="date" class="form-control" id="date" name="date" value="{{ $customer->date }}" required>
            </div>
            <div class="form-group">
                <label for="area">Nahiyə</label>
                <input type="text" class="form-control" id="area" name="area" value="{{ $customer->area }}" required>
            </div>
            <div class="form-group">
                <label for="price">Qiymət</label>
                <input type="text" name="price" id="price" class="form-control" value="{{ $customer->price }}" required>
            </div>
            <!-- create payment type by dropdown as name Cash and Card -->
            <div class="form-group">
                <label for="payment_type">Ödəniş Növü</label>
                <select name="payment_type" id="payment_type" class="form-control" required>
                    <option value="Cash" {{ $customer->payment_type == 'Cash' ? 'selected' : '' }}>Cash</option>
                    <option value="Card" {{ $customer->payment_type == 'Card' ? 'selected' : '' }}>Card</option>
                </select>
            </div>
            <!-- create session type by dropdown as name Session and Correction -->
            <div class="form-group">
                <label for="session_type">Seans Növü</label>
                <select name="session_type" id="session_type" class="form-control" required>
                    <option value="Session" {{ $customer->session_type == 'Session' ? 'selected' : '' }}>Session</option>
                    <option value="Correction" {{ $customer->session_type == 'Correction' ? 'selected' : '' }}>Correction</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Yenilə</button>
        </form>
    </div>
@endsection
