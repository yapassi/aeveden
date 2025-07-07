@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="card shadow">
        <div class="card-header bg-warning text-dark">
            <h5 class="mb-0">Modifier les fiançailles</h5>
        </div>
        
        <div class="card-body">
            <form method="POST" action="{{ route('admin.fiancailles.update', $fiancailles) }}">
                @csrf
                @method('PUT')

                <!-- Couple (lecture seule) -->
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">Fiancé (Homme)</label>
                        <input type="text" class="form-control" 
                               value="{{ $fiancailles->fiance->prenoms }} {{ $fiancailles->fiance->nom }}" readonly>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Fiancée (Femme)</label>
                        <input type="text" class="form-control" 
                               value="{{ $fiancailles->fiancee->prenoms }} {{ $fiancailles->fiancee->nom }}" readonly>
                    </div>
                </div>
                <small class="text-muted mb-3 d-block">Le couple ne peut pas être modifié après création</small>

                <div class="row">
                    <!-- Date de début -->
                    <div class="col-md-6 mb-3">
                        <label for="date_debut" class="form-label">Date de début *</label>
                        <input type="date" class="form-control @error('date_debut') is-invalid @enderror" 
                               id="date_debut" name="date_debut" 
                               value="{{ old('date_debut', $fiancailles->date_debut->format('Y-m-d')) }}" required>
                        @error('date_debut')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <!-- Date de fin -->
                    <div class="col-md-6 mb-3">
                        <label for="date_fin" class="form-label">Date de fin</label>
                        <input type="date" class="form-control @error('date_fin') is-invalid @enderror" 
                               id="date_fin" name="date_fin" 
                               value="{{ old('date_fin', optional($fiancailles->date_fin)->format('Y-m-d')) }}">
                        @error('date_fin')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <!-- Date de la dot -->
                    <div class="col-md-6 mb-3">
                        <label for="date_dot" class="form-label">Date de la dot</label>
                        <input type="date" class="form-control @error('date_dot') is-invalid @enderror" 
                               id="date_dot" name="date_dot" 
                               value="{{ old('date_dot', optional($fiancailles->date_dot)->format('Y-m-d')) }}">
                        @error('date_dot')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Lieu de la dot -->
                    <div class="col-md-6 mb-3">
                        <label for="lieu_dot" class="form-label">Lieu de la dot</label>
                        <input type="text" class="form-control @error('lieu_dot') is-invalid @enderror" 
                               id="lieu_dot" name="lieu_dot" 
                               value="{{ old('lieu_dot', $fiancailles->lieu_dot) }}">
                        @error('lieu_dot')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <!-- Date du mariage -->
                    <div class="col-md-6 mb-3">
                        <label for="date_mariage" class="form-label">Date du mariage</label>
                        <input type="date" class="form-control @error('date_mariage') is-invalid @enderror" 
                               id="date_mariage" name="date_mariage" 
                               value="{{ old('date_mariage', optional($fiancailles->date_mariage)->format('Y-m-d')) }}">
                        @error('date_mariage')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Lieu du mariage -->
                    <div class="col-md-6 mb-3">
                        <label for="lieu_mariage" class="form-label">Lieu du mariage</label>
                        <input type="text" class="form-control @error('lieu_mariage') is-invalid @enderror" 
                               id="lieu_mariage" name="lieu_mariage" 
                               value="{{ old('lieu_mariage', $fiancailles->lieu_mariage) }}">
                        @error('lieu_mariage')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <!-- Date de bénédiction -->
                    <div class="col-md-6 mb-3">
                        <label for="date_benediction" class="form-label">Date de bénédiction</label>
                        <input type="date" class="form-control @error('date_benediction') is-invalid @enderror" 
                               id="date_benediction" name="date_benediction" 
                               value="{{ old('date_benediction', optional($fiancailles->date_benediction)->format('Y-m-d')) }}">
                        @error('date_benediction')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Lieu de bénédiction -->
                    <div class="col-md-6 mb-3">
                        <label for="lieu_benediction" class="form-label">Lieu de bénédiction</label>
                        <input type="text" class="form-control @error('lieu_benediction') is-invalid @enderror" 
                               id="lieu_benediction" name="lieu_benediction" 
                               value="{{ old('lieu_benediction', $fiancailles->lieu_benediction) }}">
                        @error('lieu_benediction')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>


                <!-- Étape -->
                <div class="mb-3">
                    <label for="etape" class="form-label">Étape actuelle *</label>
                    <select class="form-select @error('etape') is-invalid @enderror" id="etape" name="etape" required>
                        @foreach(App\Models\Fiancailles::$etapeOptions as $value => $label)
                            <option value="{{ $value }}" {{ old('etape', $fiancailles->etape) == $value ? 'selected' : '' }}>
                                {{ $label }}
                            </option>
                        @endforeach
                    </select>
                    @error('etape')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Vie ensemble -->
                <div class="mb-3">
                    <label for="vie_ensemble" class="form-label">Vivent-ils ensemble ? *</label>
                    <select class="form-select @error('vie_ensemble') is-invalid @enderror" id="vie_ensemble" name="vie_ensemble" required>
                        @foreach(App\Models\Fiancailles::$vieEnsembleOptions as $value => $label)
                            <option value="{{ $value }}" {{ old('vie_ensemble', $fiancailles->vie_ensemble) == $value ? 'selected' : '' }}>
                                {{ $label }}
                            </option>
                        @endforeach
                    </select>
                    @error('vie_ensemble')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Boutons -->
                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('admin.fiancailles.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Retour
                    </a>
                    <button type="submit" class="btn btn-warning text-dark">
                        <i class="fas fa-save"></i> Mettre à jour
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
    .card {
        border-radius: 10px;
    }
    .card-header {
        border-radius: 10px 10px 0 0 !important;
    }
    .form-label {
        font-weight: 500;
    }
    .invalid-feedback {
        display: block;
    }
</style>
@endsection