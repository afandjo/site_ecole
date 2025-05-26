<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Enseignant;
use Illuminate\Support\Str;
use App\Models\Eleve;
use App\Models\Note;
use Illuminate\Support\Facades\Mail;




class EnseignantController extends Controller
{
    public function create()
    {
    return view('enseignants.create');
    }

    public function store(Request $request)
    {
    $request->validate([
        'nom' => 'required|string',
        'prenoms' => 'required|string',
        'email' => 'required|email|unique:enseignants,email',
        'matiere' => 'required|string',
        'telephone' => 'required|string',
    ]);

    $code = strtoupper(Str::random(8)); // Génère un code aléatoire

    Enseignant::create([
        'nom' => $request->nom,
        'prenoms' => $request->prenoms,
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

    // Vérifie que l'email et le code correspondent dans la BDD
    $enseignant = Enseignant::where('email', $request->email)
                            ->where('code', $request->code)
                            ->first();

    if ($enseignant) {
        // Authentifier l'enseignant (session)
        session(['enseignant_id' => $enseignant->id]);

        return redirect()->route('enseignants.dashboard')->with('success', 'Connexion réussie.');
    }

    return back()->withErrors([
        'email' => 'Identifiants incorrects.',
    ]);
}

       public function dashboard()
{
    // ✅ Récupère l’enseignant connecté via l’ID stocké dans la session
    $enseignant = Enseignant::find(session('enseignant_id'));

    // ✅ Récupère uniquement les notes de cet enseignant
    $eleves = Eleve::with(['notes' => function ($query) use ($enseignant) {
        $query->where('enseignant_id', $enseignant->id);
    }])
    ->orderBy('classe')
    ->orderBy('nom')
    ->get()
    ->groupBy('classe');

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

    // Enregistrer ou mettre à jour la note
    $note = Note::updateOrCreate(
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

    // Recalcul de la moyenne par matière
    $notes = Note::where('eleve_id', $request->eleve_id)->get();

    $sommeMatieres = 0;
    $nbMatieres = 0;

    foreach ($notes as $n) {
        $moyenneMatiere = ((($n->interrogation_1 + $n->interrogation_2 + $n->interrogation_3 + $n->devoir) / 4) + $n->composition) / 2;
        $sommeMatieres += $moyenneMatiere;
        $nbMatieres++;
    }

    // Récupérer l'élève pour connaître la classe
    $eleve = \App\Models\Eleve::find($request->eleve_id);

    // Déterminer le diviseur en fonction de la classe
    if (in_array($eleve->classe, ['6ème', '5ème'])) {
        $diviseur = 9;
    } elseif (in_array($eleve->classe, ['4ème', '3ème'])) {
        $diviseur = 18;
    } else {
        $diviseur = max(1, $nbMatieres); // fallback pour éviter division par 0
    }

    // Calcul de la moyenne générale
    $moyenneGenerale = round($sommeMatieres / $diviseur, 2);

    // Enregistrement dans la colonne "moyenne" de l’élève
    $eleve->moyenne = $moyenneGenerale;
    $eleve->save();

    return back()->with('success', 'Note enregistrée et moyenne mise à jour.');
}

        public function logo()
    {
    return view('enseignants.login');
    }
        public function valider($id)
{
    $enseignant = Enseignant::findOrFail($id);

    if ($enseignant->est_valide) {
        return back()->with('info', 'Cet enseignant est déjà validé.');
    }

    $enseignant->est_valide = true;
    $enseignant->save();

    // Envoie de l’email avec le code
    Mail::to($enseignant->email)->send(new \App\Mail\CodeConnexionEnseignant($enseignant));

    return back()->with('success', 'L’enseignant a été validé et le code a été envoyé.');
}

}

