<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rapport extends Model
{
    use HasFactory;

    protected $fillable = [
        'coaching_id',
        'nombre_seances',
        'types_seances',
        'derniere_lecon',
        'observations',
        'defis_couple',
        'solutions_coaches',
    ];

    protected $casts = [
        'types_seances' => 'array',
        'defis_couple' => 'array',
    ];

    public const TYPES_SEANCES = [
        'cours' => 'Cours',
        'priere' => 'Prière',
        'exhortation' => 'Exhortation',
        'autre' => 'Autre',
    ];

    public const DEFIS_COUPLE = [
        'finances' => 'Problèmes financiers',
        'mesentente' => 'Mésentente',
        'chomage' => 'Chômage',
        'opposition_familiale' => 'Opposition familiale',
        'communication' => 'Manque de communication',
        'spirituel' => 'Problèmes spirituels',
        'peche' => 'Vie de péché',
        'indecision' => 'Indécision',
        'maladie' => 'Maladie',
        'autre' => 'Autre',
    ];

    // Relations
    public function coaching()
    {
        return $this->belongsTo(Coaching::class);
    }
}
