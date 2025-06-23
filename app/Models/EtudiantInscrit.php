<?php

// app/Models/EtudiantInscrit.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EtudiantInscrit extends Model
{
    protected $fillable = ['user_id', 'filiere_id', 'annee_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function filiere()
    {
        return $this->belongsTo(Filiere::class);
    }

    public function annee()
    {
        return $this->belongsTo(Annee::class);
    }

    public function compositions()
    {
        return $this->hasMany(Composer::class);
    }
}
