@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2>Tableau de bord Administrateur</h2>

    {{-- ✅ Message flash --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fermer"></button>
        </div>
    @endif

    {{-- 🔹 Bouton Ajouter Élève --}}
    <div class="mb-3">
        <a href="{{ route('admin.eleves.create') }}" class="btn btn-primary">Ajouter Élève</a>
        <a href="{{ route('admin.enseignants.create') }}" class="btn btn-success">Ajouter Enseignant</a>
    </div>

    {{-- 🔹 Liste des Élèves --}}
    <h4>Liste des Élèves</h4>
    @foreach($eleves->groupBy('classe') as $classe => $classeEleves)
        <h5>Classe : {{ $classe }}</h5>
        <table class="table table-bordered">
            <thead>
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
                                {{ $note->matiere }} : Int {{ implode(', ', json_decode($note->interrogations, true) ?? []) }}, Dev {{ $note->devoir }}, Comp {{ $note->composition }}<br>
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



    {{-- 🔹 Liste des Enseignants --}}
    <h4>Liste des Enseignants</h4>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Prénoms</th>
                <th>Email</th>
                <th>Matière</th>
                <th>Téléphone</th>
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
                    <td>
                        <td>
    <a href="{{ route('admin.enseignants.edit', $enseignant->id) }}" class="btn btn-warning btn-sm">Modifier</a>

    <form method="POST" action="{{ route('admin.enseignants.destroy', $enseignant->id) }}" style="display:inline;">
        @csrf
        @method('DELETE')
        <button class="btn btn-danger btn-sm" onclick="return confirm('Voulez-vous vraiment supprimer cet enseignant ?')">Supprimer</button>
    </form>
</td>

                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @foreach(['6ème', '5ème', '4ème', '3ème'] as $classe)
    <a href="{{ route('admin.telecharger.pdf', ['classe' => $classe]) }}" class="btn btn-primary">
        Télécharger la liste des {{ $classe }} en PDF
    </a><br>
@endforeach
    <a href="{{ route('admin.enseignants.pdf') }}" class="btn btn-success">
    Télécharger la liste des enseignants en PDF
</a>

</div>
@endsection
