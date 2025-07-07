@extends('layouts.manager')

@section('title', 'Gestion des coachings')

@section('content')
<div class="container-fluid px-0">
    <div class="row g-3">
        <main class="col-12">
            <div class="card shadow border-0">
                <div class="card-header bg-white py-3">
                    <div class="d-flex flex-column flex-md-row justify-content-between align-items-center">
                        <h1 class="h4 mb-3 mb-md-0">
                            <i class="bi bi-people-fill"></i> Liste des coachings
                        </h1>
                    </div>
                </div>
                
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="bi bi-check-circle-fill"></i> {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-hover d-none d-md-table">
                            <thead class="table-light">
                                <tr>
                                    <th>ID</th>
                                    <th>Fiancés</th>
                                    <th>Coaches</th>
                                    <th>Statut</th>
                                    <th>Dates</th>
                                    <th class="text-end">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($coachings as $coaching)
                                    <tr>
                                        <td>{{ $coaching->id }}</td>
                                        <td>
                                            @if($coaching->fiancailles)
                                                <strong>{{ $coaching->fiancailles->fiance->prenoms ?? 'Inconnu' }} {{ strtoupper($coaching->fiancailles->fiance->nom ?? '' )}}
                                                    & {{ $coaching->fiancailles->fiancee->prenoms ?? 'Inconnue' }} {{ strtoupper($coaching->fiancailles->fiancee->nom ?? '' )}}
                                                </strong>
                                                <div class="text-muted small">
                                                    Depuis {{ $coaching->fiancailles->date_debut->format('d/m/Y') }}
                                                </div>
                                            @else
                                                <span class="text-danger">Fiançailles supprimées</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($coaching->coupleCoach)
                                                {{ $coaching->coupleCoach->coachHomme->prenoms ?? 'Inconnu' }} & 
                                                {{ $coaching->coupleCoach->coachFemme->prenoms ?? 'Inconnue' }} 
                                                {{ strtoupper($coaching->coupleCoach->coachHomme->nom) ?? '' }}
                                            @else
                                                <span class="text-danger">Couple de coachs supprimé</span>
                                            @endif
                                        </td>
                                        <td>
                                            @php
                                                $statusClasses = [
                                                    'actif' => 'bg-success',
                                                    'en_pause' => 'bg-warning',
                                                    'arrete' => 'bg-danger',
                                                    'acheve' => 'bg-secondary'
                                                ];
                                            @endphp
                                            <span class="badge {{ $statusClasses[$coaching->statut] ?? 'bg-primary' }}">
                                                {{ $statuts[$coaching->statut] ?? $coaching->statut }}
                                            </span>
                                        </td>
                                        <td>
                                            <div class="small">
                                                <div><i class="bi bi-calendar-event"></i> Début: {{ $coaching->date_debut->format('d/m/Y') }}</div>
                                                @if($coaching->date_fin)
                                                    <div><i class="bi bi-calendar-x"></i> Fin: {{ $coaching->date_fin->format('d/m/Y') }}</div>
                                                @endif
                                            </div>
                                        </td>
                                        <td class="text-end">
                                            <div class="d-flex justify-content-end gap-2">
                                                <a href="{{ route('manager.coachings.show', $coaching) }}" class="btn btn-sm btn-outline-primary" title="Voir">
                                                    <i class="bi bi-eye"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center py-4">
                                            <i class="bi bi-info-circle-fill fs-4 text-muted"></i>
                                            <p class="mt-2">Aucun coaching enregistré</p>
                                            <a href="{{ route('admin.coachings.create') }}" class="btn btn-sm btn-primary">
                                                Créer un coaching
                                            </a>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>

                        {{-- Mobile view --}}
                        <div class="d-block d-md-none">
                            @forelse($coachings as $coaching)
                                <div class="card mb-3 shadow-sm">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-start mb-2">
                                            <h5 class="card-title mb-0">
                                                Coaching #{{ $coaching->id }}
                                            </h5>
                                            <span class="badge {{ $statusClasses[$coaching->statut] ?? 'bg-primary' }}">
                                                {{ $statuts[$coaching->statut] ?? $coaching->statut }}
                                            </span>
                                        </div>
                                        
                                        <div class="mb-3">
                                            <h6 class="fw-bold mb-1">Fiancés</h6>
                                            @if($coaching->fiancailles)
                                                <p class="mb-1">{{ $coaching->fiancailles->fiance->prenoms ?? 'Inconnu' }} {{strtoupper($coaching->fiancailles->fiance->nom ?? '' )}}
                                                    & {{ $coaching->fiancailles->fiancee->prenoms ?? 'Inconnue' }} {{ strtoupper($coaching->fiancailles->fiancee->nom ?? '' )}}
                                                </p>
                                                <small class="text-muted">Depuis {{ $coaching->fiancailles->date_debut->format('d/m/Y') }}</small>
                                            @else
                                                <span class="text-danger">Fiançailles supprimées</span>
                                            @endif
                                        </div>
                                        
                                        <div class="mb-3">
                                            <h6 class="fw-bold mb-1">Coaches</h6>
                                            @if($coaching->coupleCoach)
                                                <p>{{ $coaching->coupleCoach->coachHomme->prenoms ?? 'Inconnu' }} 
                                                    & {{ $coaching->coupleCoach->coachFemme->prenoms ?? 'Inconnue' }} 
                                                    {{ strtoupper($coaching->coupleCoach->coachHomme->nom) ?? '' }}
                                                </p>
                                            @else
                                                <span class="text-danger">Couple de coachs supprimé</span>
                                            @endif
                                        </div>
                                        
                                        <div class="mb-3">
                                            <h6 class="fw-bold mb-1">Dates</h6>
                                            <p class="mb-1"><i class="bi bi-calendar-event"></i> Début: {{ $coaching->date_debut->format('d/m/Y') }}</p>
                                            @if($coaching->date_fin)
                                                <p class="mb-0"><i class="bi bi-calendar-x"></i> Fin: {{ $coaching->date_fin->format('d/m/Y') }}</p>
                                            @endif
                                        </div>
                                        
                                        <div class="d-flex justify-content-end gap-2 pt-2 border-top">
                                            <a href="{{ route('manager.coachings.show', $coaching) }}" class="btn btn-sm btn-outline-primary" title="Voir">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="text-center py-4">
                                    <i class="bi bi-info-circle-fill fs-4 text-muted"></i>
                                    <p class="mt-2">Aucun coaching enregistré</p>
                                    <a href="{{ route('admin.coachings.create') }}" class="btn btn-primary">
                                        Créer un coaching
                                    </a>
                                </div>
                            @endforelse
                        </div>
                    </div>
                    {{-- Pagination --}}
                    @if($coachings->hasPages())
                        <div class="card-footer bg-light px-3 py-2">
                            <div class="d-flex flex-column flex-md-row justify-content-between align-items-center">
                                <div class="small text-muted mb-2 mb-md-0">
                                    Affichage de {{ $coachings->firstItem() }} à {{ $coachings->lastItem() }} sur {{ $coachings->total() }} coachings
                                </div>
                                {{ $coachings->onEachSide(1)->links('pagination::bootstrap-4') }}
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </main>
    </div>
</div>
@endsection

@section('styles')
<style>
    .card {
        border-radius: 0.5rem;
    }
    .table th {
        font-weight: 600;
        background-color: #f8f9fa;
    }
    .badge {
        font-size: 0.75rem;
        padding: 0.35em 0.65em;
    }
    
    /* Mobile card styling */
    @media (max-width: 767.98px) {
        .card-title {
            font-size: 1.1rem;
        }
        .card-body {
            padding: 1rem;
        }
        .btn-sm {
            padding: 0.25rem 0.5rem;
            font-size: 0.8rem;
        }
    }
</style>
@endsection