<?php

// app/Http/Controllers/Auth/EtudiantLoginController.php

namespace App\Http\Controllers\Auth;

use App\Models\Etudiant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class EtudiantLoginController
{
    public function showLoginForm()
    {
        return view('etudiant.login');
    }

    public function login(Request $request)
    {
        // Valide que le matricule existe
        $etudiant = \App\Models\Etudiant::where('num_mat', $request->num_mat)->first();

        if (!$etudiant) {
            return back()->withErrors(['num_mat' => 'Matricule invalide']);
        }

        Session::put('etudiant', $etudiant);
        return redirect()->intended('/etudiant/dashboard');
    }

    public function logout()
    {
        Session::forget('etudiant');
        return redirect('/login/student');
    }
}
