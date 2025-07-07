<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Affiche la liste des utilisateurs
     */
    public function index()
    {
        $users = User::orderBy('nom', 'asc')->paginate(10);
        return view('admin.users.index', compact('users'));
    }

    /**
     * Affiche le formulaire de création
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Enregistre un nouvel utilisateur
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:100',
            'prenoms' => 'required|string|max:100',
            'sexe' => 'required|in:M,F',
            'email' => 'required|email|unique:users',
            'contact' => 'required|string|max:20',
            'role' => 'required|in:admin,coach,manager',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $validated['password'] = Hash::make($validated['password']);

        User::create($validated);

        return redirect()->route('admin.users.index')
                         ->with('success', 'Utilisateur créé avec succès!');
    }

    /**
     * Affiche les détails d'un utilisateur
     */
    public function show(User $user)
    {
        return view('admin.users.show', compact('user'));
    }

    /**
     * Affiche le formulaire d'édition
     */
    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Met à jour un utilisateur
     */
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:100',
            'prenoms' => 'required|string|max:100',
            'sexe' => 'required|in:M,F',
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore($user->id)
            ],
            'contact' => 'required|string|max:20',
            'role' => 'required|in:admin,coach,manager',
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        if ($request->filled('password')) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        $user->update($validated);

        return redirect()->route('admin.users.index')
                         ->with('success', 'Utilisateur mis à jour avec succès!');
    }

    /**
     * Supprime un utilisateur
     */
    public function destroy(User $user)
    {
        // Empêche la suppression de l'admin principal
        if ($user->id === 1) {
            return back()->with('error', 'Impossible de supprimer le super administrateur!');
        }

        $user->delete();

        return redirect()->route('admin.users.index')
                         ->with('success', 'Utilisateur supprimé avec succès!');
    }
}