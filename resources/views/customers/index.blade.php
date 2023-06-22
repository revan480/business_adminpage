@extends('layouts.app')

@section('content')

<!-- bootstrap css -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<div class="container">
    <h1>Müştərilər</h1>
    <a href="{{ route('customers.create') }}" class="btn btn-primary mb-3">Müştəri Əlavə Et</a>

    <div id="price" style="background: linear-gradient(to right, #43cea2, #185a9d); color: white; width: 100%; max-width: 1800px; font-size: 32px; text-align: center; padding: 15px; padding-left: 10px; margin-top: 20px; border-radius: 5px; display: flex; justify-content: center; margin-left: auto; margin-right: auto;">
    @if(isset($totalPrice))
        Cəmi: {{ $totalPrice }}
    @endif
</div>

    <br>
    <div class="filter-container mb-3">
    <form action="{{ route('customers.index') }}" method="GET" class="form-inline">
        <label for="search" class="mr-2">Axtarış:</label>
        <input type="text" class="form-control mr-2" id="search" name="search" value="{{ $search ?? '' }}" placeholder="Ad və ya Telefon Nömrəsi">

        <label for="startDate" class="mr-2">Başlama Tarixi:</label>
        <input type="date" class="form-control mr-2" id="startDate" name="start_date" value="{{ $startDate ?? '' }}">
        
        <label for="endDate" class="mr-2">Bitmə Tarixi:</label>
        <input type="date" class="form-control mr-2" id="endDate" name="end_date" value="{{ $endDate ?? '' }}">

        <label for="paymentType" class="mr-2">Ödəniş Növü:</label>
        <select class="form-control mr-2" id="paymentType" name="payment_type">
            <option value="">Hamısı</option>
            <option value="cash" @if($paymentType === 'cash') selected @endif>Nağd</option>
            <option value="card" @if($paymentType === 'card') selected @endif>Kart</option>
        </select>

        <button type="submit" class="btn btn-primary">Təsdiqlə</button>
    </form>
</div>


    <table class="table">
        <thead>
            <tr>
                <th>Ad</th>
                <th>Telefon Nömrəsi</th>
                <th>Tarix</th>
                <th>Nahiyə</th>
                <th>Qiymət</th>
                <th>Ödəniş Növü</th>
                <th>Seans Növü</th>
                <th>Əməliyyat</th>
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
                <td>{{ $customer->session_type }}</td>
                <td>
                    <a href="{{ route('customers.show', $customer->id) }}" class="btn btn-primary">Bax</a>
                    <a href="{{ route('customers.edit', $customer->id) }}" class="btn btn-secondary">Redaktə Et</a>
                    <form action="{{ route('customers.destroy', $customer->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this customer?')">Sil</button>
                    </form>
                    
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $customers->links() }}
</div>
@endsection
