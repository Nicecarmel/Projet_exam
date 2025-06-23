<!-- resources/views/professor/epreuves/create.blade.php -->

@extends('layouts.app')
@section('title', 'Créer une épreuve')

@section('content')
<div class="container mt-5">
    <h2>Créer une nouvelle épreuve</h2>
    <form action="{{ route('epreuves.store') }}" method="POST">
        @csrf

        <!-- Filière -->
        <div class="mb-3">
            <label for="filiere_id" class="form-label">Filière</label>
            <select name="filiere_id" id="filiere_id" class="form-select" required>
                <option value="">Sélectionnez une filière</option>
                @foreach ($filieres as $filiere)
                    <option value="{{ $filiere->id }}" {{ old('filiere_id') == $filiere->id ? 'selected' : '' }}>
                        {{ $filiere->libelle_fil }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Matière -->
        <div class="mb-3">
            <label for="matiere_id" class="form-label">Matière</label>
            <select name="matiere_id" id="matiere_id" class="form-select" required>
                <option value="">Sélectionnez une matière</option>
                @foreach ($matieres as $matiere)
                    <option value="{{ $matiere->id_mat }}" {{ old('matiere_id') == $matiere->id_mat ? 'selected' : '' }}>
                        {{ $matiere->libelle_mat }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Type d'épreuve -->
        <div class="mb-3">
            <label for="type_ep" class="form-label">Type d’épreuve</label>
            <select name="type_ep" id="type_ep" class="form-select">
                <option value="">Sélectionnez un type</option>
                <option value="qcm" {{ old('type_ep') == 'qcm' ? 'selected' : '' }}>QCM</option>
                <option value="ecrit" {{ old('type_ep') == 'ecrit' ? 'selected' : '' }}>Écrit</option>
                
            </select>
        </div>

        <!-- Titre -->
        <div class="mb-3">
            <label for="titre" class="form-label">Titre de l'épreuve</label>
            <input type="text" name="titre" id="titre" class="form-control" value="{{ old('titre') }}" required>
        </div>

        <!-- Description -->
        <div class="mb-3">
            <label for="description" class="form-label">Description (facultatif)</label>
            <textarea name="description" id="description" rows="3" class="form-control">{{ old('description') }}</textarea>
        </div>

        <!-- Date -->
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="date_ep" class="form-label">Date de l’épreuve</label>
                <input type="date" name="date_ep" id="date_ep" class="form-control" value="{{ old('date_ep') }}">
            </div>
            <div class="col-md-3">
                <label for="heure_debut" class="form-label">Heure de début</label>
                <input type="time" name="heure_debut" id="heure_debut" class="form-control" value="{{ old('heure_debut') }}">
            </div>
            <div class="col-md-3">
                <label for="heure_fin" class="form-label">Heure de fin</label>
                <input type="time" name="heure_fin" id="heure_fin" class="form-control" value="{{ old('heure_fin') }}">
            </div>
        </div>

        <!-- Durée + mode notation -->
        <div class="row mb-4">
            <div class="col-md-6">
                <label for="duree_minutes" class="form-label">Durée en minutes</label>
                <input type="number" name="duree_minutes" id="duree_minutes" class="form-control"
                       value="{{ old('duree_minutes') }}" min="10" max="300">
            </div>
            <div class="col-md-6">
                <label class="form-label">Mode notation automatique</label><br>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" name="mode_notation_auto" id="notationAuto"
                        {{ old('mode_notation_auto') ? 'checked' : '' }}>
                    <label class="form-check-label" for="notationAuto">
                        Activer la correction automatique
                    </label>
                </div>
            </div>
        </div>

        <!-- Bouton submit -->
        <button type="submit" class="btn btn-success w-100 py-2">
            Enregistrer et ajouter des questions
        </button>
    </form>
</div>
@endsection
