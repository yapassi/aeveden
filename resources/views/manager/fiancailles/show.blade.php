@extends('layouts.manager')

@section('content')
<div class="container-fluid">
    <!-- Bouton de retour -->
    <div class="row mb-4">
        <div class="col-12">
            <a href="{{ route('manager.fiancailles.index') }}" class="btn btn-outline-primary">
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
                <div class="col-md-6">
                    <h6>Dates importantes :</h6>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between">
                            <span>Début des fiançailles :</span>
                            <span>{{ $fiancailles->date_debut->format('d/m/Y') }}</span>
                        </li>
                        @if($fiancailles->date_dot)
                        <li class="list-group-item d-flex justify-content-between">
                            <span>Dot traditionnelle :</span>
                            <span>{{ $fiancailles->date_dot->format('d/m/Y') }}</span>
                        </li>
                        @endif
                        @if($fiancailles->date_mariage)
                        <li class="list-group-item d-flex justify-content-between">
                            <span>Mariage civil :</span>
                            <span>{{ $fiancailles->date_mariage->format('d/m/Y') }}</span>
                        </li>
                        @endif
                    </ul>
                </div>
                <div class="col-md-6">
                    <h6>État actuel :</h6>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between">
                            <span>Étape :</span>
                            <span>{{ $etapeOptions[$fiancailles->etape] ?? $fiancailles->etape }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <span>Vie ensemble :</span>
                            <span>{{ $vieEnsembleOptions[$fiancailles->vie_ensemble] ?? $fiancailles->vie_ensemble }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <span>Note :</span>
                            <span>
                                @for($i = 1; $i <= 5; $i++)
                                    <i class="bi bi-star{{ $i <= $fiancailles->note ? '-fill text-warning' : '' }}"></i>
                                @endfor
                            </span>
                        </li>
                    </ul>
                </div>
            </div>

            @if($fiancailles->avis)
            <div class="mb-3">
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

    <!-- Section Fiancé -->
    <div class="row mb-4">
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

        <!-- Section Fiancée -->
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

    <!-- Section Coaching associé -->
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
                    <span class="badge bg-{{ $fiancailles->coaching->statut === 'actif' ? 'success' : 'warning' }}">
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
    .bg-pink {
        background: #e83e8c;
    }
    .card {
        border-radius: 10px;
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