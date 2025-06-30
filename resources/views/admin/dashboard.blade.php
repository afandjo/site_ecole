@extends('layouts.app')

@section('content')
<div class="container mt-5">


    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap">
        <h2>Tableau de bord Administrateur</h2>
        <a href="{{ route('admin.logout') }}" class="btn btn-outline-danger d-flex align-items-center">
            <i class="bi bi-box-arrow-right me-2"></i> Déconnexion
        </a>
    </div>


    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fermer"></button>
        </div>
    @endif


    <div class="mb-4 d-flex flex-wrap gap-2">
    <a href="{{ route('admin.eleves.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Ajouter Élève
    </a>
    <a href="{{ route('admin.enseignants.create') }}" class="btn btn-success">
        <i class="bi bi-plus-circle"></i> Ajouter Enseignant
    </a>
    <a href="{{ route('admin.validations') }}" class="btn btn-danger">
        <i class="bi bi-check-circle"></i> Validation des élèves
    </a>
</div>


    <h4>Liste des Élèves</h4>
    @foreach($eleves->groupBy('classe') as $classe => $classeEleves)
        <h5>Classe : {{ $classe }}</h5>
        <table class="table table-bordered">
            <thead class="table-light">
                <tr>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Code</th>
                    <th>Notes</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($classeEleves as $eleve)
                    <tr>
                        <td>{{ $eleve->nom }}</td>
                        <td>{{ $eleve->prenom }}</td>
                        <td>{{ $eleve->code_acces }}</td>
                        <td>
                            @foreach($eleve->notes as $note)
                                <div class="mb-2">
                                    <strong>Matière :</strong> {{ $note->enseignant->matiere ?? 'N/A' }}<br>
                                    <strong>Enseignant :</strong> {{ $note->enseignant->nom ?? '' }} {{ $note->enseignant->prenoms ?? '' }}

                                    <table class="table table-sm table-bordered mt-1">
                                        <thead class="table-light">
                                            <tr>
                                                <th>Int 1</th>
                                                <th>Int 2</th>
                                                <th>Int 3</th>
                                                <th>Devoir</th>
                                                <th>Composition</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>{{ $note->interrogation_1 }}</td>
                                                <td>{{ $note->interrogation_2 }}</td>
                                                <td>{{ $note->interrogation_3 }}</td>
                                                <td>{{ $note->devoir }}</td>
                                                <td>{{ $note->composition }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            @endforeach
                        </td>
                        <td>
                            <a href="{{ route('admin.eleves.edit', $eleve->id) }}" class="btn btn-warning btn-sm">Modifier</a>
                            <form action="{{ route('admin.eleves.destroy', $eleve->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm" onclick="return confirm('Voulez-vous vraiment supprimer cet élève ?')">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endforeach


    <h4>Liste des Enseignants</h4>
    <table class="table table-bordered">
        <thead class="table-light">
            <tr>
        <th>Nom</th>
        <th>Prénoms</th>
        <th>Email</th>
        <th>Matière</th>
        <th>Téléphone</th>
        <th><strong>Code</strong></th>
        <th>Actions</th>
    </tr>
        </thead>
        <tbody>
            @foreach($enseignants as $enseignant)
                <tr>
                    <td>{{ $enseignant->nom }}</td>
                    <td>{{ $enseignant->prenoms }}</td>
                    <td>{{ $enseignant->email }}</td>
                    <td>{{ $enseignant->matiere }}</td>
                    <td>{{ $enseignant->telephone }}</td>
                    <td>{{ $enseignant->code }}</td>
                    <td class="d-flex flex-wrap gap-1">
    <a href="{{ route('admin.enseignants.edit', $enseignant->id) }}" class="btn btn-warning btn-sm">Modifier</a>

    <form method="POST" action="{{ route('admin.enseignants.destroy', $enseignant->id) }}" style="display:inline;">
        @csrf
        @method('DELETE')
        <button class="btn btn-danger btn-sm" onclick="return confirm('Voulez-vous vraiment supprimer cet enseignant ?')">Supprimer</button>
    </form>

    @if(!$enseignant->est_valide)
        <form method="POST" action="{{ route('admin.enseignants.valider', $enseignant->id) }}" style="display:inline;">
            @csrf
            <button class="btn btn-success btn-sm" onclick="return confirm('Valider cet enseignant ?')">Valider</button>
        </form>
    @else
        <span class="badge bg-success align-self-center">Validé</span>
    @endif
</td>

                </tr>
            @endforeach
        </tbody>
    </table>
        <h2 class="text-2xl font-bold mb-4">Classement des élèves par ordre decroissant de la moyenne trimestrièl.</h2>

@foreach ($elevesParClasse as $classe => $eleves)
    <h3 class="text-xl font-semibold mt-6 mb-2">Classe : {{ $classe }}</h3>
    <table class="w-full border border-gray-300 mb-6">
        <thead class="bg-gray-100">
            <tr>
                <th class="border px-4 py-2">#</th>
                <th class="border px-4 py-2">Nom</th>
                <th class="border px-4 py-2">Prénom</th>
                <th class="border px-4 py-2">Moyenne</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($eleves as $index => $eleve)
                <tr>
                    <td class="border px-4 py-2">{{ $index + 1 }}</td>
                    <td class="border px-4 py-2">{{ $eleve->nom }}</td>
                    <td class="border px-4 py-2">{{ $eleve->prenom }}</td>
                    <td class="border px-4 py-2">{{ $eleve->moyenne }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <a href="{{ route('admin.classement.pdf') }}" class="bi bi-file-earmark-pdf-fill me-1">Télécharger PDF</a>
@endforeach

    <div class="my-4">
        <h5>Télécharger les listes des Eleves ou des Enseignants en PDF :</h5>
        <div class="d-flex flex-wrap gap-2">
            @foreach(['6ème', '5ème', '4ème', '3ème'] as $classe)
                <a href="{{ route('admin.telecharger.pdf', ['classe' => $classe]) }}" class="btn btn-outline-primary">
                    <i class="bi bi-file-earmark-pdf-fill me-1"></i> Liste de la classe de {{ $classe }}
                </a>
            @endforeach
            <a href="{{ route('admin.enseignants.pdf') }}" class="btn btn-outline-success">
                <i class="bi bi-file-earmark-pdf-fill me-1"></i> Liste des enseignants
            </a>
        </div>
    </div>
</div>
@endsection
