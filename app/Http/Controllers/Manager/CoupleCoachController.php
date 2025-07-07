<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\CoupleCoach;
use App\Models\User;
use Illuminate\Http\Request;

class CoupleCoachController extends Controller
{
    public function index()
    {
        $couples = CoupleCoach::with(['coachHomme', 'coachFemme'])->paginate(5);
        return view('manager.couple-coaches.index', compact('couples'));
    }

    public function show(CoupleCoach $coupleCoach)
    {
        return view('manager.couple-coaches.show', compact('coupleCoach'));
    }
}
