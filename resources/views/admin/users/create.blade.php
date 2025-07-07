@extends('layouts.admin')

@section('title', 'Créer un utilisateur')

@section('content')
<div class="container-fluid px-0">
    <div class="row g-0 justify-content-center">
        {{-- Main content --}}
        <main class="col-12 col-md-10 col-lg-8 col-xl-6">
            {{-- Header Section --}}
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-primary text-white p-3">
                    <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-3">
                        <h1 class="h5 mb-0">
                            <i class="bi bi-person-plus-fill me-2"></i> Créer un nouvel utilisateur
                        </h1>
                        <a href="{{ route('admin.users.index') }}" class="btn btn-light btn-sm">
                            <i class="bi bi-arrow-left me-1"></i> Retour
                        </a>
                    </div>
                </div>
            </div>

            {{-- Error Messages --}}
            @if ($errors->any())
                <div class="alert alert-danger mb-4">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i>
                    <div>
                        <h6 class="alert-heading mb-2">Erreurs de validation :</h6>
                        <ul class="mb-0 small">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif

            {{-- Form Card --}}
            <div class="card border-0 shadow-sm">
                <div class="card-body p-3 p-sm-4">
                    <form action="{{ route('admin.users.store') }}" method="POST" novalidate>
                        @csrf

                        {{-- Personal Information Section --}}
                        <div class="mb-4">
                            <h5 class="text-muted mb-3 pb-2 border-bottom">
                                <i class="bi bi-person-fill me-2"></i> Informations personnelles
                            </h5>
                            
                            <div class="row g-3">
                                {{-- Nom --}}
                                <div class="col-12 col-sm-6">
                                    <label for="nom" class="form-label fw-medium">
                                        Nom <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" 
                                           name="nom" 
                                           id="nom" 
                                           value="{{ old('nom') }}" 
                                           class="form-control @error('nom') is-invalid @enderror" 
                                           placeholder="Entrez le nom"
                                           required>
                                    @error('nom')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Prénoms --}}
                                <div class="col-12 col-sm-6">
                                    <label for="prenoms" class="form-label fw-medium">
                                        Prénoms <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" 
                                           name="prenoms" 
                                           id="prenoms" 
                                           value="{{ old('prenoms') }}" 
                                           class="form-control @error('prenoms') is-invalid @enderror" 
                                           placeholder="Entrez les prénoms"
                                           required>
                                    @error('prenoms')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Sexe --}}
                                <div class="col-12 col-sm-6">
                                    <label for="sexe" class="form-label fw-medium">
                                        Sexe <span class="text-danger">*</span>
                                    </label>
                                    <select name="sexe" 
                                            id="sexe" 
                                            class="form-select @error('sexe') is-invalid @enderror" 
                                            required>
                                        <option value="">-- Sélectionner --</option>
                                        <option value="M" {{ old('sexe') == 'M' ? 'selected' : '' }}>Homme</option>
                                        <option value="F" {{ old('sexe') == 'F' ? 'selected' : '' }}>Femme</option>
                                    </select>
                                    @error('sexe')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Contact --}}
                                <div class="col-12 col-sm-6">
                                    <label for="contact" class="form-label fw-medium">
                                        Contact <span class="text-danger">*</span>
                                    </label>
                                    <input type="tel" 
                                           name="contact" 
                                           id="contact" 
                                           value="{{ old('contact') }}" 
                                           class="form-control @error('contact') is-invalid @enderror" 
                                           placeholder="+225 XX XX XX XX XX"
                                           required>
                                    @error('contact')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        {{-- Account Information Section --}}
                        <div class="mb-4">
                            <h5 class="text-muted mb-3 pb-2 border-bottom">
                                <i class="bi bi-key-fill me-2"></i> Informations du compte
                            </h5>
                            
                            <div class="row g-3">
                                {{-- Email --}}
                                <div class="col-12">
                                    <label for="email" class="form-label fw-medium">
                                        Adresse e-mail <span class="text-danger">*</span>
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="bi bi-envelope text-muted"></i>
                                        </span>
                                        <input type="email" 
                                               name="email" 
                                               id="email" 
                                               value="{{ old('email') }}" 
                                               class="form-control @error('email') is-invalid @enderror" 
                                               placeholder="exemple@email.com"
                                               required>
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Rôle --}}
                                <div class="col-12 col-sm-6">
                                    <label for="role" class="form-label fw-medium">
                                        Rôle <span class="text-danger">*</span>
                                    </label>
                                    <select name="role" 
                                            id="role" 
                                            class="form-select @error('role') is-invalid @enderror" 
                                            required>
                                        <option value="">-- Sélectionner --</option>
                                        <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>
                                            <i class="bi bi-person-check-fill"></i> Admin
                                        </option>
                                        <option value="coach" {{ old('role') == 'coach' ? 'selected' : '' }}>
                                            <i class="bi bi-people-fill"></i> Coach
                                        </option>
                                        <option value="manager" {{ old('role') == 'manager' ? 'selected' : '' }}>
                                            <i class="bi bi-person-gear"></i> Manager
                                        </option>
                                    </select>
                                    @error('role')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        {{-- Password Section --}}
                        <div class="mb-4">
                            <h5 class="text-muted mb-3 pb-2 border-bottom">
                                <i class="bi bi-lock-fill me-2"></i> Mot de passe
                            </h5>
                            
                            <div class="row g-3">
                                {{-- Password --}}
                                <div class="col-12 col-md-6">
                                    <label for="password" class="form-label fw-medium">
                                        Mot de passe <span class="text-danger">*</span>
                                    </label>
                                    <div class="input-group">
                                        <input type="password" 
                                               name="password" 
                                               id="password" 
                                               class="form-control @error('password') is-invalid @enderror" 
                                               placeholder="Min. 8 caractères"
                                               required>
                                        <button class="btn btn-outline-secondary" 
                                                type="button" 
                                                onclick="togglePassword('password')"
                                                aria-label="Afficher/masquer le mot de passe">
                                            <i class="bi bi-eye" id="password-icon"></i>
                                        </button>
                                        @error('password')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-text">
                                        <small class="text-muted">
                                            <i class="bi bi-info-circle me-1"></i>
                                            Au moins 8 caractères recommandés
                                        </small>
                                    </div>
                                </div>

                                {{-- Password Confirmation --}}
                                <div class="col-12 col-md-6">
                                    <label for="password_confirmation" class="form-label fw-medium">
                                        Confirmer le mot de passe <span class="text-danger">*</span>
                                    </label>
                                    <div class="input-group">
                                        <input type="password" 
                                               name="password_confirmation" 
                                               id="password_confirmation" 
                                               class="form-control @error('password_confirmation') is-invalid @enderror" 
                                               placeholder="Confirmez le mot de passe"
                                               required>
                                        <button class="btn btn-outline-secondary" 
                                                type="button" 
                                                onclick="togglePassword('password_confirmation')"
                                                aria-label="Afficher/masquer la confirmation">
                                            <i class="bi bi-eye" id="password_confirmation-icon"></i>
                                        </button>
                                        @error('password_confirmation')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Action Buttons --}}
                        <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center pt-3 border-top">
                            <div class="order-2 order-sm-1 mt-2 mt-sm-0">
                                <small class="text-muted">
                                    <i class="bi bi-info-circle me-1"></i>
                                    Les champs marqués d'un astérisque (<span class="text-danger">*</span>) sont obligatoires
                                </small>
                            </div>
                            <div class="order-1 order-sm-2 d-flex gap-2">
                                <a href="{{ route('admin.users.index') }}" 
                                   class="btn btn-outline-secondary">
                                    <i class="bi bi-x-lg me-1"></i> Annuler
                                </a>
                                <button type="submit" 
                                        class="btn btn-success px-4">
                                    <i class="bi bi-plus-circle me-1"></i> Créer
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </div>
</div>

{{-- JavaScript pour toggle password --}}
<script>
function togglePassword(fieldId) {
    const field = document.getElementById(fieldId);
    const icon = document.getElementById(fieldId + '-icon');
    
    if (field.type === 'password') {
        field.type = 'text';
        icon.classList.remove('bi-eye');
        icon.classList.add('bi-eye-slash');
    } else {
        field.type = 'password';
        icon.classList.remove('bi-eye-slash');
        icon.classList.add('bi-eye');
    }
}

// Validation en temps réel
document.addEventListener('DOMContentLoaded', function() {
    const passwordField = document.getElementById('password');
    const confirmField = document.getElementById('password_confirmation');
    
    function validatePasswords() {
        if (confirmField.value && passwordField.value !== confirmField.value) {
            confirmField.setCustomValidity('Les mots de passe ne correspondent pas');
            confirmField.classList.add('is-invalid');
        } else {
            confirmField.setCustomValidity('');
            confirmField.classList.remove('is-invalid');
        }
    }
    
    passwordField.addEventListener('input', validatePasswords);
    confirmField.addEventListener('input', validatePasswords);
});
</script>

@endsection