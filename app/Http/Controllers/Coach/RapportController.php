<?php

namespace App\Http\Controllers\Coach;

use App\Http\Controllers\Controller;
use App\Models\Coaching;
use App\Models\Rapport;
use Illuminate\Http\Request;

class RapportController extends Controller
{
    public function index(Request $request)
    {
        $coachId = auth()->id();

        $rapports = Rapport::whereHas('coaching.coupleCoach', function ($query) use ($coachId) {
            $query->where('coach_homme_id', $coachId)
                  ->orWhere('coach_femme_id', $coachId);
        })
        ->when($request->filled('nom'), function ($query) use ($request) {
            $query->where(function ($q) use ($request) {
                $q->whereHas('coaching.fiancailles.fiance', function ($sub) use ($request) {
                    $sub->where('nom', 'like', '%' . $request->nom . '%')
                        ->orWhere('prenoms', 'like', '%' . $request->nom . '%');
                })
                ->orWhereHas('coaching.fiancailles.fiancee', function ($sub) use ($request) {
                    $sub->where('nom', 'like', '%' . $request->nom . '%')
                        ->orWhere('prenoms', 'like', '%' . $request->nom . '%');
                });
            });
        })
        ->when($request->filled('mois'), fn($q) => $q->whereMonth('created_at', $request->mois))
        ->when($request->filled('annee'), fn($q) => $q->whereYear('created_at', $request->annee))
        ->latest()
        ->paginate(10);

        return view('coach.rapports.index', compact('rapports'));
    }

    public function create($coachingId)
    {
        $coaching = Coaching::findOrFail($coachingId);

        return view('coach.rapports.create', [
            'coaching' => $coaching,
            'typesSeances' => Rapport::TYPES_SEANCES,
            'defisOptions' => Rapport::DEFIS_COUPLE
        ]);
    }

    public function store(Request $request, $coachingId)
    {
        $validated = $request->validate([
            'nombre_seances'     => 'required|integer|min:0',
            'types_seances'      => 'required|array',
            'types_seances.*'    => 'in:' . implode(',', array_keys(Rapport::TYPES_SEANCES)),
            'derniere_lecon'     => 'required|string|max:255',
            'observations'       => 'nullable|string',
            'defis_couple'       => 'nullable|array',
            'defis_couple.*'     => 'in:' . implode(',', array_keys(Rapport::DEFIS_COUPLE)),
            'solutions_coaches'  => 'nullable|string',
        ]);

        $validated['coaching_id'] = $coachingId;

        Rapport::create($validated);

        return redirect()->route('coach.coachings.show', $coachingId)
                         ->with('success', 'Rapport créé avec succès.');
    }

    public function show($id)
    {
        $rapport = Rapport::with([
            'coaching.fiancailles.fiance',
            'coaching.fiancailles.fiancee'
        ])->findOrFail($id);

        $this->authorizeCoach($rapport);

        return view('coach.rapports.show', compact('rapport'));
    }

    public function edit($id)
    {
        $rapport = Rapport::findOrFail($id);
        $this->authorizeCoach($rapport);

        return view('coach.rapports.edit', [
            'rapport' => $rapport,
            'typesSeances' => Rapport::TYPES_SEANCES,
            'defisOptions' => Rapport::DEFIS_COUPLE
        ]);
    }

    public function update(Request $request, Rapport $rapport)
    {
        $this->authorizeCoach($rapport);

        $validated = $request->validate([
            'nombre_seances'     => 'required|integer|min:1',
            'types_seances'      => 'nullable|array',
            'types_seances.*'    => 'in:' . implode(',', array_keys(Rapport::TYPES_SEANCES)),
            'derniere_lecon'     => 'nullable|string|max:255',
            'observations'       => 'nullable|string',
            'defis_couple'       => 'nullable|array',
            'defis_couple.*'     => 'in:' . implode(',', array_keys(Rapport::DEFIS_COUPLE)),
            'solutions_coaches'  => 'nullable|string',
        ]);

        $rapport->update($validated);

        return redirect()->route('coach.rapports.show', $rapport)
                         ->with('success', 'Rapport mis à jour avec succès.');
    }

    public function destroy(Rapport $rapport)
    {
        $this->authorizeCoach($rapport);
        $rapport->delete();

        return redirect()->route('coach.rapports.index')
                         ->with('success', 'Rapport supprimé avec succès.');
    }

    private function authorizeCoach(Rapport $rapport)
    {
        $userId = auth()->id();

        if (!(
            $rapport->coaching &&
            $rapport->coaching->coupleCoach &&
            in_array($userId, [
                $rapport->coaching->coupleCoach->coach_homme_id,
                $rapport->coaching->coupleCoach->coach_femme_id
            ])
        )) {
            abort(403, 'Vous n\'êtes pas autorisé à accéder à ce rapport.');
        }
    }
}
