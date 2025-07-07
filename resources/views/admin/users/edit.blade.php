@extends('layouts.admin')

@section('title', 'Modifier un utilisateur')

@section('content')
<div class="container-fluid px-0">
    <div class="card border-0 shadow-sm">
        <!-- Card Header -->
        <div class="card-header bg-primary text-white p-3">
            <div class="d-flex justify-content-between align-items-center">
                <h1 class="h5 mb-0">
                    <i class="bi bi-person-gear me-2"></i> Modifier l'utilisateur
                </h1>
                <a href="{{ route('admin.users.index') }}" class="btn btn-light btn-sm">
                    <i class="bi bi-arrow-left me-1"></i> Retour
                </a>
            </div>
        </div>

        <!-- Card Body -->
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger mb-4">
                    <div class="d-flex align-items-center">
                        <i class="bi bi-exclamation-triangle-fill me-2"></i>
                        <div>
                            <h6 class="mb-1">Erreurs de validation</h6>
                            <ul class="mb-0 ps-3">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            @endif

            <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row g-3">
                    <!-- Colonne gauche -->
                    <div class="col-12 col-md-6">
                        <div class="mb-3">
                            <label for="nom" class="form-label">Nom <span class="text-danger">*</span></label>
                            <input type="text" name="nom" id="nom" 
                                   class="form-control" 
                                   value="{{ old('nom', $user->nom) }}" 
                                   required>
                        </div>

                        <div class="mb-3">
                            <label for="prenoms" class="form-label">Prénoms <span class="text-danger">*</span></label>
                            <input type="text" name="prenoms" id="prenoms" 
                                   class="form-control" 
                                   value="{{ old('prenoms', $user->prenoms) }}" 
                                   required>
                        </div>

                        <div class="mb-3">
                            <label for="sexe" class="form-label">Sexe <span class="text-danger">*</span></label>
                            <select name="sexe" id="sexe" class="form-select" required>
                                <option value="">-- Sélectionner --</option>
                                <option value="M" {{ old('sexe', $user->sexe) == 'M' ? 'selected' : '' }}>Homme</option>
                                <option value="F" {{ old('sexe', $user->sexe) == 'F' ? 'selected' : '' }}>Femme</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="contact" class="form-label">Contact <span class="text-danger">*</span></label>
                            <input type="text" name="contact" id="contact" 
                                   class="form-control" 
                                   value="{{ old('contact', $user->contact) }}" 
                                   required>
                        </div>
                    </div>

                    <!-- Colonne droite -->
                    <div class="col-12 col-md-6">
                        <div class="mb-3">
                            <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                            <input type="email" name="email" id="email" 
                                   class="form-control" 
                                   value="{{ old('email', $user->email) }}" 
                                   required>
                        </div>

                        <div class="mb-3">
                            <label for="role" class="form-label">Rôle <span class="text-danger">*</span></label>
                            <select name="role" id="role" class="form-select" required>
                                <option value="">-- Sélectionner --</option>
                                <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Admin</option>
                                <option value="coach" {{ old('role', $user->role) == 'coach' ? 'selected' : '' }}>Coach</option>
                                <option value="manager" {{ old('role', $user->role) == 'manager' ? 'selected' : '' }}>Manager</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Nouveau mot de passe</label>
                            <div class="input-group">
                                <input type="password" name="password" id="password" 
                                       class="form-control">
                                <button class="btn btn-outline-secondary toggle-password" type="button">
                                    <i class="bi bi-eye"></i>
                                </button>
                            </div>
                            <small class="text-muted">Laisser vide pour ne pas modifier</small>
                        </div>

                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Confirmation</label>
                            <div class="input-group">
                                <input type="password" name="password_confirmation" id="password_confirmation" 
                                       class="form-control">
                                <button class="btn btn-outline-secondary toggle-password" type="button">
                                    <i class="bi bi-eye"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Actions -->
                <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center mt-4 gap-3">
                    <button type="reset" class="btn btn-outline-secondary flex-grow-1">
                        <i class="bi bi-arrow-counterclockwise me-2"></i> Réinitialiser
                    </button>
                    <button type="submit" class="btn btn-primary flex-grow-1">
                        <i class="bi bi-check-circle me-2"></i> Mettre à jour
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.querySelectorAll('.toggle-password').forEach(button => {
        button.addEventListener('click', function() {
            const input = this.previousElementSibling;
            const icon = this.querySelector('i');
            
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.replace('bi-eye', 'bi-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.replace('bi-eye-slash', 'bi-eye');
            }
        });
    });
</script>
@endsection

@section('styles')
<style>
    .toggle-password {
        border-top-left-radius: 0;
        border-bottom-left-radius: 0;
    }
    @media (max-width: 767.98px) {
        .card-header {
            padding: 0.75rem;
        }
        .card-body {
            padding: 1rem;
        }
    }
    .form-label {
        font-weight: 500;
        margin-bottom: 0.25rem;
    }
</style>
@endsection