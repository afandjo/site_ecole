<!DOCTYPE html>
<html>
<head>
    <title>Modifier {{ $type === 'eleve' ? 'Élève' : 'Enseignant' }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h2>Modifier {{ $type === 'eleve' ? 'Élève' : 'Enseignant' }}</h2>

    <form action="{{ route('admin.update', ['type' => $type, 'id' => $item->id]) }}" method="POST">
        @csrf

        @if($type === 'eleve')
            <div class="mb-3">
                <label>Nom</label>
                <input type="text" name="nom" class="form-control" value="{{ $item->nom }}" required>
            </div>
            <div class="mb-3">
                <label>Prénom</label>
                <input type="text" name="prenom" class="form-control" value="{{ $item->prenom }}" required>
            </div>
            <div class="mb-3">
                <label>Date de naissance</label>
                <input type="date" name="date_naissance" class="form-control" value="{{ $item->date_naissance }}" required>
            </div>
            <div class="mb-3">
                <label>Lieu de naissance</label>
                <input type="text" name="lieu_naissance" class="form-control" value="{{ $item->lieu_naissance }}" required>
            </div>
            <div class="mb-3">
                <label>Âge</label>
                <input type="number" name="age" class="form-control" value="{{ $item->age }}" required>
            </div>
            <div class="mb-3">
                <label>Classe</label>
                <input type="text" name="classe" class="form-control" value="{{ $item->classe }}" required>
            </div>
            <div class="mb-3">
                <label>Établissement de provenance</label>
                <input type="text" name="etablissement_prevenance" class="form-control" value="{{ $item->etablissement_prevenance }}" required>
            </div>
        @else
            <div class="mb-3">
                <label>Nom</label>
                <input type="text" name="nom" class="form-control" value="{{ $item->nom }}" required>
            </div>
            <div class="mb-3">
                <label>Prénoms</label>
                <input type="text" name="prenoms" class="form-control" value="{{ $item->prenoms }}" required>
            </div>
            <div class="mb-3">
                <label>Email</label>
                <input type="email" name="email" class="form-control" value="{{ $item->email }}" required>
            </div>
            <div class="mb-3">
                <label>Matière</label>
                <input type="text" name="matiere" class="form-control" value="{{ $item->matiere }}" required>
            </div>
            <div class="mb-3">
                <label>Téléphone</label>
                <input type="text" name="telephone" class="form-control" value="{{ $item->telephone }}" required>
            </div>
        @endif

        <button class="btn btn-primary">Mettre à jour</button>
    </form>
</div>
</body>
</html>
