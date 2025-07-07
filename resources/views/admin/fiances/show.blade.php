@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12">
            <a href="{{ route('admin.fiances.index') }}" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left"></i> Retour à la liste
            </a>
        </div>
    </div>

    <div class="row">
        <!-- Colonne de gauche - Photo et informations de base -->
        <div class="col-lg-4 mb-4">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-{{ $fiance->sexe === 'M' ? 'primary' : 'danger' }} text-white">
                    <h5 class="mb-0">
                        <i class="bi bi-{{ $fiance->sexe === 'M' ? 'gender-male' : 'gender-female' }}"></i>
                        Profil du fiancé
                    </h5>
                </div>
                <div class="card-body text-center">
                    <img src="{{ $fiance->photo ? asset('storage/'.$fiance->photo) : ($fiance->sexe === 'M' ? asset('images/default-male.png') : asset('images/default-female.png')) }}" 
                         class="rounded-circle mb-3 border" width="150" height="150" alt="Photo du fiancé">
                    <h3>{{ $fiance->prenoms }} {{ $fiance->nom }}</h3>
                    <p class="text-muted">{{ $fiance->profession }}</p>
                    <hr>
                    <div class="text-start">
                        <p><i class="bi bi-envelope"></i> <strong>Email :</strong> {{ $fiance->email }}</p>
                        <p><i class="bi bi-telephone"></i> <strong>Téléphone :</strong> {{ $fiance->contact }}</p>
                        <p><i class="bi bi-calendar"></i> <strong>Âge :</strong> {{ $fiance->date_naissance->age }} ans</p>
                        <p><i class="bi bi-geo-alt"></i> <strong>Adresse :</strong> {{ $fiance->domicile }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Colonne de droite - Détails complets -->
        <div class="col-lg-8">
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-light">
                    <h5 class="mb-0"><i class="bi bi-file-earmark-text"></i> Informations détaillées</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <!-- Colonne gauche détails -->
                        <div class="col-md-6">
                            <h6><i class="bi bi-person-badge"></i> État civil</h6>
                            <ul class="list-group list-group-flush mb-3">
                                <li class="list-group-item d-flex justify-content-between">
                                    <span>Date de naissance</span>
                                    <span>{{ $fiance->date_naissance->format('d/m/Y') }}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between">
                                    <span>Lieu de naissance</span>
                                    <span>{{ $fiance->lieu_naissance }}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between">
                                    <span>Ethnie</span>
                                    <span>{{ $fiance->ethnie }}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between">
                                    <span>Genre</span>
                                    <span>{{ $fiance->sexe === 'M' ? 'Masculin' : 'Féminin' }}</span>
                                </li>
                            </ul>

                            <h6><i class="bi bi-house"></i> Situation familiale</h6>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item d-flex justify-content-between">
                                    <span>Statut d'habitation</span>
                                    <span>{{ $fiance->statut_habitation }}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between">
                                    <span>Nombre d'enfants</span>
                                    <span>{{ $fiance->nombre_enfants }}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between">
                                    <span>Personnes à charge</span>
                                    <span>{{ $fiance->personnes_en_charge }}</span>
                                </li>
                            </ul>
                        </div>

                        <!-- Colonne droite détails -->
                        <div class="col-md-6">
                            <h6><i class="bi bi-briefcase"></i> Profession</h6>
                            <ul class="list-group list-group-flush mb-3">
                                <li class="list-group-item">
                                    <strong>Profession :</strong> {{ $fiance->profession }}
                                </li>
                                <li class="list-group-item">
                                    <strong>Entreprise :</strong> {{ $fiance->nom_entreprise }}
                                </li>
                                <li class="list-group-item">
                                    <strong>Localisation :</strong> {{ $fiance->commune_entreprise }}
                                </li>
                            </ul>

                            <h6><i class="bi bi-heart"></i> Vie spirituelle</h6>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">
                                    <strong>Église :</strong> {{ $fiance->eglise }}
                                </li>
                                <li class="list-group-item">
                                    <strong>Tribu :</strong> {{ $fiance->tribu }}
                                </li>
                                <li class="list-group-item">
                                    <strong>Département :</strong> {{ $fiance->departement }}
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Section Coaching -->
            <div class="card shadow-sm">
                <div class="card-header bg-light">
                    <h5 class="mb-0"><i class="bi bi-people-fill"></i> Contexte de coaching</h5>
                </div>
                <div class="card-body">
                    @php
                        $fiancailles = $fiance->fiancaillesHomme ?? $fiance->fiancaillesFemme;
                    @endphp

                    @if($fiancailles && $fiancailles->coaching)
                        <div class="row">
                            <div class="col-md-6">
                                <h6>Couple :</h6>
                                <p>
                                    @if($fiance->sexe === 'M')
                                        {{ $fiance->prenoms }} & {{ $fiancailles->fiancee->prenoms }}
                                    @else
                                        {{ $fiancailles->fiance->prenoms }} & {{ $fiance->prenoms }}
                                    @endif
                                </p>

                                <h6 class="mt-3">Date de début :</h6>
                                <p>{{ $fiancailles->coaching->date_debut->format('d/m/Y') }}</p>
                            </div>
                            <div class="col-md-6">
                                <h6>Statut :</h6>
                                <span class="badge bg-{{ $fiancailles->coaching->statut === 'actif' ? 'success' : 'warning' }}">
                                    {{ $fiancailles->coaching->statut }}
                                </span>

                                <h6 class="mt-3">Coachs :</h6>
                                <p>
                                    {{ $fiancailles->coaching->coupleCoach->coachHomme->prenoms ?? 'Non défini' }} & 
                                    {{ $fiancailles->coaching->coupleCoach->coachFemme->prenoms ?? 'Non défini' }}
                                    {{ $fiancailles->coaching->coupleCoach->coachHomme->nom ?? 'Non défini' }}
                                </p>
                            </div>
                        </div>
                    @else
                        <div class="alert alert-warning">
                            Ce fiancé ne fait actuellement partie d'aucun coaching actif.
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
    .bg-pink {
        background-color: #e83e8c;
    }
    .card {
        border-radius: 10px;
    }
    .list-group-item {
        border-left: none;
        border-right: none;
        padding: 0.75rem 0;
    }
    .list-group-item:first-child {
        border-top: none;
    }
    img {
        object-fit: cover;
    }
</style>
@endsection