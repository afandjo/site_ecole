<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Liste des élèves - {{ $classe }}</title>
    <style>
        body { font-family: sans-serif; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #000; padding: 5px; text-align: left; }
    </style>
</head>
<body>
    <h2>Liste des élèves de la classe de {{ $classe }}</h2>
    <table>
        <thead>
            <tr>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Date de naissance</th>
                <th>Âge</th>
                <th>Lieu de naissance</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($eleves as $eleve)
            <tr>
                <td>{{ $eleve->nom }}</td>
                <td>{{ $eleve->prenom }}</td>
                <td>{{ $eleve->date_naissance }}</td>
                <td>{{ $eleve->age }}</td>
                <td>{{ $eleve->lieu_naissance }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
