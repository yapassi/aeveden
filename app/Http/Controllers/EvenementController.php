<?php

namespace App\Http\Controllers;

use App\Models\Fiancailles;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

class EvenementController extends Controller
{
    public function index()
    {
        $allFiancailles = Fiancailles::with(['fiance', 'fiancee'])->get();
        
        $upcomingEvents = [];
        $pastEvents = [];
        
        $today = Carbon::today();

        foreach ($allFiancailles as $fiance) {
            // Événements de dot
            if ($fiance->date_dot) {
                $this->addEvent(
                    $fiance,
                    'Dot traditionnelle',
                    $fiance->date_dot,
                    $fiance->lieu_dot,
                    'dot',
                    $today,
                    $upcomingEvents,
                    $pastEvents
                );
            }

            // Événements de mariage
            if ($fiance->date_mariage) {
                $this->addEvent(
                    $fiance,
                    'Mariage',
                    $fiance->date_mariage,
                    $fiance->lieu_mariage,
                    'mariage',
                    $today,
                    $upcomingEvents,
                    $pastEvents
                );
            }

            // Événements de bénédiction
            if ($fiance->date_benediction) {
                $this->addEvent(
                    $fiance,
                    'Bénédiction nuptiale',
                    $fiance->date_benediction,
                    $fiance->lieu_benediction,
                    'benediction',
                    $today,
                    $upcomingEvents,
                    $pastEvents
                );
            }
        }

        // Trier les événements par date
        usort($upcomingEvents, function($a, $b) {
            return $a['date'] <=> $b['date'];
        });

        usort($pastEvents, function($a, $b) {
            return $b['date'] <=> $a['date'];
        });

        return view('evenements.index', compact('upcomingEvents', 'pastEvents'));
    }

    private function addEvent($fiance, $title, $date, $location, $type, $today, &$upcomingEvents, &$pastEvents)
    {
        $event = [
            'title' => $title,
            'date' => $date,
            'location' => $location,
            'type' => $type,
            'couple' => $fiance->fiance->nom . ' & ' . $fiance->fiancee->nom,
            'badge_class' => $this->getBadgeClass($type),
            'fiancailles_id' => $fiance->id
        ];

        if ($date >= $today) {
            $upcomingEvents[] = $event;
        } else {
            $pastEvents[] = $event;
        }
    }

    private function getBadgeClass($type)
    {
        switch ($type) {
            case 'dot':
                return 'info';
            case 'mariage':
                return 'success';
            case 'benediction':
                return 'warning';
            default:
                return 'primary';
        }
    }

    public function show($id)
    {
        $fiancailles = \App\Models\Fiancailles::with(['fiance', 'fiancee'])->findOrFail($id);

        $events = [];
        if ($fiancailles->date_dot) {
            $events[] = [
                'type' => 'Dot traditionnelle',
                'date' => $fiancailles->date_dot,
                'location' => $fiancailles->lieu_dot,
                'badge' => 'info',
            ];
        }
        if ($fiancailles->date_mariage) {
            $events[] = [
                'type' => 'Mariage',
                'date' => $fiancailles->date_mariage,
                'location' => $fiancailles->lieu_mariage,
                'badge' => 'success',
            ];
        }
        if ($fiancailles->date_benediction) {
            $events[] = [
                'type' => 'Bénédiction nuptiale',
                'date' => $fiancailles->date_benediction,
                'location' => $fiancailles->lieu_benediction,
                'badge' => 'warning',
            ];
        }

        return view('evenements.show', compact('fiancailles', 'events'));
    }

    public function exportPdf($id)
    {
        $fiancailles = \App\Models\Fiancailles::with(['fiance', 'fiancee'])->findOrFail($id);
        $events = [];
        if ($fiancailles->date_dot) {
            $events[] = [
                'type' => 'Dot traditionnelle',
                'date' => $fiancailles->date_dot,
                'location' => $fiancailles->lieu_dot,
                'badge' => 'info',
            ];
        }
        if ($fiancailles->date_mariage) {
            $events[] = [
                'type' => 'Mariage',
                'date' => $fiancailles->date_mariage,
                'location' => $fiancailles->lieu_mariage,
                'badge' => 'success',
            ];
        }
        if ($fiancailles->date_benediction) {
            $events[] = [
                'type' => 'Bénédiction nuptiale',
                'date' => $fiancailles->date_benediction,
                'location' => $fiancailles->lieu_benediction,
                'badge' => 'warning',
            ];
        }
        $pdf = Pdf::loadView('evenements.pdf', compact('fiancailles', 'events'));
        return $pdf->download('faire-part-fiancailles-'.$fiancailles->id.'.pdf');
    }
}