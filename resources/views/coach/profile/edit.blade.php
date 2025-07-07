@extends('layouts.coach')

@section('content')
<div class="container-fluid mt-4">
    <h2>Mon Profil</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Onglets -->
    <ul class="nav nav-tabs" id="profileTabs" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="infos-tab" data-bs-toggle="tab" data-bs-target="#infos"
                    type="button" role="tab" aria-controls="infos" aria-selected="true">
                Informations
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="password-tab" data-bs-toggle="tab" data-bs-target="#password"
                    type="button" role="tab" aria-controls="password" aria-selected="false">
                Mot de passe
            </button>
        </li>
    </ul>

    <div class="tab-content mt-3" id="profileTabsContent">
        <!-- Tab 1 : Informations -->
        <div class="tab-pane fade show active" id="infos" role="tabpanel" aria-labelledby="infos-tab">
            <form action="{{ route('coach.profile.update') }}" method="POST" style="max-width:600px">
                @csrf @method('PUT')

                <div class="mb-3">
                    <label for="nom" class="form-label">Nom</label>
                    <input type="text" id="nom" name="nom"
                           class="form-control @error('nom') is-invalid @enderror"
                           value="{{ old('nom', $coach->nom) }}" required>
                    @error('nom')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="mb-3">
                    <label for="prenoms" class="form-label">Prénoms</label>
                    <input type="text" id="prenoms" name="prenoms"
                           class="form-control @error('prenoms') is-invalid @enderror"
                           value="{{ old('prenoms', $coach->prenoms) }}" required>
                    @error('prenoms')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Adresse e-mail</label>
                    <input type="email" id="email" name="email"
                           class="form-control @error('email') is-invalid @enderror"
                           value="{{ old('email', $coach->email) }}" required>
                    @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="mb-3">
                    <label for="contact" class="form-label">Contact</label>
                    <input type="text" id="contact" name="contact"
                           class="form-control @error('contact') is-invalid @enderror"
                           value="{{ old('contact', $coach->contact) }}" required>
                    @error('contact')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <button type="submit" class="btn btn-primary">Mettre à jour</button>
            </form>
        </div>

        <!-- Tab 2 : Mot de passe -->
        <div class="tab-pane fade" id="password" role="tabpanel" aria-labelledby="password-tab">
            <form action="{{ route('coach.password.update') }}" method="POST" style="max-width:600px">
                @csrf @method('PUT')

                <div class="mb-3">
                    <label for="password" class="form-label">Nouveau mot de passe</label>
                    <input type="password" id="password" name="password"
                           class="form-control @error('password') is-invalid @enderror">
                    @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">Confirmer le mot de passe</label>
                    <input type="password" id="password_confirmation" name="password_confirmation"
                           class="form-control">
                </div>

                <button type="submit" class="btn btn-primary">Modifier le mot de passe</button>
            </form>
        </div>
    </div>
</div>
@endsection
