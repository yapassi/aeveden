<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'prenoms',
        'sexe',
        'contact',
        'email',
        'password',
        'role'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public const ROLES = [
        'admin' => 'Administrateur',
        'coach' => 'Coach',
        'manager' => 'Manager'
    ];

    public const GENRES = [
        'M' => 'Masculin',
        'F' => 'Féminin'
    ];

    // Relations
    public function coupleCoachHomme()
    {
        return $this->hasOne(CoupleCoach::class, 'coach_homme_id');
    }

    public function coupleCoachFemme()
    {
        return $this->hasOne(CoupleCoach::class, 'coach_femme_id');
    }
}