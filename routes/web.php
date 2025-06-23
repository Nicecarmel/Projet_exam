<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\EpreuveController;
use App\Http\Controllers\ReponseController;
use App\Http\Controllers\QuestionController;

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Auth\EtudiantLoginController;
use App\Http\Controllers\Auth\ProfesseurLoginController;
use App\Http\Controllers\Auth\AdministrateurLoginController;

// Page d'accueil
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// Connexion étudiant
Route::get('/login/student', [EtudiantLoginController::class, 'showLoginForm'])->name('student.login');
Route::post('/login/student', [EtudiantLoginController::class, 'login']);
Route::post('/logout/student', [EtudiantLoginController::class, 'logout'])->name('student.logout');

// Connexion professeur
Route::get('/login/professor', [ProfesseurLoginController::class, 'showLoginForm'])->name('professor.login');
Route::post('/login/professor', [ProfesseurLoginController::class, 'login']);
Route::post('/logout/professor', [ProfesseurLoginController::class, 'logout'])->name('professor.logout');

// Connexion administrateur
Route::get('/login/admin', [AdministrateurLoginController::class, 'showLoginForm'])->name('admin.login');
Route::post('/login/admin', [AdministrateurLoginController::class, 'login']);
Route::post('/logout/admin', [AdministrateurLoginController::class, 'logout'])->name('admin.logout');

// Tableau de bord étudiant
Route::middleware(['auth.etudiant'])->prefix('etudiant')->group(function () {
    Route::get('/dashboard', [ExamController::class, 'dashboard'])->name('etudiant.dashboard');

    // Passation des épreuves
    Route::prefix('epreuves')->group(function () {
        Route::get('/{epreuve}/passer', [ExamController::class, 'showPassation'])
             ->name('epreuves.etudiant.passation');

        Route::post('/{epreuve}/soumettre', [ExamController::class, 'submitPassation'])
             ->name('epreuves.etudiant.submit');

        Route::get('/{epreuve}/resultats', [ExamController::class, 'resultat'])
             ->name('etudiant.resultat');
    });

    // Réponses soumises
    Route::prefix('reponses')->group(function () {
        Route::get('/', [ReponseController::class, 'index'])->name('etudiant.reponses.index');
        Route::get('/{reponse}', [ReponseController::class, 'show'])->name('etudiant.reponses.show');
    });
});

// Tableau de bord professeur
Route::middleware(['auth.professeur'])->group(function () {
    Route::get('/professor/dashboard', function () {
        return view('professor.dashboard');
    })->name('professor.dashboard');

    // Gestion des épreuves
    Route::prefix('epreuves')->group(function () {
        Route::get('/', [EpreuveController::class, 'index'])->name('epreuves.index');
        Route::get('/create', [EpreuveController::class, 'create'])->name('epreuves.create');
        Route::post('/', [EpreuveController::class, 'store'])->name('epreuves.store');
        Route::get('/{epreuve}', [EpreuveController::class, 'show'])->name('epreuves.show');
        Route::get('/{epreuve}/edit', [EpreuveController::class, 'edit'])->name('epreuves.edit');
        Route::put('/{epreuve}', [EpreuveController::class, 'update'])->name('epreuves.update');
        Route::delete('/{epreuve}', [EpreuveController::class, 'destroy'])->name('epreuves.destroy');
        Route::post('/{epreuve}/soumettre', [EpreuveController::class, 'submitForValidation'])
             ->name('epreuves.submit_for_validation');
    });

    // Questions (CRUD complet)
    Route::prefix('epreuves/{epreuve}/questions')->group(function () {
        Route::get('/', [QuestionController::class, 'index'])->name('epreuves.questions.index');
        Route::get('/create', [QuestionController::class, 'create'])->name('epreuves.questions.create');
        Route::post('/', [QuestionController::class, 'store'])->name('epreuves.questions.store');
        Route::get('/{question}/edit', [QuestionController::class, 'edit'])->name('epreuves.questions.edit');
        Route::put('/{question}', [QuestionController::class, 'update'])->name('epreuves.questions.update');
        Route::delete('/{question}', [QuestionController::class, 'destroy'])->name('epreuves.questions.destroy');
    });
});

// Administration


Route::middleware(['auth.admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    // Épreuves
    Route::get('/epreuves', [AdminController::class, 'epreuvesIndex'])->name('admin.epreuves.index');
    Route::get('/epreuves/{epreuve}', [AdminController::class, 'epreuveShow'])->name('admin.epreuves.show');
    Route::post('/epreuves/{epreuve}/validate', [AdminController::class, 'epreuveValidate'])->name('admin.epreuves.validate');
    Route::delete('/epreuves/{epreuve}/refuse', [AdminController::class, 'epreuveRefuse'])->name('admin.epreuves.refuse');

    // Professeurs
    Route::get('/utilisateurs/professeurs', [AdminController::class, 'professeursIndex'])->name('admin.utilisateurs.professeurs.index');
    Route::get('/utilisateurs/professeurs/create', [AdminController::class, 'professeursCreate'])->name('admin.utilisateurs.professeurs.create');
    Route::post('/utilisateurs/professeurs', [AdminController::class, 'professeursStore'])->name('admin.utilisateurs.professeurs.store');
    Route::get('/utilisateurs/professeurs/{professeur}/edit', [AdminController::class, 'professeursEdit'])->name('admin.utilisateurs.professeurs.edit');
    Route::put('/utilisateurs/professeurs/{professeur}', [AdminController::class, 'professeursUpdate'])->name('admin.utilisateurs.professeurs.update');
    Route::delete('/utilisateurs/professeurs/{professeur}', [AdminController::class, 'professeursDestroy'])->name('admin.utilisateurs.professeurs.destroy');

    // Étudiants
    Route::get('/utilisateurs/etudiants', [AdminController::class, 'etudiantsIndex'])->name('admin.utilisateurs.etudiants.index');
    Route::get('/utilisateurs/etudiants/create', [AdminController::class, 'etudiantsCreate'])->name('admin.utilisateurs.etudiants.create');
    Route::post('/utilisateurs/etudiants', [AdminController::class, 'etudiantsStore'])->name('admin.utilisateurs.etudiants.store');
    Route::get('/utilisateurs/etudiants/{etudiant}/edit', [AdminController::class, 'etudiantsEdit'])->name('admin.utilisateurs.etudiants.edit');
    Route::put('/utilisateurs/etudiants/{etudiant}', [AdminController::class, 'etudiantsUpdate'])->name('admin.utilisateurs.etudiants.update');
    Route::delete('/utilisateurs/etudiants/{etudiant}', [AdminController::class, 'etudiantsDestroy'])->name('admin.utilisateurs.etudiants.destroy');

    // Filières
    Route::get('/filieres', [AdminController::class, 'filieresIndex'])->name('admin.filieres.index');
    Route::get('/filieres/create', [AdminController::class, 'filieresCreate'])->name('admin.filieres.create');
    Route::post('/filieres', [AdminController::class, 'filieresStore'])->name('admin.filieres.store');
    Route::get('/filieres/{filiere}/edit', [AdminController::class, 'filieresEdit'])->name('admin.filieres.edit');
    Route::put('/filieres/{filiere}', [AdminController::class, 'filieresUpdate'])->name('admin.filieres.update');
    Route::delete('/filieres/{filiere}', [AdminController::class, 'filieresDestroy'])->name('admin.filieres.destroy');

    // Matières
    Route::get('/matieres', [AdminController::class, 'matieresIndex'])->name('admin.matieres.index');
    Route::get('/matieres/create', [AdminController::class, 'matieresCreate'])->name('admin.matieres.create');
    Route::post('/matieres', [AdminController::class, 'matieresStore'])->name('admin.matieres.store');
    Route::get('/matieres/{matiere}/edit', [AdminController::class, 'matieresEdit'])->name('admin.matieres.edit');
    Route::put('/matieres/{matiere}', [AdminController::class, 'matieresUpdate'])->name('admin.matieres.update');
    Route::delete('/matieres/{matiere}', [AdminController::class, 'matieresDestroy'])->name('admin.matieres.destroy');

    // Logs d’activité
    Route::get('/logs', [AdminController::class, 'logsIndex'])->name('admin.logs.index');
});
