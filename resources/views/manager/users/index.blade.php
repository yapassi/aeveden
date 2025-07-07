
@extends('layouts.manager')

@section('title', 'Utilisateurs')

@section('content')
<div class="container-fluid px-0">
    <div class="row g-0">
        {{-- Main content --}}
        <main class="col-12">
            <div class="card border-0 shadow-sm">
                {{-- Card Header --}}
                <div class="card-header bg-primary text-white p-3">
                    <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-3">
                        <h1 class="h5 mb-0">
                            <i class="bi bi-people-fill me-2"></i> Liste des utilisateurs
                        </h1>
                    </div>
                </div>

                {{-- Alert --}}
                @if(session('success'))
                    <div class="alert alert-success m-3 mb-0">
                        <i class="bi bi-check-circle me-2"></i> {{ session('success') }}
                    </div>
                @endif

                {{-- Mobile View --}}
                <div class="d-md-none">
                    @forelse ($users as $user)
                        <div class="border-bottom p-3">
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <div>
                                    <h3 class="h6 mb-1">{{ $user->prenoms }} {{ $user->nom }}</h3>
                                    <div class="small text-muted">
                                        {{ $user->email }}
                                    </div>
                                </div>
                                <span class="badge bg-{{ $user->role === 'manager' ? 'danger' : 'primary' }}">
                                    {{ ucfirst($user->role) }}
                                </span>
                            </div>
                            
                            <div class="d-flex flex-wrap gap-1 mb-2">
                                <span class="badge bg-light text-dark border">
                                    <i class="bi bi-telephone me-1"></i> {{ $user->contact }}
                                </span>
                                <span class="badge bg-light text-dark border">
                                    <i class="bi bi-calendar me-1"></i> {{ $user->created_at->format('d/m/Y') }}
                                </span>
                            </div>
                        </div>
                    @empty
                        <div class="alert alert-info m-3">
                            <i class="bi bi-info-circle me-2"></i> Aucun utilisateur trouvé
                        </div>
                    @endforelse
                </div>

                {{-- Desktop View --}}
                <div class="d-none d-md-block">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th width="50">#</th>
                                    <th>Nom</th>
                                    <th>Prénoms</th>
                                    <th>Contact</th>
                                    <th>Email</th>
                                    <th width="100">Rôle</th>
                                    <th width="120">Créé le</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($users as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->nom }}</td>
                                    <td>{{ $user->prenoms }}</td>
                                    <td>{{ $user->contact }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        <span class="badge bg-{{ $user->role === 'manager' ? 'danger' : 'primary' }}">
                                            {{ ucfirst($user->role) }}
                                        </span>
                                    </td>
                                    <td>{{ $user->created_at->format('d/m/Y') }}</td>
                                    
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="8" class="text-center py-4 text-muted">
                                        <i class="bi bi-people me-2"></i> Aucun utilisateur enregistré
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                {{-- Pagination --}}
                @if($users->hasPages())
                <div class="card-footer bg-light px-3 py-2">
                    <div class="d-flex flex-column flex-md-row justify-content-between align-items-center">
                        <div class="small text-muted mb-2 mb-md-0">
                            Affichage de {{ $users->firstItem() }} à {{ $users->lastItem() }} sur {{ $users->total() }} utilisateurs
                        </div>
                        {{ $users->onEachSide(1)->links('pagination::bootstrap-4') }}
                    </div>
                </div>
                @endif
            </div>
        </main>
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
        .border-bottom {
            padding: 0.75rem;
        }
    }
    .badge.bg-light {
        color: #495057 !important;
    }
</style>
@endsection