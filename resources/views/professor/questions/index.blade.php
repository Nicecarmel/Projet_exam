<!-- resources/views/professor/questions/index.blade.php -->

@extends('layouts.app')
@section('title', 'Questions - ' . $epreuve->titre)

@section('content')
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Questions de l’épreuve : {{ $epreuve->titre }}</h2>
        <a href="{{ route('epreuves.questions.create', ['epreuve' => $epreuve->id_ep]) }}" class="btn btn-primary">+ Nouvelle question</a>
    </div>

    @if ($epreuve->questions->count() > 0)
        <div class="list-group">
            @foreach ($epreuve->questions as $question)
                <div class="list-group-item list-group-item-action py-3">
                    <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1">{{ $question->libelle_quest }}</h5>
                        <small>Type: <strong>{{ strtoupper($question->type) }}</strong></small>
                    </div>
                    <p class="mb-1 text-muted">Points : {{ $question->point }}</p>

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

                    <div class="mt-3">
                        <a href="{{ route('epreuves.questions.edit', ['epreuve' => $epreuve->id_ep, 'question' => $question->id_ques]) }}" class="btn btn-sm btn-outline-secondary me-2">
                            Modifier
                        </a>
                        <form action="{{ route('epreuves.questions.destroy', ['epreuve' => $epreuve->id_ep, 'question' => $question->id_ques]) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette question ?')">Supprimer</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-4">
            <a href="{{ route('epreuves.show', ['epreuve' => $epreuve->id_ep]) }}" class="btn btn-outline-success">
                ← Retour à l’épreuve
            </a>
        </div>
    @else
        <div class="alert alert-info">Aucune question ajoutée pour le moment.</div>
    @endif
</div>
@endsection
