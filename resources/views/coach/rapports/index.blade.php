@extends('layouts.coach')

@section('content')
<div class="container-fluid px-0">
    <div class="card border-0 shadow-sm">
        <!-- Header avec titre et boutons -->
        <div class="card-header bg-primary text-white p-3">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-3">
                <h1 class="h5 mb-0">
                    <i class="bi bi-file-earmark-text me-2"></i> Liste des Rapports
                </h1>
                
            </div>
        </div>

        <!-- Formulaire de recherche -->
        <div class="card-body border-bottom">
            <form method="GET" action="{{ route('coach.rapports.index') }}">
                <div class="row g-2">
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0">
                                <i class="bi bi-search text-muted"></i>
                            </span>
                            <input type="text" name="nom" class="form-control border-start-0" 
                                   placeholder="Rechercher par nom..." value="{{ request('nom') }}">
                        </div>
                    </div>
                    
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0">
                                <i class="bi bi-calendar text-muted"></i>
                            </span>
                            <select name="mois" class="form-select border-start-0 border-end-0">
                                <option value="">Tous les mois</option>
                                @php
                                    $mois_actuel = request('mois') ?: date('m');
                                    $mois_noms = [
                                        '01' => 'Janvier', '02' => 'Février', '03' => 'Mars', '04' => 'Avril',
                                        '05' => 'Mai', '06' => 'Juin', '07' => 'Juillet', '08' => 'Août',
                                        '09' => 'Septembre', '10' => 'Octobre', '11' => 'Novembre', '12' => 'Décembre'
                                    ];
                                @endphp
                                @foreach($mois_noms as $numero => $nom)
                                    <option value="{{ $numero }}" {{ request('mois') == $numero ? 'selected' : '' }}>
                                        {{ $nom }}
                                    </option>
                                @endforeach
                            </select>
                            <select name="annee" class="form-select border-start-0">
                                <option value="">Toutes les années</option>
                                @php
                                    $annee_actuelle = date('Y');
                                    $annee_debut = $annee_actuelle - 5; // 5 ans en arrière
                                    $annee_fin = $annee_actuelle + 1;   // 1 an en avant
                                @endphp
                                @for($annee = $annee_fin; $annee >= $annee_debut; $annee--)
                                    <option value="{{ $annee }}" {{ request('annee') == $annee ? 'selected' : '' }}>
                                        {{ $annee }}
                                    </option>
                                @endfor
                            </select>
                        </div>
                    </div>
                    
                    <div class="col-12 col-lg-4 d-flex gap-2">
                        <button type="submit" class="btn btn-primary flex-grow-1">
                            <i class="bi bi-funnel me-1"></i> Filtrer
                        </button>
                        <a href="{{ route('coach.rapports.index') }}" class="btn btn-outline-secondary">
                            <i class="bi bi-arrow-counterclockwise"></i>
                        </a>
                    </div>
                </div>
            </form>
        </div>

        <!-- Contenu principal -->
        <div class="card-body p-0">
            @if($rapports->isEmpty())
                <div class="alert alert-info m-3">
                    <i class="bi bi-info-circle me-2"></i> Aucun rapport trouvé
                </div>
            @else
                <!-- Version mobile -->
                <div class="d-md-none list-group list-group-flush">
                    @foreach($rapports as $rapport)
                    <div class="list-group-item p-3 border-bottom">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <div>
                                <h3 class="h6 mb-1">
                                    {{ $rapport->created_at->format('d/m/Y') }}
                                </h3>
                                <div class="small text-muted">
                                    {{ optional($rapport->coaching->fiancailles->fiance)->prenoms }} & 
                                    {{ optional($rapport->coaching->fiancailles->fiancee)->prenoms }}
                                </div>
                            </div>
                            <span class="badge bg-primary rounded-pill">
                                {{ $rapport->nombre_seances }} séance(s)
                            </span>
                        </div>
                        
                        <p class="small mb-2 text-truncate">
                            {{ $rapport->derniere_lecon ?? 'Aucune leçon mentionnée' }}
                        </p>
                        
                        <div class="d-flex gap-2">
                            <a href="{{ route('coach.rapports.show', $rapport->id) }}" 
                               class="btn btn-sm btn-outline-primary flex-grow-1">
                                <i class="bi bi-eye"></i> Voir
                            </a>
                            <a href="{{ route('coach.rapports.edit', $rapport->id) }}" 
                               class="btn btn-sm btn-outline-warning">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form action="{{ route('coach.rapports.destroy', $rapport->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger" 
                                        onclick="return confirm('Supprimer ce rapport ?')">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                    @endforeach
                </div>

                <!-- Version desktop -->
                <div class="d-none d-md-block table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th width="120">Date</th>
                                <th>Couple</th>
                                <th width="120" class="text-center">Séances</th>
                                <th>Dernière leçon</th>
                                <th width="200" class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($rapports as $rapport)
                            <tr>
                                <td>
                                    {{ $rapport->created_at->format('d/m/Y') }}
                                </td>
                                <td>
                                    <div class="d-flex flex-column">
                                        <span class="fw-medium">{{ optional($rapport->coaching->fiancailles->fiance)->prenoms }} {{ optional($rapport->coaching->fiancailles->fiance)->nom }}</span>
                                        <span class="fw-medium">{{ optional($rapport->coaching->fiancailles->fiancee)->prenoms }} {{ optional($rapport->coaching->fiancailles->fiancee)->nom }}</span>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <span class="badge bg-primary rounded-pill">
                                        {{ $rapport->nombre_seances }}
                                    </span>
                                </td>
                                <td class="text-truncate" style="max-width: 250px;">
                                    {{ $rapport->derniere_lecon ?? '—' }}
                                </td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center gap-2">
                                        <a href="{{ route('coach.rapports.show', $rapport->id) }}" 
                                           class="btn btn-sm btn-outline-primary px-3">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                        <a href="{{ route('coach.rapports.edit', $rapport->id) }}" 
                                           class="btn btn-sm btn-outline-warning">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <form action="{{ route('coach.rapports.destroy', $rapport->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger" 
                                                    onclick="return confirm('Supprimer ce rapport ?')">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>

        <!-- Pagination -->
        @if($rapports->hasPages())
        <div class="card-footer bg-light px-3 py-2">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-center">
                <div class="small text-muted mb-2 mb-md-0">
                    Affichage de {{ $rapports->firstItem() }} à {{ $rapports->lastItem() }} sur {{ $rapports->total() }} rapports
                </div>
                {{ $rapports->withQueryString()->onEachSide(1)->links('pagination::bootstrap-4') }}
            </div>
        </div>
        @endif
    </div>
</div>
@endsection

@section('styles')
<style>
    .table th {
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    .list-group-item {
        border-left: 0;
        border-right: 0;
    }
    @media (max-width: 767.98px) {
        .card-header {
            padding: 0.75rem;
        }
        .list-group-item {
            padding: 0.75rem;
        }
    }
    .input-group-text {
        transition: all 0.2s;
    }
    .input-group:focus-within .input-group-text {
        color: #0d6efd;
    }
    
    /* Styles pour les sélecteurs mois/année */
    .input-group select.form-select {
        transition: all 0.2s ease;
    }
    
    .input-group select.form-select:focus {
        border-color: #86b7fe;
        box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
    }
    
    .input-group select.form-select:first-of-type {
        border-top-right-radius: 0;
        border-bottom-right-radius: 0;
    }
    
    .input-group select.form-select:last-of-type {
        border-top-left-radius: 0;
        border-bottom-left-radius: 0;
    }
</style>
@endsection