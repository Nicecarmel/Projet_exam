@extends('layouts.app')
@section('title', 'Modifier le professeur')

@section('content')
<div class="container mt-5">
    <div class="card shadow-sm card-hover" style="border-radius: 12px; background: white;">
        <div class="card-body">
            <h2>Modifier le professeur</h2>
            <form action="{{ route('admin.utilisateurs.professeurs.update', ['professeur' => $professeur->id_prof]) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="nom_prof" class="form-label">Nom</label>
                    <input type="text" name="nom_prof" id="nom_prof" class="form-control" value="{{ $professeur->nom_prof }}" required>
                </div>
                <div class="mb-3">
                    <label for="prenom_prof" class="form-label">Prénom</label>
                    <input type="text" name="prenom_prof" id="prenom_prof" class="form-control" value="{{ $professeur->prenom_prof }}" required>
                </div>
                <div class="mb-3">
                    <label for="email_prof" class="form-label">Email</label>
                    <input type="email" name="email_prof" id="email_prof" class="form-control" value="{{ $professeur->email_prof }}" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Nouveau mot de passe (facultatif)</label>
                    <input type="password" name="password" id="password" class="form-control">
                </div>
                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary">Mettre à jour</button>
                    <a href="{{ route('admin.utilisateurs.professeurs.index') }}" class="btn btn-outline-secondary">← Retour</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
