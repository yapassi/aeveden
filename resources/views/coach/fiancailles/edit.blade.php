@extends('layouts.coach')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3>Modifier les fiançailles</h3>
        <a href="{{ route('coach.fiancailles.index') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left"></i> Retour à la liste
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('coach.fiancailles.update', $fiancailles->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row">
            <!-- Colonne de gauche -->
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">Informations principales</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="note" class="form-label">Note (sur 5)</label>
                            <div class="rating">
                                @for($i = 1; $i <= 5; $i++)
                                    <input type="radio" id="star{{$i}}" name="note" value="{{$i}}" 
                                           {{ old('note', $fiancailles->note) == $i ? 'checked' : '' }}>
                                    <label for="star{{$i}}"><i class="bi bi-star-fill"></i></label>
                                @endfor
                            </div>
                            @error('note')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="avis" class="form-label">Avis du coach</label>
                            <textarea name="avis" class="form-control" rows="3">{{ old('avis', $fiancailles->avis) }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label for="etape" class="form-label">Étape actuelle</label>
                            <select name="etape" class="form-select">
                                @foreach(\App\Models\Fiancailles::$etapeOptions as $key => $label)
                                    <option value="{{ $key }}" {{ old('etape', $fiancailles->etape) == $key ? 'selected' : '' }}>
                                        {{ $label }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="vie_ensemble" class="form-label">Vie ensemble</label>
                            <select name="vie_ensemble" class="form-select">
                                @foreach(\App\Models\Fiancailles::$vieEnsembleOptions as $key => $label)
                                    <option value="{{ $key }}" {{ old('vie_ensemble', $fiancailles->vie_ensemble) == $key ? 'selected' : '' }}>
                                        {{ $label }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Colonne de droite -->
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">Dates importantes</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="date_debut" class="form-label">Date de début</label>
                            <input type="date" name="date_debut" id="date_debut" 
                                   class="form-control" 
                                   value="{{ old('date_debut', $fiancailles->date_debut->format('Y-m-d')) }}">
                        </div>

                        <div class="mb-3">
                            <label for="date_dot" class="form-label">Date de dot</label>
                            <input type="date" name="date_dot" id="date_dot" 
                                   class="form-control" 
                                   value="{{ old('date_dot', $fiancailles->date_dot ? $fiancailles->date_dot->format('Y-m-d') : '') }}">
                        </div>

                        <div class="mb-3">
                            <label for="lieu_dot" class="form-label">Lieu de la dot</label>
                            <input type="text" name="lieu_dot" id="lieu_dot" 
                                   class="form-control" 
                                   value="{{ old('lieu_dot', $fiancailles->lieu_dot) }}">
                        </div>

                        <div class="mb-3">
                            <label for="date_mariage" class="form-label">Date de mariage</label>
                            <input type="date" name="date_mariage" id="date_mariage" 
                                   class="form-control" 
                                   value="{{ old('date_mariage', $fiancailles->date_mariage ? $fiancailles->date_mariage->format('Y-m-d') : '') }}">
                        </div>

                        <div class="mb-3">
                            <label for="lieu_mariage" class="form-label">Lieu du mariage</label>
                            <input type="text" name="lieu_mariage" id="lieu_mariage" 
                                   class="form-control" 
                                   value="{{ old('lieu_mariage', $fiancailles->lieu_mariage) }}">
                        </div>

                        <div class="mb-3">
                            <label for="date_benediction" class="form-label">Date de bénédiction</label>
                            <input type="date" name="date_benediction" id="date_benediction" 
                                   class="form-control" 
                                   value="{{ old('date_benediction', $fiancailles->date_benediction ? $fiancailles->date_benediction->format('Y-m-d') : '') }}">
                        </div>

                        <div class="mb-3">
                            <label for="lieu_benediction" class="form-label">Lieu de bénédiction</label>
                            <input type="text" name="lieu_benediction" id="lieu_benediction" 
                                   class="form-control" 
                                   value="{{ old('lieu_benediction', $fiancailles->lieu_benediction) }}">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-between">
            <a href="{{ route('coach.fiancailles.index') }}" class="btn btn-secondary">
                <i class="bi bi-x-circle"></i> Annuler
            </a>
            <button type="submit" class="btn btn-primary">
                <i class="bi bi-check-circle"></i> Enregistrer les modifications
            </button>
        </div>
    </form>
</div>
@endsection

@section('styles')
<style>
    .rating {
        display: flex;
        flex-direction: row-reverse;
        justify-content: flex-end;
    }
    .rating > input {
        display: none;
    }
    .rating > label {
        position: relative;
        width: 1.5em;
        font-size: 1.5rem;
        color: #ffc107;
        cursor: pointer;
    }
    .rating > label:hover,
    .rating > label:hover ~ label,
    .rating > input:checked ~ label {
        color: #ffc107;
    }
    .card {
        border-radius: 10px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }
    .card-header {
        border-radius: 10px 10px 0 0 !important;
    }
</style>
@endsection