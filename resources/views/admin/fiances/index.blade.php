@extends('layouts.admin')

@section('content')
<div class="container-fluid p-0">
    <div class="row g-0">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-primary text-white p-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <h1 class="h5 mb-0">
                            <i class="bi bi-people-fill me-2"></i>Liste des fiancés
                        </h1>
                        <a href="{{ route('admin.fiances.create') }}" class="btn btn-light btn-sm">
                            <i class="bi bi-plus-circle me-1"></i> Ajouter
                        </a>
                    </div>
                </div>

                <div class="card-body p-0">
                    @if($fiances->isEmpty())
                        <div class="alert alert-info m-3">
                            <i class="bi bi-info-circle me-2"></i> Aucun fiancé enregistré
                        </div>
                    @else
                        <!-- Mobile View -->
                        <div class="d-md-none list-group list-group-flush">
                            @foreach($fiances as $fiance)
                            <div class="list-group-item p-3 border-bottom">
                                <div class="d-flex align-items-start gap-3 mb-2">
                                    <div class="flex-shrink-0">
                                        @if($fiance->photo)
                                        <img src="{{ asset('storage/' . $fiance->photo) }}" 
                                             class="rounded-circle" width="50" height="50" style="object-fit: cover">
                                        @else
                                        <div class="bg-light rounded-circle d-flex align-items-center justify-content-center" 
                                             style="width:50px;height:50px;">
                                            <i class="bi bi-person text-muted fs-5"></i>
                                        </div>
                                        @endif
                                    </div>
                                    <div class="flex-grow-1">
                                        <h6 class="mb-1">{{ $fiance->prenoms }} <strong>{{ $fiance->nom }}</strong></h6>
                                        <div class="text-muted small">
                                            <div><i class="bi bi-envelope me-1"></i> {{ $fiance->email }}</div>
                                            <div><i class="bi bi-telephone me-1"></i> {{ $fiance->contact }}</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-end gap-2 mt-2">
                                    <a href="{{ route('admin.fiances.show', $fiance->id) }}" 
                                       class="btn btn-sm btn-outline-primary px-2">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.fiances.edit', $fiance->id) }}" 
                                       class="btn btn-sm btn-outline-warning px-2">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="{{ route('admin.fiances.destroy', $fiance->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger px-2" 
                                                onclick="return confirm('Confirmer la suppression ?')">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                            @endforeach
                        </div>

                        <!-- Desktop View -->
                        <div class="d-none d-md-block table-responsive">
                            <table class="table table-hover mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th width="60">Photo</th>
                                        <th>Nom & Prénoms</th>
                                        <th>Email</th>
                                        <th>Contact</th>
                                        <th width="150">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($fiances as $fiance)
                                    <tr>
                                        <td>
                                            @if($fiance->photo)
                                            <img src="{{ asset('storage/' . $fiance->photo) }}" 
                                                 class="rounded-circle" width="40" height="40" style="object-fit: cover">
                                            @else
                                            <div class="bg-light rounded-circle d-flex align-items-center justify-content-center" 
                                                 style="width:40px;height:40px;">
                                                <i class="bi bi-person text-muted"></i>
                                            </div>
                                            @endif
                                        </td>
                                        <td>
                                            <strong>{{ $fiance->nom }}</strong> {{ $fiance->prenoms }}
                                        </td>
                                        <td>{{ $fiance->email }}</td>
                                        <td>{{ $fiance->contact }}</td>
                                        <td>
                                            <div class="d-flex gap-2">
                                                <a href="{{ route('admin.fiances.show', $fiance->id) }}" 
                                                   class="btn btn-sm btn-outline-primary px-2" title="Voir">
                                                    <i class="bi bi-eye"></i>
                                                </a>
                                                <a href="{{ route('admin.fiances.edit', $fiance->id) }}" 
                                                   class="btn btn-sm btn-outline-warning px-2" title="Modifier">
                                                    <i class="bi bi-pencil"></i>
                                                </a>
                                                <form action="{{ route('admin.fiances.destroy', $fiance->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-outline-danger px-2" 
                                                            onclick="return confirm('Confirmer la suppression ?')" title="Supprimer">
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

                        <!-- Pagination -->
                        <div class="px-3 py-2 border-top">
                            <div class="d-flex flex-column flex-md-row justify-content-between align-items-center">
                                <div class="small text-muted mb-2 mb-md-0">
                                    Affichage de {{ $fiances->firstItem() }} à {{ $fiances->lastItem() }} sur {{ $fiances->total() }} fiances
                                </div>
                                {{ $fiances->onEachSide(1)->links('pagination::bootstrap-4') }}
                            </div>
                            
                        </div>
                    @endif
                </div>
            </div>
        </div>
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
    }
    /*.pagination .page-item.active .page-link {
        background-color: #0d6efd;
        border-color: #0d6efd;
    }*/
    @media (max-width: 767.98px) {
        .card-header {
            padding: 0.75rem;
        }
        .list-group-item {
            padding: 0.75rem;
        }
    }
</style>
@endsection