@extends('layouts.app')
@section('title', 'Ajouter un professeur')

@section('content')
<div class="container mt-5">
    <div class="card shadow-sm card-hover" style="border-radius: 12px; background: white;">
        <div class="card-body">
            <h2>Ajouter un professeur</h2>
            <form action="{{ route('admin.utilisateurs.professeurs.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="nom_prof" class="form-label">Nom</label>
                    <input type="text" name="nom_prof" id="nom_prof" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="prenom_prof" class="form-label">Prénom</label>
                    <input type="text" name="prenom_prof" id="prenom_prof" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="email_prof" class="form-label">Email</label>
                    <input type="email" name="email_prof" id="email_prof" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Mot de passe</label>
                    <input type="password" name="password" id="password" class="form-control" required>
                </div>
                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary">Ajouter</button>
                    <a href="{{ route('admin.utilisateurs.professeurs.index') }}" class="btn btn-outline-secondary">← Annuler</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
