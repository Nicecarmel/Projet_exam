@extends('layouts.app')
@section('title', 'Tableau de bord - Admin')

@section('content')
<div class="container mt-5">
    <div class="row g-4">

        <!-- Épreuves en attente -->
        <div class="col-md-6">
            <div class="card shadow-sm h-100 card-hover" style="background: white; border-radius: 12px;">
                <div class="card-body">
                    <h5 class="card-title">Épreuves en attente</h5>
                    <p class="card-text fs-4 fw-bold text-primary">{{ $epreuvesEnAttente->count() }}</p>
                    <a href="{{ route('admin.epreuves.index') }}" class="btn btn-outline-primary w-100 py-2">
                        ➤ Voir les épreuves
                    </a>
                </div>
            </div>
        </div>

        <!-- Professeurs -->
        <div class="col-md-3">
            <div class="card shadow-sm h-100 card-hover" style="background: white; border-radius: 12px;">
                <div class="card-body">
                    <i class="fas fa-chalkboard-teacher text-info mb-2" style="font-size: 28px;"></i>
                    <h6 class="card-subtitle mb-2 text-muted">Professeurs</h6>
                    <p class="fs-5 fw-bold">{{ $profCount }}</p>
                    <a href="{{ route('admin.utilisateurs.professeurs.index') }}" class="btn btn-sm btn-outline-info w-100">
                        ➤ Gérer les professeurs
                    </a>
                </div>
            </div>
        </div>

        <!-- Étudiants -->
        <div class="col-md-3">
            <div class="card shadow-sm h-100 card-hover" style="background: white; border-radius: 12px;">
                <div class="card-body">
                    <i class="fas fa-user-graduate text-success mb-2" style="font-size: 28px;"></i>
                    <h6 class="card-subtitle mb-2 text-muted">Étudiants</h6>
                    <p class="fs-5 fw-bold">{{ $etudiantCount }}</p>
                    <a href="{{ route('admin.utilisateurs.etudiants.index') }}" class="btn btn-sm btn-outline-success w-100">
                        ➤ Gérer les étudiants
                    </a>
                </div>
            </div>
        </div>

        <!-- Filières -->
        <div class="col-md-6">
            <div class="card shadow-sm card-hover" style="background: white; border-radius: 12px;">
                <div class="card-body">
                    <h5>Filières</h5>
                    <ul class="list-group list-group-flush">
                        @foreach ($filieres as $filiere)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                {{ $filiere->libelle_fil }}
                                <span class="badge bg-secondary rounded-pill">{{ $filiere->effectif ?? 'N/A' }}</span>
                            </li>
                        @endforeach
                    </ul>
                    <a href="{{ route('admin.filieres.index') }}" class="btn btn-link mt-3">→ Toutes les filières</a>
                </div>
            </div>
        </div>

        <!-- Matières -->
        <div class="col-md-6">
            <div class="card shadow-sm card-hover" style="background: white; border-radius: 12px;">
                <div class="card-body">
                    <h5>Matières</h5>
                    <ul class="list-group list-group-flush">
                        @foreach ($matieres as $matiere)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                {{ $matiere->libelle_mat }} ({{ $matiere->code_mat }})
                                <span class="badge bg-info rounded-pill">{{ optional($matiere->filiere)->libelle_fil ?? 'Aucune' }}</span>
                            </li>
                        @endforeach
                    </ul>
                    <a href="{{ route('admin.matieres.index') }}" class="btn btn-link mt-3">→ Toutes les matières</a>
                </div>
            </div>
        </div>

        <!-- Logs récents -->
        

    </div>
</div>
@endsection
