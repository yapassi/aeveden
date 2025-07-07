@extends('layouts.coach')

@section('title', 'Détails du Couple Coach')

@section('content')
<div class="container-fluid px-0">
    <div class="card border-0 shadow-sm">
        <!-- Card Header -->
        <div class="card-header bg-primary text-white p-3">
            <div class="d-flex justify-content-between align-items-center">
                <h1 class="h5 mb-0">
                    <i class="bi bi-people-fill me-2"></i> Détails du Couple Coach
                </h1>
                <a href="{{ route('admin.couple-coaches.index') }}" class="btn btn-light btn-sm">
                    <i class="bi bi-arrow-left me-1"></i> Retour
                </a>
            </div>
        </div>

        <!-- Card Body -->
        <div class="card-body">
            <div class="row g-3">
                <!-- Coach Homme -->
                <div class="col-12 col-md-6">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-header bg-light">
                            <h6 class="mb-0">Coach Homme</h6>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <h5 class="mb-1">{{ $coupleCoach->coachHomme->prenoms }} {{ $coupleCoach->coachHomme->nom }}</h5>
                                <div class="text-muted small">
                                    <div><i class="bi bi-envelope me-1"></i> {{ $coupleCoach->coachHomme->email }}</div>
                                    <div><i class="bi bi-telephone me-1"></i> {{ $coupleCoach->coachHomme->contact }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Coach Femme -->
                <div class="col-12 col-md-6">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-header bg-light">
                            <h6 class="mb-0">Coach Femme</h6>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <h5 class="mb-1">{{ $coupleCoach->coachFemme->prenoms }} {{ $coupleCoach->coachFemme->nom }}</h5>
                                <div class="text-muted small">
                                    <div><i class="bi bi-envelope me-1"></i> {{ $coupleCoach->coachFemme->email }}</div>
                                    <div><i class="bi bi-telephone me-1"></i> {{ $coupleCoach->coachFemme->contact }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Informations du couple -->
                <div class="col-12">
                    <div class="card border-0 shadow-sm">
                        <div class="card-header bg-light">
                            <h6 class="mb-0">Informations du Couple</h6>
                        </div>
                        <div class="card-body">
                            <div class="row g-3">
                                <div class="col-12 col-md-4">
                                    <div class="border rounded p-3 bg-light">
                                        <small class="text-muted d-block">Date de mariage</small>
                                        <span>{{ $coupleCoach->date_mariage->format('d/m/Y') }}</span>
                                    </div>
                                </div>
                                <div class="col-12 col-md-4">
                                    <div class="border rounded p-3 bg-light">
                                        <small class="text-muted d-block">Date début coaching</small>
                                        <span>{{ $coupleCoach->date_debut_coaching->format('d/m/Y') }}</span>
                                    </div>
                                </div>
                                <div class="col-12 col-md-4">
                                    <div class="border rounded p-3 bg-light">
                                        <small class="text-muted d-block">Domicile</small>
                                        <span>{{ $coupleCoach->domicile ?? 'Non spécifié' }}</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Liste des coachings -->
                            @if($coupleCoach->coachings->count() > 0)
                            <div class="mt-4">
                                <h6 class="text-muted mb-2">Coachings associés</h6>
                                <div class="list-group">
                                    @foreach($coupleCoach->coachings as $coaching)
                                    <a href="{{ route('admin.coachings.show', $coaching->id) }}" 
                                       class="list-group-item list-group-item-action">
                                        <div class="d-flex justify-content-between">
                                            <span>Coaching #{{ $coaching->id }}</span>
                                            <span class="badge bg-{{ $coaching->statut === 'actif' ? 'success' : 'secondary' }}">
                                                {{ ucfirst($coaching->statut) }}
                                            </span>
                                        </div>
                                        <small class="text-muted">
                                            {{ $coaching->date_debut->format('d/m/Y') }} - 
                                            {{ $coaching->date_fin ? $coaching->date_fin->format('d/m/Y') : 'En cours' }}
                                        </small>
                                    </a>
                                    @endforeach
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Actions -->
                <div class="col-12 mt-4">
                    <div class="d-flex flex-column flex-sm-row justify-content-end gap-3">
                        <a href="{{ route('admin.couple-coaches.edit', $coupleCoach->id) }}" 
                           class="btn btn-warning flex-grow-1 flex-sm-grow-0">
                            <i class="bi bi-pencil me-2"></i> Modifier
                        </a>
                        <form action="{{ route('admin.couple-coaches.destroy', $coupleCoach->id) }}" 
                              method="POST" class="flex-grow-1 flex-sm-grow-0">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger w-100"
                                    onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce couple coach ?')">
                                <i class="bi bi-trash me-2"></i> Supprimer
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
    .border-pink {
        border-color: #ff69b4 !important;
    }
    .bg-light {
        background-color: #f8f9fa !important;
    }
    @media (max-width: 767.98px) {
        .card-header {
            padding: 0.75rem;
        }
        .card-body {
            padding: 1rem;
        }
    }
    .list-group-item {
        transition: all 0.2s;
    }
    .list-group-item:hover {
        background-color: #f8f9fa;
    }
</style>
@endsection