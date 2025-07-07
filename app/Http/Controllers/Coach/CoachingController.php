<?php

namespace App\Http\Controllers\Coach;

use App\Http\Controllers\Controller;
use App\Models\Coaching;
use Illuminate\Support\Facades\Auth;

class CoachingController extends Controller
{
    public function index()
    {
        // Récupère tous les coachings où l'utilisateur est soit coach_homme soit coach_femme
        $coachings = Coaching::with([
                'fiancailles.fiance', 
                'fiancailles.fiancee',
                'coupleCoach'
            ])
            ->whereHas('coupleCoach', function($query) {
                $query->where('coach_homme_id', Auth::id())
                      ->orWhere('coach_femme_id', Auth::id());
            })
            ->whereHas('fiancailles')
            ->orderBy('date_debut', 'desc')
            ->get();

        return view('coach.coachings.index', compact('coachings'));
    }

    public function show($id)
    {
        $coaching = Coaching::with([
                'fiancailles.fiance', 
                'fiancailles.fiancee',
                'coupleCoach.coachHomme',
                'coupleCoach.coachFemme',
                'rapports'
            ])
            ->whereHas('coupleCoach', function($query) {
                $query->where('coach_homme_id', Auth::id())
                      ->orWhere('coach_femme_id', Auth::id());
            })
            ->findOrFail($id);

        return view('coach.coachings.show', compact('coaching'));
    }
}



