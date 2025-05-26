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
                            <th>Enseignant</th>
                            <th>Int. 1</th>
                            <th>Int. 2</th>
                            <th>Int. 3</th>
                            <th>Devoir</th>
                            <th>Composition</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($eleve->notes as $note)
                            <tr>
                                <td>{{ $note->enseignant->matiere ?? 'N/A' }}</td>
                                <td>{{ $note->enseignant->nom ?? '' }} {{ $note->enseignant->prenoms ?? '' }}</td>
                                <td>{{ $note->interrogation_1 }}</td>
                                <td>{{ $note->interrogation_2 }}</td>
                                <td>{{ $note->interrogation_3 }}</td>
                                <td>{{ $note->devoir }}</td>
                                <td>{{ $note->composition }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
        <div class="text-center my-4">
    <h3>Votre moyenne trimestrielle est :</h3>
    <h1 class="text-4xl font-bold">{{ $eleve->moyenne ?? 'Non disponible' }}/20</h1>

    @if($eleve->moyenne !== null)
        @if($eleve->moyenne >= 10)
            <div class="flex flex-col items-center mt-4">
                <div class="w-16 h-16 rounded-full bg-green-500"></div>
                <span class="text-green-700 font-semibold mt-2">Réussite</span>
            </div>
        @elseif($eleve->moyenne <= 9)
            <div class="flex flex-col items-center mt-4">
                <div class="w-16 h-16 rounded-full bg-red-500"></div>
                <span class="text-red-700 font-semibold mt-2">Échec</span>
            </div>
        @endif
    @endif
</div>

    <a href="{{ route('eleves.deconnexion') }}" class="btn btn-danger mt-3">Se déconnecter</a>
@endsection
