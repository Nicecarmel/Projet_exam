<?php

// app/Models/Administrateur.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Administrateur extends Model
{
    use Notifiable;

    protected $primaryKey = 'id_admin';
    protected $fillable = ['email_admin', 'mdp_admin'];
    protected $hidden = ['mdp_admin', 'remember_token'];
}