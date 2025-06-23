<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role', // 👈 On ajoute cette ligne
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'role' => 'string', // 👈 Optionnel mais utile
    ];

    // 🔐 Vérifie si l'utilisateur a un rôle spécifique
    public function hasRole(string $role): bool
    {
        return $this->role === $role;
    }

    public function isAdmin(): bool
    {
        return $this->hasRole('admin');
    }

    public function isProfessor(): bool
    {
        return $this->hasRole('professor');
    }

    public function isStudent(): bool
    {
        return $this->hasRole('student');
    }

    // 📚 Relations avec les autres modèles

    public function professeurInscrit()
    {
        return $this->hasOne(ProfesseurInscrit::class);
    }

    public function etudiantInscrit()
    {
        return $this->hasOne(EtudiantInscrit::class);
    }

    public function epreuves()
    {
        return $this->hasMany(Epreuve::class, 'user_id');
    }
}
