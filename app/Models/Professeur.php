<?php

// app/Models/Professeur.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Auth\Authenticatable;
use App\Models\Epreuve; // ✅ Bon import

class Professeur extends Model implements AuthenticatableContract
{
    use Authenticatable;

    protected $primaryKey = 'id_prof';
    protected $fillable = ['nom_prof', 'prenom_prof', 'email_prof', 'tel_prof', 'password'];
    protected $hidden = ['password', 'remember_token'];

    public function getAuthPassword()
    {
        return $this->password;
    }

    // Relation avec les épreuves créées par le professeur
    public function epreuves()
    {
        return $this->hasMany(Epreuve::class, 'professeur_id', 'id_prof');
    }
}
