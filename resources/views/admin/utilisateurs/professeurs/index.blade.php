@extends('layouts.app')
@section('title', 'Liste des professeurs')

@section('content')
<div class="container mt-5">
    <h2>Liste des professeurs</h2>
    <table class="table table-bordered table-hover mt-3">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Email</th>
                <th>Telephone</th>
                <th>Matière enseignée</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($professeurs as $professeur)
                <tr>
                    <td>{{ $professeur->id_prof }}</td>
                    <td>{{ $professeur->nom_prof }} {{ $professeur->prenom_prof }}</td>
                    <td>{{ $professeur->email_prof }}</td>
                     <td>{{ $professeur->tel_prof }}</td>
                    <td>{{ optional($professeur->matiere)->libelle_mat ?? 'Aucune' }}</td>
                    <td>
                        <a href="{{ route('admin.utilisateurs.professeurs.edit', ['professeur' => $professeur->id_prof]) }}" class="btn btn-sm btn-warning">✏️</a>
                        <form action="{{ route('admin.utilisateurs.professeurs.destroy', ['professeur' => $professeur->id_prof]) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Supprimer ce professeur ?')">🗑️</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <a href="{{ route('admin.utilisateurs.professeurs.create') }}" class="btn btn-success">➕ Ajouter un professeur</a>
</div>
@endsection
