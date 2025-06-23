<?php

namespace App\Http\Controllers;

use App\Models\Epreuve;
use App\Models\Filiere;
use App\Models\Matiere;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EpreuveController extends Controller
{
    /**
     * Affiche le formulaire de création d'épreuve.
     */
    public function create()
    {
        // Vérifie que le professeur est bien connecté
        if (!session()->has('professeur')) {
            abort(403, 'Accès interdit.');
        }

        $filieres = Filiere::all();
        $matieres = Matiere::all();

        return view('professor.epreuves.create',compact('filieres'), compact('matieres'));
    }

    /**
     * Liste toutes les épreuves du professeur connecté.
     */
    public function index(Request $request)
    {
        // Vérifie que le professeur est connecté
        if (!session()->has('professeur')) {
            return redirect()->route('professor.login');
        }

        // Récupère les épreuves du professeur via session
        $professeur = session('professeur');
        $epreuves = $professeur->epreuves;

        return view('professor.epreuves.index', compact('epreuves'));
    }

    /**
     * Stocke une nouvelle épreuve en base de données.
     */
    public function store(Request $request)
    {
        if (!session()->has('professeur')) {
            abort(403, 'Accès interdit.');
        }

        // Validation des champs obligatoires
        $validated = $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'nullable|string',
            'date_ep' => 'nullable|date',
            'heure_debut' => 'nullable',
            'heure_fin' => 'nullable',
            'duree_minutes' => 'nullable|integer|min:10|max:300',
            'mode_notation_auto' => 'nullable|boolean',
        ]);

        $professeur = session('professeur');

        $filiere_id = $request->input('filiere_id');
        $matiere_id = $request->input('matiere_id');

        // Création de l’épreuve
        $epreuve = Epreuve::create([
            'type_ep' => null, // Peut être rempli plus tard
            'titre' => $validated['titre'],
            'description' => $validated['description'] ?? null,
            'date_ep' => $validated['date_ep'] ?? now(),
            'statut_ep' => 'brouillon',
            'heure_debut' => $validated['heure_debut'] ?? null,
            'heure_fin' => $validated['heure_fin'] ?? null,
            'duree_minutes' => $validated['duree_minutes'] ?? null,
            'mode_notation_auto' => $request->has('mode_notation_auto'),
            'professeur_id' => $professeur->id_prof,
            'matiere_id' => $matiere_id,
            'admin_id' => null, // Laisser vide tant que non validée
            'question_id' => null,  // Optionnel : géré côté questions
        ]);

        return redirect()->route('epreuves.questions.create', ['epreuve' => $epreuve->id_ep])
                         ->with('success', 'Épreuve créée. Vous pouvez maintenant ajouter des questions.');
    }

    /**
     * Affiche le formulaire d'édition d'une épreuve.
     */
    public function edit(Epreuve $epreuve)
    {
        if ($epreuve->professeur_id != session('professeur')->id_prof) {
            abort(403, 'Vous n\'êtes pas autorisé à modifier cette épreuve.');
        }

        return view('professor.epreuves.edit', compact('epreuve', 'filieres', 'matieres'));
    }

    /**
     * Affiche les détails d’une épreuve (show).
     */
    public function show(Epreuve $epreuve)
    {
        if ($epreuve->professeur_id  != session('professeur')->id_prof) {
            abort(403, 'Accès interdit');
        }

        return view('professor.epreuves.show', compact('epreuve'));
    }

    /**
     * Met à jour une épreuve existante.
     */
    public function update(Request $request, Epreuve $epreuve)
    {
        if ($epreuve->professeur_id  != session('professeur')->id_prof) {
            abort(403, 'Accès refusé');
        }

        $validated = $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'nullable|string',
            'date_ep' => 'nullable|date',
            'heure_debut' => 'nullable',
            'heure_fin' => 'nullable',
            'duree_minutes' => 'nullable|integer',
            'mode_notation_auto' => 'nullable|boolean',
            'filiere_id' => 'nullable|exists:filieres,id_fil',
            'matiere_id' => 'nullable|exists:matieres,id_mat',
        ]);

        $epreuve->update([
            'titre' => $validated['titre'],
            'description' => $validated['description'] ?? null,
            'date_ep' => $validated['date_ep'] ?? $epreuve->date_ep,
            'heure_debut' => $validated['heure_debut'] ?? null,
            'heure_fin' => $validated['heure_fin'] ?? null,
            'duree_minutes' => $validated['duree_minutes'] ?? null,
            'statut_ep' => $epreuve->statut_ep, // Ne change pas automatiquement
            'mode_notation_auto' => $request->mode_notation_auto ? true : false,
            'filiere_id' => $request->filiere_id ?? $epreuve->filiere_id,
            'matiere_id' => $request->matiere_id ?? $epreuve->matiere_id,
        ]);

        return back()->with('success', 'Épreuve mise à jour.');
    }

    /**
     * Supprime une épreuve.
     */
    public function destroy(Epreuve $epreuve)
    {
        if ($epreuve->professeur_id  != session('professeur')->id_prof) {
            abort(403, 'Accès interdit.');
        }

        $epreuve->delete();

        return redirect()->route('professor.dashboard')
                         ->with('success', 'Épreuve supprimée avec succès.');
    }

    /**
     * Envoie l'épreuve pour validation admin
     */
    public function submitForValidation(Epreuve $epreuve)
    {
        if ($epreuve->professeur_id  != session('professeur')->id_prof) {
            abort(403, 'Vous n\'êtes pas autorisé à envoyer cette épreuve');
        }

        // Vérifie qu’il y a au moins une question
        if ($epreuve->questions->count() < 1) {
            return back()->with('error', 'Ajoutez au moins une question avant de soumettre.');
        }

        // Met à jour le statut de l’épreuve
        $epreuve->update(['statut_ep' => 'en_attente_validation']);

        return redirect()->route('epreuves.index')
                         ->with('success', 'Épreuve envoyée en attente de validation');
    }
}
