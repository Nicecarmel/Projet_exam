@extends('layouts.app')
@section('title', 'Résultats - ' . $epreuve->titre)

@section('content')
<div class="container mt-5">
    <div class="card shadow-sm border-0">
        <div class="card-body p-5">
            <h2>Résultats de l’épreuve</h2>
            <p class="lead mb-4">{{ $epreuve->titre }}</p>

            @foreach ($reponses as $rep)
                <div class="mb-4">
                    <strong>Question :</strong> {{ $rep->question->libelle_quest }}<br>
                    <strong>Votre réponse :</strong>
                    @if ($rep->option_id)
                        {{ optional($rep->option)->libelle_op }}
                    @else
                        {{ $rep->reponse_text }}
                    @endif<br>
                    <strong>Points obtenus :</strong> {{ $rep->point_obtenu ?? 0 }}/{{ $rep->question->point }}
                </div>
            @endforeach

            <h4>Note totale : {{ $note }} / {{ $totalPoints }}</h4>

            <a href="{{ route('etudiant.dashboard') }}" class="btn btn-outline-secondary mt-3">← Retour au tableau de bord</a>
        </div>
    </div>
</div>
@endsection
