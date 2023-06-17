<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laser Hair Removal Service</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    @stack('styles')
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container">
                <a href="{{ route('customers.index') }}" class="navbar-brand">Laser Hair Removal</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a href="{{ route('customers.index') }}" class="nav-link">Customers</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('expenses.index') }}" class="nav-link">Expenses</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('reports.financial') }}" class="nav-link">Reports</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('whatsapp') }}" class="nav-link">Whatsapp</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <main class="container py-4">
        @yield('content')
    </main>

    <footer class="bg-light py-4">
        <div class="container text-center">
            <p class="text-muted">&copy; {{ date('Y') }} Ravan Osmanli</p>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    @stack('scripts')
</body>
</html>
