<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Eleve;

class EnseignantDashboardController extends Controller
{
    public function index()
{
    $enseignant = auth()->user(); // Si l'enseignant est authentifié
    $eleves = Eleve::orderBy('classe')->orderBy('nom')->get()->groupBy('classe');
    return view('enseignants.dashboard', compact('enseignant', 'eleves'));
}

}
