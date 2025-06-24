<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Matiere extends Model
{
    protected $primaryKey = 'id_mat';
    
    protected $fillable = ['libelle_mat', 'code_mat', 'obligatoire', 'filiere_id'];

    public function filiere()
    {
        return $this->belongsTo(\App\Models\Filiere::class, 'filiere_id', 'id_fil');
    }

    public function epreuves()
    {
        return $this->hasMany(Epreuve::class);
    }
}
