<?php

// app/Http/Controllers/Auth/ProfesseurLoginController.php

namespace App\Http\Controllers\Auth;

use App\Models\Professeur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ProfesseurLoginController
{
    public function showLoginForm()
    {
        return view('professor.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email_prof' => 'required|email',
            'password' => 'required'
        ]);

        // Trouve le professeur par email
        $professeur = Professeur::where('email_prof', $request->email_prof)->first();

        if (!$professeur) {
            return back()->withErrors(['email_prof' => 'Email invalide']);
        }

        // Compare les hash manuellement
        if (!password_verify($request->password, $professeur->password)) {
            return back()->withErrors(['password' => 'Mot de passe incorrect']);
        }

        // Connecte le professeur via session
        Session::put('professeur', $professeur);

        return redirect()->route('professor.dashboard');
    }

    public function logout()
    {
        Session::forget('professeur');
        return redirect('/login/professor');
    }
}
