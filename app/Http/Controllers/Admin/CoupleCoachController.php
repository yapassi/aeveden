<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CoupleCoach;
use App\Models\User;
use Illuminate\Http\Request;

class CoupleCoachController extends Controller
{
    public function index()
    {
        $couples = CoupleCoach::with(['coachHomme', 'coachFemme'])->paginate(5);
        return view('admin.couple-coaches.index', compact('couples'));
    }

    public function create()
    {
        $coachesHommes = User::where('role', 'coach')
            ->where('sexe', 'M')
            ->whereDoesntHave('coupleCoachHomme')
            ->get();

        $coachesFemmes = User::where('role', 'coach')
            ->where('sexe', 'F')
            ->whereDoesntHave('coupleCoachFemme')
            ->get();

        return view('admin.couple-coaches.create', compact('coachesHommes', 'coachesFemmes'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'coach_homme_id' => 'required|exists:users,id',
            'coach_femme_id' => 'required|exists:users,id|different:coach_homme_id',
            'date_mariage' => 'nullable|date',
            'date_debut_coaching' => 'nullable|date',
            'domicile' => 'nullable|string|max:255',
        ]);

        // Vérification supplémentaire des sexes
        $coachHomme = User::find($request->coach_homme_id);
        $coachFemme = User::find($request->coach_femme_id);

        if ($coachHomme->sexe !== 'M' || $coachFemme->sexe !== 'F') {
            return back()->withErrors([
                'error' => 'Un couple coach doit être composé d\'un homme et d\'une femme'
            ]);
        }

        CoupleCoach::create($validated);

        return redirect()->route('admin.couple-coaches.index')
            ->with('success', 'Couple coach créé avec succès!');
    }

    // ... autres méthodes (show, edit, update, destroy)

    public function show(CoupleCoach $coupleCoach)
    {
        return view('admin.couple-coaches.show', compact('coupleCoach'));
    }
    public function edit(CoupleCoach $coupleCoach)
    {
        $coachesHommes = User::where('role', 'coach')
            ->where('sexe', 'M')
            ->whereDoesntHave('coupleCoachHomme', function ($query) use ($coupleCoach) {
                $query->where('id', '!=', $coupleCoach->id);
            })
            ->get();

        $coachesFemmes = User::where('role', 'coach')
            ->where('sexe', 'F')
            ->whereDoesntHave('coupleCoachFemme', function ($query) use ($coupleCoach) {
                $query->where('id', '!=', $coupleCoach->id);
            })
            ->get();

        return view('admin.couple-coaches.edit', compact('coupleCoach', 'coachesHommes', 'coachesFemmes'));
    }
    public function update(Request $request, CoupleCoach $coupleCoach)
    {
        // Validation des données
        $validated = $request->validate([
            'coach_homme_id' => 'required|exists:users,id',
            'coach_femme_id' => 'required|exists:users,id|different:coach_homme_id',
            'date_mariage' => 'nullable|date',
            'date_debut_coaching' => 'nullable|date',
            'domicile' => 'nullable|string|max:255',
        ]);
        // Vérification supplémentaire  
        // Vérification
        $coachHomme = User::find($request->coach_homme_id);
        $coachFemme = User::find($request->coach_femme_id);
        if ($coachHomme->sexe !== 'M' || $coachFemme->sexe !== 'F') {
            return back()->withErrors([
                'error' => 'Un couple coach doit être composé d\'un homme et d\'une femme'
            ]);
        }
        // Mise à jour du couple coach
        $coupleCoach->update($validated);
        return redirect()->route('admin.couple-coaches.index')
            ->with('success', 'Couple coach mis à jour avec succès!');
    }
}