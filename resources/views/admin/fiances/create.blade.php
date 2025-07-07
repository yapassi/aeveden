@extends('layouts.admin')

@section('content')
<div class="container-fluid px-0">
    <div class="card border-0 shadow-sm">
        <!-- Card Header -->
        <div class="card-header bg-primary text-white p-3">
            <div class="d-flex justify-content-between align-items-center">
                <h1 class="h5 mb-0">
                    <i class="bi bi-heart-fill me-2"></i> Créer un fiancé
                </h1>
                <a href="{{ route('admin.fiances.index') }}" class="btn btn-light btn-sm">
                    <i class="bi bi-arrow-left me-1"></i> Retour
                </a>
            </div>
        </div>

        <!-- Card Body -->
        <div class="card-body">
            <form action="{{ route('admin.fiances.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row g-3">
                    <!-- Informations personnelles -->
                    <div class="col-12">
                        <div class="card mb-4 border-0 shadow-sm">
                            <div class="card-header bg-light">
                                <h6 class="mb-0">Informations personnelles</h6>
                            </div>
                            <div class="card-body">
                                <div class="row g-3">
                                    <div class="col-12 col-md-6">
                                        <label class="form-label">Nom <span class="text-danger">*</span></label>
                                        <input type="text" name="nom" class="form-control" required>
                                    </div>

                                    <div class="col-12 col-md-6">
                                        <label class="form-label">Prénoms <span class="text-danger">*</span></label>
                                        <input type="text" name="prenoms" class="form-control" required>
                                    </div>

                                    <div class="col-12 col-md-6">
                                        <label class="form-label">Sexe <span class="text-danger">*</span></label>
                                        <select name="sexe" class="form-select" required>
                                            <option value="">-- Sélectionner --</option>
                                            <option value="M">Homme</option>
                                            <option value="F">Femme</option>
                                        </select>
                                    </div>

                                    <div class="col-12 col-md-6">
                                        <label class="form-label">Photo</label>
                                        <input type="file" name="photo" class="form-control">
                                    </div>

                                    <div class="col-12 col-md-6">
                                        <label class="form-label">Date de naissance</label>
                                        <input type="date" name="date_naissance" class="form-control">
                                    </div>

                                    <div class="col-12 col-md-6">
                                        <label class="form-label">Lieu de naissance</label>
                                        <input type="text" name="lieu_naissance" class="form-control">
                                    </div>

                                    <div class="col-12 col-md-6">
                                        <label class="form-label">Ethnie</label>
                                        <input type="text" name="ethnie" class="form-control">
                                    </div>

                                    <div class="col-12 col-md-6">
                                        <label class="form-label">Contact</label>
                                        <input type="text" name="contact" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Coordonnées -->
                    <div class="col-12 col-md-6">
                        <div class="card h-100 border-0 shadow-sm">
                            <div class="card-header bg-light">
                                <h6 class="mb-0">Coordonnées</h6>
                            </div>
                            <div class="card-body">
                                <div class="row g-3">
                                    <div class="col-12">
                                        <label class="form-label">Email</label>
                                        <input type="email" name="email" class="form-control">
                                    </div>

                                    <div class="col-12">
                                        <label class="form-label">Église</label>
                                        <input type="text" name="eglise" class="form-control">
                                    </div>

                                    <div class="col-12">
                                        <label class="form-label">Tribu</label>
                                        <input type="text" name="tribu" class="form-control">
                                    </div>

                                    <div class="col-12">
                                        <label class="form-label">Département</label>
                                        <input type="text" name="departement" class="form-control">
                                    </div>

                                    <div class="col-12">
                                        <label class="form-label">Domicile</label>
                                        <input type="text" name="domicile" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Situation professionnelle & familiale -->
                    <div class="col-12 col-md-6">
                        <div class="card h-100 border-0 shadow-sm">
                            <div class="card-header bg-light">
                                <h6 class="mb-0">Situation</h6>
                            </div>
                            <div class="card-body">
                                <div class="row g-3">
                                    <div class="col-12">
                                        <label class="form-label">Profession</label>
                                        <input type="text" name="profession" class="form-control">
                                    </div>

                                    <div class="col-12">
                                        <label class="form-label">Nom de l'entreprise</label>
                                        <input type="text" name="nom_entreprise" class="form-control">
                                    </div>

                                    <div class="col-12">
                                        <label class="form-label">Commune de l'entreprise</label>
                                        <input type="text" name="commune_entreprise" class="form-control">
                                    </div>

                                    <div class="col-12">
                                        <label class="form-label">Statut habitation</label>
                                        <select name="statut_habitation" class="form-select">
                                            <option value="">-- Sélectionner --</option>
                                            <option value="en famille">En famille</option>
                                            <option value="locataire">Locataire</option>
                                            <option value="propriétaire">Propriétaire</option>
                                            <option value="colocataire">Colocataire</option>
                                        </select>
                                    </div>

                                    <div class="col-12 col-md-6">
                                        <label class="form-label">Nombre d'enfants</label>
                                        <input type="number" name="nombre_enfants" class="form-control" min="0">
                                    </div>

                                    <div class="col-12 col-md-6">
                                        <label class="form-label">Personnes en charge</label>
                                        <input type="number" name="personnes_en_charge" class="form-control" min="0">
                                    </div>
                                </div>
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
                        <i class="bi bi-check-circle me-2"></i> Enregistrer
                    </button>
                </div>
            </form>
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