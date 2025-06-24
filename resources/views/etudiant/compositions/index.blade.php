@extends('layouts.app')
@section('title', 'Épreuves disponibles - Étudiant')

@section('content')
<div class="container mt-5">
    <h2>Épreuves disponibles</h2>
    <p class="lead">Sélectionnez une épreuve pour commencer.</p>

    @if ($epreuves->isEmpty())
        <div class="alert alert-info">Aucune épreuve disponible pour le moment.</div>
    @else
        <div class="row g-4">
            @foreach ($epreuves as $epreuve)
                <div class="col-md-6 col-lg-4">
                    <div class="card shadow-sm border-0 card-hover" style="border-radius: 12px; background: white;">
                        <div class="card-body p-4">
                            <h5>{{ $epreuve->titre }}</h5>
                            <p class="card-text text-muted small">{{ Str::limit($epreuve->description, 80) }}</p>
                            <a href="{{ route('epreuves.etudiant.passation', ['epreuve' => $epreuve->id_ep]) }}" class="btn btn-primary w-100 py-2">
                                ➤ Commencer l’épreuve
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

    <a href="{{ route('etudiant.dashboard') }}" class="btn btn-outline-secondary mt-4">
        ← Retour au tableau de bord
    </a>
</div>
@endsection
