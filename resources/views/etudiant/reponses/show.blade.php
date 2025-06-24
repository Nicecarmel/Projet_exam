@extends('layouts.app')
@section('title', 'Détail des réponses')

@section('content')
<div class="container mt-5">
    <h2>Détail des réponses</h2>
    <p class="lead">Épreuve : {{ $epreuve->titre }}</p>

    <ul class="list-group">
        @foreach ($reponses as $rep)
            <li class="list-group-item">
                <strong>{{ $rep->question->libelle_quest }}</strong><br>
                @if ($rep->option_id)
                    Votre réponse : {{ optional($rep->option)->libelle_op }}
                @else
                    Votre réponse : {{ $rep->reponse_text }}
                @endif<br>
                <small>Note : {{ $rep->point_obtenu ?? 0 }}/{{ $rep->question->point }}</small>
            </li>
        @endforeach
    </ul>

    <a href="{{ route('etudiant.reponses.index') }}" class="btn btn-outline-secondary mt-4">
        ← Retour à mes résultats
    </a>
</div>
@endsection
