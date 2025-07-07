@extends('layouts.admin')

@section('title', 'Faire-part de fiançailles')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center mb-3">
        <div class="col-lg-8 d-flex justify-content-between align-items-center">
            <a href="{{ url()->previous() }}" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left"></i> Retour
            </a>
            <a href="{{ route('evenements.exportPdf', $fiancailles->id) }}" class="btn btn-outline-primary">
                <i class="bi bi-file-earmark-pdf"></i> Exporter en PDF
            </a>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-lg border-0 mb-4">
                <div class="card-body p-4">
                    <div class="row align-items-center mb-4">
                        <div class="col-5 text-center">
                            <img src="{{ asset('images/default-male.png') }}" alt="Photo fiancé" class="rounded-circle shadow" style="width: 120px; height: 120px; object-fit: cover;">
                            <h5 class="mt-3 mb-0">{{ $fiancailles->fiance->prenoms ?? '' }}</h5>
                            <div class="text-muted small">{{ $fiancailles->fiance->nom ?? '' }}</div>
                        </div>
                        <div class="col-2 text-center">
                            <i class="bi bi-heart-fill text-danger fs-1"></i>
                        </div>
                        <div class="col-5 text-center">
                            <img src="{{ asset('images/default-female.png') }}" alt="Photo fiancée" class="rounded-circle shadow" style="width: 120px; height: 120px; object-fit: cover;">
                            <h5 class="mt-3 mb-0">{{ $fiancailles->fiancee->prenoms ?? '' }}</h5>
                            <div class="text-muted small">{{ $fiancailles->fiancee->nom ?? '' }}</div>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-6">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item"><strong>Nom :</strong> {{ $fiancailles->fiance->nom ?? '-' }}</li>
                                <li class="list-group-item"><strong>Prénoms :</strong> {{ $fiancailles->fiance->prenoms ?? '-' }}</li>
                                <li class="list-group-item"><strong>Église :</strong> {{ $fiancailles->fiance->eglise ?? '-' }}</li>
                                <li class="list-group-item"><strong>Département :</strong> {{ $fiancailles->fiance->departement ?? '-' }}</li>
                                <li class="list-group-item"><strong>Tribu :</strong> {{ $fiancailles->fiance->tribu ?? '-' }}</li>
                                <li class="list-group-item"><strong>Téléphone :</strong> {{ $fiancailles->fiance->contact ?? '-' }}</li>
                            </ul>
                        </div>
                        <div class="col-6">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item"><strong>Nom :</strong> {{ $fiancailles->fiancee->nom ?? '-' }}</li>
                                <li class="list-group-item"><strong>Prénoms :</strong> {{ $fiancailles->fiancee->prenoms ?? '-' }}</li>
                                <li class="list-group-item"><strong>Église :</strong> {{ $fiancailles->fiancee->eglise ?? '-' }}</li>
                                <li class="list-group-item"><strong>Département :</strong> {{ $fiancailles->fiancee->departement ?? '-' }}</li>
                                <li class="list-group-item"><strong>Tribu :</strong> {{ $fiancailles->fiancee->tribu ?? '-' }}</li>
                                <li class="list-group-item"><strong>Téléphone :</strong> {{ $fiancailles->fiancee->contact ?? '-' }}</li>
                            </ul>
                        </div>
                    </div>
                    <hr>
                    <h4 class="mb-3 text-center"><i class="bi bi-calendar-event me-2"></i>Événements</h4>
                    <div class="timeline">
                        @forelse($events as $event)
                            <div class="timeline-item mb-4">
                                <span class="badge bg-{{ $event['badge'] }} mb-2">{{ $event['type'] }}</span>
                                <div><i class="bi bi-calendar"></i> <strong>Date :</strong> {{ \Carbon\Carbon::parse($event['date'])->format('d/m/Y') }}</div>
                                @if($event['location'])
                                    <div><i class="bi bi-geo-alt"></i> <strong>Lieu :</strong> {{ $event['location'] }}</div>
                                @endif
                            </div>
                        @empty
                            <div class="alert alert-info">Aucun événement renseigné.</div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
.timeline {
    border-left: 3px solid #dee2e6;
    margin-left: 1.5rem;
    padding-left: 1.5rem;
}
.timeline-item {
    position: relative;
}
.timeline-item:before {
    content: '';
    position: absolute;
    left: -1.65rem;
    top: 0.5rem;
    width: 1rem;
    height: 1rem;
    background: #fff;
    border: 3px solid #0d6efd;
    border-radius: 50%;
    z-index: 1;
}
</style>
@endsection
