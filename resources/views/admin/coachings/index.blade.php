@extends('layouts.admin')

@section('title', 'Gestion des coachings')

@section('content')
<div class="container-fluid px-0">
    <div class="row g-3">
        <main class="col-12">
            <div class="card shadow border-0">
                <div class="card-header bg-white py-3">
                    <div class="d-flex flex-column flex-md-row justify-content-between align-items-center">
                        <h1 class="h4 mb-3 mb-md-0">
                            <i class="bi bi-people-fill"></i> Gestion des coachings
                        </h1>
                        <a href="{{ route('admin.coachings.create') }}" class="btn btn-primary">
                            <i class="bi bi-plus-lg"></i> Nouveau coaching
                        </a>
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
                                                <a href="{{ route('admin.coachings.show', $coaching) }}" class="btn btn-sm btn-outline-primary" title="Voir">
                                                    <i class="bi bi-eye"></i>
                                                </a>
                                                <a href="{{ route('admin.coachings.edit', $coaching) }}" class="btn btn-sm btn-outline-secondary" title="Modifier">
                                                    <i class="bi bi-pencil"></i>
                                                </a>
                                                <form action="{{ route('admin.coachings.destroy', $coaching) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-outline-danger" title="Supprimer" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce coaching ?')">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </form>
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
                                            <a href="{{ route('admin.coachings.show', $coaching) }}" class="btn btn-sm btn-outline-primary" title="Voir">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                            <a href="{{ route('admin.coachings.edit', $coaching) }}" class="btn btn-sm btn-outline-secondary" title="Modifier">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <form action="{{ route('admin.coachings.destroy', $coaching) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger" title="Supprimer" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce coaching ?')">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
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
:root {
  --primary: #2C3E50;
  --secondary: #e83e8c;
  --success: #198754;
  --light: #f8f9fa;
  --card-bg: #fff;
  --text-main: #222;
  --text-secondary: #6c757d;
  --border-radius: 0.75rem;
  --shadow: 0 2px 12px rgba(44,62,80,0.07);
}
body {
  background: var(--light);
  color: var(--text-main);
  font-family: 'Segoe UI', 'Roboto', Arial, sans-serif;
}
.card, .modal-content {
  border-radius: var(--border-radius);
  box-shadow: var(--shadow);
  background: var(--card-bg);
  border: none;
}
.card-header, .modal-header {
  background: var(--light);
  color: var(--primary);
  font-weight: 600;
  border-bottom: 1px solid #e5e5e5;
}
.btn-primary {
  background: var(--primary);
  border: none;
}
.btn-primary:hover, .btn-primary:focus {
  background: #1a2533;
}
.btn-secondary, .bg-secondary {
  background: var(--secondary) !important;
  color: #fff !important;
  border: none;
}
.btn-secondary:hover, .btn-secondary:focus {
  background: #c2185b !important;
}
.badge-pink {
  background: var(--secondary);
  color: #fff;
}
.badge-blue {
  background: var(--primary);
  color: #fff;
}
.badge-success {
  background: var(--success);
  color: #fff;
}
.table thead {
  background: var(--primary);
  color: #fff;
}
.table-hover tbody tr:hover {
  background: #f1f3f7;
}
input:focus, select:focus, textarea:focus {
  border-color: var(--secondary);
  box-shadow: 0 0 0 0.2rem rgba(232,62,140,.15);
}
a {
  color: var(--primary);
}
a:hover {
  color: var(--secondary);
  text-decoration: underline;
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