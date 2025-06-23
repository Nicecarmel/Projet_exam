@extends('layouts.app')

@section('title', 'Bienvenue - CFP Les Métiers du Digital')

@section('content')
<style>
    .header-bg {
        background-image: url("{{ asset('images/image_projet.jpg') }}");
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        position: relative;
        color: white;
        text-shadow: 0 2px 6px rgba(0, 0, 0, 0.6);
    }

    .header-overlay {
        position: absolute;
        top: 0; left: 0;
        width: 100%; height: 100%;
        background-color: rgba(0, 51, 102, 0.7);
        z-index: 1;
    }

    .header-content {
        position: relative;
        z-index: 2;
        padding: 120px 0 80px;
        text-align: center;
    }

    .card-hover {
        transition: 0.4s ease;
    }

    .card-hover:hover {
        transform: translateY(-8px);
        box-shadow: 0 12px 24px rgba(0, 0, 0, 0.1);
    }

    footer {
        background-color: #003366;
        color: white;
        padding: 40px 20px;
    }

    footer a {
        color: white;
        text-decoration: none;
    }

    footer a:hover {
        text-decoration: underline;
    }
</style>

<!-- HEADER -->
<div class="header-bg">
    <div class="header-overlay"></div>
    <div class="container header-content">
       <!-- <img src="{{ asset('images/Logo Lmd.jpg') }}" alt="Logo CFP" height="120" class="mb-4 rounded shadow-sm bg-white p-2" style="max-width: 240px;"> -->
        <h1 class="display-5 fw-bold mb-3">Plateforme d'Évaluation en Ligne</h1>
        <p class="lead mb-4">Bienvenue sur la plateforme officielle du CFP Les Métiers du Digital pour la gestion des épreuves académiques.</p>
        <div class="d-flex justify-content-center flex-wrap gap-3">
            <a href="{{ route('student.login') }}" class="btn btn-success btn-lg px-4">Accès Étudiant</a>
            <a href="{{ route('professor.login') }}" class="btn btn-primary btn-lg px-4">Accès Enseignant</a>
            <a href="{{ route('admin.login') }}" class="btn btn-dark btn-lg px-4">Administration</a>
        </div>
    </div>
</div>

<!-- FONCTIONNALITÉS -->
<section class="py-5 bg-light">
    <div class="container">
        <h2 class="text-center mb-5">Fonctionnalités principales</h2>
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-3 mb-4">
                <div class="card text-center p-4 shadow-sm card-hover border-top border-primary">
                    <i class="fas fa-edit fa-2x mb-3 text-primary"></i>
                    <h5 class="text-primary">Création d'épreuves</h5>
                    <p class="text-muted small">Concevez facilement des évaluations en ligne depuis votre espace.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-3 mb-4">
                <div class="card text-center p-4 shadow-sm card-hover border-top border-success">
                    <i class="fas fa-user-lock fa-2x mb-3 text-success"></i>
                    <h5 class="text-success">Accès sécurisé</h5>
                    <p class="text-muted small">Connexion individuelle pour chaque rôle : étudiant, enseignant ou admin.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-3 mb-4">
                <div class="card text-center p-4 shadow-sm card-hover border-top border-warning">
                    <i class="fas fa-check-circle fa-2x mb-3 text-warning"></i>
                    <h5 class="text-warning">Correction automatique</h5>
                    <p class="text-muted small">Évaluations instantanées avec génération automatique des résultats.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-3 mb-4">
                <div class="card text-center p-4 shadow-sm card-hover border-top border-danger">
                    <i class="fas fa-chart-line fa-2x mb-3 text-danger"></i>
                    <h5 class="text-danger">Tableau de bord</h5>
                    <p class="text-muted small">Statistiques de participation et performance en temps réel.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- FOOTER -->
<footer class="text-center mt-auto">
    <div class="container">
        <h5 class="fw-bold">CFP Les Métiers du Digital</h5>
        <p class="mb-2">Une plateforme numérique au service de l’enseignement et de l’évaluation moderne</p>
        <div class="mb-3">
            <a href="#"><i class="fab fa-facebook-f me-3"></i></a>
            <a href="#"><i class="fab fa-twitter me-3"></i></a>
            <a href="#"><i class="fab fa-linkedin-in me-3"></i></a>
            <a href="#"><i class="fab fa-instagram"></i></a>
        </div>
        <p class="mb-0">&copy; {{ date('Y') }} LMD Exam - Tous droits réservés</p>
    </div>
</footer>

<!-- FontAwesome (si en local, à inclure dans app.blade aussi) -->
@push('scripts')
<script src="{{ asset('fontawesome/js/all.min.js') }}"></script>
@endpush
@endsection
