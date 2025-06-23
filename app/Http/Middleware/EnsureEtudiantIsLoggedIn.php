<?php

// app/Http/Middleware/EnsureEtudiantIsLoggedIn.php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class EnsureEtudiantIsLoggedIn
{
    public function handle(Request $request, Closure $next)
    {
        if (!Session::has('etudiant')) {
            return redirect()->route('student.login')->with('error', 'Vous devez être connecté.');
        }

        return $next($request);
    }
}
