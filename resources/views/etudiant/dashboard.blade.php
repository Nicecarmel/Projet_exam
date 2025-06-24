@extends('layouts.app')
@section('title', 'Tableau de bord - Étudiant')

@section('content')
<style>
    .dashboard-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .dashboard-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1);
    }

    .icon-container {
        width: 70px;
        height: 70px;
        margin: 0 auto;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        background: white;
    }
</style>

<div class="container mt-5">
    <div class="row justify-content-center text-center mb-4">
        <div class="col-md-8">
            <h2>Bienvenue, {{ session('etudiant')->nom_et }} {{ session('etudiant')->prenom_et }}</h2>
            <p class="lead">Vous pouvez maintenant participer aux épreuves ou consulter vos résultats.</p>
        </div>
    </div>

    <div class="row g-4">
        <!-- Épreuves disponibles -->
        <div class="col-md-6 col-lg-4 mx-auto mx-lg-0">
            <div class="card dashboard-card border-success shadow-sm h-100 card-hover" style="border-radius: 12px; background: white;">
                <div class="card-body p-4">
                    <div class="icon-container mb-3" style="background: linear-gradient(135deg, #2ecc71 0%, #27ae60 100%);">
                        <i class="fas fa-book fa-lg text-white"></i>
                    </div>
                    <h5 class="card-title mt-3">Épreuves disponibles</h5>
                    <p class="card-text text-muted">Accédez aux épreuves validées et commencez à répondre.</p>
                    <a href="{{ route('epreuves.etudiant.index') }}" class="btn btn-success w-100 py-2">
                        ➤ Commencer une épreuve
                    </a>
                </div>
            </div>
        </div>

        <!-- Mes résultats -->
        <div class="col-md-6 col-lg-4 mx-auto mx-lg-0">
            <div class="card dashboard-card border-info shadow-sm h-100 card-hover" style="border-radius: 12px; background: white;">
                <div class="card-body p-4">
                    <div class="icon-container mb-3" style="background: linear-gradient(135deg, #3498db 0%, #2980b9 100%);">
                        <i class="fas fa-chart-line fa-lg text-white"></i>
                    </div>
                    <h5 class="card-title mt-3">Mes résultats</h5>
                    <p class="card-text text-muted">Consultez vos notes et feedbacks après passation.</p>
                    <a href="{{ route('etudiant.reponses.index') }}" class="btn btn-outline-info w-100 py-2">
                        📊 Voir mes résultats
                    </a>
                </div>
            </div>
        </div>

        <!-- Historique des épreuves -->
        <div class="col-md-6 col-lg-4 mx-auto mx-lg-0">
            <div class="card dashboard-card border-warning shadow-sm h-100 card-hover" style="border-radius: 12px; background: white;">
                <div class="card-body p-4">
                    <div class="icon-container mb-3" style="background: linear-gradient(135deg, #f1c40f 0%, #f39c12 100%);">
                        <i class="fas fa-history fa-lg text-white"></i>
                    </div>
                    <h5 class="card-title mt-3">Historique des épreuves</h5>
                    <p class="card-text text-muted">Retrouvez toutes les épreuves passées et en attente.</p>
                    <a href="{{ route('etudiant.reponses.index') }}" class="btn btn-warning w-100 py-2">
                        📖 Mon historique
                    </a>
                </div>
            </div>
        </div>
    </div>

    <hr class="my-5">

    <div class="text-center">
        <form action="{{ route('student.logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-outline-danger py-2 px-4">
                <i class="fas fa-sign-out-alt me-2"></i>Déconnexion
            </button>
        </form>
    </div>
</div>
@endsection
