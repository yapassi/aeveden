<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\Fiance;
use Illuminate\Http\Request;

class FianceController extends Controller
{
    public function index()
    {
        $fiances = Fiance::orderBy('nom')->orderBy('prenoms')->paginate(15);
        return view('manager.fiances.index', compact('fiances'));
    }

    public function show($id)
    {
        $fiance = Fiance::findOrFail($id);
        return view('manager.fiances.show', compact('fiance'));
    }
}
