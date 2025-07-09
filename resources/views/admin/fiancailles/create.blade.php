@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Création d'une nouvelle fiançailles</h5>
        </div>
        
        <div class="card-body">
            <form method="POST" action="{{ route('admin.fiancailles.store') }}">
                @csrf

                <!-- Champs existants -->
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="fiance_id" class="form-label">Fiancé (Homme) *</label>
                        <select class="form-select @error('fiance_id') is-invalid @enderror" 
                                id="fiance_id" name="fiance_id" required>
                            <option value="">Sélectionner un fiancé</option>
                            @foreach($fiances as $fiance)
                                <option value="{{ $fiance->id }}">
                                    {{ $fiance->prenoms }} {{ $fiance->nom }}
                                </option>
                            @endforeach
                        </select>
                        @error('fiance_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="fiancee_id" class="form-label">Fiancée (Femme) *</label>
                        <select class="form-select @error('fiancee_id') is-invalid @enderror" 
                                id="fiancee_id" name="fiancee_id" required>
                            <option value="">Sélectionner une fiancée</option>
                            @foreach($fiancees as $fiancee)
                                <option value="{{ $fiancee->id }}">
                                    {{ $fiancee->prenoms }} {{ $fiancee->nom }}
                                </option>
                            @endforeach
                        </select>
                        @error('fiancee_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Champ date_début -->
                <div class="mb-3">
                    <label for="date_debut" class="form-label">Date de début *</label>
                    <input type="date" class="form-control @error('date_debut') is-invalid @enderror" 
                           id="date_debut" name="date_debut" value="{{ old('date_debut') }}" required>
                    @error('date_debut')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Nouveau champ etape -->
                <div class="mb-3">
                    <label for="etape" class="form-label">Étape actuelle *</label>
                    <select class="form-select @error('etape') is-invalid @enderror" 
                            id="etape" name="etape" required>
                        @foreach($etapeOptions as $value => $label)
                            <option value="{{ $value }}" {{ old('etape') == $value ? 'selected' : '' }}>
                                {{ $label }}
                            </option>
                        @endforeach
                    </select>
                    @error('etape')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <small class="text-muted">Sélectionnez le stade actuel de la relation</small>
                </div>
                <!-- Champ vie_ensemble -->
                <div class="mb-3">
                    <label for="vie_ensemble" class="form-label">Vivent-ils ensemble ? *</label>
                    <select class="form-select @error('vie_ensemble') is-invalid @enderror" 
                            id="vie_ensemble" name="vie_ensemble" required>
                        @foreach($vieEnsembleOptions as $value => $label)
                            <option value="{{ $value }}" {{ old('vie_ensemble') == $value ? 'selected' : '' }}>
                                {{ $label }}
                            </option>
                        @endforeach
                    </select>
                    @error('etape')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('admin.fiancailles.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Retour
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Enregistrer
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection