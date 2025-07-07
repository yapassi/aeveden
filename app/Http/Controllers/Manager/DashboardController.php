<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\Fiancailles;
use App\Models\Coaching;
use App\Models\Rapport;
use App\Models\CoupleCoach;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // === [ Onglet 1 : Statistiques générales ] ===

        $totalFiancailles = Fiancailles::count();
        $totalCoachingsEnCours = Coaching::where('statut', 'actif')->count();
        $totalCoachingsPause = Coaching::where('statut', 'en_pause')->count();
        $totalCouplesCoach = CoupleCoach::count();

        $longestCoachings = Coaching::whereNotNull('date_debut')
            ->where('statut', 'actif')
            ->with('fiancailles.fiance', 'fiancailles.fiancee')
            ->get()
            ->map(function ($coaching) {
                // Calcul de la durée en jours (jusqu'à aujourd'hui si date_fin est null)
                $endDate = $coaching->date_fin ?? now();
                $duree = $coaching->date_debut->diff($endDate);
                $coaching->duree_mois = $duree->m;
                $coaching->duree_annee = $duree->y;
                $coaching->duree_jours = $coaching->date_debut->diffInDays($endDate);
                $coaching->duree_annees_mois = $coaching->duree_annee . ' an(s) et ' . $coaching->duree_mois . ' mois';
                return $coaching;
            })
            ->filter(function ($coaching) {
                // Filtrer ceux qui durent plus de 12 mois (365 jours)
                return $coaching->duree_jours > 365;
            })
            ->sortByDesc('duree_jours');
            
        $coachingsEnPause = Coaching::where('statut', 'en_pause')
            ->with('fiancailles.fiance', 'fiancailles.fiancee')
            ->latest('updated_at')
            ->get();

        $defisCounts = Rapport::pluck('defis_couple')
            ->flatten()
            ->filter()
            ->countBy();

        $totalDefis = $defisCounts->sum(); // Total de tous les défis

        $topDefis = $defisCounts
            ->sortDesc()
            ->take(5)
            ->map(function ($count) use ($totalDefis) {
                return [
                    'count' => $count,
                    'percentage' => round(($count / $totalDefis) * 100, 2) // Pourcentage avec 2 décimales
                ];
            });

        $totalCoachs = User::where('role', 'coach')->count();
        $totalManagers = User::where('role', 'manager')->count();
        $totalAdmins = User::where('role', 'admin')->count();

        // === [ Onglet 2 : Répartition des fiançailles ] ===

        $etapeData = Fiancailles::groupBy('etape')
            ->select('etape', DB::raw('count(*) as total'))
            ->pluck('total', 'etape');

        $defisData = Rapport::pluck('defis_couple')
            ->flatten()
            ->filter()
            ->countBy()
            ->sortDesc()
            ->take(10);

        $dureeData = [
            'Moins de 3 mois' => 0,
            '3 à 6 mois' => 0,
            '6 à 12 mois' => 0,
            'Plus de 12 mois' => 0,
        ];

        Coaching::whereNotNull('date_debut')->get()->each(function ($c) use (&$dureeData) {
            $debut = $c->date_debut;
            $fin = $c->date_fin ?? now();
            $diff = $debut->diffInMonths($fin);

            if ($diff < 3) {
                $dureeData['Moins de 3 mois']++;
            } elseif ($diff < 6) {
                $dureeData['3 à 6 mois']++;
            } elseif ($diff < 12) {
                $dureeData['6 à 12 mois']++;
            } else {
                $dureeData['Plus de 12 mois']++;
            }
        });

        // === [ Onglet 3 : Activités des coaches ] ===

        // 1. Répartition des couples de coaches par nombre de fiançailles encadrées
        $coachingCountsByCouple = Coaching::select('couple_coach_id', DB::raw('count(*) as total'))
            ->groupBy('couple_coach_id')
            ->pluck('total', 'couple_coach_id');

        $coachCouples = CoupleCoach::with('coachHomme', 'coachFemme')->get()->mapWithKeys(function ($c) use ($coachingCountsByCouple) {
            $label = 'couple'.$c->coachHomme->nom ;
            $total = $coachingCountsByCouple[$c->id] ?? 0;
            return [$label => $total];
        });

        $coachCouples2 = CoupleCoach::with('coachHomme', 'coachFemme')->get();

        //dd($coachCouples2);

        // 2. Diagramme en bâton : activité des coaches (nombre moyen de séances/mois)
        $monthlyCoachStats = [];

        Rapport::with('coaching.coupleCoach')->get()->each(function ($r) use (&$monthlyCoachStats) {
            $mois = Carbon::parse($r->created_at)->format('Y-m');
            $coach = $r->coaching->coupleCoach->coachHomme->prenom ?? 'Coach';

            $monthlyCoachStats[$mois][$coach] = ($monthlyCoachStats[$mois][$coach] ?? 0) + $r->nombre_seances;
        });

        foreach ($monthlyCoachStats as $mois => $coachs) {
            foreach ($coachs as $nom => $total) {
                $monthlyCoachStats[$mois][$nom] = round($total, 1);
            }
        }

        // === [ Onglet 4:  Dots et Mariages ] ===
        $today = Carbon::today();
        $year = 2025;

        // Événements passés
        $totalDotsPasse = Fiancailles::whereNotNull('date_dot')->where('date_dot', '<=', $today)->count();
        $dotsEn2025 = Fiancailles::whereYear('date_dot', $year)->where('date_dot', '<=', $today)->count();

        $totalMariagesPasse = Fiancailles::whereNotNull('date_mariage')->where('date_mariage', '<=', $today)->count();
        $mariagesEn2025 = Fiancailles::whereYear('date_mariage', $year)->where('date_mariage', '<=', $today)->count();

        $totalBenedictionsPasse = Fiancailles::whereNotNull('date_benediction')->where('date_benediction', '<=', $today)->count();
        $benedictionsEn2025 = Fiancailles::whereYear('date_benediction', $year)->where('date_benediction', '<=', $today)->count();

        // Événements à venir
        $dotsFuturs = Fiancailles::whereNotNull('date_dot')->where('date_dot', '>', $today)->count();
        $mariagesFuturs = Fiancailles::whereNotNull('date_mariage')->where('date_mariage', '>', $today)->count();
        $benedictionsFutures = Fiancailles::whereNotNull('date_benediction')->where('date_benediction', '>', $today)->count();

        //dd($dotsFuturs);

        return view('manager.dashboard', compact(
            // Onglet 1
            'totalFiancailles', 'totalCoachingsEnCours', 'totalCoachingsPause',
            'totalCouplesCoach', 'longestCoachings', 'coachingsEnPause', 'topDefis',
            'totalCoachs', 'totalManagers', 'totalAdmins',

            // Onglet 2
            'etapeData', 'defisData', 'dureeData',

            // Onglet 3
            'coachCouples', 'monthlyCoachStats',
            'coachingCountsByCouple',

            // Onglet 4
            'totalDotsPasse', 'dotsEn2025', 'totalMariagesPasse', 'mariagesEn2025',
            'totalBenedictionsPasse', 'benedictionsEn2025', 'dotsFuturs', 'mariagesFuturs', 'benedictionsFutures'   
        ));
    }
}
