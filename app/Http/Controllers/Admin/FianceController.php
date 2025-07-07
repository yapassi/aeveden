<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Fiance;
use Illuminate\Http\Request;

class FianceController extends Controller
{
    public function index()
    {
        $fiances = Fiance::orderBy('nom')->orderBy('prenoms')->paginate(15);
        return view('admin.fiances.index', compact('fiances'));
    }

    public function show($id)
    {
        $fiance = Fiance::findOrFail($id);
        return view('admin.fiances.show', compact('fiance'));
    }

    
    public function create()
    {
        return view('admin.fiances.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'prenoms' => 'required|string|max:255',
            'sexe' => 'required|in:M,F', 
            'email' => 'required|email|unique:fiances,email',
            'date_naissance' => 'required|date',
            'lieu_naissance' => 'nullable|string|max:255',
            'ethnie' => 'nullable|string|max:255',
            'contact' => 'required|string|max:20',
            'eglise' => 'nullable|string|max:255',
            'tribu' => 'nullable|string|max:255',
            'departement' => 'nullable|string|max:255',
            'profession' => 'nullable|string|max:255',
            'nom_entreprise' => 'nullable|string|max:255',
            'commune_entreprise' => 'nullable|string|max:255',
            'domicile' => 'nullable|string|max:255',
            'statut_habitation' => 'nullable|in:en famille,locataire,propriétaire,colocataire',
            'nombre_enfants' => 'nullable|integer|min:0',
            'personnes_en_charge' => 'nullable|integer|min:0',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $photoPath = null;
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('photos_fiances', 'public');
        }

        Fiance::create([
            'nom' => $request->nom,
            'prenoms' => $request->prenoms,
            'sexe' => $request->sexe,
            'email' => $request->email,
            'photo' => $photoPath,
            'date_naissance' => $request->date_naissance,
            'lieu_naissance' => $request->lieu_naissance,
            'ethnie' => $request->ethnie,
            'contact' => $request->contact,
            'eglise' => $request->eglise,
            'tribu' => $request->tribu,
            'departement' => $request->departement,
            'profession' => $request->profession,
            'nom_entreprise' => $request->nom_entreprise,
            'commune_entreprise' => $request->commune_entreprise,
            'domicile' => $request->domicile,
            'statut_habitation' => $request->statut_habitation,
            'nombre_enfants' => $request->nombre_enfants,
            'personnes_en_charge' => $request->personnes_en_charge,
        ]);

        return redirect()->route('admin.fiances.create')->with('success', 'Fiancé enregistré avec succès.');
}

    public function edit($id)
    {
        // Logique pour récupérer le fiancé par ID et afficher le formulaire d'édition
        $fiance = Fiance::findOrFail($id);
        if (!$fiance) {
            return redirect()->route('admin.fiances.index')->with('error', 'Fiancé non trouvé.');
        }
        return view('admin.fiances.edit', compact('fiance'));
    }

    public function update(Request $request, $id)
    {
        $fiance = Fiance::findOrFail($id);

        $request->validate([
            'nom' => 'required|string|max:255',
            'prenoms' => 'required|string|max:255',
            'sexe' => 'required|in:M,F', 
            'email' => 'required|email|unique:fiances,email,' . $fiance->id,
            'date_naissance' => 'required|date',
            'lieu_naissance' => 'nullable|string|max:255',
            'ethnie' => 'nullable|string|max:255',
            'contact' => 'required|string|max:20',
            'eglise' => 'nullable|string|max:255',
            'tribu' => 'nullable|string|max:255',
            'departement' => 'nullable|string|max:255',
            'profession' => 'nullable|string|max:255',
            'nom_entreprise' => 'nullable|string|max:255',
            'commune_entreprise' => 'nullable|string|max:255',
            'domicile' => 'nullable|string|max:255',
            'statut_habitation' => 'nullable|in:en famille,locataire,propriétaire,colocataire',
            'nombre_enfants' => 'nullable|integer|min:0',
            'personnes_en_charge' => 'nullable|integer|min:0',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $photoPath = $fiance->photo;
        if ($request->hasFile('photo')) {
            if ($photoPath) {
                \Storage::disk('public')->delete($photoPath);
            }
            $photoPath = $request->file('photo')->store('photos_fiances', 'public');
        }

        $fiance->update([
            'nom' => $request->nom,
            'prenoms' => $request->prenoms,
            'sexe' => $request->sexe,
            'email' => $request->email,
            'photo' => $photoPath,
            'date_naissance' => $request->date_naissance,
            'lieu_naissance' => $request->lieu_naissance,
            'ethnie' => $request->ethnie,
            'contact' => $request->contact,
            'eglise' => $request->eglise,
            'tribu' => $request->tribu,
            'departement' => $request->departement,
            'profession' => $request->profession,
            'nom_entreprise' => $request->nom_entreprise,
            'commune_entreprise' => $request->commune_entreprise,
            'domicile' => $request->domicile,
            'statut_habitation' => $request->statut_habitation,
            'nombre_enfants' => $request->nombre_enfants,
            'personnes_en_charge' => $request->personnes_en_charge,
        ]);

        return redirect()->route('admin.fiances.index')->with('success', 'Fiancé mis à jour avec succès.');
    }

    public function destroy($id)
    {
        $fiance = Fiance::findOrFail($id);
        if ($fiance->photo) {
            \Storage::disk('public')->delete($fiance->photo);
        }
        $fiance->delete();
        return redirect()->route('admin.fiances.index')->with('success', 'Fiancé supprimé avec succès.');
    }
}
