<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Eleve;
use App\Models\Enseignant;
use Illuminate\Support\Str;
use PDF;


class AdminController extends Controller
{
    public function showLogin()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'code' => 'required'
        ]);

        if ($request->email === 'tekorolandafandjo94@gmail.com' && $request->code === 'rol2002@') {
            session(['admin' => true]);
            return redirect()->route('admin.dashboard');
        }

        return back()->withErrors(['email' => 'Identifiants incorrects']);
    }

    public function dashboard()
    {
        if (!session('admin')) {
            return redirect()->route('admin.login');
        }

        $eleves = Eleve::orderBy('classe')->orderBy('nom')->get();
        $enseignants = Enseignant::orderBy('nom')->get();

        return view('admin.dashboard', compact('eleves', 'enseignants'));
    }
    public function enseignants()
    {
    $enseignants = Enseignant::all();
    return view('enseignants.create', compact('enseignants'));
    }

    public function showAjoutForm() {
        return view('admin.ajouter');
    }

    public function ajouterEleve(Request $request) {
        Eleve::create($request->all());
        return redirect()->route('admin.dashboard');
    }

    public function ajouterEnseignant(Request $request) {
        Enseignant::create($request->all());
        return redirect()->route('admin.dashboard');
    }

    public function showEditForm($type, $id) {
        $item = $type === 'eleve' ? Eleve::findOrFail($id) : Enseignant::findOrFail($id);
        return view('admin.modifier', compact('item', 'type'));
    }

    public function update(Request $request, $type, $id) {
        $model = $type === 'eleve' ? Eleve::class : Enseignant::class;
        $model::findOrFail($id)->update($request->all());
        return redirect()->route('admin.dashboard');
    }

    public function delete($type, $id) {
        $model = $type === 'eleve' ? Eleve::class : Enseignant::class;
        $model::destroy($id);
        return redirect()->route('admin.dashboard');
    }
    public function createEleve()
    {
    return view('eleves.step1');
    }
    public function storeEleve(Request $request)
{
    $request->validate([
        'nom' => 'required|string',
        'prenom' => 'required|string',
        'date_naissance' => 'required|date',
        'lieu_naissance' => 'required|string',
        'age' => 'required|integer',
        'classe' => 'required|string',
        'etablissement_prevenance' => 'required|string',
    ]);

    // Génère le code d'accès
    $codeAcces = strtoupper(Str::random(8));

    // Crée l'élève en base
    $eleve = Eleve::create([
        'nom' => $request->nom,
        'prenom' => $request->prenom,
        'date_naissance' => $request->date_naissance,
        'lieu_naissance' => $request->lieu_naissance,
        'age' => $request->age,
        'classe' => $request->classe,
        'etablissement_prevenance' => $request->etablissement_prevenance,
        'code_acces' => $codeAcces,
    ]);

    // Redirige vers la page dashboard avec le message du code d'accès
    return redirect()->route('admin.dashboard')->with('success', "Élève ajouté avec succès. Code d'accès : $codeAcces");
    }
    public function editEleve($id)
    {
        $eleve = Eleve::findOrFail($id);
        return view('admin.eleves.edit', compact('eleve'));
    }
    public function updateEleve(Request $request, $id)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'date_naissance' => 'nullable|date',
            'lieu_naissance' => 'nullable|string|max:255',
            'age' => 'nullable|integer',
            'classe' => 'required|string|max:255',
            'etablissement_prevenance' => 'nullable|string|max:255',
        ]);

        $eleve = Eleve::findOrFail($id);

        $eleve->update($request->all());

        return redirect()->route('admin.dashboard')->with('success', 'Élève modifié avec succès.');
    }
    public function destroyEleve($id)
    {
        $eleve = Eleve::findOrFail($id);
        $eleve->delete();

        return redirect()->route('admin.dashboard')->with('success', 'Élève supprimé avec succès.');
    }
    public function destroyEnseignant($id)
    {
        $enseignant = Enseignant::findOrFail($id);
        $enseignant->delete();

        return redirect()->route('admin.dashboard')->with('success', 'Enseignant supprimé avec succès.');
    }
    public function editEnseignant($id)
{
    $enseignant = Enseignant::findOrFail($id);
    return view('admin.enseignants.edit', compact('enseignant'));
}

public function updateEnseignant(Request $request, $id)
{
    $request->validate([
        'nom' => 'required',
        'prenoms' => 'required',
        'email' => 'required|email',
        'matiere' => 'required',
        'telephone' => 'required',
    ]);

    $enseignant = Enseignant::findOrFail($id);
    $enseignant->update($request->all());

    return redirect()->route('admin.dashboard')->with('success', 'Enseignant modifié avec succès.');
}
    public function createEnseignant()
{
    return view('admin.enseignants.create');
}
public function storeEnseignant(Request $request)
{
    $request->validate([
        'nom' => 'required',
        'prenoms' => 'required',
        'email' => 'required|email|unique:enseignants',
        'matiere' => 'required',
        'telephone' => 'required',
    ]);

    Enseignant::create([
        'nom' => $request->nom,
        'prenoms' => $request->prenoms,
        'email' => $request->email,
        'matiere' => $request->matiere,
        'telephone' => $request->telephone,
        'code' => strtoupper(Str::random(8)),
    ]);

    return redirect()->route('admin.dashboard')->with('success', 'Enseignant ajouté avec succès.');
}

public function telechargerListeClasse($classe)
{
    $eleves = Eleve::where('classe', $classe)->orderBy('nom')->get();

    $pdf = PDF::loadView('admin.pdf_classe', compact('eleves', 'classe'));

    return $pdf->download("liste_{$classe}.pdf");
}
public function telechargerEnseignants()
{
    $enseignants = Enseignant::orderBy('nom')->get();

    $pdf = PDF::loadView('admin.pdf_enseignants', compact('enseignants'));

    return $pdf->download('liste_enseignants.pdf');
}
}
