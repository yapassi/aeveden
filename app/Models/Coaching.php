<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coaching extends Model
{
    use HasFactory;

    protected $fillable = [
        'fiancailles_id',
        'couple_coach_id',
        'statut',
        'date_debut',
        'date_fin',
    ];

    public const STATUTS = [
        'actif' => 'Actif',
        'en_pause' => 'En pause',
        'arrete' => 'Arrêté',
        'acheve' => 'Achevé'
    ];

    protected $casts = [
        'date_debut' => 'date',
        'date_fin' => 'date',
    ];

    // Relations
    public function fiancailles()
    {
        return $this->belongsTo(Fiancailles::class);
    }

    public function coupleCoach()
    {
        return $this->belongsTo(CoupleCoach::class);
    }

    public function rapports()
    {
        return $this->hasMany(Rapport::class);
    }

    public function coupleFiance()
    {
        if (!$this->fiancailles) return null;
        
        return [
            'fiance' => $this->fiancailles->fiance,
            'fiancee' => $this->fiancailles->fiancee
        ];
    }
}