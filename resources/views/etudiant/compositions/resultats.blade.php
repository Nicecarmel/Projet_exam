@extends('layouts.app')
@section('title', 'Résultats - ' . $epreuve->titre)

@section('content')
<div class="container mt-5">
    <div class="card shadow-sm border-0">
        <div class="card-body p-5">
            <h2>Résultats de l’épreuve </h2>
            <p class="lead">Épreuve : <strong>{{ $epreuve->titre }}</strong></p>


            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Question</th>
                        <th>Votre réponse</th>
                        <th>Correcte ?</th>
                        <th>Points</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($reponses as $rep)
                        <tr>
                            <td>{{ $rep->question->libelle_quest }}</td>
                            <td>
                                @if ($rep->option_id)
                                    {{ optional($rep->option)->libelle_op }}
                                @else
                                    {{ $rep->reponse_text }}
                                @endif
                            </td>
                            <td>
                                @if ($rep->point_obtenu > 0)
                                    <span class="badge bg-success">✔️ Oui</span>
                                @else
                                    <span class="badge bg-danger">❌ Non</span>
                                @endif
                            </td>
                            <td>{{ $rep->point_obtenu }} / {{ $rep->question->point }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <h4>Note finale : {{ $note }} / {{ $totalPoints }}</h4>

            <a href="{{ route('etudiant.dashboard') }}" class="btn btn-outline-secondary mt-3">
                ← Retour au tableau de bord
            </a>
        </div>
    </div>
</div>
@endsection
