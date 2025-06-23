<?php

// app/Http/Controllers/ComposerController.php

namespace App\Http\Controllers;

use App\Models\Composer;
use Illuminate\Http\Request;

class ComposerController extends Controller
{
    public function index()
    {
        $etudiant = session('etudiant');
        $epreuves = Composer::where('id_et', $etudiant->id_et)->with('epreuve')->get();
        return view('student.composer.index', compact('epreuves'));
    }

    public function show($id_et, $id_ep)
    {
        $composer = Composer::where('id_et', $id_et)->where('id_ep', $id_ep)->firstOrFail();
        return view('student.composer.show', compact('composer'));
    }
}
