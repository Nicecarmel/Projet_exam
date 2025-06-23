<!-- resources/views/professor/epreuves/edit.blade.php -->

@extends('layouts.app')
@section('title', 'Modifier l’épreuve - ' . $epreuve->titre)

@section('content')
<div class="container mt-5">
    <h2>Modifier l’épreuve : {{ $epreuve->titre }}</h2>
    <form action="{{ route('epreuves.update', $epreuve->id_ep) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="titre" class="form-label">Titre de l'épreuve</label>
            <input type="text" name="titre" id="titre" class="form-control" value="{{ old('titre', $epreuve->titre) }}" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" id="description" rows="3" class="form-control">{{ old('description', $epreuve->description) }}</textarea>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="date_ep" class="form-label">Date de l’épreuve</label>
                <input type="date" name="date_ep" id="date_ep" class="form-control" value="{{ old('date_ep', $epreuve->date_ep?->format('Y-m-d')) }}" >
            </div>
            <div class="col-md-3 mb-3">
                <label for="heure_debut" class="form-label">Heure de début</label>
                <input type="time" name="heure_debut" id="heure_debut" class="form-control" value="{{ old('heure_debut', $epreuve->heure_debut) }}">
            </div>
            <div class="col-md-3 mb-3">
                <label for="heure_fin" class="form-label">Heure de fin</label>
                <input type="time" name="heure_fin" id="heure_fin" class="form-control" value="{{ old('heure_fin', $epreuve->heure_fin) }}">
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="duree_minutes" class="form-label">Durée en minutes</label>
                <input type="number" name="duree_minutes" id="duree_minutes" class="form-control" min="10" max="300" value="{{ old('duree_minutes', $epreuve->duree_minutes) }}">
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Mode notation automatique</label>
                <div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="mode_notation_auto" id="notationAuto"
                            {{ $epreuve->mode_notation_auto ? 'checked' : '' }}>
                        <label class="form-check-label" for="notationAuto">
                            Activer la correction automatique
                        </label>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-4">
            <button type="submit" class="btn btn-primary me-2">Mettre à jour</button>
            <a href="{{ route('epreuves.index') }}" class="btn btn-outline-secondary">Annuler</a>
        </div>
    </form>
</div>
@endsection
