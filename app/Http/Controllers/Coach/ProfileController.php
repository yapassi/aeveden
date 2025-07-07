<?php

namespace App\Http\Controllers\Coach;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    /** Affiche le formulaire d'édition du profil coach */
    public function edit()
    {
        $coach = Auth::user();
        return view('coach.profile.edit', compact('coach'));
    }

    /** Met à jour les informations du coach */
    public function updateProfile(Request $request)
    {
        $coach = Auth::user();

        $data = $request->validate([
            'nom'       => ['required', 'string', 'max:255'],
            'prenoms'   => ['required', 'string', 'max:255'],
            'email'     => ['required', 'email', Rule::unique('users')->ignore($coach->id)],
            'contact'   => ['required', 'string', 'max:20'],
        ]);

        // Mise à jour des champs
        $coach->nom     = $data['nom'];
        $coach->prenoms = $data['prenoms'];
        $coach->email   = $data['email'];
        $coach->contact = $data['contact'];
        $coach->save();

        return redirect()->route('coach.profile.edit')
                         ->with('success', 'Profil mis à jour avec succès.');
    }

     /** Met à jour le mot de passe du coach */
    public function updatePassword(Request $request)
    {
        $coach = Auth::user();

        $data = $request->validate([
            'password'  => ['nullable', 'min:6', 'confirmed'],
        ]);

        // Si mot de passe renseigné, on le hash
        if (!empty($data['password'])) {
            $coach->password = bcrypt($data['password']);
        }

        // Mise à jour du mot de passe
        $coach->save();

        return redirect()->route('coach.profile.edit')
                         ->with('success', 'Mot de passe mis à jour avec succès.');
    }
}
