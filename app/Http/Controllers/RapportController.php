<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Rapport;

class RapportController extends Controller
{
    public function index()
    {
        $rapports = Rapport::with('coaching.fiancaille', 'coaching.coupleCoach')->latest()->get();
        return view('admin.rapports.index', compact('rapports'));
    }
}
