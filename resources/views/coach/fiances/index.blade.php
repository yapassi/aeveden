@extends('layouts.coach')

@section('title', 'Mes fiancés coachés')

@section('content')
<div class="container-fluid px-0">
    <!-- Header -->
    <div class="card border-0 shadow-sm mb-3">
        <div class="card-header bg-primary text-white p-3">
            <h1 class="h5 mb-0">
                <i class="bi bi-people-fill me-2"></i> Mes fiancés coachés
            </h1>
        </div>

        <!-- Contenu principal -->
        <div class="card-body p-0">
            @if($fiances->isEmpty())
                <div class="alert alert-info m-3">
                    <i class="bi bi-info-circle me-2"></i> Aucun fiancé trouvé
                </div>
            @else
                <!-- Version mobile -->
                <div class="d-md-none list-group list-group-flush">
                    @foreach($fiances as $fiance)
                    <div class="list-group-item p-3 border-bottom">
                        <div class="d-flex align-items-start gap-3">
                            <!-- Photo -->
                             <div class="flex-shrink-0">
                                <img src="{{ $fiance->photo ? asset('storage/' . $fiance->photo) : ($fiance->sexe === 'M' ? asset('images/default-male.png') : asset('images/default-female.png')) }}" 
                                     class="rounded-circle" width="50" height="50" style="object-fit: cover" alt="Photo de {{ $fiance->prenoms }}">
                            </div>
                            
                            <!-- Détails -->
                            <div class="flex-grow-1">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div>
                                        <h3 class="h6 mb-0">{{ $fiance->prenoms }} <strong>{{ $fiance->nom }}</strong></h3>
                                        <span class="badge {{ $fiance->sexe === 'F' ? 'bg-danger' : 'bg-primary' }} rounded-pill mt-1">
                                            {{ $fiance->sexe === 'M' ? 'Homme' : 'Femme' }}
                                        </span>
                                    </div>
                                    <a href="{{ route('coach.fiances.show', $fiance->id) }}" 
                                       class="btn btn-sm btn-outline-primary">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                </div>
                                
                                <div class="mt-2 small">
                                    <div class="d-flex align-items-center text-muted mb-1">
                                        <i class="bi bi-telephone me-2"></i>
                                        <a href="tel:{{ $fiance->contact }}" class="text-decoration-none">{{ $fiance->contact }}</a>
                                    </div>
                                    <div class="d-flex align-items-center text-muted">
                                        <i class="bi bi-briefcase me-2"></i>
                                        <span>{{ $fiance->profession }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <!-- Version desktop -->
                <div class="d-none d-md-block table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th width="60">Photo</th>
                                <th>Nom & Prénoms</th>
                                <th width="120">Genre</th>
                                <th>Contact</th>
                                <th width="120">Profession</th>
                                <th width="100">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($fiances as $fiance)
                            <tr>
                                <!-- Photo -->
                                 <td>
                                    <img src="{{ $fiance->photo ? asset('storage/' . $fiance->photo) : ($fiance->sexe === 'M' ? asset('images/default-male.png') : asset('images/default-female.png')) }}" 
                                         class="rounded-circle" width="40" height="40" style="object-fit: cover" alt="Photo de {{ $fiance->prenoms }}">
                                </td>
                                
                                
                                <!-- Nom + Prénoms -->
                                <td>
                                    <strong>{{ $fiance->nom }}</strong> {{ $fiance->prenoms }}
                                </td>
                                
                                <!-- Genre -->
                                <td>
                                    <span class="badge {{ $fiance->sexe === 'F' ? 'bg-danger' : 'bg-primary' }} rounded-pill">
                                        {{ $fiance->sexe === 'M' ? 'Homme' : 'Femme' }}
                                    </span>
                                </td>
                                
                                <!-- Contact -->
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        <i class="bi bi-telephone text-muted"></i>
                                        <a href="tel:{{ $fiance->contact }}" class="text-decoration-none">{{ $fiance->contact }}</a>
                                    </div>
                                    <div class="small text-muted">{{ $fiance->email }}</div>
                                </td>
                                
                                <!-- Profession -->
                                <td>
                                    {{ $fiance->profession }}
                                </td>
                                
                                <!-- Actions -->
                                <td>
                                    <div class="d-flex gap-2">
                                        <a href="{{ route('coach.fiances.show', $fiance->id) }}" 
                                           class="btn btn-sm btn-outline-primary"
                                           title="Voir profil">
                                            <i class="bi bi-eye"></i>
                                        </a>
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
        @if($fiances->hasPages())
        <div class="card-footer bg-light px-3 py-2">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-center">
                <div class="small text-muted mb-2 mb-md-0">
                    Affichage de {{ $fiances->firstItem() }} à {{ $fiances->lastItem() }} sur {{ $fiances->total() }} fiancés
                </div>
                {{ $fiances->onEachSide(1)->links('pagination::bootstrap-4') }}
            </div>
        </div>
        @endif
    </div>
</div>
@endsection

@section('styles')
<style>
    .list-group-item {
        border-left: 0;
        border-right: 0;
    }
    .table th {
        white-space: nowrap;
        font-size: 0.85rem;
    }
    @media (max-width: 767.98px) {
        .card-header {
            padding: 0.75rem;
        }
        .list-group-item {
            padding: 0.75rem;
        }
        .list-group-item img {
            width: 50px !important;
            height: 50px !important;
        }
    }
    .badge {
        min-width: 70px;
    }
    .table-responsive {
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
    }
</style>
@endsection