@extends('layouts.app')
@section('title', 'Passation - ' . $epreuve->titre)

@section('content')
<div class="container mt-5">
    <h2>{{ $epreuve->titre }}</h2>
    <p class="text-muted mb-4">{{ $epreuve->description }}</p>

    <form action="{{ route('epreuves.etudiant.submit', ['epreuve' => $epreuve->id_ep]) }}" method="POST">
        @csrf

        @foreach ($epreuve->questions as $index => $question)
            <div class="card mb-4 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Question #{{ $index + 1 }}</h5>
                    <p class="card-text">{{ $question->libelle_quest }}</p>

                    @if ($question->type === 'qcm')
                        @foreach ($question->options as $option)
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="radio"
                                       name="reponses[{{ $question->id_ques }}]" value="{{ $option->id_op }}" required>
                                <label class="form-check-label">{{ $option->libelle_op }}</label>
                            </div>
                        @endforeach
                    @elseif ($question->type === 'vrai_faux')
                        <div class="d-flex gap-3 mb-2">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="reponses[{{ $question->id_ques }}]" value="1" required>
                                <label class="form-check-label">Vrai</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="reponses[{{ $question->id_ques }}]" value="0" required>
                                <label class="form-check-label">Faux</label>
                            </div>
                        </div>
                    @else
                        <div class="mb-3">
                            <label for="reponse_{{ $question->id_ques }}" class="form-label">Votre réponse</label>
                            <textarea name="reponses[{{ $question->id_ques }}]" id="reponse_{{ $question->id_ques }}" rows="3" class="form-control" required></textarea>
                        </div>
                    @endif
                </div>
            </div>
        @endforeach

        <div class="mt-4">
            <button type="submit" class="btn btn-success w-100 py-2">✅ Soumettre mes réponses</button>
        </div>
    </form>
</div>
@endsection
