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
                                <button class="btn btn-primary send-message-btn" data-phone="{{ $customer->phone_number }}">Whatsapp Mesaj Göndər</button>
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

    <!-- Confirmation Modal -->
    <div class="modal fade" id="confirmationModal" tabindex="-1" role="dialog" aria-labelledby="confirmationModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmationModalLabel">Təsdiq Mesajı</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Whatsapp mesaji göndərməyə əminsiniz?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">İmtina Et</button>
                    <button type="button" class="btn btn-primary" id="confirmSend">Mesaj Göndər</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

    <script>
        $(document).ready(function() {
            $('.send-message-btn').click(function() {
                let row = $(this).closest('tr');
                let phoneNumber = $(this).data('phone');
                $('#confirmSend').data('phoneNumber', phoneNumber);
                $('#confirmSend').data('row', row);
                $('#confirmationModal').modal('show');
            });

            $('#confirmSend').click(function() {
                let phoneNumber = $(this).data('phoneNumber');
                let row = $(this).data('row');
                $('#confirmationModal').modal('hide');
                window.open(`https://wa.me/994${phoneNumber}`, '_blank');
                row.find('td:last').html('<span class="text-success">Message Sent</span>');
            });
        });
    </script>
@endsection
