<?php

// app/Http/Controllers/Etudiant/ExamController.php


namespace App\Http\Controllers;

use App\Models\Epreuve;
use App\Models\Composer;
use App\Models\Reponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ExamController extends Controller
{
    // 📊 Tableau de bord étudiant
    public function dashboard()
    {
        $epreuves = Epreuve::where('statut_ep', 'validee')->get();
        return view('etudiant.dashboard', compact('epreuves'));
    }

    // 📋 Liste des épreuves disponibles
    public function index()
    {
        $epreuves = Epreuve::where('statut_ep', 'validee')->get();
        return view('etudiant.compositions.index', compact('epreuves'));
    }

    // 📝 Passer une épreuve
   public function showPassation(Epreuve $epreuve)
{
    // Vérifie que l'étudiant est connecté
    if (!session()->has('etudiant')) {
        abort(403, 'Accès refusé : vous devez être connecté(e)');
    }

    // Récupère l’étudiant connecté
    $etudiant = session('etudiant');

    // Vérifie que l’épreuve est validée
    if ($epreuve->statut_ep !== 'validee') {
        abort(403, 'Cette épreuve n’est pas disponible pour le moment.');
    }

    // Vérifie si l’étudiant a déjà soumis cette épreuve
    $composition = Composer::where([
        'etudiant_id' => $etudiant->id_et,
        'epreuve_id' => $epreuve->id_ep,
    ])->first();

    if ($composition && in_array($composition->statut, ['termine'])) {
        return redirect()->route('etudiant.resultat', ['epreuve' => $epreuve->id_ep])
                         ->with('info', 'Vous avez déjà soumis cette épreuve.');
    }

    // Met à jour ou crée une entrée dans composers
    Composer::updateOrCreate(
        [
            'etudiant_id' => $etudiant->id_et,
            'epreuve_id' => $epreuve->id_ep
        ],
        [
            'statut' => 'en_cours',
            'date_debut' => now()
        ]
    );

    return view('etudiant.compositions.passation', compact('epreuve'));
}

    // 💾 Soumettre les réponses
    public function submitPassation(Request $request, Epreuve $epreuve)
    {
        $etudiant = session('etudiant');

        // Récupère toutes les réponses soumises
        $reponses = $request->input('reponses', []);

        $note = 0;

        foreach ($reponses as $questionId => $rep) {
            $question = $epreuve->questions->find($questionId);

            if (!$question) continue;

            // Enregistre chaque réponse dans la base
            Reponse::create([
                'etudiant_id' => $etudiant->id_et,
                'epreuve_id' => $epreuve->id_ep,
                'question_id' => $question->id_ques,
                'option_id' => is_array($rep) ? $rep['id_op'] ?? null : null,
                'reponse_text' => is_string($rep) ? $rep : ($rep['text'] ?? null),
                'point_obtenu' => $this->calculerPoints($rep, $question),
            ]);

            // Calcule la note totale si notation auto
             if ($epreuve->mode_notation_auto && in_array($question->type, ['qcm', 'vrai_faux'])) {
            $note += $this->calculerPoints($rep, $question);
           }
        }

        // Met à jour le statut dans `composers`
        Composer::updateOrCreate(
            ['etudiant_id' => $etudiant->id_et,
             'epreuve_id' => $epreuve->id_ep
            ],
            [
            'statut' => 'termine',
            'date_fin' => now(),
            'note' => $note ?: null,
            ]
        );

        return redirect()->route('etudiant.resultat', ['epreuve' => $epreuve->id_ep])
                         ->with(['note' => $note, 'totalPoints' => $epreuve->questions->sum('point')]);
    }

    // 🔢 Méthode privée pour calculer les points
    private function calculerPoints($reponse, $question)
    {
        if (!in_array($question->type, ['qcm', 'vrai_faux'])) {
            return 0; // Pas de correction automatique pour questions ouvertes
        }

        // Cherche si l’option choisie est correcte
        $option = $question->options->where('id_op', $reponse)->first();

        return $option && $option->correct ? $question->point : 0;
    }


    // 📊 Voir les résultats après épreuve
    public function resultat(Epreuve $epreuve)
    {
        $etudiant = session('etudiant');

        $reponses = Reponse::where('etudiant_id', $etudiant->id_et)
            ->where('epreuve_id', $epreuve->id_ep)
            ->with('question', 'option')
            ->get();

        $totalPoints = $epreuve->questions->sum('point');
        $note = $reponses->sum('point_obtenu');

        return view('etudiant.compositions.resultats', compact('epreuve', 'reponses', 'note', 'totalPoints'));
    }
}
