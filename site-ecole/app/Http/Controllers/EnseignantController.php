<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Enseignant;
use Illuminate\Support\Str;
use App\Models\Eleve;
use App\Models\Note;



class EnseignantController extends Controller
{
    public function create()
    {
    return view('enseignants.create');
    }

    public function store(Request $request)
    {
    $request->validate([
        'nom' => 'required',
        'prenoms' => 'required',
        'email' => 'required|email|unique:enseignants,email',
        'matiere' => 'required',
        'telephone' => 'required',
    ]);

    $code = strtoupper(Str::random(8)); // Génère un code aléatoire

    Enseignant::create([
        'nom' => $request->nom,
        'prenoms' => $request->prenom,
        'email' => $request->email,
        'matiere' => $request->matiere,
        'telephone' => $request->telephone,
        'code' => $code
    ]);

    return redirect()->route('enseignants.login')->with('success', 'Inscription réussie. Votre code est : ' . $code);
    }

    public function loginForm()
    {
    return view('enseignants.login');
    }

    public function login(Request $request)
    {
    $request->validate([
        'email' => 'required|email',
        'code' => 'required'
    ]);

    // Vérification des identifiants fixes
    if (
        $request->email === 'tekorolandafandjo9@gmail.com' &&
        $request->code === 'rol2002@'
    ) {
        return redirect()->route('enseignants.dashboard')->with('success', 'Connexion réussie.');
    }

    return back()->withErrors(['email' => 'Identifiants incorrects']);
    }
       public function dashboard()
{
    $enseignant = Enseignant::first(); // Ou l’enseignant connecté

    // Récupère les élèves avec leurs notes, groupés par classe
    $eleves = Eleve::with('notes')
        ->orderBy('classe')
        ->orderBy('nom')
        ->get()
        ->groupBy('classe');  // groupBy crée un tableau [classe => Collection d'élèves]

    return view('enseignants.dashboard', compact('enseignant', 'eleves'));
}

public function storeNote(Request $request)
{
    $request->validate([
        'eleve_id' => 'required|exists:eleves,id',
        'enseignant_id' => 'required|exists:enseignants,id',
        'interrogation_1' => 'nullable|numeric',
        'interrogation_2' => 'nullable|numeric',
        'interrogation_3' => 'nullable|numeric',
        'devoir' => 'nullable|numeric',
        'composition' => 'nullable|numeric',
    ]);

            Note::updateOrCreate(
        [
            'eleve_id' => $request->eleve_id,
            'enseignant_id' => $request->enseignant_id
        ],
        [
            'interrogation_1' => $request->interrogation_1,
            'interrogation_2' => $request->interrogation_2,
            'interrogation_3' => $request->interrogation_3,
            'devoir' => $request->devoir,
            'composition' => $request->composition
        ]
    );

    return back()->with('success', 'Note enregistrée avec succès.');
}
}
