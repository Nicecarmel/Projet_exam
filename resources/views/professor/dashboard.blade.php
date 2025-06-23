<!-- resources/views/professor/dashboard.blade.php -->

@extends('layouts.app')

@section('title', 'Tableau de bord - Professeur')

@section('content')
<div class="container mt-5">
    <div class="row text-center">
        <h3>Bienvenue, {{ session('professeur')->nom_prof }} {{ session('professeur')->prenom_prof }}</h3>
        <p>Créez et gérez vos épreuves ici.</p>
    </div>

    <div class="row g-4 mt-2">
        <!-- Créer une épreuve -->
        <div class="col-md-4">
            <div class="card dashboard-card border-primary shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Créer une épreuve</h5>
                    <p class="card-text">Commencez à créer une nouvelle épreuve.</p>
                    <a href="{{ route('epreuves.create') }}" class="btn btn-primary w-100 py-2">Nouvelle épreuve</a>
                </div>
            </div>
        </div>

        <!-- Voir mes épreuves -->
        <div class="col-md-4">
            <div class="card dashboard-card border-warning shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Mes épreuves</h5>
                    <p class="card-text">Liste des épreuves créées.</p>
                    <a href="{{ route('epreuves.index') }}" class="btn btn-warning w-100 py-2">Voir mes épreuves</a>
                </div>
            </div>
        </div>

        <!-- Statistiques -->
        <div class="col-md-4">
            <div class="card dashboard-card border-secondary shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Statistiques</h5>
                    <p class="card-text">Suivi des performances de vos étudiants.</p>
                    <a href="#" class="btn btn-outline-secondary w-100 py-2">Voir les stats</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
