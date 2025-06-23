@extends('layouts.app')
@section('title', 'Modifier la question')

@section('content')
<div class="container mt-5">
    <h2>Modifier la question</h2>
    <p class="lead mb-4">Épreuve : <strong>{{ $question->epreuve->titre }}</strong></p>

    <form action="{{ route('epreuves.questions.update', ['epreuve' => $question->epreuve->id_ep, 'question' => $question->id_ques]) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Contenu -->
        <div class="mb-3">
            <label for="libelle_quest" class="form-label">Contenu de la question</label>
            <textarea name="libelle_quest" id="libelle_quest" rows="3" class="form-control" required>{{ old('libelle_quest', $question->libelle_quest) }}</textarea>
        </div>

        <!-- Type -->
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="type" class="form-label">Type de question</label>
                <select name="type" id="type" class="form-select" required>
                    <option value="">Sélectionnez un type</option>
                    <option value="qcm" {{ $question->type === 'qcm' ? 'selected' : '' }}>QCM</option>
                    <option value="qroc" {{ $question->type === 'qroc' ? 'selected' : '' }}>QROC</option>
                    <option value="vrai_faux" {{ $question->type === 'vrai_faux' ? 'selected' : '' }}>Vrai / Faux</option>
                    <option value="ouverte" {{ $question->type === 'ouverte' ? 'selected' : '' }}>Question ouverte</option>
                </select>
            </div>

            <!-- Points -->
            <div class="col-md-6 mb-3">
                <label for="point" class="form-label">Points attribués</label>
                <input type="number" name="point" id="point" class="form-control" min="1" max="20" value="{{ old('point', $question->point) }}" required>
            </div>
        </div>

        <!-- Options -->
        <div id="options-container" style="display: block;">
            <h4>Options de réponse</h4>
            <div id="options">
                @if (in_array($question->type, ['qcm', 'vrai_faux']) && $question->options->count() > 0)
                    @foreach ($question->options as $option)
                        <div class="option-group mb-3 d-flex align-items-center">
                            <input type="text" name="options[{{ $loop->index }}][text]"
                                   value="{{ $option->libelle_op }}" class="form-control me-2">
                            <input type="hidden" name="options[{{ $loop->index }}][id_op]" value="{{ $option->id_op }}">
                            <input type="checkbox" name="options[{{ $loop->index }}][correct]"
                                   {{ $option->correct ? 'checked' : '' }} class="form-check-input">
                            <label class="form-check-label ms-2">Correcte</label>
                        </div>
                    @endforeach
                @else
                    <p class="text-muted">Aucune option nécessaire pour ce type de question.</p>
                @endif
            </div>
            <button type="button" class="btn btn-outline-primary btn-sm" onclick="addOption()">+ Ajouter une option</button>
        </div>

        <!-- Bouton soumission -->
        <div class="mt-4">
            <button type="submit" class="btn btn-primary w-100 py-2">Mettre à jour</button>
        </div>
    </form>
</div>

<script>
    let optionCount = {{ count($question->options) }};

    document.getElementById('type').addEventListener('change', function () {
        const container = document.getElementById('options-container');
        const selected = this.value;
        container.style.display = (selected === 'qcm' || selected === 'vrai_faux') ? 'block' : 'none';
    });

    function addOption() {
        const group = document.createElement('div');
        group.className = 'option-group mb-3 d-flex align-items-center';
        group.innerHTML = `
            <input type="text" name="options[${optionCount}][text]" placeholder="Nouvelle option" class="form-control me-2">
            <input type="checkbox" name="options[${optionCount}][correct]" class="form-check-input">
            <label class="form-check-label ms-2">Correcte</label>
        `;
        document.getElementById('options').appendChild(group);
        optionCount++;
    }
</script>
@endsection
