<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NoteController extends Controller
{
    public function store(Request $request)
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

    $note = \App\Models\Note::updateOrCreate(
        [
            'eleve_id' => $request->eleve_id,
            'enseignant_id' => $request->enseignant_id,
        ],
        [
            'interrogation_1' => $request->interrogation_1,
            'interrogation_2' => $request->interrogation_2,
            'interrogation_3' => $request->interrogation_3,
            'devoir' => $request->devoir,
            'composition' => $request->composition,
        ]
    );

    return back()->with('success', 'Notes enregistrées avec succès.');
}

}
