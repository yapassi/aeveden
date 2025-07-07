<?php

namespace App\Http\Controllers;

use App\Models\Fiancailles;
use Illuminate\Http\Request;
use Carbon\Carbon;

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

        return view('admin.evenements.index', compact('upcomingEvents', 'pastEvents'));
    }

    private function addEvent($fiance, $title, $date, $location, $type, $today, &$upcomingEvents, &$pastEvents)
    {
        $event = [
            'title' => $title,
            'date' => $date,
            'location' => $location,
            'type' => $type,
            'couple' => $fiance->fiance->nom . ' & ' . $fiance->fiancee->nom,
            'badge_class' => $this->getBadgeClass($type)
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
}