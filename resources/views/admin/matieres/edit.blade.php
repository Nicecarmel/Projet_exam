@extends('layouts.app')
@section('title', 'Modifier la matière - ' . $matiere->libelle_mat)

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm card-hover" style="background: white; border-radius: 12px;">
                <div class="card-body p-4">
                    <h2>Modifier la matière</h2>
                    <form action="{{ route('admin.matieres.update', ['matiere' => $matiere->id_mat]) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="libelle_mat" class="form-label">Nom de la matière</label>
                            <input type="text" name="libelle_mat" id="libelle_mat" class="form-control" value="{{ $matiere->libelle_mat }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="code_mat" class="form-label">Code de la matière</label>
                            <input type="text" name="code_mat" id="code_mat" class="form-control" value="{{ $matiere->code_mat }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="filiere_id" class="form-label">Filière associée</label>
                            <select name="filiere_id" id="filiere_id" class="form-select" required>
                                <option value="">Sélectionnez une filière</option>
                                @foreach ($filieres as $filiere)
                                    <option value="{{ $filiere->id_fil }}" {{ $filiere->id_fil == $matiere->filiere_id ? 'selected' : '' }}>
                                        {{ $filiere->libelle_fil }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary py-2">Mettre à jour</button>
                            <a href="{{ route('admin.matieres.index') }}" class="btn btn-outline-secondary py-2">← Retour</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
