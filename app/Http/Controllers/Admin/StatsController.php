<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Fiancailles;
use App\Models\Coaching;
use App\Models\Rapport;
use App\Models\User;
use App\Models\CoupleCoach;
use Carbon\Carbon;

class StatsController extends Controller
{
    public function index()
    {
        $fiancaillesCount = Fiancailles::count();
        $coachingsCount = Coaching::count();
        $rapportsCount = Rapport::count();
        $noteMoyenne = Fiancailles::avg('note');

        $statutsCoachings = Coaching::select('statut')
            ->selectRaw('count(*) as total')
            ->groupBy('statut')
            ->pluck('total', 'statut');

        $vieEnsembleStats = Fiancailles::select('vie_ensemble')
            ->selectRaw('count(*) as total')
            ->groupBy('vie_ensemble')
            ->pluck('total', 'vie_ensemble');

        $etapesStats = Fiancailles::select('etape')
            ->selectRaw('count(*) as total')
            ->groupBy('etape')
            ->pluck('total', 'etape');

        $topFiancailles = Fiancailles::whereNotNull('note')
            ->orderByDesc('note')
            ->take(5)
            ->get();

        $coachingsActifs = Coaching::where('statut', 'actif')
            ->whereDate('date_debut', '<=', now())
            ->where(function ($query) {
                $query->whereNull('date_fin')->orWhere('date_fin', '>=', now());
            })
            ->count();

        $mariagesTotal = Fiancailles::whereNotNull('date_mariage')->count();

        $coachingsParCouple = CoupleCoach::withCount('coachings')
            ->get()
            ->mapWithKeys(function ($cc) {
                $nom = $cc->coachHomme->prenoms . ' & ' . $cc->coachFemme->prenoms;
                return [$nom => $cc->coachings_count];
            });

        $dureeMoyenneCoaching = Coaching::whereNotNull('date_fin')
            ->whereNotNull('date_debut')
            ->get()
            ->map(function ($c) {
                return $c->date_fin->diffInDays($c->date_debut);
            })
            ->avg();

        $fiancaillesCeMois = Fiancailles::whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();

            // Répartition des couples coachs actifs par mois
    $currentYear = now()->year;
    $monthlyCoachStats = [];

    // Récupère tous les couples coachs avec leurs coachings et rapports
    $couples = CoupleCoach::with(['coachings.rapports'])->get();

    foreach (range(1, 12) as $month) {
        $monthName = Carbon::create()->month($month)->format('F');

        foreach ($couples as $couple) {
            $coachingsThisMonth = $couple->coachings->filter(function ($coaching) use ($month, $currentYear) {
                $debut = $coaching->date_debut;
                $fin = $coaching->date_fin ?? now();

                return $debut->year <= $currentYear && $fin->year >= $currentYear &&
                       $debut->month <= $month && $fin->month >= $month;
            });

            $seancesTotal = 0;
            $rapportCount = 0;

            foreach ($coachingsThisMonth as $coaching) {
                foreach ($coaching->rapports as $rapport) {
                    if ($rapport->nombre_seances) {
                        $seancesTotal += $rapport->nombre_seances;
                        $rapportCount++;
                    }
                }
            }

            $coupleName = $couple->coachHomme->prenoms . ' & ' . $couple->coachFemme->prenoms;

            $monthlyCoachStats[$monthName][$coupleName] = $rapportCount > 0
            ? round($seancesTotal / $rapportCount, 1)
            : 0;

        }
    }

        return view('admin.statistiques.index', compact(
            'fiancaillesCount',
            'coachingsCount',
            'rapportsCount',
            'noteMoyenne',
            'statutsCoachings',
            'vieEnsembleStats',
            'etapesStats',
            'topFiancailles',
            'coachingsActifs',
            'mariagesTotal',
            'coachingsParCouple',
            'dureeMoyenneCoaching',
            'fiancaillesCeMois',
            'monthlyCoachStats'
        ));

    }
}