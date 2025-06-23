@extends('layouts.app')
@section('title', 'Filières - Admin')

@section('content')
<div class="container mt-5">
    <h2>Filières</h2>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Code</th>
                <th>Effectif</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($filieres as $filiere)
                <tr>
                    <td>{{ $filiere->id_fil }}</td>
                    <td>{{ $filiere->libelle_fil }}</td>
                    <td>{{ $filiere->code_fil }}</td>
                    <td>{{ $filiere->effectif ?? 'Non défini' }}</td>
                    <td>
                        <a href="{{ route('admin.filieres.edit', ['filiere' => $filiere->id_fil]) }}" class="btn btn-sm btn-warning">✏️</a>
                        <form action="{{ route('admin.filieres.destroy', ['filiere' => $filiere->id_fil]) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Vraiment supprimer cette filière ?')">🗑️</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <a href="{{ route('admin.filieres.create') }}" class="btn btn-success">➕ Ajouter une filière</a>
</div>
@endsection
