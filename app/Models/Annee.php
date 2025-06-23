<?php

// app/Models/Annee.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Annee extends Model
{
    protected $fillable = ['libelle_annee', 'est_actuelle'];

    public function professeursInscrits()
    {
        return $this->hasMany(ProfesseurInscrit::class);
    }

    public function etudiantsInscrits()
    {
        return $this->hasMany(EtudiantInscrit::class);
    }
}
