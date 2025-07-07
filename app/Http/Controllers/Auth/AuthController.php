<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    /**
     * Affiche le formulaire de connexion
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Traite la tentative de connexion
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $credentials = $request->only('email', 'password');
        $remember = $request->filled('remember');

        // Tentative d'authentification
        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();

            // Redirection basée sur le rôle
            return $this->authenticated($request, Auth::user());
        }

        // Si l'authentification échoue
        return $this->sendFailedLoginResponse($request);
    }

    /**
     * Redirection après authentification réussie
     */
    protected function authenticated(Request $request, $user)
    {
        switch ($user->role) {
            case 'admin':
                return redirect()->route('admin.dashboard');
            case 'manager':
                return redirect()->route('manager.dashboard');
            case 'coach':
                return redirect()->route('coach.dashboard');
            default:
                return redirect()->route('home');
        }
    }

    /**
     * Réponse en cas d'échec de connexion
     */
    protected function sendFailedLoginResponse(Request $request)
    {
        throw ValidationException::withMessages([
            'email' => [trans('auth.failed')],
        ]);
    }

    /**
     * Déconnexion de l'utilisateur
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}