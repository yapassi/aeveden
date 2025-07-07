<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Faire-part de fiançailles</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; }
        .avatar { width: 100px; height: 100px; border-radius: 50%; object-fit: cover; border: 2px solid #ccc; }
        .section-title { text-align: center; margin: 20px 0 10px 0; font-size: 1.3em; }
        .table-infos { width: 100%; margin-bottom: 20px; }
        .table-infos td { padding: 6px 10px; vertical-align: top; }
        .timeline { border-left: 3px solid #0d6efd; margin-left: 1.5rem; padding-left: 1.5rem; }
        .timeline-item { margin-bottom: 18px; }
        .badge { display: inline-block; padding: 0.4em 0.8em; border-radius: 0.5em; color: #fff; font-size: 0.95em; }
        .bg-info { background: #0dcaf0; }
        .bg-success { background: #198754; }
        .bg-warning { background: #ffc107; color: #333; }
    </style>
</head>
<body>
    <h2 class="section-title">Faire-part de fiançailles</h2>
    <table class="table-infos" border="0">
        <tr>
            <td align="center">
                <img src="{{ public_path('images/default-male.png') }}" class="avatar" alt="Photo fiancé"><br>
                <strong>{{ $fiancailles->fiance->prenoms ?? '' }}</strong><br>
                <span style="color:#888;">{{ $fiancailles->fiance->nom ?? '' }}</span>
            </td>
            <td align="center" style="font-size:2.5em; color:#dc3545;">&hearts;</td>
            <td align="center">
                <img src="{{ public_path('images/default-female.png') }}" class="avatar" alt="Photo fiancée"><br>
                <strong>{{ $fiancailles->fiancee->prenoms ?? '' }}</strong><br>
                <span style="color:#888;">{{ $fiancailles->fiancee->nom ?? '' }}</span>
            </td>
        </tr>
        <tr>
            <td>
                <strong>Nom :</strong> {{ $fiancailles->fiance->nom ?? '-' }}<br>
                <strong>Prénoms :</strong> {{ $fiancailles->fiance->prenoms ?? '-' }}<br>
                <strong>Église :</strong> {{ $fiancailles->fiance->eglise ?? '-' }}<br>
                <strong>Département :</strong> {{ $fiancailles->fiance->departement ?? '-' }}<br>
                <strong>Tribu :</strong> {{ $fiancailles->fiance->tribu ?? '-' }}<br>
                <strong>Téléphone :</strong> {{ $fiancailles->fiance->contact ?? '-' }}
            </td>
            <td></td>
            <td>
                <strong>Nom :</strong> {{ $fiancailles->fiancee->nom ?? '-' }}<br>
                <strong>Prénoms :</strong> {{ $fiancailles->fiancee->prenoms ?? '-' }}<br>
                <strong>Église :</strong> {{ $fiancailles->fiancee->eglise ?? '-' }}<br>
                <strong>Département :</strong> {{ $fiancailles->fiancee->departement ?? '-' }}<br>
                <strong>Tribu :</strong> {{ $fiancailles->fiancee->tribu ?? '-' }}<br>
                <strong>Téléphone :</strong> {{ $fiancailles->fiancee->contact ?? '-' }}
            </td>
        </tr>
    </table>
    <h3 class="section-title">Événements</h3>
    <div class="timeline">
        @forelse($events as $event)
            <div class="timeline-item">
                <span class="badge bg-{{ $event['badge'] }}">{{ $event['type'] }}</span><br>
                <span><strong>Date :</strong> {{ \Carbon\Carbon::parse($event['date'])->format('d/m/Y') }}</span><br>
                @if($event['location'])
                    <span><strong>Lieu :</strong> {{ $event['location'] }}</span>
                @endif
            </div>
        @empty
            <div>Aucun événement renseigné.</div>
        @endforelse
    </div>
</body>
</html>