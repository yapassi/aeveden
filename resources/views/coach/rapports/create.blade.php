@extends('layouts.coach')

@section('content')
<div class="container py-3">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">
                <i class="bi bi-journal-text"></i> Nouveau rapport - 
                <strong>{{ $coaching->fiancailles->fiance->prenoms ?? 'Fiancé' }} {{ $coaching->fiancailles->fiance->nom ?? '' }} & 
                        {{ $coaching->fiancailles->fiancee->prenoms ?? 'Fiancée' }} {{ $coaching->fiancailles->fiancee->nom ?? '' }}</strong>
            </h5>
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('coach.rapports.store', $coaching->id) }}">
                @csrf

                <input type="hidden" name="mois" value="{{ now()->format('Y-m') }}">

                <!-- Nombre de séances -->
                <div class="mb-3">
                    <label for="nombre_seances" class="form-label">Nombre de séances *</label>
                    <input type="number" name="nombre_seances" id="nombre_seances" 
                           class="form-control @error('nombre_seances') is-invalid @enderror" 
                           min="0" required>
                    @error('nombre_seances')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Types de séances -->
                <div class="mb-3">
                    <label class="form-label">Types de séances *</label>
                    <div class="row">
                        @foreach(\App\Models\Rapport::TYPES_SEANCES as $key => $label)
                            <div class="col-md-6">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" 
                                           name="types_seances[]" value="{{ $key }}" 
                                           id="type_{{ $key }}">
                                    <label class="form-check-label" for="type_{{ $key }}">
                                        {{ $label }}
                                    </label>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    @error('types_seances')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Dernière leçon -->
                <div class="mb-3">
                    <label for="derniere_lecon" class="form-label">Dernière leçon enseignée *</label>
                    <input type="text" name="derniere_lecon" id="derniere_lecon" 
                           class="form-control @error('derniere_lecon') is-invalid @enderror" required>
                    @error('derniere_lecon')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Observations -->
                <div class="mb-3">
                    <label for="observations" class="form-label">Observations</label>
                    <textarea name="observations" id="observations" class="form-control" rows="3"></textarea>
                </div>

                <!-- Défis du couple -->
                <div class="mb-3">
                    <label class="form-label">Défis du couple</label>
                    <div class="row">
                        @foreach(\App\Models\Rapport::DEFIS_COUPLE as $key => $label)
                            <div class="col-md-6">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" 
                                           name="defis_couple[]" value="{{ $key }}" 
                                           id="defis_{{ $key }}">
                                    <label class="form-check-label" for="defis_{{ $key }}">
                                        {{ $label }}
                                    </label>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    @error('defis_couple')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Solutions proposées -->
                <div class="mb-3">
                    <label for="solutions_coaches" class="form-label">Solutions proposées</label>
                    <textarea name="solutions_coaches" id="solutions_coaches" class="form-control" rows="3"></textarea>
                </div>

                <!-- Actions -->
                <div class="d-flex flex-column flex-md-row justify-content-between gap-2 mt-4">
                    <a href="{{ route('coach.coachings.show', $coaching->id) }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i> Annuler
                    </a>
                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-save"></i> Enregistrer le rapport
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
