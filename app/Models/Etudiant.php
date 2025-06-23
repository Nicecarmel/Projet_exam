<?php

// app/Models/Etudiant.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Etudiant extends Model
{
    use Notifiable;

    protected $primaryKey = 'id_et';
    protected $fillable = ['nom_et', 'prenom_et', 'email_et', 'sexe', 'tel_et', 'num_mat', 'password'];
    protected $hidden = ['password', 'remember_token'];

    public function inscriptions()
    {
        return $this->hasMany(EtudiantInscrit::class);
    }

    public function compositions()
    {
      return $this->hasMany(\App\Models\Composer::class, 'etudiant_id', 'id_et');
    }

    public function reponses()
    {
      return $this->hasMany(\App\Models\Reponse::class, 'etudiant_id', 'id_et');
    }
}
