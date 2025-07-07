@extends('layouts.coach')

@section('content')
<div class="container-fluid px-0">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">
                <i class="bi bi-people-fill"></i> Mes couples coachés
            </h4>
        </div>
        
        <div class="card-body p-0">
            @if($coachings->isEmpty())
                <div class="alert alert-info m-3">
                    Aucun couple assigné pour le moment.
                </div>
            @else
                <!-- Version Mobile -->
                <div class="d-block d-md-none">
                    @foreach($coachings as $coaching)
                    <div class="border-bottom p-3">
                        <div class="d-flex align-items-center mb-2">
                            <!-- Photo du fiancé -->
                            <div class="position-relative me-2">
                                <img src="{{ $coaching->fiancailles->fiance->photo ? asset('storage/'.$coaching->fiancailles->fiance->photo) : asset('images/default-male.png') }}" 
                                     class="rounded-circle border border-2 border-primary" 
                                     width="48" 
                                     height="48" 
                                     style="object-fit: cover;"
                                     alt="{{ $coaching->fiancailles->fiance->prenoms ?? 'Fiancé' }}"
                                     onerror="this.onerror=null;this.src='{{ asset('images/default-male.png') }}'">
                                <span class="position-absolute bottom-0 end-0 bg-primary rounded-circle p-1"></span>
                            </div>
                            
                            <!-- Photo de la fiancée -->
                            <div class="position-relative me-2">
                                <img src="{{ $coaching->fiancailles->fiancee->photo ? asset('storage/'.$coaching->fiancailles->fiancee->photo) : asset('images/default-female.png') }}" 
                                     class="rounded-circle border border-2 border-danger" 
                                     width="48" 
                                     height="48" 
                                     style="object-fit: cover;"
                                     alt="{{ $coaching->fiancailles->fiancee->prenoms ?? 'Fiancée' }}"
                                     onerror="this.onerror=null;this.src='{{ asset('images/default-female.png') }}'">
                                <span class="position-absolute bottom-0 end-0 bg-danger rounded-circle p-1"></span>
                            </div>
                            
                            <div class="flex-grow-1">
                                <h6 class="mb-0">
                                    {{ $coaching->fiancailles->fiance->prenoms ?? 'N/A' }} & 
                                    {{ $coaching->fiancailles->fiancee->prenoms ?? 'N/A' }}
                                </h6>
                                <small class="text-muted">
                                    {{ $coaching->date_debut->format('d/m/Y') }}
                                </small>
                            </div>
                            
                            <span class="badge bg-{{ $coaching->statut === 'actif' ? 'success' : ($coaching->statut === 'en_pause' ? 'warning text-dark' : 'secondary') }}">
                                {{ ucfirst($coaching->statut) }}
                            </span>
                        </div>
                        
                        <div class="d-flex justify-content-between align-items-center mt-2">
                            <small class="text-muted">
                                {{ $coaching->fiancailles->fiance->nom ?? '' }} & 
                                {{ $coaching->fiancailles->fiancee->nom ?? '' }}
                            </small>
                            
                            <a href="{{ route('coach.coachings.show', $coaching->id) }}" 
                               class="btn btn-sm btn-primary"
                               title="Voir détails">
                                <i class="bi bi-eye"></i>
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>
                
                <!-- Version Desktop -->
                <div class="d-none d-md-block">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle m-0">
                            <thead class="bg-light">
                                <tr>
                                    <th>Couple</th>
                                    <th>Date début</th>
                                    <th>Date fin</th>
                                    <th>Statut</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($coachings as $coaching)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <!-- Photo du fiancé -->
                                            <div class="position-relative me-2">
                                                <img src="{{ $coaching->fiancailles->fiance->photo ? asset('storage/'.$coaching->fiancailles->fiance->photo) : asset('images/default-male.png') }}" 
                                                     class="rounded-circle border border-2 border-primary" 
                                                     width="40" 
                                                     height="40" 
                                                     style="object-fit: cover;"
                                                     alt="{{ $coaching->fiancailles->fiance->prenoms ?? 'Fiancé' }}"
                                                     onerror="this.onerror=null;this.src='{{ asset('images/default-male.png') }}'">
                                                <span class="position-absolute bottom-0 end-0 bg-primary rounded-circle p-1"></span>
                                            </div>
                                            
                                            <!-- Photo de la fiancée -->
                                            <div class="position-relative me-3">
                                                <img src="{{ $coaching->fiancailles->fiancee->photo ? asset('storage/'.$coaching->fiancailles->fiancee->photo) : asset('images/default-female.png') }}" 
                                                     class="rounded-circle border border-2 border-danger" 
                                                     width="40" 
                                                     height="40" 
                                                     style="object-fit: cover;"
                                                     alt="{{ $coaching->fiancailles->fiancee->prenoms ?? 'Fiancée' }}"
                                                     onerror="this.onerror=null;this.src='{{ asset('images/default-female.png') }}'">
                                                <span class="position-absolute bottom-0 end-0 bg-danger rounded-circle p-1"></span>
                                            </div>
                                            
                                            <div>
                                                <strong class="d-block">
                                                    {{ $coaching->fiancailles->fiance->prenoms ?? 'N/A' }} & 
                                                    {{ $coaching->fiancailles->fiancee->prenoms ?? 'N/A' }}
                                                </strong>
                                                <small class="text-muted">
                                                    {{ $coaching->fiancailles->fiance->nom ?? '' }} & 
                                                    {{ $coaching->fiancailles->fiancee->nom ?? '' }}
                                                </small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ $coaching->date_debut ? $coaching->date_debut->format('d/m/Y') : 'non défini'}}</td>
                                    <td>{{ $coaching->date_fin ? $coaching->date_fin->format('d/m/Y') : 'non défini'}}</td>
                                    <td>
                                        <span class="badge bg-{{ $coaching->statut === 'actif' ? 'success' : ($coaching->statut === 'en_pause' ? 'warning text-dark' : 'secondary') }}">
                                            {{ ucfirst($coaching->statut) }}
                                        </span>
                                    </td>
                                    <td>
                                        <a href="{{ route('coach.coachings.show', $coaching->id) }}" 
                                           class="btn btn-sm btn-primary"
                                           title="Voir détails">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
    .border-pink {
        border-color: #ff69b4 !important;
    }
    .bg-pink {
        background-color: #ff69b4;
    }
    .table th, .table td {
        vertical-align: middle;
    }
    @media (max-width: 767.98px) {
        .container-fluid {
            padding-left: 0.5rem;
            padding-right: 0.5rem;
        }
    }
</style>
@endsection