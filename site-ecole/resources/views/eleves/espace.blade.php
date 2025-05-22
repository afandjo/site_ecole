@extends('layouts.app')

@section('content')
    <h1>Espace Élève</h1>
    <h2>Bienvenue {{ $eleve->prenom }} {{ $eleve->nom }}</h2>

    {{-- Informations personnelles --}}
    <div class="card mt-4">
        <div class="card-header">
            Informations personnelles
        </div>
        <div class="card-body">
            <p><strong>Date de naissance :</strong> {{ $eleve->date_naissance }}</p>
            <p><strong>Lieu de naissance :</strong> {{ $eleve->lieu_naissance }}</p>
            <p><strong>Âge :</strong> {{ $eleve->age }} ans</p>
            <p><strong>Classe :</strong> {{ $eleve->classe }}</p>
            <p><strong>Établissement de provenance :</strong> {{ $eleve->etablissement_prevenance }}</p>
            <p><strong>Code d'accès :</strong> {{ $eleve->code_acces }}</p>

            @if($eleve->classe === '6ème')
                <p><strong>Numéro de table CEPD :</strong> {{ $eleve->num_table }}</p>
                <p><strong>Moyenne CEPD :</strong> {{ $eleve->moyenne_cepd }}</p>
            @else
                <p><strong>Moyenne T1 :</strong> {{ $eleve->moyenne_t1 }}</p>
                <p><strong>Moyenne T2 :</strong> {{ $eleve->moyenne_t2 }}</p>
                <p><strong>Moyenne T3 :</strong> {{ $eleve->moyenne_t3 }}</p>
            @endif
        </div>
    </div>

    {{-- Tableau des notes --}}
    <div class="card mt-4">
        <div class="card-header">
            Notes par matière
        </div>
        <div class="card-body">
            @if($eleve->notes->isEmpty())
                <p>Aucune note enregistrée pour le moment.</p>
            @else
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Matière</th>
                            <th>Interrogation 1</th>
                            <th>Interrogation 2</th>
                            <th>Interrogation 3</th>
                            <th>Devoir</th>
                            <th>Composition</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($eleve->notes as $note)
                            <tr>
                                <td>{{ $note->matiere }}</td>
                                <td>{{ $note->interrogation1 }}</td>
                                <td>{{ $note->interrogation2 }}</td>
                                <td>{{ $note->interrogation3 }}</td>
                                <td>{{ $note->devoir }}</td>
                                <td>{{ $note->composition }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>

    <a href="{{ route('eleves.deconnexion') }}" class="btn btn-danger mt-3">Se déconnecter</a>
</div>
@endsection
