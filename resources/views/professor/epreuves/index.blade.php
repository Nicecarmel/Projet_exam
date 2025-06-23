<!-- resources/views/professor/epreuves/index.blade.php -->

@extends('layouts.app')
@section('title', 'Mes épreuves')

<style>
    .btn-hover {
        transition: all 0.3s ease;
    }
    .btn-hover:hover {
        transform: scale(1.02);
    }
</style>

@section('content')
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Mes épreuves</h2>
        <a href="{{ route('epreuves.create') }}" class="btn btn-success">+ Nouvelle épreuve</a>
    </div>

    @if ($epreuves->count() > 0)
        <div class="row g-4">
            @foreach ($epreuves as $epreuve)
                <div class="col-md-6 col-lg-4">
                    <div class="card shadow-sm card-hover border-0" style="border-radius: 12px;">
                        <div class="card-body">
                            <!-- Titre -->
                            <h5 class="card-title">{{ $epreuve->titre }}</h5>
                            <!-- Description -->
                            <p class="card-text text-muted small">{{ Str::limit($epreuve->description, 80) }}</p>

                            <!-- Statut et date -->
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                @php
                                    // Couleurs selon le statut
                                    $statutColors = [
                                        'brouillon' => 'bg-secondary',
                                        'en_attente_validation' => 'bg-warning',
                                        'validee' => 'bg-success',
                                        'refusee' => 'bg-danger'
                                    ];
                                @endphp

                                <span class="badge {{ $statutColors[$epreuve->statut_ep] ?? 'bg-info' }}">
                                    {{ ucfirst($epreuve->statut_ep) }}
                                </span>
                                <small>{{ \Carbon\Carbon::parse($epreuve->created_at)->format('d M Y') }}</small>
                            </div>

                            <!-- Nombre de questions -->
                            <div class="mb-3">
                                <small class="text-muted">
                                    {{ $epreuve->questions->count() }} question(s)
                                </small>
                            </div>

                            <!-- Boutons d’actions -->
                            <div class="d-grid gap-2">
                                <a href="{{ route('epreuves.questions.index', ['epreuve' => $epreuve->id_ep]) }}" class="btn btn-outline-primary">
                                    Voir les questions
                                </a>
                                <a href="{{ route('epreuves.show', $epreuve->id_ep) }}" class="btn btn-outline-primary btn-hover w-100">
                                    Détail
                                </a>
                                <a href="{{ route('epreuves.edit', $epreuve->id_ep) }}" class="btn btn-outline-secondary">
                                    Modifier
                                </a>

                                <!-- Soumettre pour validation (visible uniquement si brouillon et avec des questions) -->
                                @if ($epreuve->statut_ep === 'brouillon' && $epreuve->questions->count() > 0)
                                    <form action="{{ route('epreuves.submit_for_validation', $epreuve->id_ep) }}" method="POST" onsubmit="return confirm('Envoyer cette épreuve pour validation ?');">
                                        @csrf
                                        <button type="submit" class="btn btn-primary w-100">
                                            Soumettre pour validation
                                        </button>
                                    </form>
                                @endif

                                <!-- Supprimer -->
                                <form action="{{ route('epreuves.destroy', $epreuve->id_ep) }}" method="POST" onsubmit="return confirm('Voulez-vous vraiment supprimer cette épreuve ?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger w-100">
                                        Supprimer
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="alert alert-info">Vous n’avez pas encore créé d’épreuve.</div>
    @endif
</div>
@endsection
