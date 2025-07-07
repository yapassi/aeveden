@extends('layouts.admin')

@section('title', 'Événements')

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
.card .badge {
  font-size: 0.85em;
  padding: 0.4em 0.8em;
  border-radius: 0.5em;
}
.card-title {
  font-weight: 600;
  color: var(--primary);
}
@media (max-width: 767.98px) {
  .card-body {
    padding: 1rem;
  }
}
</style>
@endsection

@section('content')
<div class="container py-4">
    <h2 class="mb-4"><i class="bi bi-calendar-event me-2"></i>Événements à venir</h2>
    @if(count($upcomingEvents))
        <div class="row g-3 mb-5">
            @foreach($upcomingEvents as $event)
                <div class="col-md-6 col-lg-4">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body">
                            <span class="badge bg-{{ $event['badge_class'] }} mb-2">{{ $event['title'] }}</span>
                            <h5 class="card-title mb-1">{{ $event['couple'] }}</h5>
                            <div class="mb-2 text-muted small">
                                <i class="bi bi-calendar"></i>
                                {{ \Carbon\Carbon::parse($event['date'])->format('d/m/Y') }}
                            </div>
                            @if($event['location'])
                                <div class="mb-2">
                                    <i class="bi bi-geo-alt"></i>
                                    {{ $event['location'] }}
                                </div>
                            @endif
                            <a href="{{ route('evenements.show', $event['fiancailles_id']) }}" class="btn btn-outline-primary btn-sm mt-2">
                                <i class="bi bi-eye"></i> Voir
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="alert alert-info">Aucun événement à venir.</div>
    @endif

    <h2 class="mb-4 mt-5"><i class="bi bi-clock-history me-2"></i>Événements passés</h2>
    @if(count($pastEvents))
        <div class="row g-3">
            @foreach($pastEvents as $event)
                <div class="col-md-6 col-lg-4">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body">
                            <span class="badge bg-{{ $event['badge_class'] }} mb-2">{{ $event['title'] }}</span>
                            <h5 class="card-title mb-1">{{ $event['couple'] }}</h5>
                            <div class="mb-2 text-muted small">
                                <i class="bi bi-calendar"></i>
                                {{ \Carbon\Carbon::parse($event['date'])->format('d/m/Y') }}
                            </div>
                            @if($event['location'])
                                <div class="mb-2">
                                    <i class="bi bi-geo-alt"></i>
                                    {{ $event['location'] }}
                                </div>
                            @endif
                            <a href="{{ route('evenements.show', $event['fiancailles_id']) }}" class="btn btn-outline-primary btn-sm mt-2">
                                <i class="bi bi-eye"></i> Voir
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="alert alert-info">Aucun événement passé.</div>
    @endif
</div>
@endsection