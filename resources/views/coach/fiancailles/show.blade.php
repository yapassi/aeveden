{{-- resources/views/coach/fiancailles/show.blade.php --}}
@extends('layouts.coach')

@section('content')
<div class="container-fluid">
    <!-- Bouton de retour -->
    <div class="row mb-4">
        <div class="col-12">
            <a href="{{ route('coach.fiancailles.index') }}" class="btn btn-outline-primary">
                <i class="bi bi-arrow-left"></i> Retour
            </a>
        </div>
    </div>

    <div class="card shadow-sm mb-4">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">
                <i class="bi bi-heart-fill"></i> Détails des fiançailles
            </h5>
        </div>
        <div class="card-body">
            <div class="row mb-4">
                <!-- Section Dates -->
                <div class="col-md-6">
                    <h6>Dates et lieux importants :</h6>
                    <div class="timeline">
                        <!-- Date début -->
                        <div class="timeline-item">
                            <div class="timeline-date">{{ $fiancailles->date_debut->format('d/m/Y') }}</div>
                            <div class="timeline-content">
                                <strong>Début des fiançailles</strong>
                            </div>
                        </div>

                        <!-- Date dot -->
                        @if($fiancailles->date_dot)
                        <div class="timeline-item">
                            <div class="timeline-date">{{ $fiancailles->date_dot->format('d/m/Y') }}</div>
                            <div class="timeline-content">
                                <strong>Dot traditionnelle</strong>
                                @if($fiancailles->lieu_dot)
                                <div class="text-muted small">
                                    <i class="bi bi-geo-alt"></i> {{ $fiancailles->lieu_dot }}
                                </div>
                                @endif
                            </div>
                        </div>
                        @endif

                        <!-- Date mariage -->
                        @if($fiancailles->date_mariage)
                        <div class="timeline-item">
                            <div class="timeline-date">{{ $fiancailles->date_mariage->format('d/m/Y') }}</div>
                            <div class="timeline-content">
                                <strong>Mariage civil</strong>
                                @if($fiancailles->lieu_mariage)
                                <div class="text-muted small">
                                    <i class="bi bi-geo-alt"></i> {{ $fiancailles->lieu_mariage }}
                                </div>
                                @endif
                            </div>
                        </div>
                        @endif

                        <!-- Date bénédiction -->
                        @if($fiancailles->date_benediction)
                        <div class="timeline-item">
                            <div class="timeline-date">{{ $fiancailles->date_benediction->format('d/m/Y') }}</div>
                            <div class="timeline-content">
                                <strong>Bénédiction nuptiale</strong>
                                @if($fiancailles->lieu_benediction)
                                <div class="text-muted small">
                                    <i class="bi bi-geo-alt"></i> {{ $fiancailles->lieu_benediction }}
                                </div>
                                @endif
                            </div>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Section Statut -->
                <div class="col-md-6">
                    <h6>État actuel :</h6>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span>Étape :</span>
                            <span class="badge bg-info">{{ $etapeOptions[$fiancailles->etape] ?? $fiancailles->etape }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span>Vie ensemble :</span>
                            <span>{{ $vieEnsembleOptions[$fiancailles->vie_ensemble] ?? $fiancailles->vie_ensemble }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span>Note :</span>
                            <span>
                                @for($i = 1; $i <= 5; $i++)
                                    <i class="bi bi-star{{ $i <= $fiancailles->note ? '-fill text-warning' : '' }}"></i>
                                @endfor
                            </span>
                        </li>
                    </ul>

                    @if($fiancailles->avis)
                    <div class="mt-3">
                        <h6>Avis du coach :</h6>
                        <div class="card bg-light">
                            <div class="card-body">
                                {{ $fiancailles->avis }}
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Section Couple -->
    <div class="row mb-4">
        <!-- Fiancé -->
        <div class="col-md-6">
            <div class="card h-100 shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">
                        <i class="bi bi-gender-male"></i> Fiancé
                    </h5>
                </div>
                <div class="card-body">
                    @if($fiancailles->fiance)
                        <div class="text-center mb-3">
                            <img src="{{ $fiancailles->fiance->photo ? asset('storage/'.$fiancailles->fiance->photo) : asset('images/default-male.png') }}" 
                                 class="rounded-circle" width="120" height="120" style="object-fit: cover;"
                                 alt="Photo fiancé"
                                 onerror="this.onerror=null;this.src='{{ asset('images/default-male.png') }}'">
                        </div>
                        <h4>{{ $fiancailles->fiance->prenoms }} {{ $fiancailles->fiance->nom }}</h4>
                        
                        <div class="mt-3">
                            <p><i class="bi bi-envelope"></i> {{ $fiancailles->fiance->email }}</p>
                            <p><i class="bi bi-telephone"></i> {{ $fiancailles->fiance->contact }}</p>
                            <p><i class="bi bi-briefcase"></i> {{ $fiancailles->fiance->profession }}</p>
                        </div>
                    @else
                        <div class="alert alert-warning">Aucun fiancé associé</div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Fiancée -->
        <div class="col-md-6">
            <div class="card h-100 shadow-sm">
                <div class="card-header bg-danger text-white">
                    <h5 class="mb-0">
                        <i class="bi bi-gender-female"></i> Fiancée
                    </h5>
                </div>
                <div class="card-body">
                    @if($fiancailles->fiancee)
                        <div class="text-center mb-3">
                            <img src="{{ $fiancailles->fiancee->photo ? asset('storage/'.$fiancailles->fiancee->photo) : asset('images/default-female.png') }}" 
                                 class="rounded-circle" width="120" height="120" style="object-fit: cover;"
                                 alt="Photo fiancée"
                                 onerror="this.onerror=null;this.src='{{ asset('images/default-female.png') }}'">
                        </div>
                        <h4>{{ $fiancailles->fiancee->prenoms }} {{ $fiancailles->fiancee->nom }}</h4>
                        
                        <div class="mt-3">
                            <p><i class="bi bi-envelope"></i> {{ $fiancailles->fiancee->email }}</p>
                            <p><i class="bi bi-telephone"></i> {{ $fiancailles->fiancee->contact }}</p>
                            <p><i class="bi bi-briefcase"></i> {{ $fiancailles->fiancee->profession }}</p>
                        </div>
                    @else
                        <div class="alert alert-warning">Aucune fiancée associée</div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Section Coaching -->
    @if($fiancailles->coaching)
    <div class="card shadow-sm">
        <div class="card-header bg-light">
            <h5 class="mb-0">
                <i class="bi bi-people-fill"></i> Coaching associé
            </h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <h6>Statut :</h6>
                    <span class="badge bg-{{ $fiancailles->coaching->statut === 'actif' ? 'success' : ($fiancailles->coaching->statut === 'en_pause' ? 'warning' : 'secondary') }}">
                        {{ $fiancailles->coaching->statut }}
                    </span>
                </div>
                <div class="col-md-4">
                    <h6>Dates :</h6>
                    <p>
                        Début : {{ $fiancailles->coaching->date_debut->format('d/m/Y') }}<br>
                        @if($fiancailles->coaching->date_fin)
                        Fin : {{ $fiancailles->coaching->date_fin->format('d/m/Y') }}
                        @endif
                    </p>
                </div>
                <div class="col-md-4">
                    <h6>Coachs :</h6>
                    <p>
                        {{ $fiancailles->coaching->coupleCoach->coachHomme->prenoms ?? 'Inconnu' }} & 
                        {{ $fiancailles->coaching->coupleCoach->coachFemme->prenoms ?? 'Inconnue' }}
                    </p>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
@endsection

@section('styles')
<style>
    .card {
        border-radius: 10px;
    }
    
    .timeline {
        position: relative;
        padding-left: 30px;
    }
    
    .timeline-item {
        position: relative;
        padding-bottom: 20px;
    }
    
    .timeline-item:before {
        content: '';
        position: absolute;
        left: -20px;
        top: 0;
        width: 12px;
        height: 12px;
        border-radius: 50%;
        background: #0d6efd;
        border: 2px solid white;
    }
    
    .timeline-item:after {
        content: '';
        position: absolute;
        left: -15px;
        top: 12px;
        width: 2px;
        height: 100%;
        background: #dee2e6;
    }
    
    .timeline-item:last-child:after {
        display: none;
    }
    
    .timeline-date {
        font-weight: 500;
        color: #0d6efd;
        margin-bottom: 5px;
    }
    
    .timeline-content {
        background: #f8f9fa;
        padding: 10px 15px;
        border-radius: 6px;
    }
    
    .list-group-item {
        border-left: none;
        border-right: none;
    }
    
    img {
        object-fit: cover;
    }
</style>
@endsection