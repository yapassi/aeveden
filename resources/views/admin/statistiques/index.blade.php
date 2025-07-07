@php
    $layout = auth()->user()->role === 'manager' ? 'layout.manager' : 'layouts.admin';
@endphp

@extends($layout)

@section('title', 'Statistiques générales')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12">
            <h1 class="h3 mb-0">
                <i class="bi bi-graph-up text-primary me-2"></i> Statistiques générales
            </h1>
            <p class="text-muted">Vue d'ensemble des fiançailles, coachings et rapports.</p>
        </div>
    </div>

    <!-- Statistiques rapides -->
    <div class="row g-4">
        <div class="col-md-3">
            <div class="card shadow-sm border-0">
                <div class="card-body text-center">
                    <i class="bi bi-heart-fill fs-2 text-danger"></i>
                    <h5 class="mt-2">Fiançailles</h5>
                    <h3>{{ $fiancaillesCount }}</h3>
                    <p class="text-muted mb-0">Couples engagés</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm border-0">
                <div class="card-body text-center">
                    <i class="bi bi-people-fill fs-2 text-primary"></i>
                    <h5 class="mt-2">Coachings</h5>
                    <h3>{{ $coachingsCount }}</h3>
                    <p class="text-muted mb-0">Suivis en cours ou passés</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm border-0">
                <div class="card-body text-center">
                    <i class="bi bi-file-text-fill fs-2 text-success"></i>
                    <h5 class="mt-2">Rapports</h5>
                    <h3>{{ $rapportsCount }}</h3>
                    <p class="text-muted mb-0">Comptes rendus enregistrés</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm border-0">
                <div class="card-body text-center">
                    <i class="bi bi-star-fill fs-2 text-warning"></i>
                    <h5 class="mt-2">Note moyenne</h5>
                    <h3>{{ number_format($noteMoyenne, 1) ?? '—' }}</h3>
                    <p class="text-muted mb-0">Attribuée aux couples</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Statut des coachings -->
    <div class="row mt-5">
        <div class="col-12">
            <h4><i class="bi bi-info-circle-fill me-2 text-secondary"></i>Répartition des coachings par statut</h4>
            <ul class="list-group mt-3">
                @foreach($statutsCoachings as $statut => $nombre)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        {{ App\Models\Coaching::STATUTS[$statut] ?? ucfirst($statut) }}
                        <span class="badge bg-primary rounded-pill">{{ $nombre }}</span>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>

    <!-- Taux de vie ensemble -->
    <div class="row mt-5">
        <div class="col-12">
            <h4><i class="bi bi-house-heart-fill me-2 text-secondary"></i>Situation de vie des couples</h4>
            <ul class="list-group mt-3">
                @foreach($vieEnsembleStats as $cle => $valeur)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        {{ App\Models\Fiancailles::$vieEnsembleOptions[$cle] ?? ucfirst($cle) }}
                        <span class="badge bg-secondary rounded-pill">{{ $valeur }}</span>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>

    <!-- Section : Couples les mieux notés -->
<div class="row mt-5">
    <div class="col-12">
        <h4><i class="bi bi-trophy-fill text-warning me-2"></i>Top 5 des couples les mieux notés</h4>
        <div class="table-responsive mt-3">
            <table class="table table-sm table-striped">
                <thead>
                    <tr>
                        <th>Couple</th>
                        <th>Note</th>
                        <th>Date début</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($topFiancailles as $f)
                        <tr>
                            <td>{{ $f->fiance->prenoms }} & {{ $f->fiancee->prenoms }}</td>
                            <td>{{ $f->note }}/5</td>
                            <td>{{ $f->date_debut->format('d/m/Y') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Section : Répartition par étape -->
<div class="row mt-5">
    <div class="col-12">
        <h4><i class="bi bi-flag-fill me-2 text-success"></i>Répartition des couples par étape</h4>
        <ul class="list-group mt-3">
            @foreach($etapesStats as $cle => $val)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    {{ App\Models\Fiancailles::$etapeOptions[$cle] ?? ucfirst($cle) }}
                    <span class="badge bg-success rounded-pill">{{ $val }}</span>
                </li>
            @endforeach
        </ul>
    </div>
</div>

<!-- Section : Coachings par coach -->
<div class="row mt-5">
    <div class="col-12">
        <h4><i class="bi bi-person-fill-gear me-2 text-dark"></i>Coachings par couple de coachs</h4>
        <ul class="list-group mt-3">
            @foreach($coachingsParCouple as $coach => $total)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    {{ $coach }}
                    <span class="badge bg-dark rounded-pill">{{ $total }}</span>
                </li>
            @endforeach
        </ul>
    </div>
</div>
<div class="container-fluid px-3">
    <div class="card shadow-sm">
        <div class="card-body">
            <h5 class="card-title">Statistiques des séances par couple de coachs</h5>
            <div class="chart-container" style="position: relative; width: 100%;">
                <canvas id="coachMonthlyChart"></canvas>
            </div>
        </div>
    </div>
</div>


</div>
@endsection
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const monthlyCoachStats = @json($monthlyCoachStats);

    // Récupérer tous les mois
    const months = Object.keys(monthlyCoachStats);

    // Récupérer tous les noms de couples, même s'ils ne sont pas présents dans tous les mois
    const allCoupleNames = new Set();
    for (const month in monthlyCoachStats) {
        for (const couple in monthlyCoachStats[month]) {
            allCoupleNames.add(couple);
        }
    }
    const couples = Array.from(allCoupleNames);

    // Générer les datasets pour chaque couple
    const datasets = couples.map((couple, idx) => {
        const data = months.map(month => monthlyCoachStats[month]?.[couple] ?? 0);
        const color = `hsl(${idx * 47 % 360}, 65%, 60%)`;

        return {
            label: couple,
            data: data,
            backgroundColor: color,
            borderColor: color,
            borderWidth: 1
        };
    });

    const ctx = document.getElementById('coachMonthlyChart').getContext('2d');

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: months,
            datasets: datasets
        },
        options: {
            responsive: true,
            plugins: {
                title: {
                    display: true,
                    text: 'Nombre moyen de séances par couple de coachs (par mois)',
                    font: { size: 18 }
                },
                tooltip: {
                    mode: 'index',
                    intersect: false
                },
                legend: {
                    position: 'bottom',
                    labels: {
                        boxWidth: 12
                    }
                }
            },
            interaction: {
                mode: 'nearest',
                axis: 'x',
                intersect: false
            },
            scales: {
                x: {
                    stacked: true,
                    title: {
                        display: true,
                        text: 'Mois'
                    }
                },
                y: {
                    stacked: false,
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Moyenne des séances'
                    }
                }
            }
        }
    });
});
</script>

