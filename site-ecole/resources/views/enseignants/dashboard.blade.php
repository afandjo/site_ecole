@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1>Tableau de Bord Enseignant</h1>
    <h2 class="mb-4">Bienvenue {{ $enseignant->prenoms }} {{ $enseignant->nom }} ({{ $enseignant->matiere }})</h2>

    @foreach($eleves as $classe => $listeEleves)
        <h4 class="mt-4 text-primary">Classe : {{ $classe }}</h4>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Prénoms</th>
                    <th>Interrogation 1</th>
                    <th>Interrogation 2</th>
                    <th>Interrogation 3</th>
                    <th>Devoir</th>
                    <th>Composition</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($listeEleves as $eleve)
                    @php
                        $note = $eleve->notes->where('enseignant_id', $enseignant->id)->first();
                    @endphp
                    <tr>
                        <form action="{{ route('enseignants.notes.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="eleve_id" value="{{ $eleve->id }}">
                            <input type="hidden" name="enseignant_id" value="{{ $enseignant->id }}">
                            <td>{{ $eleve->nom }}</td>
                            <td>{{ $eleve->prenom }}</td>
                            <td><input type="number" step="0.01" name="interrogation_1" class="form-control" value="{{ $note->interrogation_1 ?? '' }}"></td>
                            <td><input type="number" step="0.01" name="interrogation_2" class="form-control" value="{{ $note->interrogation_2 ?? '' }}"></td>
                            <td><input type="number" step="0.01" name="interrogation_3" class="form-control" value="{{ $note->interrogation_3 ?? '' }}"></td>
                            <td><input type="number" step="0.01" name="devoir" class="form-control" value="{{ $note->devoir ?? '' }}"></td>
                            <td><input type="number" step="0.01" name="composition" class="form-control" value="{{ $note->composition ?? '' }}"></td>
                            <td><button type="submit" class="btn btn-success btn-sm">Enregistrer</button></td>
                        </form>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endforeach
</div>
@endsection
