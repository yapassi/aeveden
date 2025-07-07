<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Fiancailles;
use Illuminate\Http\Request;

class FiancailleController extends Controller
{
    /**
     * Affiche la liste des fiançailles
     */
    public function index()
    {
        $fiancailles = Fiancailles::with(['fiance', 'fiancee', 'coaching'])
            ->orderBy('date_debut', 'desc')
            ->paginate(10);

        return view('admin.fiancailles.index', [
            'fiancailles' => $fiancailles,
            'etapeOptions' => Fiancailles::$etapeOptions,
            'coachingStatuts' => \App\Models\Coaching::STATUTS
        ]);
    }

    /**
     * Affiche les détails d'une fiançailles
     */
    public function show($id)
    {
        $fiancailles = Fiancailles::findOrFail($id);
        return view('admin.fiancailles.show', [
            'fiancailles' => $fiancailles->load(['fiance', 'fiancee', 'coaching.coupleCoach']),
            'etapeOptions' => Fiancailles::$etapeOptions,
            'vieEnsembleOptions' => Fiancailles::$vieEnsembleOptions
        ]);
    }

    /**
     * Affiche le formulaire d'édition
     */
    public function edit($id)
    {
        $fiancailles = Fiancailles::findOrFail($id);
        return view('admin.fiancailles.edit', [
            'fiancailles' => $fiancailles,
            'etapeOptions' => Fiancailles::$etapeOptions,
            'vieEnsembleOptions' => Fiancailles::$vieEnsembleOptions
        ]);
    }

    /**
     * Met à jour les fiançailles
     */
    public function update(Request $request, $id)
    {
        $fiancailles = Fiancailles::findOrFail($id);
        $validated = $request->validate([
            'date_debut' => 'required|date',
            'date_fin' => 'nullable|date|after_or_equal:date_debut',
            'date_dot' => 'nullable|date',
            'lieu_dot' => 'nullable|string|max:255',
            'date_mariage' => 'nullable|date',
            'lieu_mariage' => 'nullable|string|max:255',
            'date_benediction' => 'nullable|date',
            'lieu_benediction' => 'nullable|string|max:255',
            'note' => 'nullable|integer|min:0|max:5',
            'avis' => 'nullable|string',
            'etape' => 'required|in:' . implode(',', array_keys(Fiancailles::$etapeOptions)),
            'vie_ensemble' => 'required|in:' . implode(',', array_keys(Fiancailles::$vieEnsembleOptions)),
        ]);

        $fiancailles->update($validated);

        return redirect()->route('admin.fiancailles.show', $fiancailles)
            ->with('success', 'Fiançailles mises à jour avec succès');
    }

    /**
     * Supprime les fiançailles
     */
    public function destroy(Fiancailles $fiancailles)
    {
        $fiancailles->delete();

        return redirect()->route('admin.fiancailles.index')
            ->with('success', 'Fiançailles supprimées avec succès');
    }
}