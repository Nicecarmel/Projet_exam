<?php

// app/Models/Reponse.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reponse extends Model
{
    protected $primaryKey = 'id_rep'; // Clé primaire personnalisée
    public $timestamps = true; // Utilise les timestamps par défaut
    protected $table = 'reponses'; // Nom de la table personnalisée
    protected $fillable = [
        'etudiant_id','epreuve_id', 'question_id', 'option_id', 'reponse_text', 'point_obtenu'
    ];

    public function etudiant()
    {
        return $this->belongsTo(\App\Models\Etudiant::class, 'etudiant_id', 'id_et');
    }

    public function epreuve()
    {
        return $this->belongsTo(\App\Models\Epreuve::class, 'epreuve_id', 'id_ep');
    }

    public function question()
    {
        return $this->belongsTo(\App\Models\Question::class, 'question_id', 'id_ques');
    }

    public function option()
    {
        return $this->belongsTo(\App\Models\Option::class, 'option_id', 'id_op');
    }
}
