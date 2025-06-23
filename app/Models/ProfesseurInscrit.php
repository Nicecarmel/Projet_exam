<?php

// app/Models/ProfesseurInscrit.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfesseurInscrit extends Model
{
    protected $fillable = ['user_id', 'annee_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function annee()
    {
        return $this->belongsTo(Annee::class);
    }

    public function epreuves()
    {
        return $this->hasMany(Epreuve::class);
    }
}