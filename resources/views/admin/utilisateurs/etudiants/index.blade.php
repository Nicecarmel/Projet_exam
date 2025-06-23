@extends('layouts.app')
@section('title', 'Liste des étudiants')

@section('content')
<div class="container mt-5">
    <h2>Liste des étudiants</h2>
    <table class="table table-hover mt-3">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Email</th>
                <th>Inscrit depuis</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($etudiants as $etudiant)
                <tr>
                    <td>{{ $etudiant->id_et }}</td>
                    <td>{{ $etudiant->nom_et }} {{ $etudiant->prenom_et }}</td>
                    <td>{{ $etudiant->email_et }}</td>
                    <td>{{ $etudiant->created_at->diffForHumans() }}</td>
                    <td>
                        <a href="{{ route('admin.utilisateurs.etudiants.edit', ['etudiant' => $etudiant->id_et]) }}" class="btn btn-sm btn-warning">✏️</a>
                        <form action="{{ route('admin.utilisateurs.etudiants.destroy', ['etudiant' => $etudiant->id_et]) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Supprimer cet étudiant ?')">🗑️</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <a href="{{ route('admin.utilisateurs.etudiants.create') }}" class="btn btn-success">➕ Ajouter un étudiant</a>
</div>
@endsection
