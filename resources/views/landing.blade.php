@extends('layouts.app')

@section('content')
    <!-- bootstrap css -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <div class="landing-container">
        <h1 class="landing-title">Kişi Lazer Elmler Admin Panel</h1>
        <p class="landing-description">Admin Panelə giriş</p>
        <a href="{{ route('customers.index') }}" class="btn btn-primary landing-button">Giriş</a>
    </div>
@endsection

@push('styles')
    <style>
        .landing-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            text-align: center;
        }

        .landing-title {
            font-size: 3rem;
            font-weight: bold;
            animation: fade-in 1s ease-in-out;
        }

        .landing-description {
            font-size: 1.5rem;
            margin-top: 1rem;
            animation: slide-up 1s ease-in-out;
        }

        .landing-button {
            margin-top: 2rem;
            animation: fade-in 1s ease-in-out;
        }

        @keyframes fade-in {
            0% {
                opacity: 0;
            }
            100% {
                opacity: 1;
            }
        }

        @keyframes slide-up {
            0% {
                transform: translateY(100px);
            }
            100% {
                transform: translateY(0);
            }
        }

        /* Responsive Styles */
        @media (max-width: 768px) {
            .landing-title {
                font-size: 2rem;
            }

            .landing-description {
                font-size: 1.2rem;
            }
        }
    </style>
@endpush
