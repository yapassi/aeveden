<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\Fiance;
use App\Models\Fiancailles;
use Illuminate\Http\Request;

class FiancailleController extends Controller
{
    public function index()
    {
        $fiancailles = Fiancailles::with(['fiance', 'fiancee'])
            ->orderBy('date_debut', 'desc')
            ->paginate(10);

        return view('manager.fiancailles.index', compact('fiancailles'));
    }

    public function show($id)
    {
        $fiancailles = Fiancailles::with([
            'fiance', 
            'fiancee',
            'coaching.coupleCoach.coachHomme',
            'coaching.coupleCoach.coachFemme'
        ])->findOrFail($id);

        return view('manager.fiancailles.show', compact('fiancailles'));
    }
}
