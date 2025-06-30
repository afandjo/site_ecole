<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Eleve;
use Illuminate\Support\Str;

class EleveController extends Controller
{
    public function showStep1()
    {
        return view('eleves.step1');
    }

    public function postStep1(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'date_naissance' => 'required|date',
            'lieu_naissance' => 'required|string|max:255',
            'age' => 'required|integer|min:3|max:30',
            'classe' => 'required|in:6ème,5ème,4ème,3ème',
        ]);

        $eleveExiste = Eleve::where('nom', $request->nom)
            ->where('prenom', $request->prenom)
            ->where('date_naissance', $request->date_naissance)
            ->first();

        if ($eleveExiste) {
            return back()->withErrors(['existe' => 'Cet élève est déjà inscrit.']);
        }

        session([
            'etape1' => $request->only([
                'nom', 'prenom', 'date_naissance',
                'lieu_naissance', 'age', 'classe'
            ])
        ]);

        return redirect()->route('eleves.step2');
    }

    public function showStep2()
    {
        $etape1 = session('etape1');
        if (!$etape1) {
            return redirect()->route('eleves.step1');
        }

        return view('eleves.step2', ['classe' => $etape1['classe']]);
    }

    public function postStep2(Request $request)
    {
        $etape1 = session('etape1');
        if (!$etape1) {
            return redirect()->route('eleves.step1');
        }

        if ($etape1['classe'] === '6ème') {
            $request->validate([
                'etablissement_prevenance' => 'required|string|max:255',
                'num_table' => 'required|string|max:50',
                'moyenne_cepd' => 'required|numeric|min:0|max:180',
            ]);
        } else {
            $request->validate([
                'etablissement_prevenance' => 'required|string|max:255',
                'moyenne_t1' => 'required|numeric|min:0|max:20',
                'moyenne_t2' => 'required|numeric|min:0|max:20',
                'moyenne_t3' => 'required|numeric|min:0|max:20',
            ]);
        }

        $code = strtoupper(Str::random(8));

        // Création de l'élève avec les données fusionnées
        $eleve = Eleve::create(array_merge($etape1, $request->all(), [
            'code_acces' => $code
        ]));

        session()->forget('etape1');

        return view('eleves.code', ['code' => $code]);
    }

    public function showConnexionForm()
    {
        return view('eleves.connexion');
    }

    public function connecter(Request $request)
    {
        $request->validate([
            'code_acces' => 'required|string|size:8',
        ]);

        $eleve = Eleve::where('code_acces', $request->code_acces)->first();

        if (!$eleve) {
            return back()->withErrors(['code_acces' => 'Code invalide.']);
        }

        session(['eleve_id' => $eleve->id]);

        return redirect()->route('eleves.espace');
    }

    public function espace()
{
    $eleve = Eleve::with('notes')->find(session('eleve_id'));
        
    if (!$eleve) {
        return redirect()->route('eleves.connexion.form');
    }

    return view('eleves.espace', compact('eleve'));
}


    public function deconnexion()
    {
        session()->forget('eleve_id');
        return redirect()->route('eleves.connexion.form');
    }
    public function dashboard()
{
    $eleve = Eleve::find(session('eleve_id')); // ou Auth::user() si tu utilises auth
    return view('eleves.espace', compact('eleve'));
}

}
