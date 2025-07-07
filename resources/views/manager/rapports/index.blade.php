@extends('layouts.manager')

@section('content')
<div class="container-fluid px-3 py-4">
    <!-- En-tête -->
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-4 gap-3">
        <div>
            <h1 class="h4 mb-2">
                <i class="bi bi-file-earmark-text text-primary me-2"></i>Rapports de Coaching
            </h1>
            <p class="text-muted mb-0">Gestion des rapports mensuels de suivi</p>
        </div>
    </div>

    <!-- Formulaire de recherche -->
    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <form method="GET" action="{{ route('manager.rapports.index') }}">
                <div class="row g-3">
                    <div class="col-12 col-md-4">
                        <label class="form-label">Coach</label>
                        <select name="coach_id" class="form-select">
                            <option value="">Tous les coachs</option>
                            @foreach ($coachs as $coach)
                                <option value="{{ $coach->id }}" {{ request('coach_id') == $coach->id ? 'selected' : '' }}>
                                    {{ $coach->prenoms }} {{ $coach->nom }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-12 col-md-4">
                        <label class="form-label">Fiancé(e)</label>
                        <input type="text" name="fiancaille" class="form-control" placeholder="Nom du fiancé ou fiancée" value="{{ request('fiancaille') }}">
                    </div>

                    <div class="col-12 col-md-4">
                        <label class="form-label">Date</label>
                        <input type="date" name="date" class="form-control" value="{{ request('date') }}">
                    </div>

                    <div class="col-12">
                        <div class="d-flex flex-column flex-md-row justify-content-end gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-search me-1"></i> Rechercher
                            </button>
                            <a href="{{ route('manager.rapports.index') }}" class="btn btn-outline-secondary">
                                <i class="bi bi-arrow-counterclockwise me-1"></i> Réinitialiser
                            </a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Tableau Desktop -->
    <div class="card shadow-sm d-none d-md-block">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Date</th>
                        <th>Fiancé(e)s</th>
                        <th>Coaches</th>
                        <th class="text-center">Séances</th>
                        <th>Type(s)</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($rapports as $rapport)
                    <tr>
                        <td>
                            <div class="fw-medium">{{ $rapport->created_at->format('d/m/Y') }}</div>
                            <div class="small text-muted">{{ $rapport->created_at->format('H:i') }}</div>
                        </td>
                        <td>
                            <div class="d-flex flex-column">
                                <span class="fw-medium">{{ $rapport->coaching->fiancailles->fiance->prenoms ?? '—' }} {{ $rapport->coaching->fiancailles->fiance->nom ?? '—' }}</span>
                                <span class="fw-medium">{{ $rapport->coaching->fiancailles->fiancee->prenoms ?? '—' }} {{ $rapport->coaching->fiancailles->fiancee->nom ?? '—' }}</span>
                            </div>
                        </td>
                        <td>
                            <div class="d-flex flex-column">
                                <span>{{ $rapport->coaching->coupleCoach->coachHomme->prenoms ?? '—' }} {{ $rapport->coaching->coupleCoach->coachHomme->nom ?? '—' }}</span>
                                <span>{{ $rapport->coaching->coupleCoach->coachFemme->prenoms ?? '—' }} {{ $rapport->coaching->coupleCoach->coachFemme->nom ?? '—' }}</span>
                            </div>
                        </td>
                        <td class="text-center">
                            <span class="badge bg-primary rounded-pill">{{ $rapport->nombre_seances }}</span>
                        </td>
                        <td>
                            <div class="d-flex flex-wrap gap-1">
                                @foreach ($rapport->types_seances as $type)
                                    <span class="badge bg-secondary bg-opacity-10 text-secondary border border-secondary border-opacity-25">
                                        {{ \App\Models\Rapport::TYPES_SEANCES[$type] ?? $type }}
                                    </span>
                                @endforeach
                            </div>
                        </td>
                        <td>
                            <div class="d-flex gap-2">
                                <a href="{{ route('manager.rapports.show', $rapport->id) }}" class="btn btn-sm btn-outline-primary" title="Voir">
                                    <i class="bi bi-eye"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-4">
                            <i class="bi bi-info-circle fs-4 text-muted"></i>
                            <p class="mt-2">Aucun rapport trouvé</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Liste Mobile -->
    <div class="d-block d-md-none">
        @forelse ($rapports as $rapport)
        <div class="card shadow-sm mb-3">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div>
                        <h3 class="h6 mb-1">{{ $rapport->created_at->format('d/m/Y H:i') }}</h3>
                        <div class="badge bg-primary rounded-pill">{{ $rapport->nombre_seances }} séance(s)</div>
                    </div>
                    <div class="dropdown">
                        <button class="btn btn-sm btn-outline-secondary rounded-circle" type="button" data-bs-toggle="dropdown">
                            <i class="bi bi-three-dots-vertical"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="{{ route('manager.rapports.show', $rapport->id) }}"><i class="bi bi-eye me-2"></i>Voir</a></li>
                        </ul>
                    </div>
                </div>

                <div class="mb-3">
                    <h4 class="small fw-bold text-muted mb-1">Fiancé(e)s</h4>
                    <div class="d-flex flex-column">
                        <span>{{ $rapport->coaching->fiancailles->fiance->prenoms ?? '—' }} {{ $rapport->coaching->fiancailles->fiance->nom ?? '—' }}</span>
                        <span>{{ $rapport->coaching->fiancailles->fiancee->prenoms ?? '—' }} {{ $rapport->coaching->fiancailles->fiancee->nom ?? '—' }}</span>
                    </div>
                </div>

                <div class="mb-3">
                    <h4 class="small fw-bold text-muted mb-1">Coaches</h4>
                    <div class="d-flex flex-column">
                        <span>{{ $rapport->coaching->coupleCoach->coachHomme->prenoms ?? '—' }} {{ $rapport->coaching->coupleCoach->coachHomme->nom ?? '—' }}</span>
                        <span>{{ $rapport->coaching->coupleCoach->coachFemme->prenoms ?? '—' }} {{ $rapport->coaching->coupleCoach->coachFemme->nom ?? '—' }}</span>
                    </div>
                </div>

                <div>
                    <h4 class="small fw-bold text-muted mb-1">Types de séances</h4>
                    <div class="d-flex flex-wrap gap-1">
                        @foreach ($rapport->types_seances as $type)
                            <span class="badge bg-secondary bg-opacity-10 text-secondary border border-secondary border-opacity-25">
                                {{ \App\Models\Rapport::TYPES_SEANCES[$type] ?? $type }}
                            </span>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="alert alert-info">
            <i class="bi bi-info-circle me-2"></i>Aucun rapport trouvé
        </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if($rapports->hasPages())
    <div class="d-flex justify-content-center mt-4">
        <nav aria-label="Page navigation">
            {{ $rapports->withQueryString()->links() }}
        </nav>
    </div>
    @endif
</div>
@endsection

@section('styles')
<style>
    .card {
        border-radius: 0.75rem;
        border: none;
    }
    
    .table th {
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.75rem;
        letter-spacing: 0.5px;
        color: #6c757d;
    }
    
    .badge {
        font-weight: 500;
        letter-spacing: 0.4px;
        padding: 0.35em 0.65em;
    }
    
    @media (max-width: 767.98px) {
        .dropdown-menu {
            font-size: 0.875rem;
        }
        
        .card-body {
            padding: 1.25rem;
        }
    }
</style>
@endsection