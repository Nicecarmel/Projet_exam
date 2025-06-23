<?php

// app/Providers/CustomAuthProvider.php

namespace App\Providers;

use Illuminate\Auth\EloquentUserProvider;
use Illuminate\Contracts\Auth\Authenticatable as UserContract;
use App\Models\Etudiant;
use App\Models\Professeur;
use App\Models\Administrateur;

class CustomAuthProvider extends EloquentUserProvider
{
    /**
     * Constructeur adapté pour Laravel 10
     */
    public function __construct($model, $connection = null)
    {
        // On passe uniquement les 2 paramètres attendus par EloquentUserProvider
        parent::__construct($model, $connection);
    }

    /**
     * Récupère un utilisateur selon son identifiant (ID ou num_mat)
     */
    public function retrieveById($identifier)
    {
        // On récupère le type d'utilisateur via session ou autre
        $type = session('login_type', 'etudiant');

        return match ($type) {
            'professeur' => Professeur::find($identifier),
            'admin' => Administrateur::where('email_admin', $identifier)->first(),
            default => Etudiant::where('num_mat', $identifier)->first(),
        };
    }

    /**
     * Valide les identifiants (email/password ou matricule/password)
     */
    public function validateCredentials(UserContract $user, array $credentials)
    {
        $plainPassword = $credentials['password'] ?? null;

        if (!$plainPassword || !$user->getAuthPassword()) {
            return false;
        }

        return password_verify($plainPassword, $user->getAuthPassword());
    }
}
