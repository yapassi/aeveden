@extends('layouts.manager')

@section('title', 'Couples Coaches')

@section('content')
<div class="container-fluid px-3 px-sm-4">
    <div class="row justify-content-center">
        <main class="col-12">
            <!-- Header Section -->
            <div class="d-flex flex-column flex-sm-row justify-content-between align-items-start align-items-sm-center mb-4 pt-3 pt-md-4">
                <div class="mb-2 mb-sm-0">
                    <h1 class="h3 h2-md mb-1">Couples Coaches</h1>
                    <p class="text-muted mb-0 small">
                        <i class="bi bi-people-fill me-1"></i>
                        {{ $couples->total() }} couple(s) enregistré(s)
                    </p>
                </div>
            </div>

            <!-- Search and Filters -->
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-body p-3">
                    <div class="row g-2 align-items-end">
                        <div class="col-12 col-sm-6 col-md-4">
                            <label class="form-label small fw-medium">Rechercher</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="bi bi-search text-muted"></i>
                                </span>
                                <input type="text" 
                                       class="form-control" 
                                       placeholder="Nom, prénom, domicile..."
                                       id="searchInput">
                            </div>
                        </div>
                        <div class="col-6 col-sm-3 col-md-2">
                            <button class="btn btn-outline-secondary w-100" onclick="resetFilters()">
                                <i class="bi bi-arrow-clockwise"></i>
                                <span class="d-none d-sm-inline ms-1">Reset</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Desktop Table View -->
            <div class="card shadow-sm border-0 d-none d-lg-block">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th class="px-4 py-3 border-0">#</th>
                                    <th class="px-4 py-3 border-0">Couple</th>
                                    <th class="px-4 py-3 border-0">Domicile</th>
                                    <th class="px-4 py-3 border-0">Mariage</th>
                                    <th class="px-4 py-3 border-0">Coaches depuis</th>
                                    <th class="px-4 py-3 border-0 text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($couples as $couple)
                                <tr class="couple-row">
                                    <td class="px-4 py-3">
                                        <span class="badge bg-light text-dark">{{ $couple->id }}</span>
                                    </td>
                                    <td class="px-4 py-3">
                                        <div class="d-flex align-items-center">
                                            <!-- Homme -->
                                            <div class="me-3">
                                               <!-- <img src="{{ asset('images/default-male.png'.$couple->coachHomme->photo) }}" 
                                                     class="rounded-circle border border-2 border-primary" 
                                                     width="48" height="48" 
                                                     style="object-fit: cover;"
                                                     alt="Photo {{ $couple->coachHomme->prenoms }}"> -->
                                                <img src="{{ asset('images/default-male.png') }}" 
                                                     class="rounded-circle border border-2 border-primary" 
                                                     width="48" height="48" 
                                                     style="object-fit: cover;"
                                                     alt="Photo {{ $couple->coachHomme->prenoms }}">
                                                <div class="mt-1">
                                                    <div class="fw-medium text-primary">{{ $couple->coachHomme->prenoms }}</div>
                                                    <div class="text-muted small" style="font-size: 0.75rem;">{{ $couple->coachHomme->nom }}</div>
                                                </div>
                                            </div>
                                            
                                            <!-- Femme -->
                                            <div class="ms-3">
                                                 <!--<img src="{{ asset('storage/'.$couple->coachFemme->photo) }}" 
                                                     class="rounded-circle border border-2 border-pink" 
                                                     width="48" height="48" 
                                                     style="object-fit: cover;"
                                                     alt="Photo {{ $couple->coachFemme->prenoms }}">-->
                                                <img src="{{ asset('images/default-female.png') }}" 
                                                     class="rounded-circle border border-2 border-pink" 
                                                     width="48" height="48" 
                                                     style="object-fit: cover;"
                                                     alt="Photo {{ $couple->coachFemme->prenoms }}">
                                                <div class="mt-1">
                                                    <div class="fw-medium text-pink">{{ $couple->coachFemme->prenoms }}</div>
                                                    <div class="text-muted small" style="font-size: 0.75rem;">{{ $couple->coachFemme->nom }}</div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-4 py-3">
                                        <i class="bi bi-geo-alt text-muted me-1"></i>
                                        {{ $couple->domicile ?? 'Non spécifié' }}
                                    </td>
                                    <td class="px-4 py-3">
                                        @if($couple->date_mariage)
                                            <div class="d-flex align-items-center">
                                                <i class="bi bi-calendar-heart text-muted me-1"></i>
                                                {{ $couple->date_mariage->format('d/m/Y') }}
                                            </div>
                                        @else
                                            <span class="text-muted">Non spécifié</span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-3">
                                        @if($couple->date_debut_coaching)
                                            <div class="d-flex align-items-center">
                                                <i class="bi bi-clock text-muted me-1"></i>
                                                {{ $couple->date_debut_coaching->format('d/m/Y') }}
                                            </div>
                                        @else
                                            <span class="text-muted">Non spécifié</span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-3 text-center">
                                        <div class="btn-group">
                                            <a href="{{ route('manager.couple-coaches.show', $couple->id) }}" 
                                               class="btn btn-sm btn-outline-info" 
                                               title="Voir">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Mobile/Tablet Card View -->
            <div class="d-lg-none">
                @foreach($couples as $couple)
                <div class="card shadow-sm border-0 mb-3 couple-card">
                    <div class="card-body p-3">
                        <!-- Header with ID and Actions -->
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <span class="badge bg-primary">ID: {{ $couple->id }}</span>
                            <div class="btn-group">
                                <a href="{{ route('manager.couple-coaches.show', $couple->id) }}" 
                                   class="btn btn-sm btn-outline-info">
                                    <i class="bi bi-eye"></i>
                                </a>
                            </div>
                        </div>

                        <!-- Couple Info -->
                        <div class="mb-3">
                            <div class="d-flex align-items-center justify-content-around">
                                <!-- Homme -->
                                <div class="text-center">
                                    <img src="{{ asset('storage/'.$couple->coachHomme->photo) }}" 
                                         class="rounded-circle border border-2 border-primary mb-2" 
                                         width="60" height="60" 
                                         style="object-fit: cover;"
                                         alt="Photo {{ $couple->coachHomme->prenoms }}">
                                    <div class="fw-medium text-primary">{{ $couple->coachHomme->prenoms }}</div>
                                    <div class="text-muted small">{{ $couple->coachHomme->nom }}</div>
                                </div>

                                <!-- Femme -->
                                <div class="text-center">
                                    <img src="{{ asset('storage/'.$couple->coachFemme->photo) }}" 
                                         class="rounded-circle border border-2 border-pink mb-2" 
                                         width="60" height="60" 
                                         style="object-fit: cover;"
                                         alt="Photo {{ $couple->coachFemme->prenoms }}">
                                    <div class="fw-medium text-pink">{{ $couple->coachFemme->prenoms }}</div>
                                    <div class="text-muted small">{{ $couple->coachFemme->nom }}</div>
                                </div>
                            </div>
                        </div>

                        <!-- Details -->
                        <div class="row g-2 text-sm">
                            <div class="col-12 col-sm-6">
                                <div class="d-flex align-items-center mb-2">
                                    <i class="bi bi-geo-alt text-muted me-2"></i>
                                    <div>
                                        <div class="text-muted small">Domicile</div>
                                        <div class="fw-medium">{{ $couple->domicile ?? 'Non spécifié' }}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6">
                                <div class="d-flex align-items-center mb-2">
                                    <i class="bi bi-calendar-heart text-muted me-2"></i>
                                    <div>
                                        <div class="text-muted small">Mariage</div>
                                        <div class="fw-medium">
                                            {{ $couple->date_mariage ? $couple->date_mariage->format('d/m/Y') : 'Non spécifié' }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="d-flex align-items-center">
                                    <i class="bi bi-clock text-muted me-2"></i>
                                    <div>
                                        <div class="text-muted small">Coaches depuis</div>
                                        <div class="fw-medium">{{ $couple->date_debut_coaching ?? 'Non spécifié' }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Empty State -->
            @if($couples->isEmpty())
            <div class="text-center py-5">
                <div class="mb-4">
                    <i class="bi bi-heart text-muted" style="font-size: 4rem;"></i>
                </div>
                <h3 class="text-muted mb-3">Aucun couple enregistré</h3>
                <p class="text-muted mb-4">Commencez par créer votre premier couple de coaches</p>
                <a href="{{ route('manager.couple-coaches.create') }}" class="btn btn-primary">
                    <i class="bi bi-plus-circle me-2"></i>Créer un couple
                </a>
            </div>
            @endif

            <!-- Pagination -->
            @if($couples->hasPages())
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-center">
                <div class="small text-muted mb-2 mb-md-0">
                            Affichage de {{ $couples->firstItem() }} à {{ $couples->lastItem() }} sur {{ $couples->total() }} couples
                </div>
                <nav aria-label="Navigation des pages">
                    {{ $couples->links('pagination::bootstrap-4') }}
                </nav>
            </div>
            @endif
        </main>
    </div>
</div>

<!-- Delete Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title" id="deleteModalLabel">
                    <i class="bi bi-exclamation-triangle text-warning me-2"></i>
                    Confirmation
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
            </div>
            <div class="modal-body">
                <p class="mb-0">Voulez-vous vraiment supprimer ce couple ?</p>
                <small class="text-muted">Cette action est irréversible.</small>
            </div>
            <div class="modal-footer border-0 pt-0">
                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Annuler</button>
                <form id="deleteForm" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">
                        <i class="bi bi-trash me-1"></i>Supprimer
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
// Search functionality
document.getElementById('searchInput').addEventListener('input', function() {
    const searchTerm = this.value.toLowerCase();
    const cards = document.querySelectorAll('.couple-card');
    const rows = document.querySelectorAll('.couple-row');
    
    // Filter cards (mobile/tablet)
    cards.forEach(card => {
        const text = card.textContent.toLowerCase();
        card.style.display = text.includes(searchTerm) ? 'block' : 'none';
    });
    
    // Filter rows (desktop)
    rows.forEach(row => {
        const text = row.textContent.toLowerCase();
        row.style.display = text.includes(searchTerm) ? 'table-row' : 'none';
    });
});

// Delete confirmation
function deleteCouple(coupleId) {
    const deleteForm = document.getElementById('deleteForm');
    deleteForm.action = `/manager/couple-coaches/${coupleId}`;
    
    const modal = new bootstrap.Modal(document.getElementById('deleteModal'));
    modal.show();
}

// Reset filters
function resetFilters() {
    document.getElementById('searchInput').value = '';
    document.getElementById('filterSelect').value = '';
    
    // Show all items
    document.querySelectorAll('.couple-card, .couple-row').forEach(item => {
        item.style.display = item.classList.contains('couple-card') ? 'block' : 'table-row';
    });
}
</script>

@section('styles')
<style>
    .border-pink {
        border-color: #ff69b4 !important;
    }
    .text-pink {
        color: #ff69b4 !important;
    }
    .bg-pink {
        background-color: #ff69b4 !important;
    }
    .couple-card {
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    .couple-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(0,0,0,0.1) !important;
    }
    .btn-group .btn {
        border-radius: 0.375rem !important;
        margin-left: 0.25rem;
    }
    .btn-group .btn:first-child {
        margin-left: 0;
    }
    @media (max-width: 576px) {
        .btn-group {
            display: flex;
            gap: 0.25rem;
        }
        .btn-group .btn {
            flex: 1;
            margin-left: 0;
        }
    }
    @media (max-width: 1199px) {
        .table td {
            padding: 0.5rem !important;
            font-size: 0.875rem;
        }
        .table th {
            padding: 0.75rem 0.5rem !important;
            font-size: 0.875rem;
        }
    }
    .coach-name {
        transition: all 0.2s ease;
    }
    .coach-name:hover {
        transform: translateY(-1px);
    }
    @media (max-width: 767.98px) {
        .coach-avatar {
            width: 60px !important;
            height: 60px !important;
        }
    }
</style>
@endsection
@endsection