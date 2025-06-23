@extends('layouts.app')
@section('title', 'Détail épreuve - ' . $epreuve->titre)

@section('content')
<div class="container mt-5">
    <div class="card shadow-sm card-hover" style="border-radius: 12px; background: white;">
        <div class="card-body">
            <h2 class="mb-4">{{ $epreuve->titre }}</h2>
            <p class="text-muted">{{ $epreuve->description }}</p>

            <div class="row mb-4">
                <div class="col-md-6">
                    <strong>Créée par :</strong> {{ optional($epreuve->professeur)->nom_prof ?? 'Inconnu' }}
                </div>
                <div class="col-md-6">
                    <strong>Statut :</strong>
                    @if ($epreuve->statut_ep === 'en_attente_validation')
                        <span class="badge bg-warning text-dark">{{ ucfirst($epreuve->statut_ep) }}</span>
                    @elseif ($epreuve->statut_ep === 'validee')
                        <span class="badge bg-success">Validee</span>
                    @else
                        <span class="badge bg-danger">{{ ucfirst($epreuve->statut_ep) }}</span>
                    @endif
                </div>
            </div>

            <h4>Questions</h4>
            <ul class="list-group mb-4">
                @forelse ($epreuve->questions as $question)
                    <li class="list-group-item">
                        {{ $question->libelle_quest }}
                        @if ($question->type === 'qcm' || $question->type === 'vrai_faux')
                            <ul class="mt-2 ps-3">
                                @foreach ($question->options as $option)
                                    <li>
                                        {{ $option->libelle_op }}
                                        @if ($option->correct)
                                            <span class="badge bg-success ms-2">✅</span>
                                        @endif
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </li>
                @empty
                    <div class="alert alert-warning mt-3">Aucune question associée</div>
                @endforelse
            </ul>

            <div class="d-grid gap-2 gap-md-0 d-md-flex">
                <form action="{{ route('admin.epreuves.validate', ['epreuve' => $epreuve->id_ep]) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-success me-md-2">✅ Valider l’épreuve</button>
                </form>
                <form action="{{ route('admin.epreuves.refuse', ['epreuve' => $epreuve->id_ep]) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Refuser cette épreuve ?')">❌ Refuser</button>
                </form>
            </div>

            <a href="{{ route('admin.epreuves.index') }}" class="btn btn-outline-secondary mt-3">
                ← Retour à la liste
            </a>
        </div>
    </div>
</div>
@endsection
