<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <h1>Classement des élèves</h1>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th, td { border: 1px solid #000; padding: 5px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h2 style="text-align:center;">Classement des élèves par classe</h2>

    @foreach ($elevesParClasse as $classe => $eleves)
        <h3>Classe : {{ $classe }}</h3>
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Moyenne</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($eleves as $index => $eleve)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $eleve->nom }}</td>
                        <td>{{ $eleve->prenom }}</td>
                        <td>{{ $eleve->moyenne }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endforeach
</body>
</html>
