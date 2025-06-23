<?php

// app/Http/Controllers/Etudiant/ExamController.php


namespace App\Http\Controllers;

use App\Models\Epreuve;
use App\Models\Composer;
use App\Models\Reponse;
use App\Models\Question;
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

    // 📝 Affiche l’épreuve à passer
    public function showPassation(Epreuve $epreuve)
    {
        if ($epreuve->statut_ep !== 'validee') {
            abort(403, 'Épreuve non disponible');
        }

        $etudiant = session('etudiant');

        // Créer une nouvelle entrée dans `composers` si pas encore commencée
        $composition = Composer::firstOrCreate(
            [
                'etudiant_id' => $etudiant->id_et,
                'epreuve_id' => $epreuve->id_ep
            ],
            [
                'statut' => 'en_cours',
                'date_debut' => now(),
                'date_fin' => null,
                'note' => null
            ]
        );

        return view('etudiant.compositions.passation', compact('epreuve'));
    }

    // 💾 Soumet les réponses
    public function submitPassation(Request $request, Epreuve $epreuve)
    {
        $etudiant = session('etudiant');
        $reponses = $request->input('reponses', []);

        // Récupère ou crée la composition
        $composition = Composer::firstOrCreate(
            ['etudiant_id' => $etudiant->id_et, 'epreuve_id' => $epreuve->id_ep],
            ['statut' => 'termine']
        );

        $note = 0;

        foreach ($reponses as $questionId => $rep) {
            $question = $epreuve->questions->find($questionId);

            if (!$question) continue;

            // Enregistre la réponse
            Reponse::updateOrCreate(
                ['etudiant_id' => $etudiant->id_et, 'epreuve_id' => $epreuve->id_ep, 'question_id' => $question->id_ques],
                [
                    'reponse_text' => is_array($rep) ? null : $rep,
                    'option_id' => is_array($rep) ? null : null,
                    'point_obtenu' => $this->calculerPoints($rep, $question),
                ]
            );

            $note += $this->calculerPoints($rep, $question);
        }

        // Met à jour la note dans `composers`
        $composition->update([
            'note' => $note,
            'date_fin' => now(),
            'statut' => 'corrige'
        ]);

        return redirect()->route('etudiant.resultat', ['epreuve' => $epreuve->id_ep])
                         ->with(['note' => $note, 'totalPoints' => $epreuve->questions->sum('point')]);
    }

    // 🔢 Calcule les points obtenus selon le type de question
    private function calculerPoints($reponse, $question)
    {
        if ($question->type === 'qcm' || $question->type === 'vrai_faux') {
            $option = $question->options->find($reponse);
            return $option && $option->correct ? $question->point : 0;
        } elseif ($question->type === 'ouverte') {
            return 0; // À corriger manuellement plus tard
        } else {
            return 0; // QROC, etc.
        }
    }

    // 📊 Affiche les résultats après soumission
    public function resultat(Epreuve $epreuve)
    {
        $etudiant = session('etudiant');

        // Récupère toutes les réponses de cet étudiant pour cette épreuve
        $reponses = Reponse::where('etudiant_id', $etudiant->id_et)
                          ->where('epreuve_id', $epreuve->id_ep)
                          ->with(['question', 'option'])
                          ->get();

        $note = $reponses->sum('point_obtenu');
        $totalPoints = $epreuve->questions->sum('point');

        return view('etudiant.compositions.resultats', compact('epreuve', 'reponses', 'note', 'totalPoints'));
    }
}
