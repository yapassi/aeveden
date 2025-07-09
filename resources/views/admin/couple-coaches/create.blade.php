@extends('layouts.admin')

@section('content')
<div class="container-fluid px-2">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Créer un nouveau couple coach</h5>
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('admin.couple-coaches.store') }}">
                @csrf

                {{-- Sélection des coaches --}}
                <div class="mb-3">
                    <label for="coach_homme_id" class="form-label">Coach Homme *</label>
                    <select class="form-select @error('coach_homme_id') is-invalid @enderror" 
                            id="coach_homme_id" name="coach_homme_id" required>
                        <option value="">Sélectionner un coach homme</option>
                        @foreach($coachesHommes as $coach)
                            <option value="{{ $coach->id }}" >
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
                            <option value="{{ $coach->id }}">
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
                               value="{{ old('domicile') }}">
                    </div>
                    <div class="col-12 col-md-4">
                        <label for="date_mariage" class="form-label">Date de mariage</label>
                        <input type="date" class="form-control" id="date_mariage" name="date_mariage" 
                               value="{{ old('date_mariage') }}">
                    </div>
                    <div class="col-12 col-md-4">
                        <label for="date_debut_coaching" class="form-label">Date de début du coaching</label>
                        <input type="date" class="form-control" id="date_debut_coaching" name="date_debut_coaching" 
                               value="{{ old('date_debut_coaching') }}">
                    </div>
                </div>

                {{-- Boutons --}}
                <div class="d-flex flex-column flex-md-row justify-content-end gap-2 mt-4">
                    <a href="{{ route('admin.couple-coaches.index') }}" class="btn btn-secondary w-100 w-md-auto">
                        Annuler
                    </a>
                    <button type="submit" class="btn btn-primary w-100 w-md-auto">
                        Enregistrer le couple
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection
