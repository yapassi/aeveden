@extends('layouts.coach')

@section('content')
<div class="container">
    <h2>Modifier le rapport</h2>

    <form action="{{ route('coach.rapports.update', $rapport) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Nombre de séances -->
        <div class="mb-3">
            <label class="form-label">Nombre de séances</label>
            <input type="number" name="nombre_seances" value="{{ old('nombre_seances', $rapport->nombre_seances) }}" class="form-control" required>
            @error('nombre_seances')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Types de séances -->
        <div class="mb-3">
            <label class="form-label">Types de séances</label>
            @foreach($typesSeances as $key => $label)
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="types_seances[]" value="{{ $key }}"
                        {{ in_array($key, old('types_seances', $rapport->types_seances ?? [])) ? 'checked' : '' }}>
                    <label class="form-check-label">{{ $label }}</label>
                </div>
            @endforeach
            @error('types_seances')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Dernière leçon -->
        <div class="mb-3">
            <label class="form-label">Dernière leçon</label>
            <input type="text" name="derniere_lecon" value="{{ old('derniere_lecon', $rapport->derniere_lecon) }}" class="form-control">
            @error('derniere_lecon')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Observations -->
        <div class="mb-3">
            <label class="form-label">Observations</label>
            <textarea name="observations" class="form-control" rows="3">{{ old('observations', $rapport->observations) }}</textarea>
            @error('observations')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Défis du couple (array) -->
        <div class="mb-3">
            <label class="form-label">Défis du couple</label>
            @foreach($defisOptions as $key => $defi)
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="defis_couple[]" value="{{ $key }}"
                        {{ in_array($key, old('defis_couple', $rapport->defis_couple ?? [])) ? 'checked' : '' }}>
                    <label class="form-check-label">{{ ucfirst($defi) }}</label>
                </div>
            @endforeach
            @error('defis_couple')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Solutions proposées -->
        <div class="mb-3">
            <label class="form-label">Solutions proposées</label>
            <textarea name="solutions_coaches" class="form-control" rows="3">{{ old('solutions_coaches', $rapport->solutions_coaches) }}</textarea>
            @error('solutions_coaches')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Boutons -->
        <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
        <a href="{{ route('coach.rapports.index') }}" class="btn btn-secondary">Annuler</a>
    </form>
</div>
@endsection
