<?php

// app/Models/Option.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    protected $primaryKey = 'id_op'; // Clé primaire personnalisée
    public $timestamps = true;
    protected $fillable = ['question_id', 'libelle_op', 'correct', 'ordre'];
    protected $table = 'options';

    public function question()
    {
        return $this->belongsTo(Question::class);
    }
}
