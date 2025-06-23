<!-- resources/views/professor/questions/create.blade.php -->

@extends('layouts.app')
@section('title', 'Ajouter une question')

@section('content')
<div class="container mt-5">
    <h2>Ajouter une question à l’épreuve </h2>
    <p class="lead mb-4">Épreuve : <strong>{{ $epreuve->titre }}</strong></p>

    <form action="{{ route('epreuves.questions.store', ['epreuve' => $epreuve->id_ep]) }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="libelle_quest" class="form-label">Contenu de la question</label>
            <textarea name="libelle_quest" id="libelle_quest" rows="3" class="form-control" required></textarea>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="type" class="form-label">Type de question</label>
                <select name="type" id="type" class="form-select" required>
                    <option value="">Sélectionnez un type</option>
                    <option value="qcm">QCM (Choix multiples)</option>
                    <option value="qroc">QROC (Réponse courte)</option>
                    <option value="vrai_faux">Vrai / Faux</option>
                    <option value="ouverte">Question ouverte</option>
                </select>
            </div>
            <div class="col-md-6 mb-3">
                <label for="point" class="form-label">Points attribués</label>
                <input type="number" name="point" id="point" class="form-control" min="1" max="20" value="1" required>
            </div>
        </div>

        <!-- Zone pour les options -->
        <div id="options-container" style="display: none;">
            <h4 class="mt-4">Options de réponse</h4>
            <div id="options">
                <div class="option-group mb-3 d-flex align-items-center">
                    <input type="text" name="options[0][text]" placeholder="Option 1" class="form-control me-2">
                    <input type="checkbox" name="options[0][correct]" class="form-check-input">
                    <label class="form-check-label ms-2">Correcte</label>
                </div>
                <div class="option-group mb-3 d-flex align-items-center">
                    <input type="text" name="options[1][text]" placeholder="Option 2" class="form-control me-2">
                    <input type="checkbox" name="options[1][correct]" class="form-check-input">
                    <label class="form-check-label ms-2">Correcte</label>
                </div>
            </div>
            <button type="button" onclick="addOption()" class="btn btn-outline-primary btn-sm">+ Ajouter une option</button>
        </div>

        <div class="d-grid gap-2">
            <button type="submit" class="btn btn-success w-100 py-2">
                Enregistrer et continuer
            </button>
            <a href="{{ route('epreuves.show', ['epreuve' => $epreuve->id_ep]) }}" class="btn btn-secondary">
                ← Retour à l’épreuve
            </a>
        </div>
    </form>
</div>

<script>
    let optionCount = 2;

    document.getElementById('type').addEventListener('change', function () {
        const container = document.getElementById('options-container');
        const selected = this.value;

        container.style.display = (selected === 'qcm' || selected === 'vrai_faux') ? 'block' : 'none';
    });

    function addOption() {
        const group = document.createElement('div');
        group.className = 'option-group mb-3 d-flex align-items-center';
        group.innerHTML = `
            <input type="text" name="options[${optionCount}][text]" placeholder="Option ${optionCount + 1}" class="form-control me-2">
            <input type="checkbox" name="options[${optionCount}][correct]" class="form-check-input">
            <label class="form-check-label ms-2">Correcte</label>
        `;
        document.getElementById('options').appendChild(group);
        optionCount++;
    }
</script>
@endsection
