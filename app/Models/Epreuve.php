<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Epreuve extends Model
{
    protected $primaryKey = 'id_ep';
    protected $table = 'epreuves'; // Assure-toi que c'est bien le bon nom de table

    protected $fillable = [
        'type_ep',
        'titre',
        'date_ep',
        'statut_ep',
        'heure_debut',
        'heure_fin',
        'duree_minutes',
        'description',
        'mode_notation_auto',
        'professeur_id',
        'filiere_id',
        'matiere_id',
        'admin_id',
        'ques_id'
    ];

    protected $casts = [
        'date_ep' => 'date',
        'heure_debut' => 'datetime:H:i',
        'heure_fin' => 'datetime:H:i',
        'duree_minutes' => 'integer',
        'mode_notation_auto' => 'boolean',
        'statut_ep' => 'string',
        'type_ep' => 'string',
    ];



    // Relations

    public function professeur()
    {
        return $this->belongsTo(\App\Models\Professeur::class, 'professeur_id', 'id_prof');
    }

    public function matiere()
    {
        return $this->belongsTo(\App\Models\Matiere::class, 'matiere_id', 'id_mat');
    }

    public function administrateur()
    {
        return $this->belongsTo(\App\Models\Administrateur::class, 'admin_id', 'id_admin');
    }

    public function questions()
    {
        return $this->hasMany(\App\Models\Question::class, 'epreuve_id', 'id_ep');
    }

    public function compositions()
    {
      return $this->hasMany(\App\Models\Composer::class, 'epreuve_id', 'id_ep');
    }
}
