@extends('layouts.app')
@section('title', 'Passation - ' . $epreuve->titre)

@section('content')
<div class="container mt-5">
    <h2>{{ $epreuve->titre }}</h2>
    <p class="text-muted mb-4">{{ $epreuve->description }}</p>

     <!-- Chronomètre -->
    <div class="mb-4 text-center">
        <h4>Temps restant :</h4>
        <div id="timer" class="display-4"></div>
    </div>

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
                                <input type="radio"
                                       name="reponses[{{ $question->id_ques }}]"
                                       value="{{ $option->id_op }}"
                                       id="option-{{ $option->id_op }}"
                                       required>
                                <label for="option-{{ $option->id_op }}" class="form-check-label">
                                    {{ $option->libelle_op }}
                                </label>
                            </div>
                        @endforeach
                    @elseif ($question->type === 'vrai_faux')
                        <div class="d-flex gap-3">
                            <div class="form-check">
                                <input type="radio" name="reponses[{{ $question->id_ques }}]" value="1" id="vrai-{{ $question->id_ques }}" required>
                                <label class="form-check-label" for="vrai-{{ $question->id_ques }}">Vrai</label>
                            </div>
                            <div class="form-check">
                                <input type="radio" name="reponses[{{ $question->id_ques }}]" value="0" id="faux-{{ $question->id_ques }}" required>
                                <label class="form-check-label" for="faux-{{ $question->id_ques }}">Faux</label>
                            </div>
                        </div>
                    @else
                        <textarea name="reponses[{{ $question->id_ques }}][text]" rows="3" class="form-control" required></textarea>
                    @endif
                </div>
            </div>
        @endforeach

        <div class="mt-4">
            <button type="submit" class="btn btn-success w-100 py-2">✅ Soumettre mes réponses</button>
        </div>
    </form>
</div>

<!-- Script pour le chronomètre -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const timerElement = document.getElementById('timer');
        let timeLeft = {{ $epreuve->duree_minutes * 60 }}; // Durée en secondes (par exemple : 30 minutes = 1800s)
        let interval;

        function startTimer() {
            interval = setInterval(() => {
                if (timeLeft <= 0) {
                    clearInterval(interval);
                    alert("Temps écoulé !");
                    window.location.href = "{{ route('etudiant.resultat', ['epreuve' => $epreuve->id_ep]) }}";
                    return;
                }

                const hours = Math.floor(timeLeft / 3600);
                const minutes = Math.floor((timeLeft % 3600) / 60);
                const seconds = timeLeft % 60;

                timerElement.textContent = `${hours.toString().padStart(2, '0')}:${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;

                timeLeft--;
            }, 1000);
        }

        startTimer();
    });
@endsection
