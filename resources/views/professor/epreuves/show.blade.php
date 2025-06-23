@extends('layouts.app')
@section('title', 'Détail de l’épreuve - ' . $epreuve->titre)

@section('content')
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>{{ $epreuve->titre }}</h2>
        <span class="badge bg-info fs-6">{{ ucfirst($epreuve->statut_ep) }}</span>
    </div>

    <p class="text-muted">{{ $epreuve->description }}</p>

    <div class="row mb-4">
        <div class="col-md-4">
            <strong>Date</strong> : {{ $epreuve->date_ep ? \Carbon\Carbon::parse($epreuve->date_ep)->format('d M Y') : 'Non définie' }}
        </div>
        <div class="col-md-4">
            <strong>Durée</strong> : {{ $epreuve->duree_minutes ?? 'Non définie' }} min
        </div>
        <div class="col-md-4">
            <strong>Correction auto</strong> :
            @if ($epreuve->mode_notation_auto)
                <span class="badge bg-success">Activée</span>
            @else
                <span class="badge bg-secondary">Désactivée</span>
            @endif
        </div>
    </div>

    <hr />

    <h4>Liste des questions</h4>

    @if ($epreuve->questions->count() > 0)
        <div class="list-group mb-4">
            @foreach ($epreuve->questions as $question)
                <div class="list-group-item py-3">
                    <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1">{{ $question->libelle_quest }}</h5>
                        <small>Type: <strong>{{ strtoupper($question->type) }}</strong></small>
                    </div>
                    <p class="mb-1 text-muted">Points : {{ $question->point }}</p>

                    <!-- Affiche les options si c’est QCM ou Vrai/Faux -->
                    @if (in_array($question->type, ['qcm', 'vrai_faux']))
                        <ul class="list-group list-group-flush mt-2">
                            @foreach ($question->options as $option)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    {{ $option->libelle_op }}
                                    @if ($option->correct)
                                        <span class="badge bg-success">Correcte</span>
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            @endforeach
        </div>

        <!-- Bouton Soumettre pour validation -->
        <form action="{{ route('epreuves.submit_for_validation', $epreuve->id_ep) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir envoyer cette épreuve pour validation ?');">
            @csrf
            <button type="submit" class="btn btn-primary w-100 py-2">
                <i class="fas fa-paper-plane me-2"></i>Soumettre pour validation
            </button>
        </form>

    @else
        <div class="alert alert-warning">Aucune question ajoutée pour le moment.</div>
    @endif

    <div class="mt-4">
        <a href="{{ route('epreuves.questions.create', ['epreuve' => $epreuve->id_ep]) }}" class="btn btn-outline-primary">
            <i class="fas fa-plus me-2"></i>Ajouter une question
        </a>
    </div>
</div>
@endsection
