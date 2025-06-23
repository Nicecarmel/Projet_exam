<?php

// app/Models/Composer.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Composer extends Model
{
    protected $fillable = [
        'etudiant_id', 'epreuve_id', 'statut', 'date_debut', 'date_fin', 'note', 'feedback'
    ];

   public function etudiant()
    {
        return $this->belongsTo(\App\Models\Etudiant::class, 'etudiant_id', 'id_et');
    }

    public function epreuve()
    {
        return $this->belongsTo(\App\Models\Epreuve::class, 'epreuve_id', 'id_ep');
    }

    public function reponses()
    {
        return $this->hasMany(\App\Models\Reponse::class, 'etudiant_id', 'etudiant_id')
                    ->where('epreuve_id', $this->epreuve_id);
    }

}
