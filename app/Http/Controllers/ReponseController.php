<?php

// app/Http/Controllers/ReponseController.php

namespace App\Http\Controllers;

use App\Models\Epreuve;
use App\Models\Reponse;
use App\Models\Composer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReponseController extends Controller
{
    // 📋 Historique des épreuves passées
    public function index()
    {
        $etudiant = session('etudiant');

        $compositions = Composer::where('etudiant_id', $etudiant->id_et)
            ->with('epreuve')
            ->get();

        // Assure-toi que chaque composition a des réponses
        foreach ($compositions as $composition) {
            if (!$composition->reponses->count()) {
                // Optionnel : Redirige ou affiche un message
                return redirect()->back()->with('error', 'Aucune réponse trouvée.');
            }
        }
        return view('etudiant.reponses.index', compact('compositions'));
    }

    // 📄 Détails des réponses à une épreuve
    public function show(Reponse $reponse)
    {
        // Vérifie que cette réponse appartient bien à l’étudiant connecté
        if ($reponse->etudiant_id != session('etudiant')->id_et) {
            abort(403);
        }

        // Récupère l'épreuve associée
        $epreuve = $reponse->epreuve;

        // Récupère toutes les réponses de cette épreuve
        $reponses = $reponse->etudiant->reponses()
            ->where('epreuve_id', $epreuve->id_ep)
            ->with('question', 'option')
            ->get();

        $note = $reponses->sum('point_obtenu');
        $totalPoints = $epreuve->questions->sum('point');

        return view('etudiant.reponses.show', compact('epreuve', 'reponses', 'note', 'totalPoints'));
    }
}
