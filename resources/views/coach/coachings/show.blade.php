@extends('layouts.admin')

@section('content')
<div class="container-fluid px-0">
    <!-- Bouton Retour -->
    <div class="px-3 py-2">
        <a href="{{ route('coach.coachings.index') }}" class="btn btn-outline-secondary btn-sm">
            <i class="bi bi-arrow-left"></i> Retour
        </a>
    </div>

    <!-- Carte Principale Coaching -->
    <div class="card border-0 shadow-sm mb-3">
        <div class="card-header bg-primary text-white p-3">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-2">
                <h1 class="h5 mb-0">
                    <i class="bi bi-people-fill"></i> Coaching #{{ $coaching->id }}
                </h1>
            </div>
        </div>
        
        <div class="card-body">
            <div class="row g-3">
                <div class="col-12 col-md-6">
                    <div class="d-flex flex-column gap-2">
                        <div>
                            <h6 class="mb-1 fw-bold">Statut :</h6>
                            <span class="badge bg-{{ $coaching->statut === 'actif' ? 'success' : 'warning' }} rounded-pill">
                                {{ \App\Models\Coaching::STATUTS[$coaching->statut] ?? $coaching->statut }}
                            </span>
                        </div>
                        
                        <div>
                            <h6 class="mb-1 fw-bold">Dates :</h6>
                            <div class="small">
                                <div>Début : {{ $coaching->date_debut->format('d/m/Y') }}</div>
                                <div>Fin : {{ $coaching->date_fin ? $coaching->date_fin->format('d/m/Y') : '-' }}</div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-12 col-md-6">
                    <h6 class="mb-1 fw-bold">Coachs :</h6>
                    <div class="d-flex flex-column gap-2">
                        <div class="d-flex align-items-center gap-2">
                            <i class="bi bi-gender-male text-primary"></i>
                            <span>{{ $coaching->coupleCoach->coachHomme->prenoms ?? 'Non défini' }} {{ $coaching->coupleCoach->coachHomme->nom ?? 'Non défini' }}</span>
                        </div>
                        <div class="d-flex align-items-center gap-2">
                            <i class="bi bi-gender-female text-pink"></i>
                            <span>{{ $coaching->coupleCoach->coachFemme->prenoms ?? 'Non défini' }} {{ $coaching->coupleCoach->coachFemme->nom ?? 'Non défini' }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Section Couple -->
    <div class="row g-3 mb-3">
        <!-- Fiancé -->
        <div class="col-12 col-md-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-primary text-white p-3">
                    <h2 class="h6 mb-0">
                        <i class="bi bi-gender-male"></i> Fiancé
                    </h2>
                </div>
                <div class="card-body">
                    @if($coaching->fiancailles->fiance)
                        <!--<div class="text-center mb-3">
                            <img src="{{ $coaching->fiancailles->fiance->photo ? asset('storage/'.$coaching->fiancailles->fiance->photo) : asset('images/default-male.png') }}" 
                                 class="rounded-circle" width="80" height="80" style="object-fit: cover" alt="Photo fiancé">
                        </div>-->
                        <div class="text-center mb-3">
                            <img src="{{ asset('images/default-male.png') }}" 
                                 class="rounded-circle" width="80" height="80" style="object-fit: cover" alt="Photo fiancé">
                        </div>
                        
                        <div class="text-center mb-3">
                            <h3 class="h5">{{ $coaching->fiancailles->fiance->prenoms }} {{ $coaching->fiancailles->fiance->nom }}</h3>
                        </div>
                        
                        <div class="d-flex flex-column gap-2 small">
                            <div class="d-flex align-items-center gap-2">
                                <i class="bi bi-envelope text-muted"></i>
                                <span>{{ $coaching->fiancailles->fiance->email }}</span>
                            </div>
                            <div class="d-flex align-items-center gap-2">
                                <i class="bi bi-telephone text-muted"></i>
                                <a href="tel:{{ $coaching->fiancailles->fiance->contact }}" class="text-decoration-none">
                                    {{ $coaching->fiancailles->fiance->contact }}
                                </a>
                            </div>
                            <div class="d-flex align-items-center gap-2">
                                <i class="bi bi-briefcase text-muted"></i>
                                <span>{{ $coaching->fiancailles->fiance->profession }}</span>
                            </div>
                        </div>
                    @else
                        <div class="alert alert-warning mb-0">Aucun fiancé associé</div>
                    @endif
                </div>
            </div>
        </div>
        
        <!-- Fiancée -->
        <div class="col-12 col-md-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-danger text-white p-3">
                    <h2 class="h6 mb-0">
                        <i class="bi bi-gender-female"></i> Fiancée
                    </h2>
                </div>
                <div class="card-body">
                    @if($coaching->fiancailles->fiancee)
                         <!--<div class="text-center mb-3">
                            <img src="{{ $coaching->fiancailles->fiancee->photo ? asset('storage/'.$coaching->fiancailles->fiancee->photo) : asset('images/default-female.png') }}" 
                                 class="rounded-circle" width="80" height="80" style="object-fit: cover" alt="Photo fiancée">
                        </div>-->
                        <div class="text-center mb-3">
                            <img src="{{ asset('images/default-female.png') }}" 
                                 class="rounded-circle" width="80" height="80" style="object-fit: cover" alt="Photo fiancée">
                        </div>
                        
                        <div class="text-center mb-3">
                            <h3 class="h5">{{ $coaching->fiancailles->fiancee->prenoms }} {{ $coaching->fiancailles->fiancee->nom }}</h3>
                        </div>
                        
                        <div class="d-flex flex-column gap-2 small">
                            <div class="d-flex align-items-center gap-2">
                                <i class="bi bi-envelope text-muted"></i>
                                <span>{{ $coaching->fiancailles->fiancee->email }}</span>
                            </div>
                            <div class="d-flex align-items-center gap-2">
                                <i class="bi bi-telephone text-muted"></i>
                                <a href="tel:{{ $coaching->fiancailles->fiancee->contact }}" class="text-decoration-none">
                                    {{ $coaching->fiancailles->fiancee->contact }}
                                </a>
                            </div>
                            <div class="d-flex align-items-center gap-2">
                                <i class="bi bi-briefcase text-muted"></i>
                                <span>{{ $coaching->fiancailles->fiancee->profession }}</span>
                            </div>
                        </div>
                    @else
                        <div class="alert alert-warning mb-0">Aucune fiancée associée</div>
                    @endif
                </div>
            </div>
        </div>
    </div>

   <!-- Section Rapports -->
<div class="card border-0 shadow-sm">
        <div class="card-header bg-light p-3">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-2">
    <div class="d-flex align-items-center gap-2">
        <h2 class="h6 mb-0">
            <i class="bi bi-file-earmark-text"></i> Rapports mensuels
        </h2>
        <span class="badge bg-primary rounded-pill">{{ $coaching->rapports->count() }}</span>
    </div>
    
    <a href="{{ route('coach.rapports.create', ['coaching' => $coaching->id]) }}" class="btn btn-sm btn-outline-success">
        <i class="bi bi-plus-circle"></i> Nouveau rapport
    </a>
</div>
        </div>
        
        <div class="card-body p-0">
            @if($coaching->rapports->count() > 0)
                <div class="list-group list-group-flush">
                    @foreach($coaching->rapports as $rapport)
                    <div class="list-group-item p-3 border-bottom">
                        <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-3">
                            <div class="flex-grow-1">
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <h3 class="h6 mb-0">{{ $rapport->created_at->format('d/m/Y') }}</h3>
                                    <span class="badge bg-secondary">{{ $rapport->nombre_seances }} séance(s)</span>
                                </div>
                                
                                <div class="d-flex flex-wrap gap-1 mb-2">
                                    @foreach($rapport->types_seances as $type)
                                        <span class="badge bg-light text-dark border">{{ \App\Models\Rapport::TYPES_SEANCES[$type] }}</span>
                                    @endforeach
                                </div>
                                
                                <p class="small text-muted mb-0">
                                    {{ Str::limit($rapport->derniere_lecon, 70) }}
                                </p>
                            </div>
                            
                            <div class="flex-shrink-0">
                                <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" 
                                        data-bs-target="#rapportModal{{ $rapport->id }}">
                                    <i class="bi bi-eye"></i> <span class="d-none d-md-inline">Voir</span>
                                </button>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            @else
                <div class="alert alert-info m-3 mb-0">
                    <i class="bi bi-info-circle"></i> Aucun rapport disponible
                </div>
            @endif
        </div>
    </div>
</div>


<!-- Modals pour les rapports -->
@foreach($coaching->rapports as $rapport)
<div class="modal fade" id="rapportModal{{ $rapport->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">Rapport du {{ $rapport->created_at->format('d/m/Y') }}</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row g-3 mb-3">
                    <div class="col-12 col-md-6">
                        <div class="card bg-light h-100">
                            <div class="card-body">
                                <h6 class="fw-bold">Détails</h6>
                                <div class="small">
                                    <div class="mb-2">
                                        <span class="text-muted">Nombre de séances :</span>
                                        <div>{{ $rapport->nombre_seances }}</div>
                                    </div>
                                    <div>
                                        <span class="text-muted">Types :</span>
                                        <div class="d-flex flex-wrap gap-1">
                                            @foreach($rapport->types_seances as $type)
                                                <span class="badge bg-secondary">{{ \App\Models\Rapport::TYPES_SEANCES[$type] }}</span>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-12 col-md-6">
                        <div class="card bg-light h-100">
                            <div class="card-body">
                                <h6 class="fw-bold">Dernière leçon</h6>
                                <p class="small mb-0">{{ $rapport->derniere_lecon }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="card bg-light mb-3">
                    <div class="card-body">
                        <h6 class="fw-bold">Observations</h6>
                        <p class="small mb-0">{{ $rapport->observations ?: 'Aucune observation' }}</p>
                    </div>
                </div>
                
                <div class="card bg-light mb-3">
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
                
                <div class="card bg-light">
                    <div class="card-body">
                        <h6 class="fw-bold">Solutions proposées</h6>
                        <p class="small mb-0">{{ $rapport->solutions_coaches ?: 'Aucune solution proposée' }}</p>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>
@endforeach

@endsection

@section('styles')
<style>
    .bg-pink {
        background-color: #e83e8c;
    }
    .card {
        border-radius: 0.5rem;
    }
    .list-group-item {
        border-left: 0;
        border-right: 0;
    }
    @media (max-width: 767.98px) {
        .card-header {
            padding: 0.75rem;
        }
        .modal-dialog {
            margin: 0.5rem;
        }
    }
</style>
@endsection