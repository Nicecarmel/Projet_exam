<?php

namespace App\Http\Controllers;

use App\Models\Epreuve;
use App\Models\Question;
use App\Models\Option;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    /**
     * Affiche le formulaire de création d'une question.
     */
    public function create(Epreuve $epreuve)
    {
        if ($epreuve->professeur_id != session('professeur')->id_prof) {
            abort(403);
        }

        return view('professor.questions.create', compact('epreuve'));
    }

    public function index(Epreuve $epreuve)
    {
    // Vérifie que le professeur est connecté et propriétaire de l’épreuve
    if ($epreuve->professeur_id != session('professeur')->id_prof) {
        abort(403);
    }

    // Récupère toutes les questions de l’épreuve
    $questions = $epreuve->questions;

    return view('professor.questions.index', compact('epreuve', 'questions'));
   }

    /**
     * Stocke une nouvelle question dans la base de données.
     */
    public function store(Request $request, Epreuve $epreuve)
    {
        if (!session()->has('professeur')) {
        return redirect()->route('professor.login');
        }

        // Récupère le professeur depuis la session
        $prof = session('professeur');

        // Vérifie qu’il est autorisé à modifier l’épreuve
        if ($epreuve->professeur_id != $prof->id_prof) {
        abort(403);
       }

        // Valide les champs
        $validated = $request->validate([
            'libelle_quest' => 'required|string',
            'type' => 'required|in:qcm,qroc,vrai_faux,ouverte',
            'point' => 'required|integer|min:1|max:20',
            'options' => 'array|required_if:type,qcm,vrai_faux'
        ]);

        // Crée la question
        $question = $epreuve->questions()->create([
            'libelle_quest' => $validated['libelle_quest'],
            'type' => $validated['type'],
            'point' => $validated['point'] ?? 1,
        ]);

        // Si QCM ou Vrai/Faux → enregistre les options
        if ($request->has('options')) {
            foreach ($validated['options'] as $index => $op) {
                if (!empty($op['text'])) {
                    $question->options()->create([
                        'libelle_op' => $op['text'],
                        'correct' => !empty($op['correct']),
                        'ordre' => $index + 1,
                    ]);
                }
            }
        }

        return redirect()->route('epreuves.questions.create', ['epreuve' => $epreuve->id_ep]);
    }

    /**
     * Affiche le formulaire d’édition d’une question.
     */
    public function edit(Question $question)
    {
        if ($question->epreuve->professeur_id != session('professeur')->id_prof) {
            abort(403);
        }

        $epreuve = $question->epreuve;

        return view('professor.questions.edit', compact('question'));
    }

    /**
     * Met à jour une question et ses options.
     */
    public function update(Request $request, Question $question)
    {
        if ($question->epreuve->professeur_id  != session('professeur')->id_prof) {
            abort(403);
        }

        $validated = $request->validate([
            'libelle_quest' => 'required|string',
            'type' => 'required|in:qcm,qroc,vrai_faux,ouverte',
            'point' => 'required|integer|min:1|max:20',
            'options' => 'array|required_if:type,qcm,vrai_faux'
        ]);

        $question->update([
            'libelle_quest' => $validated['libelle_quest'],
            'type' => $validated['type'],
            'point' => $validated['point'],
        ]);

        // Mise à jour des options si type QCM ou Vrai/Faux
       // Mise à jour des options si QCM ou Vrai/Faux
       if (in_array($request->input('type'), ['qcm', 'vrai_faux'])) {
        foreach ($validated['options'] as $opData) {
            if (!empty($opData['text'])) {
                Option::updateOrCreate(
                    ['id_op' => $opData['id_op'] ?? null],
                    [
                        'question_id' => $question->id_ques,
                        'libelle_op' => $opData['text'],
                        'correct' => !empty($opData['correct']),
                        'ordre' => $opData['ordre'] ?? $opData['id_op']
                    ]
                );
            }
        }
       }

       return redirect()->route('epreuves.show', ['epreuve' => $question->epreuve->id_ep])
                     ->with('success', 'Question mise à jour.');
       }

    /**
     * Supprime une question.
     */
    public function destroy(Question $question)
    {
        if ($question->epreuve->professeur_id  != session('professeur')->id_prof) {
            abort(403);
        }

        $epreuveId = $question->epreuve_id;
        $question->delete();

        return redirect()->route('epreuves.questions.index', ['epreuve' => $epreuveId])
                         ->with('success', 'Question supprimée avec succès');
    }
}
