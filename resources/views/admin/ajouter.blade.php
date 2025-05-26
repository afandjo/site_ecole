<!DOCTYPE html>
<html>
<head>
    <title>Ajouter Élève / Enseignant</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h2 class="mb-4">Ajouter un Élève</h2>
    <form action="{{ route('admin.ajouter.eleve') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Nom</label>
            <input type="text" name="nom" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Prénom</label>
            <input type="text" name="prenom" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Date de naissance</label>
            <input type="date" name="date_naissance" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Lieu de naissance</label>
            <input type="text" name="lieu_naissance" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Âge</label>
            <input type="number" name="age" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Classe</label>
            <select name="classe" class="form-control" required>
                <option value="6ème">6ème</option>
                <option value="5ème">5ème</option>
                <option value="4ème">4ème</option>
                <option value="3ème">3ème</option>
            </select>
        </div>
        <div class="mb-3">
            <label>Établissement de provenance</label>
            <input type="text" name="etablissement_prevenance" class="form-control" required>
        </div>
        <button class="btn btn-primary">Ajouter l'élève</button>
    </form>
</div>
</body>
</html>
