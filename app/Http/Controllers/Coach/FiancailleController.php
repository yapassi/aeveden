<?php

namespace App\Http\Controllers\Coach;

use App\Http\Controllers\Controller;
use App\Models\Fiancailles;
use App\Models\Coaching;
use App\Models\CoupleCoach;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class FiancailleController extends Controller
{
    public function index()
    {
        // Récupérer l'utilisateur coach connecté
        $user = Auth::user();
        
        // Vérifier si l'utilisateur est bien un coach
        if ($user->role !== 'coach') {
            abort(403, 'Accès non autorisé');
        }
        
        // Trouver les couples de coaches où l'utilisateur est impliqué
        $coupleCoaches = CoupleCoach::where('coach_homme_id', $user->id)
            ->orWhere('coach_femme_id', $user->id)
            ->with(['coachHomme', 'coachFemme'])
            ->get();
            
        // Récupérer les coachings associés à ces couples de coaches
        $coachings = Coaching::whereIn('couple_coach_id', $coupleCoaches->pluck('id'))
            ->with(['fiancailles.fiance', 'fiancailles.fiancee'])
            ->get();
            
        // Préparer les données pour la vue
        $fiancailles = $coachings->map(function($coaching) {
            return [
                'id' => $coaching->fiancailles->id,
                'fiance' => $coaching->fiancailles->fiance,
                'fiancee' => $coaching->fiancailles->fiancee,
                'date_debut' => $coaching->fiancailles->date_debut,
                'date_dot' => $coaching->fiancailles->date_dot,
                'date_mariage' => $coaching->fiancailles->date_mariage,
                'date_benediction' => $coaching->fiancailles->date_benediction,
                'lieu_dot' => $coaching->fiancailles->lieu_dot,
                'lieu_mariage' => $coaching->fiancailles->lieu_mariage,
                'lieu_benediction' => $coaching->fiancailles->lieu_benediction,
                'etape' => $coaching->fiancailles->etape,
                'statut_coaching' => $coaching->statut,
                'coaching_id' => $coaching->id,
            ];
        });
        
        return view('coach.fiancailles.index', [
            'fiancailles' => $fiancailles,
            'coupleCoaches' => $coupleCoaches,
            'etapeOptions' => Fiancailles::$etapeOptions,
            'coachingStatuts' => Coaching::STATUTS
        ]);
    }

    public function show($id)
    {
        $fiancailles = Fiancailles::with([
                'fiance', 
                'fiancee',
                'coaching.coupleCoach'
            ])
            ->whereHas('coaching.coupleCoach', function($query) {
                $query->where('coach_homme_id', Auth::id())
                      ->orWhere('coach_femme_id', Auth::id());
            })
            ->findOrFail($id);

        return view('coach.fiancailles.show', [
            'fiancailles' => $fiancailles,
            'etapeOptions' => Fiancailles::$etapeOptions,
            'vieEnsembleOptions' => Fiancailles::$vieEnsembleOptions
        ]);
    }

    public function edit($id)
    {
        $fiancailles = Fiancailles::findOrFail($id);

        $coaching = Coaching::where('fiancailles_id', $id)
            ->whereHas('coupleCoach', function ($query) {
                $userId = Auth::id();
                $query->where('coach_homme_id', $userId)
                      ->orWhere('coach_femme_id', $userId);
            })->first();

        if (!$coaching) {
            abort(403, "Vous n'êtes pas autorisé à modifier ces fiançailles.");
        }

        return view('coach.fiancailles.edit', [
            'fiancailles' => $fiancailles,
            'etapeOptions' => Fiancailles::$etapeOptions,
            'vieEnsembleOptions' => Fiancailles::$vieEnsembleOptions
        ]);
    }

    public function update(Request $request, $id)
    {
        $fiancailles = Fiancailles::findOrFail($id);

        $coaching = Coaching::where('fiancailles_id', $id)
            ->whereHas('coupleCoach', function ($query) {
                $userId = Auth::id();
                $query->where('coach_homme_id', $userId)
                      ->orWhere('coach_femme_id', $userId);
            })->first();

        if (!$coaching) {
            abort(403, "Vous n'êtes pas autorisé à modifier ces fiançailles.");
        }

        // Validation
        $validatedData = $request->validate([
            'note' => 'nullable|integer|min:0|max:5',
            'avis' => 'nullable|string|max:500',
            'date_debut' => 'required|date',
            'date_dot' => 'nullable|date',
            'date_mariage' => 'nullable|date|after_or_equal:date_debut',
            'date_benediction' => 'nullable|date|after_or_equal:date_mariage',
            'lieu_dot' => 'nullable|string|max:255',
            'lieu_mariage' => 'nullable|string|max:255',
            'lieu_benediction' => 'nullable|string|max:255',
            'etape' => 'nullable|in:' . implode(',', array_keys(Fiancailles::$etapeOptions)),
            'vie_ensemble' => 'nullable|in:' . implode(',', array_keys(Fiancailles::$vieEnsembleOptions)),
        ]);

        // Mise à jour des champs
        $fiancailles->update($validatedData);

        return redirect()->route('coach.fiancailles.show', $id)
            ->with('success', 'Fiançailles mises à jour avec succès.');
    }
}