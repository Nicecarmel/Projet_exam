<?php

// app/Models/Reponse.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reponse extends Model
{
    protected $fillable = [
        'etudiant_id', 'question_id', 'option_id', 'reponse_text', 'point_obtenu'
    ];

    public function etudiant()
    {
        return $this->belongsTo(Etudiant::class, 'etudiant_id', 'id_et');
    }

    public function question()
    {
        return $this->belongsTo(Question::class, 'question_id', 'id_ques');
    }

    public function option()
    {
        return $this->belongsTo(Option::class, 'option_id', 'id_op');
    }
}
