@extends('layouts.admin')

@section('title', 'Modifier un fiancé')

@section('content')
<div class="container-fluid p-0">
    <div class="row g-0">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <!-- Card Header -->
                <div class="card-header bg-primary text-white p-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <h1 class="h5 mb-0">
                            <i class="bi bi-person-gear me-2"></i> Modifier le fiancé
                        </h1>
                        <a href="{{ route('admin.fiances.index') }}" class="btn btn-light btn-sm">
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

                    <form action="{{ route('admin.fiances.update', $fiance->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row g-3">
                            <!-- Photo & Basic Info -->
                            <div class="col-12 col-md-4">
                                <div class="card h-100 border-0 shadow-sm">
                                    <div class="card-header bg-light">
                                        <h6 class="mb-0">Photo</h6>
                                    </div>
                                    <div class="card-body text-center">
                                        <!-- Current Photo -->
                                        <div class="mb-3">
                                            @if($fiance->photo)
                                                <img src="{{ asset('storage/' . $fiance->photo) }}" 
                                                     class="rounded-circle border mb-3" 
                                                     width="150" height="150" 
                                                     style="object-fit: cover;"
                                                     alt="Photo actuelle">
                                            @else
                                                <div class="bg-light rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3" 
                                                     style="width:150px;height:150px;">
                                                    <i class="bi bi-person text-muted fs-1"></i>
                                                </div>
                                            @endif
                                        </div>
                                        
                                        <!-- File Input -->
                                        <div class="mb-3">
                                            <label for="photo" class="form-label">Changer la photo</label>
                                            <input class="form-control" type="file" id="photo" name="photo">
                                            <small class="text-muted">Format: JPG, PNG (max 2MB)</small>
                                        </div>
                                        
                                        <!-- Sexe -->
                                        <div class="mb-3">
                                            <label for="sexe" class="form-label">Sexe <span class="text-danger">*</span></label>
                                            <select name="sexe" id="sexe" class="form-select" required>
                                                <option value="">-- Sélectionner --</option>
                                                <option value="M" {{ old('sexe', $fiance->sexe) == 'M' ? 'selected' : '' }}>Homme</option>
                                                <option value="F" {{ old('sexe', $fiance->sexe) == 'F' ? 'selected' : '' }}>Femme</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Personal Info -->
                            <div class="col-12 col-md-8">
                                <div class="card h-100 border-0 shadow-sm">
                                    <div class="card-header bg-light">
                                        <h6 class="mb-0">Informations personnelles</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="row g-3">
                                            <div class="col-12 col-md-6">
                                                <label for="nom" class="form-label">Nom <span class="text-danger">*</span></label>
                                                <input type="text" name="nom" id="nom" 
                                                       class="form-control" 
                                                       value="{{ old('nom', $fiance->nom) }}" 
                                                       required>
                                            </div>

                                            <div class="col-12 col-md-6">
                                                <label for="prenoms" class="form-label">Prénoms <span class="text-danger">*</span></label>
                                                <input type="text" name="prenoms" id="prenoms" 
                                                       class="form-control" 
                                                       value="{{ old('prenoms', $fiance->prenoms) }}" 
                                                       required>
                                            </div>

                                            <div class="col-12 col-md-6">
                                                <label for="date_naissance" class="form-label">Date de naissance</label>
                                                <input type="date" name="date_naissance" id="date_naissance" 
                                                       class="form-control" 
                                                       value="{{ old('date_naissance', $fiance->date_naissance ? $fiance->date_naissance->format('Y-m-d') : '') }}">
                                            </div>

                                            <div class="col-12 col-md-6">
                                                <label for="lieu_naissance" class="form-label">Lieu de naissance</label>
                                                <input type="text" name="lieu_naissance" id="lieu_naissance" 
                                                       class="form-control" 
                                                       value="{{ old('lieu_naissance', $fiance->lieu_naissance) }}">
                                            </div>

                                            <div class="col-12 col-md-6">
                                                <label for="ethnie" class="form-label">Ethnie</label>
                                                <input type="text" name="ethnie" id="ethnie" 
                                                       class="form-control" 
                                                       value="{{ old('ethnie', $fiance->ethnie) }}">
                                            </div>

                                            <div class="col-12 col-md-6">
                                                <label for="tribu" class="form-label">Tribu</label>
                                                <input type="text" name="tribu" id="tribu" 
                                                       class="form-control" 
                                                       value="{{ old('tribu', $fiance->tribu) }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Contact & Professional Info -->
                            <div class="col-12 col-md-6">
                                <div class="card h-100 border-0 shadow-sm">
                                    <div class="card-header bg-light">
                                        <h6 class="mb-0">Coordonnées</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="row g-3">
                                            <div class="col-12">
                                                <label for="contact" class="form-label">Contact <span class="text-danger">*</span></label>
                                                <input type="text" name="contact" id="contact" 
                                                       class="form-control" 
                                                       value="{{ old('contact', $fiance->contact) }}" 
                                                       required>
                                            </div>

                                            <div class="col-12">
                                                <label for="email" class="form-label">Email</label>
                                                <input type="email" name="email" id="email" 
                                                       class="form-control" 
                                                       value="{{ old('email', $fiance->email) }}">
                                            </div>

                                            <div class="col-12">
                                                <label for="domicile" class="form-label">Domicile</label>
                                                <input type="text" name="domicile" id="domicile" 
                                                       class="form-control" 
                                                       value="{{ old('domicile', $fiance->domicile) }}">
                                            </div>

                                            <div class="col-12">
                                                <label for="eglise" class="form-label">Église</label>
                                                <input type="text" name="eglise" id="eglise" 
                                                       class="form-control" 
                                                       value="{{ old('eglise', $fiance->eglise) }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Professional Info -->
                            <div class="col-12 col-md-6">
                                <div class="card h-100 border-0 shadow-sm">
                                    <div class="card-header bg-light">
                                        <h6 class="mb-0">Situation professionnelle</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="row g-3">
                                            <div class="col-12">
                                                <label for="profession" class="form-label">Profession</label>
                                                <input type="text" name="profession" id="profession" 
                                                       class="form-control" 
                                                       value="{{ old('profession', $fiance->profession) }}">
                                            </div>

                                            <div class="col-12">
                                                <label for="nom_entreprise" class="form-label">Nom de l'entreprise</label>
                                                <input type="text" name="nom_entreprise" id="nom_entreprise" 
                                                       class="form-control" 
                                                       value="{{ old('nom_entreprise', $fiance->nom_entreprise) }}">
                                            </div>

                                            <div class="col-12">
                                                <label for="commune_entreprise" class="form-label">Commune de l'entreprise</label>
                                                <input type="text" name="commune_entreprise" id="commune_entreprise" 
                                                       class="form-control" 
                                                       value="{{ old('commune_entreprise', $fiance->commune_entreprise) }}">
                                            </div>

                                            <div class="col-12">
                                                <label for="statut_habitation" class="form-label">Statut habitation</label>
                                                <select name="statut_habitation" id="statut_habitation" class="form-select">
                                                    <option value="">-- Sélectionner --</option>
                                                    <option value="en famille" {{ old('statut_habitation', $fiance->statut_habitation) == 'en famille' ? 'selected' : '' }}>En famille</option>
                                                    <option value="locataire" {{ old('statut_habitation', $fiance->statut_habitation) == 'locataire' ? 'selected' : '' }}>Locataire</option>
                                                    <option value="propriétaire" {{ old('statut_habitation', $fiance->statut_habitation) == 'propriétaire' ? 'selected' : '' }}>Propriétaire</option>
                                                    <option value="colocataire" {{ old('statut_habitation', $fiance->statut_habitation) == 'colocataire' ? 'selected' : '' }}>Colocataire</option>
                                                </select>
                                            </div>

                                            <div class="col-12 col-md-6">
                                                <label for="nombre_enfants" class="form-label">Nombre d'enfants</label>
                                                <input type="number" name="nombre_enfants" id="nombre_enfants" 
                                                       class="form-control" min="0"
                                                       value="{{ old('nombre_enfants', $fiance->nombre_enfants) }}">
                                            </div>

                                            <div class="col-12 col-md-6">
                                                <label for="personnes_en_charge" class="form-label">Personnes en charge</label>
                                                <input type="number" name="personnes_en_charge" id="personnes_en_charge" 
                                                       class="form-control" min="0"
                                                       value="{{ old('personnes_en_charge', $fiance->personnes_en_charge) }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Form Actions -->
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
    </div>
</div>
@endsection

@section('styles')
<style>
    .card-header.bg-light {
        background-color: #f8f9fa !important;
    }
    .form-label {
        font-weight: 500;
        margin-bottom: 0.25rem;
    }
    @media (max-width: 767.98px) {
        .card-header {
            padding: 0.75rem;
        }
        .card-body {
            padding: 1rem;
        }
    }
</style>
@endsection