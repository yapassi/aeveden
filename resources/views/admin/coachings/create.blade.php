@extends('layouts.admin')

@section('title', 'Créer un nouveau coaching')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-3">
                <div>
                    <h1 class="h3 mb-2">
                        <i class="bi bi-people-fill text-primary me-2"></i>Créer un nouveau coaching
                    </h1>
                    <p class="text-muted mb-0">Configurez un nouveau suivi de couple</p>
                </div>
                <a href="{{ route('admin.coachings.index') }}" class="btn btn-outline-secondary">
                    <i class="bi bi-arrow-left me-1"></i> Retour à la liste
                </a>
            </div>
        </div>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <form action="{{ route('admin.coachings.store') }}" method="POST">
                @csrf

                <div class="row g-4">
                    <!-- Fiançailles -->
                    <div class="col-md-6">
                        <div class="form-floating">
                            <select class="form-select @error('fiancailles_id') is-invalid @enderror" id="fiancailles_id" name="fiancailles_id" required>
                                <option value="" selected disabled>Sélectionnez...</option>
                                @foreach($fiancailles as $f)
                                    <option value="{{ $f->id }}" @selected(old('fiancailles_id') == $f->id)>
                                        {{ $f->fiance->prenoms }} & {{ $f->fiancee->prenoms }}
                                        (depuis {{ $f->date_debut->format('d/m/Y') }})
                                    </option>
                                @endforeach
                            </select>
                            <label for="fiancailles_id">
                                <i class="bi bi-heart-fill text-danger me-1"></i> Couple en fiançailles
                            </label>
                            @error('fiancailles_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <small class="text-muted mt-1 d-block">Seuls les couples sans coaching actif sont listés</small>
                    </div>

                    <!-- Couple de coachs -->
                    <div class="col-md-6">
                        <div class="form-floating">
                            <select class="form-select @error('couple_coach_id') is-invalid @enderror" id="couple_coach_id" name="couple_coach_id" required>
                                <option value="" selected disabled>Sélectionnez...</option>
                                @foreach($coupleCoachs as $cc)
                                    <option value="{{ $cc->id }}" @selected(old('couple_coach_id') == $cc->id)>
                                        {{ $cc->coachHomme->prenoms }} & {{ $cc->coachFemme->prenoms }}
                                    </option>
                                @endforeach
                            </select>
                            <label for="couple_coach_id">
                                <i class="bi bi-person-badge-fill text-primary me-1"></i> Couple de coachs
                            </label>
                            @error('couple_coach_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Statut -->
                    <div class="col-md-4">
                        <div class="form-floating">
                            <select class="form-select @error('statut') is-invalid @enderror" id="statut" name="statut" required>
                                @foreach($statuts as $key => $value)
                                    <option value="{{ $key }}" @selected(old('statut') == $key)>{{ $value }}</option>
                                @endforeach
                            </select>
                            <label for="statut">
                                <i class="bi bi-info-circle-fill me-1"></i> Statut
                            </label>
                            @error('statut')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Date de début -->
                    <div class="col-md-4">
                        <div class="form-floating">
                            <input type="date" class="form-control @error('date_debut') is-invalid @enderror" id="date_debut" name="date_debut" value="{{ old('date_debut') }}" required>
                            <label for="date_debut">
                                <i class="bi bi-calendar-event-fill me-1"></i> Date de début
                            </label>
                            @error('date_debut')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Boutons -->
                    <div class="col-12 mt-4 pt-3 border-top">
                        <div class="d-flex justify-content-end gap-3">
                            <button type="reset" class="btn btn-outline-secondary">
                                <i class="bi bi-arrow-counterclockwise me-1"></i> Réinitialiser
                            </button>
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-save me-1"></i> Enregistrer
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
:root {
  --primary: #2C3E50;
  --secondary: #e83e8c;
  --success: #198754;
  --light: #f8f9fa;
  --card-bg: #fff;
  --text-main: #222;
  --text-secondary: #6c757d;
  --border-radius: 0.75rem;
  --shadow: 0 2px 12px rgba(44,62,80,0.07);
}
body {
  background: var(--light);
  color: var(--text-main);
  font-family: 'Segoe UI', 'Roboto', Arial, sans-serif;
}
.card, .modal-content {
  border-radius: var(--border-radius);
  box-shadow: var(--shadow);
  background: var(--card-bg);
  border: none;
}
.card-header, .modal-header {
  background: var(--light);
  color: var(--primary);
  font-weight: 600;
  border-bottom: 1px solid #e5e5e5;
}
.btn-primary {
  background: var(--primary);
  border: none;
}
.btn-primary:hover, .btn-primary:focus {
  background: #1a2533;
}
.btn-secondary, .bg-secondary {
  background: var(--secondary) !important;
  color: #fff !important;
  border: none;
}
.btn-secondary:hover, .btn-secondary:focus {
  background: #c2185b !important;
}
.badge-pink {
  background: var(--secondary);
  color: #fff;
}
.badge-blue {
  background: var(--primary);
  color: #fff;
}
.badge-success {
  background: var(--success);
  color: #fff;
}
.table thead {
  background: var(--primary);
  color: #fff;
}
.table-hover tbody tr:hover {
  background: #f1f3f7;
}
input:focus, select:focus, textarea:focus {
  border-color: var(--secondary);
  box-shadow: 0 0 0 0.2rem rgba(232,62,140,.15);
}
a {
  color: var(--primary);
}
a:hover {
  color: var(--secondary);
  text-decoration: underline;
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