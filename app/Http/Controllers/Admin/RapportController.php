<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Rapport;
use App\Models\User;


class RapportController extends Controller
{
    public function index(Request $request)
    {
        $query = Rapport::with([
            'coaching.fiancailles.fiance',
            'coaching.fiancailles.fiancee',
            'coaching.coupleCoach.coachHomme',
            'coaching.coupleCoach.coachFemme'
        ]);

        if ($request->filled('coach_id')) {
            $coachId = $request->coach_id;

            $query->whereHas('coaching.coupleCoach', function ($q) use ($coachId) {
                $q->where('coach_homme_id', $coachId)
                ->orWhere('coach_femme_id', $coachId);
            });
        }

        if ($request->filled('fiancaille')) {
            $term = $request->fiancaille;
            $query->whereHas('coaching.fiancailles', function ($q) use ($term) {
                $q->whereHas('fiance', fn ($q) => $q->where('nom', 'like', "%$term%"))
                ->orWhereHas('fiancee', fn ($q) => $q->where('nom', 'like', "%$term%"));
            });
        }

        if ($request->filled('date')) {
            $query->whereDate('created_at', $request->date);
        }

        $rapports = $query->latest()->paginate(10);
        $coachs = User::where('role', 'coach')->orderBy('nom')->get();

        return view('admin.rapports.index', compact('rapports', 'coachs'));
    }

    public function show(Rapport $rapport)
    {
        $rapport->load([
            'coaching.fiancailles.fiance',
            'coaching.fiancailles.fiancee',
            'coaching.coupleCoach.coachHomme',
            'coaching.coupleCoach.coachFemme'
        ]);

        return view('admin.rapports.show', compact('rapport'));
    }


}


