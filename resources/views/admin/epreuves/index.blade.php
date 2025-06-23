@extends('layouts.app')
@section('title', 'Épreuves en attente - Admin')

@section('content')
<div class="container mt-5">
    <h2>Épreuves en attente de validation</h2>
    <div class="card shadow-sm card-hover" style="border-radius: 12px; background: white;">
        <div class="card-body">
            @if ($epreuves->isEmpty())
                <div class="alert alert-info">Aucune épreuve en attente.</div>
            @else
                <table class="table table-striped table-hover align-middle">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Titre</th>
                            <th>Professeur</th>
                            <th>Date</th>
                            <th>Statut</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($epreuves as $epreuve)
                            <tr>
                                <td>{{ $epreuve->id_ep }}</td>
                                <td><a href="{{ route('admin.epreuves.show', ['epreuve' => $epreuve->id_ep]) }}">{{ $epreuve->titre }}</a></td>
                                <td>{{ optional($epreuve->professeur)->nom_prof ?? 'Inconnu' }}</td>
                                <td>{{ $epreuve->date_ep ? \Carbon\Carbon::parse($epreuve->date_ep)->format('d/m/Y') : 'Non définie' }}</td>
                                <td><span class="badge bg-warning text-dark">{{ ucfirst($epreuve->statut_ep) }}</span></td>
                                <td>
                                    <form action="{{ route('admin.epreuves.validate', ['epreuve' => $epreuve->id_ep]) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-success">✅ Valider</button>
                                    </form>
                                    <form action="{{ route('admin.epreuves.refuse', ['epreuve' => $epreuve->id_ep]) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Refuser cette épreuve ?')">❌ Refuser</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif

            <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary mt-3">
                ← Retour au tableau de bord
            </a>
        </div>
    </div>
</div>
@endsection
