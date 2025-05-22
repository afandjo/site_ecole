<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Liste des enseignants</title>
    <style>
        body { font-family: sans-serif; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #000; padding: 5px; text-align: left; }
    </style>
</head>
<body>
    <h2>Liste des enseignants</h2>
    <table>
        <thead>
            <tr>
                <th>Nom</th>
                <th>Prénoms</th>
                <th>Email</th>
                <th>Matière</th>
                <th>Téléphone</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($enseignants as $enseignant)
            <tr>
                <td>{{ $enseignant->nom }}</td>
                <td>{{ $enseignant->prenoms }}</td>
                <td>{{ $enseignant->email }}</td>
                <td>{{ $enseignant->matiere }}</td>
                <td>{{ $enseignant->telephone }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
