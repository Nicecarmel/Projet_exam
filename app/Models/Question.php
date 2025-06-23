<?php

// app/Models/Question.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $table = 'questions'; // Nom de la table
    protected $primaryKey = 'id_ques'; // Clé primaire personnalisée
    public $timestamps = true; // Si tu as created_at / updated_at

    protected $fillable = [
        'epreuve_id',
        'libelle_quest',
        'type',
        'point',
        'ordre'
    ];

    // Relations

    public function epreuve()
    {
        return $this->belongsTo(\App\Models\Epreuve::class, 'epreuve_id', 'id_ep');
    }

    public function options()
    {
        return $this->hasMany(\App\Models\Option::class, 'question_id', 'id_ques');
    }

    public function reponses()
    {
        return $this->hasMany(\App\Models\Reponse::class, 'question_id', 'id_ques');
    }
}
