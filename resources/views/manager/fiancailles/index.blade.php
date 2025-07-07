@extends('layouts.manager')

@section('content')
<div class="container-fluid px-0 px-md-3 py-3">
    <!-- Header -->
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-3 gap-2">
        <div>
            <h1 class="h4 mb-1">
                <i class="fas fa-heart text-primary me-2"></i>Liste des Fiançailles
            </h1>
            <p class="text-muted mb-0">Liste des couples de fiancés</p>
            <div>
        </div>
        </div>
    </div>

    <!-- Main Card -->
    <div class="card border-0 shadow-sm">
        @if($fiancailles->isEmpty())
            <div class="alert alert-info m-3">
                <i class="fas fa-info-circle me-2"></i> Aucun couple en coaching actuellement
            </div>
        @else
            <!-- Responsive Table -->
            <div class="table-responsive">
                <table class="table table-hover mb-0 d-none d-md-table">
                    <thead class="table-light">
                        <tr>
                            <th width="40">#</th>
                            <th>Couple</th>
                            <th>Dates</th>
                            <th>Statuts</th>
                            <th width="150">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($fiancailles as $index => $fiance)
                        <tr>
                            <td class="fw-bold">{{ $index + 1 }}</td>
                            <td>
                                <div class="d-flex align-items-center gap-3">
                                    <div class="d-flex flex-column">
                                        <div class="d-flex align-items-center mb-2">
                                            <!--<img src="{{ $fiance['fiance']->photo ?? asset('images/default-avatar.png') }}" 
                                                 class="rounded-circle me-2" width="32" height="32"> -->
                                            <img src="{{ (asset('images/default-male.png') )}}" 
                                         class="rounded-circle" width="40" height="40" style="object-fit: cover" alt="Photo de {{ $fiance['fiance']->prenoms }}">
                                            <div>
                                                <div class="fw-medium">{{ $fiance['fiance']->prenoms }} {{ $fiance['fiance']->nom }}</div>
                                                <small class="text-muted">Fiancé</small>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <!--<img src="{{ $fiance['fiancee']->photo ?? asset('images/default-avatar.png') }}" 
                                                 class="rounded-circle me-2" width="32" height="32"> -->
                                            <img src="{{ asset('images/default-female.png') }}" 
                                                 class="rounded-circle me-2" width="32" height="32">
                                            <div>
                                                <div class="fw-medium">{{ $fiance['fiancee']->prenoms }} {{ $fiance['fiancee']->nom }}</div>
                                                <small class="text-muted">Fiancée</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="small">
                                    <div class="mb-1">
                                        <span class="text-muted">Début :</span>
                                        <div>{{ $fiance['date_debut']->format('d/m/Y') }}</div>
                                    </div>
                                    <div>
                                        <span class="text-muted">Mariage :</span>
                                        <div>{{ $fiance['date_mariage'] ? $fiance['date_mariage']->format('d/m/Y') : '-' }}</div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex flex-column gap-1">
                                    <span class="badge bg-info text-white">
                                        {{ $etapeOptions[$fiance['etape']] ?? $fiance['etape'] }}
                                    </span>
                                    <span class="badge 
                                        {{ $fiance['statut_coaching'] === 'actif' ? 'bg-success' : '' }}
                                        {{ $fiance['statut_coaching'] === 'en_pause' ? 'bg-warning' : '' }}
                                        {{ $fiance['statut_coaching'] === 'arrete' ? 'bg-danger' : '' }}
                                        {{ $fiance['statut_coaching'] === 'acheve' ? 'bg-secondary' : '' }}">
                                        {{ $coachingStatuts[$fiance['statut_coaching']] ?? $fiance['statut_coaching'] }}
                                    </span>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex gap-1">
                                    <a href="{{ route('manager.fiancailles.show', $fiance['id']) }}" 
                                       class="btn btn-sm btn-outline-primary px-2"
                                       title="Voir">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <!-- Mobile Version -->
                <div class="list-group list-group-flush d-md-none">
                    @foreach($fiancailles as $fiance)
                    <div class="list-group-item p-3">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <div>
                                <h6 class="mb-1 fw-bold">Couple #{{ $loop->iteration }}</h6>
                                <div class="d-flex align-items-center mb-2">
                                    <img src="{{ asset('images/default-male.png') }}" 
                                         class="rounded-circle me-2" width="36" height="36">
                                    <div>
                                        <div class="fw-medium">{{ $fiance['fiance']->prenoms }}</div>
                                        <small class="text-muted">Fiancé</small>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center">
                                    <img src="{{ asset('images/default-female.png') }}" 
                                         class="rounded-circle me-2" width="36" height="36">
                                    <div>
                                        <div class="fw-medium">{{ $fiance['fiancee']->prenoms }}</div>
                                        <small class="text-muted">Fiancée</small>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex flex-column gap-1">
                                <span class="badge bg-info text-white">
                                    {{ $etapeOptions[$fiance['etape']] ?? $fiance['etape'] }}
                                </span>
                                <span class="badge 
                                    {{ $fiance['statut_coaching'] === 'actif' ? 'bg-success' : '' }}
                                    {{ $fiance['statut_coaching'] === 'en_pause' ? 'bg-warning' : '' }}
                                    {{ $fiance['statut_coaching'] === 'arrete' ? 'bg-danger' : '' }}
                                    {{ $fiance['statut_coaching'] === 'acheve' ? 'bg-secondary' : '' }}">
                                    {{ $coachingStatuts[$fiance['statut_coaching']] ?? $fiance['statut_coaching'] }}
                                </span>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between align-items-center mt-2">
                            <div class="small">
                                <div class="text-muted">Début: {{ $fiance['date_debut']->format('d/m/Y') }}</div>
                                <div class="text-muted">Mariage: {{ $fiance['date_mariage'] ? $fiance['date_mariage']->format('d/m/Y') : '-' }}</div>
                            </div>
                            <div class="d-flex gap-1">
                                <a href="{{ route('coach.fiancailles.show', $fiance['id']) }}" 
                                   class="btn btn-sm btn-outline-primary px-2"
                                   title="Voir">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            {{-- Pagination --}}
            @if($fiancailles->hasPages())
                <div class="card-footer bg-light px-3 py-2">
                    <div class="d-flex flex-column flex-md-row justify-content-between align-items-center">
                        <div class="small text-muted mb-2 mb-md-0">
                            Affichage de {{ $fiancailles->firstItem() }} à {{ $fiancailles->lastItem() }} sur {{ $fiancailles->total() }} fiançailles
                        </div>
                        {{ $fiancailles->onEachSide(1)->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            @endif
        @endif
    </div>
</div>
@endsection

@section('styles')
<style>
    .avatar img {
        object-fit: cover;
    }
    .table th {
        font-size: 0.75rem;
        letter-spacing: 0.5px;
    }
    .list-group-item {
        border-left: 0;
        border-right: 0;
    }
    @media (max-width: 767.98px) {
        .card-header {
            padding: 0.75rem 1rem;
        }
    }
</style>
@endsection