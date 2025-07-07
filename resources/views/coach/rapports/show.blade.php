@extends('layouts.coach')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">
            <i class="bi bi-file-earmark-text-fill text-primary"></i> Détail du rapport
        </h2>
        <a href="{{ route('coach.rapports.edit', $rapport) }}" class="btn btn-primary">
            <i class="bi bi-pencil-square"></i> Modifier
        </a>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-header bg-light-primary text-primary">
            <h5 class="mb-1">Coaching du couple</h5>
            <p class="mb-0 text-dark">
                {{ $rapport->coaching->fiancailles->fiance->prenoms ?? '' }} {{ $rapport->coaching->fiancailles->fiance->nom ?? '' }} 
                & 
                {{ $rapport->coaching->fiancailles->fiancee->prenoms ?? '' }} {{ $rapport->coaching->fiancailles->fiancee->nom ?? '' }}
            </p>
        </div>
        
        <div class="card-body">
            <div class="row">
                <!-- Colonne 1 -->
                <div class="col-md-6">
                    <div class="mb-4">
                        <h6 class="text-uppercase text-muted mb-3">Informations générales</h6>
                        <div class="list-group list-group-flush">
                            <div class="list-group-item d-flex justify-content-between align-items-center px-0">
                                <span>Nombre de séances</span>
                                <span class="badge bg-primary rounded-pill">{{ $rapport->nombre_seances }}</span>
                            </div>
                            <div class="list-group-item px-0">
                                <p class="mb-1">Types de séances</p>
                                <div class="d-flex flex-wrap gap-2">
                                    @foreach($rapport->types_seances ?? [] as $type)
                                        <span class="badge bg-light text-dark border">{{ $type }}</span>
                                    @endforeach
                                </div>
                            </div>
                            <div class="list-group-item px-0">
                                <p class="mb-1">Dernière leçon</p>
                                <p class="mb-0 text-dark">{{ $rapport->derniere_lecon }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Colonne 2 -->
                <div class="col-md-6">
                    <div class="mb-4">
                        <h6 class="text-uppercase text-muted mb-3">Dates</h6>
                        <div class="list-group list-group-flush">
                            <div class="list-group-item d-flex justify-content-between align-items-center px-0">
                                <span>Date début coaching</span>
                                <span>{{ $rapport->coaching->date_debut->format('d/m/Y') }}</span>
                            </div>
                            <div class="list-group-item d-flex justify-content-between align-items-center px-0">
                                <span>Date du rapport</span>
                                <span>{{ $rapport->created_at->format('d/m/Y à H:i') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Section Observations -->
            <div class="mb-4">
                <h6 class="text-uppercase text-muted mb-3">Observations</h6>
                <div class="card bg-light border-0">
                    <div class="card-body">
                        <p class="mb-0">{{ $rapport->observations }}</p>
                    </div>
                </div>
            </div>
            
            <!-- Section Défis & Solutions -->
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-4">
                        <h6 class="text-uppercase text-muted mb-3">Défis du couple</h6>
                        <div class="card bg-light border-0 h-100">
                            <div class="card-body">
                                @if(is_array($rapport->defis_couple) && count($rapport->defis_couple))
                                    <div class="d-flex flex-wrap gap-2">
                                        @foreach($rapport->defis_couple as $defi)
                                            <span class="badge bg-warning text-dark">{{ $defi }}</span>
                                        @endforeach
                                    </div>
                                @else
                                    <p class="mb-0 text-muted">Aucun défi renseigné.</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-4">
                        <h6 class="text-uppercase text-muted mb-3">Solutions proposées</h6>
                        <div class="card bg-light border-0 h-100">
                            <div class="card-body">
                                <p class="mb-0">{{ $rapport->solutions_coaches }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-4">
        <a href="{{ route('coach.rapports.index') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left"></i> Retour à la liste
        </a>
    </div>
</div>
@endsection

@section('styles')
<style>
    .bg-light-primary {
        background-color: rgba(13, 110, 253, 0.1);
    }
    .card-header {
        border-bottom: none;
    }
</style>
@endsection
