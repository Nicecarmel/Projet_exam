@extends('layouts.app')
@section('title', 'Modifier une filière - ' . $filiere->libelle_fil)

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm card-hover" style="border-radius: 12px; background: white;">
                <div class="card-body p-4">
                    <h2>Modifier la filière</h2>
                    <form action="{{ route('admin.filieres.update', ['filiere' => $filiere->id_fil]) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="libelle_fil" class="form-label">Nom de la filière</label>
                            <input type="text" name="libelle_fil" id="libelle_fil" class="form-control" value="{{ $filiere->libelle_fil }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="code_fil" class="form-label">Code de la filière</label>
                            <input type="text" name="code_fil" id="code_fil" class="form-control" value="{{ $filiere->code_fil }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="effectif" class="form-label">Effectif (facultatif)</label>
                            <input type="number" name="effectif" id="effectif" class="form-control" value="{{ $filiere->effectif }}">
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary py-2">Mettre à jour</button>
                            <a href="{{ route('admin.filieres.index') }}" class="btn btn-outline-secondary py-2">← Retour</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
