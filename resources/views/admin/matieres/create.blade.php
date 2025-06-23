@extends('layouts.app')
@section('title', 'Ajouter une matière')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm card-hover" style="background: white; border-radius: 12px;">
                <div class="card-body p-4">
                    <h2>Ajouter une matière</h2>
                    <form action="{{ route('admin.matieres.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="libelle_mat" class="form-label">Nom de la matière</label>
                            <input type="text" name="libelle_mat" id="libelle_mat" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="code_mat" class="form-label">Code de la matière</label>
                            <input type="text" name="code_mat" id="code_mat" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="filiere_id" class="form-label">Filière associée</label>
                            <select name="filiere_id" id="filiere_id" class="form-select" required>
                                <option value="">Sélectionnez une filière</option>
                                @foreach ($filieres as $filiere)
                                    <option value="{{ $filiere->id_fil }}">{{ $filiere->libelle_fil }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary py-2">Enregistrer</button>
                            <a href="{{ route('admin.matieres.index') }}" class="btn btn-outline-secondary py-2">← Annuler</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
