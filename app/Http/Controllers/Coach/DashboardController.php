<?php

namespace App\Http\Controllers\Coach;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Coaching;
use App\Models\Rapport;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $coachId = Auth::id();


        $coachings = Coaching::whereHas('coupleCoach', function($query) use ($coachId) {
                            $query->where('coach_homme_id', $coachId)
                                  ->orWhere('coach_femme_id', $coachId);
                            })->get();

        // Statistiques par statut

        $coachingsActifs = $coachings->where('statut', 'actif')->count();
        $coachingsEnPause = $coachings->where('statut', 'en_pause')->count();
        $coachingsAcheves = $coachings->where('statut', 'acheve')->count();
        $coachingsArretes = $coachings->where('statut', 'arrete')->count();

        return view('coach.dashboard', [
            'coachingsActifs' => $coachingsActifs,
            'coachingsEnPause' => $coachingsEnPause,
            'coachingsAcheves' => $coachingsAcheves,
            'coachingsArretes' => $coachingsArretes,            
        ]);
    }
}
