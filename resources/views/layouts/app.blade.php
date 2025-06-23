<!-- resources/views/layouts/app.blade.php -->

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'CFP Les Métiers du Digital - Plateforme LMD Exam')</title>

    <!-- Bootstrap CSS local -->
    <link href="{{ asset('bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Font Awesome local (si tu l’as téléchargé, sinon tu peux laisser en ligne) -->
    <link rel="stylesheet" href="{{ asset('fontawesome/css/all.min.css') }}">

    <style>
        body {
            background: linear-gradient(135deg, #acd4ef, #87e9b0, #91f8bc);
            font-family: 'Segoe UI', sans-serif;
            min-height: 100vh;
        }

        .btn-lg.btn-block {
            padding: 1rem;
            font-size: 1.2rem;
        }

        .dashboard-card {
            transition: transform 0.2s ease;
        }

        .dashboard-card:hover {
            transform: translateY(-5px);
        }

        .navbar {
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .navbar-brand img {
            max-height: 40px;
        }

        .card-dashboard {
            border: 1px solid #ddd;
            border-radius: 8px;
            overflow: hidden;
            transition: transform 0.2s ease;
        }

        .card-dashboard:hover {
            transform: translateY(-5px);
        }

        .card-dashboard .card-header {
            background-color: #003366;
            color: white;
        }

        .card-dashboard .card-body {
            padding: 20px;
        }

        .card-dashboard a {
            display: block;
            text-align: center;
        }

        footer a {
            color: white;
            text-decoration: none;
        }

        footer a:hover {
            text-decoration: underline;
        }
    </style>

    @stack('styles')
</head>
<body>
    @include('components.navbar')

    <div class="container py-4">
        @yield('content')
    </div>

    <!-- Bootstrap JS local -->
    <script src="{{ asset('bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Font Awesome JS local (optionnel si utilisé en local) -->
    <script src="{{ asset('fontawesome/js/all.min.js') }}"></script>

    @stack('scripts')
</body>
</html>
