@extends('layouts.app')
@section('title', 'Ajouter un étudiant')

@section('content')
<div class="container mt-5">
    <div class="card shadow-sm card-hover" style="border-radius: 12px; background: white;">
        <div class="card-body">
            <h2>Ajouter un nouvel étudiant</h2>
            <form action="{{ route('admin.utilisateurs.etudiants.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="nom_et" class="form-label">Nom</label>
                    <input type="text" name="nom_et" id="nom_et" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="prenom_et" class="form-label">Prénom</label>
                    <input type="text" name="prenom_et" id="prenom_et" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="email_et" class="form-label">Email</label>
                    <input type="email" name="email_et" id="email_et" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Mot de passe</label>
                    <input type="password" name="password" id="password" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="sexe" class="form-label">Sexe</label>
                    <select name="sexe" id="sexe" class="form-select">
                        <option value="M">Masculin</option>
                        <option value="F">Féminin</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="tel_et" class="form-label">Téléphone</label>
                    <input type="text" name="tel_et" id="tel_et" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="num_mat" class="form-label">Numéro matricule</label>
                    <input type="text" name="num_mat" id="num_mat" class="form-control">
                </div>
                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary">Ajouter</button>
                    <a href="{{ route('admin.utilisateurs.etudiants.index') }}" class="btn btn-outline-secondary">← Annuler</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
