<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fiance extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom', 'prenoms', 'sexe', 'email', 'photo', 'date_naissance', 'lieu_naissance',
        'ethnie', 'contact', 'eglise', 'tribu', 'departement', 'profession',
        'nom_entreprise', 'commune_entreprise', 'domicile', 'statut_habitation',
        'nombre_enfants', 'personnes_en_charge'
    ];

    public const GENRES = [
        'M' => 'Masculin',
        'F' => 'Féminin'
    ];

    protected $casts = [
        'date_naissance' => 'date',
    ];

    // Relations
    public function fiancaillesHomme()
    {
        return $this->hasOne(Fiancailles::class, 'fiance_id');
    }

    public function fiancaillesFemme()
    {
        return $this->hasOne(Fiancailles::class, 'fiancee_id');
    }
}