@extends('layouts.admin')

@section('content')
<div class="container-fluid px-2">
    <div class="card shadow">
        <div class="card-header bg-success text-white">
            <h5 class="mb-0">Modifier le couple coach</h5>
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('admin.couple-coaches.update', $coupleCoach->id) }}">
                @csrf
                @method('PUT')

                {{-- Sélection des coaches --}}
                <div class="mb-3">
                    <label for="coach_homme_id" class="form-label">Coach Homme *</label>
                    <select class="form-select @error('coach_homme_id') is-invalid @enderror" 
                            id="coach_homme_id" name="coach_homme_id" required>
                        <option value="">Sélectionner un coach homme</option>
                        @foreach($coachesHommes as $coach)
                            <option value="{{ $coach->id }}" 
                                {{ (old('coach_homme_id', $coupleCoach->coach_homme_id) == $coach->id) ? 'selected' : '' }}>
                                {{ $coach->prenoms }} {{ $coach->nom }} ({{ $coach->contact }})
                            </option>
                        @endforeach
                    </select>
                    @error('coach_homme_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="coach_femme_id" class="form-label">Coach Femme *</label>
                    <select class="form-select @error('coach_femme_id') is-invalid @enderror" 
                            id="coach_femme_id" name="coach_femme_id" required>
                        <option value="">Sélectionner une coach femme</option>
                        @foreach($coachesFemmes as $coach)
                            <option value="{{ $coach->id }}" 
                                {{ (old('coach_femme_id', $coupleCoach->coach_femme_id) == $coach->id) ? 'selected' : '' }}>
                                {{ $coach->prenoms }} {{ $coach->nom }} ({{ $coach->contact }})
                            </option>
                        @endforeach
                    </select>
                    @error('coach_femme_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Informations complémentaires --}}
                <div class="row g-3">
                    <div class="col-12 col-md-4">
                        <label for="domicile" class="form-label">Domicile</label>
                        <input type="text" class="form-control" id="domicile" name="domicile" 
                               value="{{ old('domicile', $coupleCoach->domicile) }}">
                    </div>
                    <div class="col-12 col-md-4">
                        <label for="date_mariage" class="form-label">Date de mariage</label>
                        <input type="date" class="form-control" id="date_mariage" name="date_mariage" 
                               value="{{ old('date_mariage', optional($coupleCoach->date_mariage)->format('Y-m-d')) }}">
                    </div>
                    <div class="col-12 col-md-4">
                        <label for="date_debut_coaching" class="form-label">Date de début du coaching</label>
                        <input type="date" class="form-control" id="date_debut_coaching" name="date_debut_coaching" 
                               value="{{ old('date_debut_coaching', optional($coupleCoach->date_debut_coaching)->format('Y-m-d')) }}">
                    </div>
                </div>

                {{-- Boutons --}}
                <div class="d-flex flex-column flex-md-row justify-content-end gap-2 mt-4">
                    <a href="{{ route('admin.couple-coaches.index') }}" class="btn btn-secondary w-100 w-md-auto">
                        Annuler
                    </a>
                    <button type="submit" class="btn btn-success w-100 w-md-auto">
                        Mettre à jour
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection
