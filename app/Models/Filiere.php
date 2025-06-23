<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Filiere extends Model
{
     protected $primaryKey = 'id_fil';
    protected $fillable = ['libelle_fil', 'code_fil', 'effectif'];

    public function matieres()
    {
        return $this->hasMany(Matiere::class);
    }

    public function etudiants()
    {
        return $this->hasMany(EtudiantInscrit::class);
    }
}
