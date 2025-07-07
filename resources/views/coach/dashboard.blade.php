@extends('layouts.coach')

@section('title', 'Tableau de bord')

@section('content')
<div class="container-fluid px-3 px-md-4 py-4">
    <!-- En-tête -->
    <div class="mb-4">
        <h1 class="fw-bold h3">Bienvenue {{ Auth::user()->prenoms }} {{ Auth::user()->nom }}</h1>
        <p class="text-muted mb-0">Aperçu de votre activité de coaching</p>
    </div>

    <!-- Cartes de statistiques -->
    <div class="row g-3 mb-4">
        <div class="col-6 col-md-3">
            <div class="card shadow-sm h-100 border-0 rounded-3">
                <div class="card-body p-3 text-center">
                    <i class="bi bi-people-fill fs-3 text-primary mb-2"></i>
                    <h6 class="card-title fw-semibold mb-1">Actifs</h6>
                    <p class="fs-5 fw-bold mb-0">{{ $coachingsActifs ?? 0 }}</p>
                </div>
            </div>
        </div>
        
        <div class="col-6 col-md-3">
            <div class="card shadow-sm h-100 border-0 rounded-3">
                <div class="card-body p-3 text-center">
                    <i class="bi bi-pause-circle fs-3 text-success mb-2"></i>
                    <h6 class="card-title fw-semibold mb-1">En pause</h6>
                    <p class="fs-5 fw-bold mb-0">{{ $coachingsEnPause ?? 0 }}</p>
                </div>
            </div>
        </div>
        
        <div class="col-6 col-md-3">
            <div class="card shadow-sm h-100 border-0 rounded-3">
                <div class="card-body p-3 text-center">
                    <i class="bi bi-check-circle fs-3 text-warning mb-2"></i>
                    <h6 class="card-title fw-semibold mb-1">Achevés</h6>
                    <p class="fs-5 fw-bold mb-0">{{ $coachingsAcheves ?? 0 }}</p>
                </div>
            </div>
        </div>
        
        <div class="col-6 col-md-3">
            <div class="card shadow-sm h-100 border-0 rounded-3">
                <div class="card-body p-3 text-center">
                    <i class="bi bi-slash-circle fs-3 text-danger mb-2"></i>
                    <h6 class="card-title fw-semibold mb-1">Arrêtés</h6>
                    <p class="fs-5 fw-bold mb-0">{{ $coachingsArretes ?? 0 }}</p>
                </div>
            </div>
        </div>
    </div>

@endsection