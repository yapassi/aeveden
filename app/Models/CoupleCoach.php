<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CoupleCoach extends Model
{
    use HasFactory;

    protected $table = 'couple_coachs'; // Nom exact de la table dans la DB

    protected $fillable = [
        'coach_homme_id',
        'coach_femme_id',
        'domicile',
        'date_mariage',
        'date_debut_coaching',
    ];

    protected $casts = [
    'date_mariage' => 'date',  // Supposé convertir en Carbon
    'date_debut_coaching' => 'date',  // Supposé convertir en Carbon
];

    // Relations
    public function coachHomme()
    {
        return $this->belongsTo(User::class, 'coach_homme_id');
    }

    public function coachFemme()
    {
        return $this->belongsTo(User::class, 'coach_femme_id');
    }

    public function coachings()
    {
        return $this->hasMany(Coaching::class);
    }
}