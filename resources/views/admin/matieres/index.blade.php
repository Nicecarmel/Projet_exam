@extends('layouts.app')
@section('title', 'Matières - Admin')

@section('content')
<div class="container mt-5">
    <h2>Matières</h2>
    <table class="table table-hover mt-3 align-middle">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Code</th>
                <th>Filière</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($matieres as $matiere)
                <tr>
                    <td>{{ $matiere->id_mat }}</td>
                    <td>{{ $matiere->libelle_mat }}</td>
                    <td>{{ $matiere->code_mat }}</td>
                    <td>{{ optional($matiere->filiere)->libelle_fil ?? 'Aucune' }}</td>
                    <td>
                        <a href="{{ route('admin.matieres.edit', ['matiere' => $matiere->id_mat]) }}" class="btn btn-sm btn-warning me-2">✏️</a>
                        <form action="{{ route('admin.matieres.destroy', ['matiere' => $matiere->id_mat]) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Vraiment supprimer cette matière ?')">🗑️</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <a href="{{ route('admin.matieres.create') }}" class="btn btn-success">➕ Ajouter une matière</a>
</div>
@endsection
