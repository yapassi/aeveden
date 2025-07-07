@extends('layouts.admin')

@section('title', 'Modifier le coaching')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-3">
                <div>
                    <h1 class="h3 mb-2">
                        <i class="bi bi-people-fill text-primary me-2"></i>Modifier le coaching
                    </h1>
                    <p class="text-muted mb-0">
                        @if($coaching->fiancailles)
                            {{ optional($coaching->fiancailles->fiance)->prenoms }} & {{ optional($coaching->fiancailles->fiancee)->prenoms }}
                        @else
                            Coaching sans couple associé
                        @endif
                    </p>
                </div>
                <a href="{{ route('admin.coachings.index') }}" class="btn btn-outline-secondary">
                    <i class="bi bi-arrow-left me-1"></i> Retour à la liste
                </a>
            </div>
        </div>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <form action="{{ route('admin.coachings.update', $coaching) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row g-4">
                    <!-- Couple en fiançailles (readonly) -->
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control" value="@if($coaching->fiancailles){{ optional($coaching->fiancailles->fiance)->prenoms }} & {{ optional($coaching->fiancailles->fiancee)->prenoms }}@else Aucun couple @endif" readonly>
                            <label><i class="bi bi-heart-fill text-danger me-1"></i> Couple en fiançailles</label>
                        </div>
                        <small class="text-muted mt-1 d-block">Le couple ne peut pas être modifié</small>
                    </div>

                    <!-- Couple de coachs -->
                    <div class="col-md-6">
                        <div class="form-floating">
                            <select class="form-select @error('couple_coach_id') is-invalid @enderror" name="couple_coach_id" id="couple_coach_id" required>
                                <option value="" disabled>Sélectionnez...</option>
                                @foreach($coupleCoachs as $cc)
                                    <option value="{{ $cc->id }}" @selected(old('couple_coach_id', $coaching->couple_coach_id) == $cc->id)>
                                        {{ $cc->coachHomme->prenoms }} & {{ $cc->coachFemme->prenoms }}
                                    </option>
                                @endforeach
                            </select>
                            <label for="couple_coach_id"><i class="bi bi-person-badge-fill text-primary me-1"></i> Couple de coachs</label>
                            @error('couple_coach_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Statut -->
                    <div class="col-md-4">
                        <div class="form-floating">
                            <select class="form-select @error('statut') is-invalid @enderror" name="statut" id="statut" required>
                                @foreach($statuts as $key => $label)
                                    <option value="{{ $key }}" @selected(old('statut', $coaching->statut) == $key)>{{ $label }}</option>
                                @endforeach
                            </select>
                            <label for="statut"><i class="bi bi-info-circle-fill me-1"></i> Statut</label>
                            @error('statut')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Date de début -->
                    <div class="col-md-4">
                        <div class="form-floating">
                            <input type="date" name="date_debut" id="date_debut" class="form-control @error('date_debut') is-invalid @enderror" value="{{ old('date_debut', optional($coaching->date_debut)->format('Y-m-d')) }}" required>
                            <label for="date_debut"><i class="bi bi-calendar-event-fill me-1"></i> Date de début</label>
                            @error('date_debut')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Date de fin -->
                    <div class="col-md-4">
                        <div class="form-floating">
                            <input type="date" name="date_fin" id="date_fin" class="form-control @error('date_fin') is-invalid @enderror" value="{{ old('date_fin', optional($coaching->date_fin)->format('Y-m-d')) }}">
                            <label for="date_fin"><i class="bi bi-calendar-x-fill me-1"></i> Date de fin (optionnel)</label>
                            @error('date_fin')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Boutons -->
                    <div class="col-12 mt-4 pt-3 border-top">
                        <div class="d-flex justify-content-between">
                            <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteModal">
                                <i class="bi bi-trash me-1"></i> Supprimer
                            </button>
                            <div class="d-flex gap-3">
                                <button type="reset" class="btn btn-outline-secondary">
                                    <i class="bi bi-arrow-counterclockwise me-1"></i> Réinitialiser
                                </button>
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-save me-1"></i> Enregistrer
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal de suppression -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form method="POST" action="{{ route('admin.coachings.destroy', $coaching) }}">
            @csrf
            @method('DELETE')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Confirmer la suppression</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                </div>
                <div class="modal-body">
                    Êtes-vous sûr de vouloir supprimer définitivement ce coaching ? Cette action est irréversible.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-danger">Supprimer définitivement</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@section('styles')
<style>
    .card {
        border-radius: 0.75rem;
        border: none;
    }
    
    .form-floating label {
        padding-left: 2.5rem;
    }

    .form-floating .bi {
        position: absolute;
        left: 1rem;
        top: 50%;
        transform: translateY(-50%);
        font-size: 1.1rem;
    }

    .form-select, .form-control {
        padding-left: 2.5rem;
        height: calc(3.5rem + 2px);
    }

    @media (max-width: 767.98px) {
        .form-floating label,
        .form-floating .bi {
            padding-left: 2rem;
            left: 0.8rem;
        }

        .form-select, .form-control {
            padding-left: 2.2rem;
        }
    }
</style>
@endsection
