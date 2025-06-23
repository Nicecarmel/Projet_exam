<?php

// app/Http/Controllers/Admin/AdminController.php

namespace App\Http\Controllers\Admin;

use App\Models\Epreuve;
use App\Models\Professeur;
use App\Models\Etudiant;
use App\Models\Filiere;
use App\Models\Matiere;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    // 📊 Tableau de bord
    public function dashboard()
    {
        $epreuvesEnAttente = Epreuve::where('statut_ep', 'en_attente_validation')->get();
        $profCount = Professeur::count();
        $etudiantCount = Etudiant::count();
        $filieres = Filiere::all();
        $matieres = Matiere::with('filiere')->get();


        return view('admin.dashboard', compact(
            'epreuvesEnAttente',
            'profCount',
            'etudiantCount',
            'filieres',
            'matieres',
            
        ));
    }

    // 📋 Liste des épreuves en attente
    public function epreuvesIndex()
    {
        $epreuves = Epreuve::where('statut_ep', 'en_attente_validation')->get();
        return view('admin.epreuves.index', compact('epreuves'));
    }

    // 📄 Détail d’une épreuve
    public function epreuveShow(Epreuve $epreuve)
    {
        return view('admin.epreuves.show', compact('epreuve'));
    }

    // ✅ Valider une épreuve
    public function epreuveValidate(Epreuve $epreuve)
    {
        $epreuve->update([
            'statut_ep' => 'validee',
            'admin_id' => session('admin')->id_admin
        ]);

        return back()->with('success', 'Épreuve validée avec succès.');
    }

    // ❌ Refuser une épreuve
    public function epreuveRefuse(Epreuve $epreuve)
    {
        $epreuve->delete();
        return back()->with('success', 'Épreuve refusée et supprimée.');
    }

    // 👨‍🏫 Liste professeurs
    public function professeursIndex()
    {
        $professeurs = Professeur::all();
        return view('admin.utilisateurs.professeurs.index', compact('professeurs'));
    }

    // ➕ Formulaire ajout professeur
    public function professeursCreate()
    {
        return view('admin.utilisateurs.professeurs.create');
    }

    // 💾 Sauvegarder professeur
    public function professeursStore(Request $request)
    {
        $validated = $request->validate([
            'nom_prof' => 'required|string|max:255',
            'prenom_prof' => 'required|string|max:255',
            'email_prof' => 'required|email|unique:professeurs,email_prof',
            'password' => 'required|min:6',
        ]);

        Professeur::create([
            'nom_prof' => $validated['nom_prof'],
            'prenom_prof' => $validated['prenom_prof'],
            'email_prof' => $validated['email_prof'],
            'password' => bcrypt($validated['password']),
        ]);

        return redirect()->route('admin.utilisateurs.professeurs.index')
                         ->with('success', 'Professeur ajouté avec succès.');
    }

    // 🖍️ Formulaire modification professeur
    public function professeursEdit(Professeur $professeur)
    {
        return view('admin.utilisateurs.professeurs.edit', compact('professeur'));
    }

    // 🔁 Mettre à jour professeur
    public function professeursUpdate(Request $request, Professeur $professeur)
    {
        $validated = $request->validate([
            'nom_prof' => 'required|string|max:255',
            'prenom_prof' => 'required|string|max:255',
            'email_prof' => 'required|email|unique:professeurs,email_prof,' . $professeur->id_prof . ',id_prof',
            'password' => 'nullable|min:6',
        ]);

        $professeur->update([
            'nom_prof' => $validated['nom_prof'],
            'prenom_prof' => $validated['prenom_prof'],
            'email_prof' => $validated['email_prof'],
            'password' => $validated['password'] ? bcrypt($validated['password']) : $professeur->password,
        ]);

        return redirect()->route('admin.utilisateurs.professeurs.index')
                         ->with('success', 'Professeur mis à jour.');
    }

    // 🗑️ Supprimer professeur
    public function professeursDestroy(Professeur $professeur)
    {
        $professeur->delete();
        return back()->with('success', 'Professeur supprimé avec succès.');
    }

    // 🧑‍🎓 Liste étudiants
    public function etudiantsIndex()
    {
        $etudiants = Etudiant::all();
        return view('admin.utilisateurs.etudiants.index', compact('etudiants'));
    }

    // ➕ Formulaire ajout étudiant
    public function etudiantsCreate()
    {
        return view('admin.utilisateurs.etudiants.create');
    }

    // 💾 Enregistrer étudiant
    public function etudiantsStore(Request $request)
    {
        $validated = $request->validate([
            'nom_et' => 'required|string|max:255',
            'prenom_et' => 'required|string|max:255',
            'email_et' => 'required|email|unique:etudiants,email_et',
            'sexe' => 'in:M,F,O',
            'tel_et' => 'nullable|string|max:15',
            'num_mat' => 'required|string|max:50|unique:etudiants,num_mat',
            'password' => 'required|min:6',
        ]);

        Etudiant::create([
            'nom_et' => $validated['nom_et'],
            'prenom_et' => $validated['prenom_et'],
            'email_et' => $validated['email_et'],
            'sexe' => $validated['sexe'],
            'tel_et' => $validated['tel_et'] ?? null,
            'num_mat' => $validated['num_mat'],
            'password' => bcrypt($validated['password']),
        ]);

        return redirect()->route('admin.utilisateurs.etudiants.index')
                         ->with('success', 'Étudiant ajouté avec succès.');
    }

    // 🖍️ Formulaire modification étudiant
    public function etudiantsEdit(Etudiant $etudiant)
    {
        return view('admin.utilisateurs.etudiants.edit', compact('etudiant'));
    }

    // 🔁 Mettre à jour étudiant
    public function etudiantsUpdate(Request $request, Etudiant $etudiant)
    {
        $validated = $request->validate([
            'nom_et' => 'required|string|max:255',
            'prenom_et' => 'required|string|max:255',
            'email_et' => 'required|email|unique:etudiants,email_et,' . $etudiant->id_et . ',id_et',
            'password' => 'nullable|min:6',
        ]);

        $etudiant->update([
            'nom_et' => $validated['nom_et'],
            'prenom_et' => $validated['prenom_et'],
            'email_et' => $validated['email_et'],
            'password' => $validated['password'] ? bcrypt($validated['password']) : $etudiant->password,
        ]);

        return redirect()->route('admin.utilisateurs.etudiants.index')
                         ->with('success', 'Étudiant mis à jour.');
    }

    // 🗑️ Supprimer étudiant
    public function etudiantsDestroy(Etudiant $etudiant)
    {
        $etudiant->delete();
        return back()->with('success', 'Étudiant supprimé.');
    }

    // 🏫 Liste filières
    public function filieresIndex()
    {
        $filieres = Filiere::all();
        return view('admin.filieres.index', compact('filieres'));
    }

    // ➕ Créer filière
    public function filieresCreate()
    {
        return view('admin.filieres.create');
    }

    // 💾 Enregistrer filière
    public function filieresStore(Request $request)
    {
        $validated = $request->validate([
            'libelle_fil' => 'required|string|max:255',
            'code_fil' => 'required|string|max:100|unique:filieres,code_fil',
            'effectif' => 'nullable|integer|min:10|max:300',
        ]);

        Filiere::create($validated);

        return redirect()->route('admin.filieres.index')
                         ->with('success', 'Filière ajoutée avec succès.');
    }

    // 🖍️ Modifier filière
    public function filieresEdit(Filiere $filiere)
    {
        return view('admin.filieres.edit', compact('filiere'));
    }

    // 🔁 Enregistrer mise à jour filière
    public function filieresUpdate(Request $request, Filiere $filiere)
    {
        $validated = $request->validate([
            'libelle_fil' => 'required|string|max:255',
            'code_fil' => 'required|string|max:100|unique:filieres,code_fil,' . $filiere->id_fil . ',id_fil',
            'effectif' => 'nullable|integer|min:10|max:300',
        ]);

        $filiere->update($validated);
        return redirect()->route('admin.filieres.index')
                         ->with('success', 'Filière mise à jour.');
    }

    // 🗑️ Supprimer filière
    public function filieresDestroy(Filiere $filiere)
    {
        $filiere->delete();
        return back()->with('success', 'Filière supprimée.');
    }

    // 📚 Liste matières
    public function matieresIndex()
    {
        $matieres = Matiere::with('filiere')->get();
        $filieres = Filiere::all();
        return view('admin.matieres.index', compact('matieres', 'filieres'));
    }

    // ➕ Créer matière
    public function matieresCreate()
    {
        $filieres = Filiere::all();
        return view('admin.matieres.create', compact('filieres'));
    }

    // 💾 Enregistrer matière
    public function matieresStore(Request $request)
    {
        $validated = $request->validate([
            'libelle_mat' => 'required|string|max:255',
            'code_mat' => 'required|string|max:100|unique:matieres,code_mat',
            'filiere_id' => 'nullable|exists:filieres,id_fil',
        ]);

        Matiere::create($validated);

        return redirect()->route('admin.matieres.index')
                         ->with('success', 'Matière ajoutée avec succès.');
    }

    // 🖍️ Modifier matière
    public function matieresEdit(Matiere $matiere)
    {
        $filieres = Filiere::all();
        return view('admin.matieres.edit', compact('matiere', 'filieres'));
    }

    // 🔁 Enregistrer mise à jour matière
    public function matieresUpdate(Request $request, Matiere $matiere)
    {
        $validated = $request->validate([
            'libelle_mat' => 'required|string|max:255',
            'code_mat' => 'required|string|max:100|unique:matieres,code_mat,' . $matiere->id_mat . ',id_mat',
            'filiere_id' => 'nullable|exists:filieres,id_fil',
        ]);

        $matiere->update($validated);
        return redirect()->route('admin.matieres.index')
                         ->with('success', 'Matière mise à jour.');
    }

    // 🗑️ Supprimer matière
    public function matieresDestroy(Matiere $matiere)
    {
        $matiere->delete();
        return back()->with('success', 'Matière supprimée.');
    }

    // 🕵️ Logs d’activité

}
