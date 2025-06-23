<!-- resources/views/student/dashboard.blade.php -->

@extends('layouts.app')

@section('title', 'Tableau de bord - Étudiant')

@section('content')
<div class="row text-center">
    <h3>Bienvenue, {{ session('etudiant')->nom_et }} {{ session('etudiant')->prenom_et }}</h3>
    <p>Vous êtes prêt(e) à participer aux épreuves.</p>
</div>

<div class="row g-4 mt-2">
    <div class="col-md-4">
        <div class="card dashboard-card border-success">
            <div class="card-body">
                <h5 class="card-title">Épreuves disponibles</h5>
                <p class="card-text">Voir et commencer les épreuves validées.</p>
                <a href="{{ route('exams.index') }}" class="btn btn-success">Accéder aux épreuves</a>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card dashboard-card border-info">
            <div class="card-body">
                <h5 class="card-title">Mes résultats</h5>
                <p class="card-text">Consulter mes notes et feedbacks.</p>
                <a href="#" class="btn btn-outline-info">Voir mes résultats</a>
            </div>
        </div>
    </div>

</div>
@endsection
