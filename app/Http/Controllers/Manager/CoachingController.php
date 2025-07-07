<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\Coaching;
use App\Models\CoupleCoach;
use App\Models\Fiancailles;
use Illuminate\Http\Request;

class CoachingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $coachings = Coaching::with(['fiancailles', 'coupleCoach'])
            ->orderBy('date_debut', 'desc')
            ->paginate(5);

        return view('manager.coachings.index', compact('coachings'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Coaching $coaching)
    {
        $coaching->load(['fiancailles', 'coupleCoach.coachHomme', 'coupleCoach.coachFemme', 'rapports']);

        return view('manager.coachings.show', compact('coaching'));
    }
}
