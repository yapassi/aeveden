<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fiancailles extends Model
{
    use HasFactory;

    protected $fillable = [
        'fiance_id',
        'fiancee_id',
        'note',
        'avis',
        'date_debut',
        'date_fin',
        'date_dot',
        'date_mariage',
        'date_benediction', // Nouveau champ
        'vie_ensemble',
        'etape',
        'lieu_dot',        // Nouveau champ
        'lieu_mariage',     // Nouveau champ
        'lieu_benediction', // Nouveau champ
    ];

    protected $casts = [
        'date_debut' => 'date',
        'date_fin' => 'date',
        'date_dot' => 'date',
        'date_mariage' => 'date',
        'date_benediction' => 'date', // Nouveau cast
    ];

    // Validation des données
    public static function rules()
    {
        return [
            'note' => 'integer|min:0|max:5',
            'date_debut' => 'required|date',
            'date_fin' => 'nullable|date|after_or_equal:date_debut',
            'date_dot' => 'nullable|date',
            'date_mariage' => 'nullable|date',
            'date_benediction' => 'nullable|date', // Nouvelle règle
            'lieu_dot' => 'nullable|string|max:255',
            'lieu_mariage' => 'nullable|string|max:255',
            'lieu_benediction' => 'nullable|string|max:255',
            // autres règles...
        ];
    }

    public static $vieEnsembleOptions = [
        'oui' => 'Oui, ils vivent ensemble',
        'non' => 'Non, ils ne vivent pas ensemble'
    ];

    // Options pour le champ etape
    public static $etapeOptions = [
        'amitié' => 'Relation amicale',
        'kokoko_fait' => 'Kokoko fait (Début officiel)',
        'dot_faite' => 'Dot traditionnelle effectuée',
        'mariage_civil_fait' => 'Mariage civil célébré',
        'benediction_recue' => 'Bénédiction nuptiale reçue' // Nouvelle option
    ];

    // Relations
    public function fiance()
    {
        return $this->belongsTo(Fiance::class, 'fiance_id');
    }

    public function fiancee()
    {
        return $this->belongsTo(Fiance::class, 'fiancee_id');
    }

    public function coaching()
    {
        return $this->hasOne(Coaching::class);
    }
}