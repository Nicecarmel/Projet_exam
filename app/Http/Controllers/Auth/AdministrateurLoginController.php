<?php

// app/Http/Controllers/Auth/AdministrateurLoginController.php

namespace App\Http\Controllers\Auth;

use App\Models\Administrateur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AdministrateurLoginController
{
    public function showLoginForm()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email_admin' => 'required|email',
            'mdp_admin' => 'required'
        ]);

        // Trouve l'admin par email
        $admin = Administrateur::where('email_admin', $request->email_admin)->first();

        if (!$admin) {
            return back()->withErrors(['email_admin' => 'Email invalide']);
        }

        // Compare les hash manuellement
        if (!password_verify($request->mdp_admin, $admin->mdp_admin)) {
            return back()->withErrors(['mdp_admin' => 'Mot de passe incorrect']);
        }

        // Connecte le professeur via session
        Session::put('admin', $admin);

        return redirect()->route('admin.dashboard');
    }

    public function logout()
    {
        Session::forget('admin');
        return redirect('/login/admin');
    }
}
