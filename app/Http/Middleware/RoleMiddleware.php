<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @param  string[] ...$roles
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        // Vérifie si l'utilisateur est connecté
        if (!Auth::check()) {
            return redirect('login');
        }

        $user = Auth::user();

        // Vérifie si le rôle de l'utilisateur fait partie des rôles autorisés
        if (!in_array($user->role, $roles)) {
            abort(403, 'Accès interdit : vous n\'avez pas les droits nécessaires.');
        }

        return $next($request);
    }
}