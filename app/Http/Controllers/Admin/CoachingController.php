<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Coaching;
use App\Models\CoupleCoach;
use App\Models\Fiancailles;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;

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

        return view('admin.coachings.index', compact('coachings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $fiancailles = Fiancailles::whereDoesntHave('coaching')->get();
        $coupleCoachs = CoupleCoach::all();
        $statuts = Coaching::STATUTS;

        return view('admin.coachings.create', compact('fiancailles', 'coupleCoachs', 'statuts'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'fiancailles_id' => 'required|exists:fiancailles,id|unique:coachings,fiancailles_id',
            'couple_coach_id' => 'required|exists:couple_coachs,id',
            'statut' => 'required|in:' . implode(',', array_keys(Coaching::STATUTS)),
            'date_debut' => 'required|date',
            'date_fin' => 'nullable|date|after:date_debut',
        ]);

        Coaching::create($validated);

        return redirect()->route('admin.coachings.index')
            ->with('success', 'Coaching créé avec succès');
    }

    /**
     * Display the specified resource.
     */
    public function show(Coaching $coaching)
    {
        $coaching->load(['fiancailles', 'coupleCoach.coachHomme', 'coupleCoach.coachFemme', 'rapports']);

        return view('admin.coachings.show', compact('coaching'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Coaching $coaching)
    {
        $fiancailles = Fiancailles::all();
        $coupleCoachs = CoupleCoach::all();
        $statuts = Coaching::STATUTS;

        return view('admin.coachings.edit', compact('coaching', 'fiancailles', 'coupleCoachs', 'statuts'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Coaching $coaching)
    {
        $validated = $request->validate([
            //'fiancailles_id' => 'required|exists:fiancailles,id|unique:coachings,fiancailles_id,' . $coaching->id,
            'couple_coach_id' => 'required|exists:couple_coachs,id',
            'statut' => 'required|in:' . implode(',', array_keys(Coaching::STATUTS)),
            'date_debut' => 'required|date',
            'date_fin' => 'nullable|date|after:date_debut',
        ]);

        $coaching->update($validated);

        return redirect()->route('admin.coachings.index')
            ->with('success', 'Coaching mis à jour avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Coaching $coaching)
    {
        $coaching->delete();

        return redirect()->route('admin.coachings.index')
            ->with('success', 'Coaching supprimé avec succès');
    }

    /**
     * Change coaching status
     */
    public function changeStatus(Coaching $coaching, $status)
    {
        if (!array_key_exists($status, Coaching::STATUTS)) {
            return back()->with('error', 'Statut invalide');
        }

        $coaching->update(['statut' => $status]);

        return back()->with('success', 'Statut du coaching mis à jour');
    }
}