@extends('layouts.manager')

@section('content')
<div class="container-fluid mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0"><i class="bi bi-speedometer2 me-2"></i>Tableau de bord Manager</h2>
        <div class="text-muted">Mis à jour : {{ now()->format('d/m/Y H:i') }}</div>
    </div>

    {{-- Onglets Bootstrap avec style amélioré --}}
    <ul class="nav nav-pills mb-4 shadow-sm" id="dashboardTabs" role="tablist">
        <li class="nav-item" role="presentation">
            <a class="nav-link active" id="stats-tab" data-bs-toggle="pill" href="#stats" role="tab">
                <i class="bi bi-bar-chart-line me-1"></i> Statistiques
            </a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="repartition-tab" data-bs-toggle="pill" href="#repartition" role="tab">
                <i class="bi bi-pie-chart me-1"></i> Répartition
            </a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="coach-tab" data-bs-toggle="pill" href="#coach" role="tab">
                <i class="bi bi-people me-1"></i> Coaching
            </a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="dot_mariage-tab" data-bs-toggle="pill" href="#dot_mariage" role="tab">
                <i class="bi bi-hearts me-1"></i> Événements
            </a>
        </li>
    </ul>

    <div class="tab-content p-3 bg-white rounded-3 shadow" id="dashboardTabsContent">
        {{-- Onglet 1 : Statistiques --}}
        <div class="tab-pane fade show active" id="stats" role="tabpanel">
            <div class="row g-4 mb-5">
                @foreach([
                    ['Fiançailles', $totalFiancailles, 'primary', 'bi-people-fill'],
                    ['Coachings actifs', $totalCoachingsEnCours, 'success', 'bi-check-circle-fill'],
                    ['Coachings en pause', $totalCoachingsPause, 'warning', 'bi-pause-circle-fill'],
                    ['Couples coachs', $totalCouplesCoach, 'dark', 'bi-person-badge-fill']
                ] as [$label, $count, $color, $icon])
                    <div class="col-xl-3 col-md-6">
                        <div class="card border-0 shadow-sm h-100 hover-scale">
                            <div class="card-body text-center py-4">
                                <div class="icon-lg bg-soft-{{ $color }} text-{{ $color }} mb-3">
                                    <i class="bi {{ $icon }}"></i>
                                </div>
                                <h3 class="mb-2">{{ $count }}</h3>
                                <p class="text-muted mb-0">{{ $label }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="row g-4">
                {{-- Coachings longue durée --}}
                <div class="col-lg-6">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-header bg-soft-primary">
                            <h5 class="mb-0"><i class="bi bi-clock-history me-2"></i>Coachings longue durée (>1 an)</h5>
                        </div>
                        <div class="card-body">
                            <div class="list-group list-group-flush">
                                @foreach($longestCoachings as $c)
                                <div class="list-group-item d-flex justify-content-between align-items-center py-3">
                                    <div>
                                        <span class="fw-bold">{{ ($c->fiancailles->fiance->prenoms ?? '') }} & {{ ($c->fiancailles->fiancee->prenoms ?? '') }}</span>
                                        <div class="text-muted small">Début: {{ $c->date_debut->format('d/m/Y') }}</div>
                                    </div>
                                    <span class="badge bg-primary rounded-pill">{{ $c->duree_annees_mois }}</span>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Coachings en pause --}}
                <div class="col-lg-6">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-header bg-soft-warning">
                            <h5 class="mb-0"><i class="bi bi-pause-circle me-2"></i>Coachings en pause</h5>
                        </div>
                        <div class="card-body">
                            <div class="list-group list-group-flush">
                                @foreach($coachingsEnPause as $c)
                                <div class="list-group-item d-flex justify-content-between align-items-center py-3">
                                    <div>
                                        <span class="fw-bold">{{ $c->fiancailles->fiance->prenoms ?? '' }} & {{ $c->fiancailles->fiancee->prenoms ?? '' }}</span>
                                        <div class="text-muted small">Depuis: {{ $c->updated_at->format('d/m/Y') }}</div>
                                    </div>
                                    <span class="badge bg-warning text-dark rounded-pill">En pause</span>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Top défis --}}
                <div class="col-12 mt-4">
                    <div class="card border-0 shadow-sm">
                        <div class="card-header bg-soft-info">
                            <h5 class="mb-0"><i class="bi bi-exclamation-triangle me-2"></i>Top 5 des défis rencontrés</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                @foreach($topDefis as $defi => $data)
                                <div class="col-md-4 mb-3">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0">
                                            <div class="avatar-sm bg-soft-{{ ['primary', 'success', 'info', 'warning', 'danger'][$loop->index] }} text-{{ ['primary', 'success', 'info', 'warning', 'danger'][$loop->index] }} rounded-circle d-flex align-items-center justify-content-center">
                                                <i class="bi bi-{{ ['heart', 'chat', 'cash', 'clock', 'emoji-frown'][$loop->index] }} fs-5"></i>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <h6 class="mb-0">{{ $defi }}</h6>
                                            <div class="progress mt-2" style="height: 6px;">
                                                <div class="progress-bar bg-{{ ['primary', 'success', 'info', 'warning', 'danger'][$loop->index] }}" role="progressbar" style="width: {{ $data['percentage'] }}%" aria-valuenow="{{ $data['percentage'] }}" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                            <small class="text-muted">{{ $data['count'] }} occurrences ({{ $data['percentage'] }}%)</small>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Onglet 2 : Répartition --}}
        <div class="tab-pane fade" id="repartition" role="tabpanel">
            <div class="row g-4">
                <div class="col-lg-4">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-header bg-soft-primary">
                            <h5 class="mb-0"><i class="bi bi-signpost-split me-2"></i>Par étape</h5>
                        </div>
                        <div class="card-body">
                            <canvas id="etapeChart" height="300"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-header bg-soft-success">
                            <h5 class="mb-0"><i class="bi bi-exclamation-octagon me-2"></i>Par défis</h5>
                        </div>
                        <div class="card-body">
                            <canvas id="defisChart" height="300"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-header bg-soft-info">
                            <h5 class="mb-0"><i class="bi bi-calendar-range me-2"></i>Durée de coaching</h5>
                        </div>
                        <div class="card-body">
                            <canvas id="dureeChart" height="300"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Onglet 3 : Coaching --}}
        <div class="tab-pane fade" id="coach" role="tabpanel">
            <div class="row g-4">
                <div class="col-lg-6">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-header bg-soft-warning">
                            <h5 class="mb-0"><i class="bi bi-trophy me-2"></i>Couples en charge</h5>
                        </div>
                        <div class="card-body">
                            <canvas id="coachCouplesChart" height="300"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-header bg-soft-danger">
                            <h5 class="mb-0"><i class="bi bi-graph-up me-2"></i>Activité mensuelle</h5>
                        </div>
                        <div class="card-body">
                            <canvas id="coachMonthlyChart" height="300"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Onglet 4 : Événements --}}
        <div class="tab-pane fade" id="dot_mariage" role="tabpanel">
            <div class="row g-4">
                @foreach([
                    ['Dots', 'bi-gem', 'primary', $totalDotsPasse, $dotsEn2025, $dotsFuturs],
                    ['Mariages', 'bi-heart', 'danger', $totalMariagesPasse, $mariagesEn2025, $mariagesFuturs],
                    ['Bénédictions', 'bi-stars', 'warning', $totalBenedictionsPasse, $benedictionsEn2025, $benedictionsFutures]
                ] as [$title, $icon, $color, $past, $current, $future])
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-header bg-soft-{{ $color }}">
                            <h5 class="mb-0"><i class="bi {{ $icon }} me-2"></i>{{ $title }}</h5>
                        </div>
                        <div class="card-body">
                            <div class="d-flex flex-column h-100">
                                <div class="mb-4">
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="icon-lg bg-soft-{{ $color }} text-{{ $color }} rounded-circle me-3">
                                            <i class="bi bi-calendar-check"></i>
                                        </div>
                                        <div>
                                            <h2 class="mb-0">{{ $current }}</h2>
                                            <small class="text-muted">Cette année</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-auto">
                                    <div class="row text-center">
                                        <div class="col-4 border-end">
                                            <h4 class="mb-1">{{ $past }}</h4>
                                            <small class="text-muted">Passés</small>
                                        </div>
                                        <div class="col-4 border-end">
                                            <h4 class="mb-1">{{ $current }}</h4>
                                            <small class="text-muted">2025</small>
                                        </div>
                                        <div class="col-4">
                                            <h4 class="mb-1 text-{{ $color }}">{{ $future }}</h4>
                                            <small class="text-muted">À venir</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
    .hover-scale {
        transition: transform 0.3s ease;
    }
    .hover-scale:hover {
        transform: translateY(-5px);
    }
    .icon-lg {
        width: 50px;
        height: 50px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
    }
    .bg-soft-primary { background-color: rgba(13, 110, 253, 0.1); }
    .bg-soft-success { background-color: rgba(25, 135, 84, 0.1); }
    .bg-soft-warning { background-color: rgba(255, 193, 7, 0.1); }
    .bg-soft-danger { background-color: rgba(220, 53, 69, 0.1); }
    .bg-soft-info { background-color: rgba(13, 202, 240, 0.1); }
    .bg-soft-dark { background-color: rgba(33, 37, 41, 0.1); }
    .nav-pills .nav-link.active {
        background-color: #6c757d;
        color: white;
        box-shadow: 0 4px 6px rgba(0,0,0,0.1);
    }
    .nav-pills .nav-link {
        color: #495057;
        font-weight: 500;
    }
</style>
@endsection

{{--@section('scripts')--}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', () => {
    // Chart configurations with improved styling
    const chartOptions = {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                position: 'bottom',
                labels: {
                    padding: 20,
                    usePointStyle: true,
                    pointStyle: 'circle'
                }
            }
        }
    };

    // Etape Chart
    new Chart(document.getElementById('etapeChart'), {
        type: 'doughnut',
        data: {
            labels: {!! json_encode($etapeData->keys()) !!},
            datasets: [{
                data: {!! json_encode($etapeData->values()) !!},
                backgroundColor: ['#0d6efd', '#198754', '#ffc107', '#dc3545', '#6c757d'],
                borderWidth: 0
            }]
        },
        options: {
            ...chartOptions,
            cutout: '70%'
        }
    });

    // Défis Chart
    new Chart(document.getElementById('defisChart'), {
        type: 'pie',
        data: {
            labels: {!! json_encode($defisData->keys()) !!},
            datasets: [{
                data: {!! json_encode($defisData->values()) !!},
                backgroundColor: ['#6610f2', '#20c997', '#fd7e14', '#0dcaf0', '#adb5bd'],
                borderWidth: 0
            }]
        },
        options: {
            ...chartOptions,
            plugins: {
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            const label = context.label || '';
                            const value = context.raw || 0;
                            const total = context.dataset.data.reduce((a, b) => a + b, 0);
                            const percentage = Math.round((value / total) * 100);
                            return `${label}: ${value} (${percentage}%)`;
                        }
                    }
                }
            }
        }
    });

    // Durée Chart
    new Chart(document.getElementById('dureeChart'), {
        type: 'bar',
        data: {
            labels: {!! json_encode(array_keys($dureeData)) !!},
            datasets: [{
                label: 'Nombre de couples',
                data: {!! json_encode(array_values($dureeData)) !!},
                backgroundColor: '#0d6efd',
                borderRadius: 6
            }]
        },
        options: {
            ...chartOptions,
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        drawBorder: false
                    }
                },
                x: {
                    grid: {
                        display: false
                    }
                }
            },
            plugins: {
                legend: {
                    display: false
                }
            }
        }
    });

    // Coach Couples Chart
    new Chart(document.getElementById('coachCouplesChart'), {
        type: 'bar',
        data: {
            labels: {!! json_encode($coachCouples->keys()) !!},
            datasets: [{
                label: 'Fiançailles encadrées',
                data: {!! json_encode($coachCouples->values()) !!},
                backgroundColor: '#ffc107',
                borderRadius: 6
            }]
        },
        options: {
            ...chartOptions,
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        drawBorder: false
                    }
                },
                x: {
                    grid: {
                        display: false
                    }
                }
            },
            plugins: {
                legend: {
                    display: false
                }
            }
        }
    });

    // Monthly Activity Chart
    const monthlyCoachStats = @json($monthlyCoachStats);
    const months = Object.keys(monthlyCoachStats);
    const coaches = [...new Set(Object.values(monthlyCoachStats).flatMap(stats => Object.keys(stats)))];

    const datasets = coaches.map((coach, i) => ({
        label: coach,
        data: months.map(month => monthlyCoachStats[month][coach] ?? 0),
        backgroundColor: `hsl(${i * 45 % 360}, 70%, 60%)`,
        borderRadius: 6
    }));

    new Chart(document.getElementById('coachMonthlyChart'), {
        type: 'bar',
        data: {
            labels: months,
            datasets
        },
        options: {
            ...chartOptions,
            scales: {
                x: {
                    stacked: true,
                    grid: {
                        display: false
                    }
                },
                y: {
                    stacked: true,
                    beginAtZero: true,
                    grid: {
                        drawBorder: false
                    }
                }
            },
            plugins: {
                title: {
                    display: true,
                    text: 'Séances mensuelles par coach',
                    padding: {
                        bottom: 20
                    }
                }
            }
        }
    });
});
</script>
{{--@endsection--}}