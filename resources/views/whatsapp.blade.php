@extends('layouts.app')

@section('content')
    <!-- bootstrap css -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <div class="container">
        <h1>WhatsApp</h1>

        <div class="row mb-3">
            <div class="col-md-6">
                <form action="{{ route('whatsapp') }}" method="GET">
                    <div class="input-group">
                        <input type="date" name="date" class="form-control" value="{{ request()->input('date') }}">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="submit">Filter</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <table class="table">
            <thead>
                <tr>
                    <th>Ad</th>
                    <th>Telefon Nömrəsi</th>
                    <th>Tarix</th>
                    <th>Əməliyyat</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($customers as $customer)
                    <tr>
                        <td>{{ $customer->name }}</td>
                        <td>{{ $customer->phone_number }}</td>
                        <td>{{ $customer->date }}</td>
                        <td>
                            @if ($customer->isMessageSent)
                                <span class="text-success">Mesaj Göndərildi</span>
                            @else
                                <a href="https://wa.me/994{{ $customer->phone_number }}" target="_blank" class="btn btn-primary send-message-btn">Whatsapp Mesaj Göndər</a>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="d-flex justify-content-center">
            {{ $customers->appends(request()->except('page'))->links() }}
        </div>
    </div>

    <!-- Bootstrap and jQuery JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script>
        // Send WhatsApp message when the button is clicked and update the button text to "Message Sent" and disable it
        $('.send-message-btn').click(function() {
            $(this).text('Mesaj Göndərildi').addClass('disabled');
        });

        
        

    </script>
@endsection
