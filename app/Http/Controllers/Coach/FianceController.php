<?php

// app/Http/Controllers/Coach/FianceController.php
namespace App\Http\Controllers\Coach;

use App\Http\Controllers\Controller;
use App\Models\Fiance;
use Illuminate\Support\Facades\Auth;

class FianceController extends Controller
{
    public function index()
    {
        // Récupère tous les fiancés coachés par l'utilisateur actuel avec pagination
        $fiances = Fiance::whereHas('fiancaillesHomme.coaching.coupleCoach', function($query) {
                $query->where('coach_homme_id', Auth::id())
                    ->orWhere('coach_femme_id', Auth::id());
            })
            ->orWhereHas('fiancaillesFemme.coaching.coupleCoach', function($query) {
                $query->where('coach_homme_id', Auth::id())
                    ->orWhere('coach_femme_id', Auth::id());
            })
            ->with(['fiancaillesHomme.coaching', 'fiancaillesFemme.coaching'])
            ->orderBy('nom')
            ->paginate(5); // 15 éléments par page

        return view('coach.fiances.index', compact('fiances'));
    }

    public function show($id)
    {
        // Récupère le fiancé avec toutes les relations nécessaires
        $fiance = Fiance::with([
                'fiancaillesHomme.coaching.coupleCoach.coachHomme',
                'fiancaillesHomme.coaching.coupleCoach.coachFemme',
                'fiancaillesHomme.fiancee',
                'fiancaillesFemme.coaching.coupleCoach.coachHomme',
                'fiancaillesFemme.coaching.coupleCoach.coachFemme',
                'fiancaillesFemme.fiance'
            ])
            // Vérifie que le coach a bien accès à ce fiancé
            ->where(function($query) {
                $query->whereHas('fiancaillesHomme.coaching.coupleCoach', function($q) {
                    $q->where('coach_homme_id', Auth::id())
                      ->orWhere('coach_femme_id', Auth::id());
                })
                ->orWhereHas('fiancaillesFemme.coaching.coupleCoach', function($q) {
                    $q->where('coach_homme_id', Auth::id())
                      ->orWhere('coach_femme_id', Auth::id());
                });
            })
            ->findOrFail($id);

        return view('coach.fiances.show', compact('fiance'));
    }
}