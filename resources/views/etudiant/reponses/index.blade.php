@extends('layouts.app')
@section('title', 'Mes résultats - Étudiant')

@section('content')
    <div class="container mt-5">
        <h2>Mes épreuves passées</h2>
        <p class="lead">Retrouvez vos notes et feedbacks ici.</p>

        @if ($compositions->isEmpty())
            <div class="alert alert-info">Aucune épreuve passée pour le moment.</div>
        @else
            <div class="list-group">
                @foreach ($compositions as $composition)
                    @if ($composition->reponses->count())
                        <a
                            href="{{ route('etudiant.reponses.show', ['reponse' => $composition->reponses->first()->id_rep]) }}">
                            Voir détails
                        </a>
                    @else
                        <p>Aucune réponse trouvée.</p>
                    @endif
                @endforeach
            </div>
        @endif

        <a href="{{ route('etudiant.dashboard') }}" class="btn btn-outline-secondary mt-4">
            ← Retour au tableau de bord
        </a>
    </div>
@endsection
