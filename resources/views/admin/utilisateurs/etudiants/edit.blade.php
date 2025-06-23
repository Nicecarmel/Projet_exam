@extends('layouts.app')
@section('title', 'Modifier un étudiant')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm card-hover" style="background: white; border-radius: 12px;">
                    <div class="card-body p-4">
                        <h2 class="mb-4">Modifier l'étudiant</h2>

                        <form action="{{ route('admin.utilisateurs.etudiants.update', ['etudiant' => $etudiant->id_et]) }}"
                            method="POST">
                            @csrf
                            @method('PUT')

                            <!-- Nom -->
                            <div class="mb-3">
                                <label for="nom_et" class="form-label">Nom</label>
                                <input type="text" name="nom_et" id="nom_et" class="form-control"
                                    value="{{ $etudiant->nom_et }}" required>
                            </div>

                            <!-- Prénom -->
                            <div class="mb-3">
                                <label for="prenom_et" class="form-label">Prénom</label>
                                <input type="text" name="prenom_et" id="prenom_et" class="form-control"
                                    value="{{ $etudiant->prenom_et }}" required>
                            </div>

                            <!-- Email -->
                            <div class="mb-3">
                                <label for="email_et" class="form-label">Email</label>
                                <input type="email" name="email_et" id="email_et" class="form-control"
                                    value="{{ $etudiant->email_et }}" required>
                            </div>

                            <!-- Mot de passe (facultatif) -->
                            <div class="mb-3">
                                <label for="password" class="form-label">Nouveau mot de passe (facultatif)</label>
                                <input type="password" name="password" id="password" class="form-control">
                                <small class="text-muted">Laissez vide si vous ne souhaitez pas changer le mot depasse</small>
                            </div>

                            <!-- Sexe -->
                            <div class="mb-3">
                                <label for="sexe" class="form-label">Sexe</label>
                                <select name="sexe" id="sexe" class="form-select">
                                    <option value="M" {{ $etudiant->sexe === 'M' ? 'selected' : '' }}>Masculin</option>
                                    <option value="F" {{ $etudiant->sexe === 'F' ? 'selected' : '' }}>Féminin</option>
                                </select>
                            </div>

                            <!-- Téléphone -->
                            <div class="mb-3">
                                <label for="tel_et" class="form-label">Téléphone</label>
                                <input type="text" name="tel_et" id="tel_et" class="form-control"
                                    value="{{ $etudiant->tel_et }}">
                            </div>

                            <!-- Numéro matricule -->
                            <div class="mb-3">
                                <label for="num_mat" class="form-label">Numéro matricule</label>
                                <input type="text" name="num_mat" id="num_mat" class="form-control"
                                    value="{{ $etudiant->num_mat }}" disabled>
                            </div>

                            <!-- Boutons -->
                            <div class="d-grid gap-2 d-md-flex justify-content-between">
                                <button type="submit" class="btn btn-primary py-2 w-100 me-2">Mettre à jour</button>
                                <a href="{{ route('admin.utilisateurs.etudiants.index') }}"
                                    class="btn btn-outline-secondary py-2 w-100">← Retour</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
