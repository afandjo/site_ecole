<!DOCTYPE html>
<html>
<head>
    <title>Code d'accès Élève</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5 text-center">
    <h2>Inscription terminée avec succès !</h2>
    <p>Voici votre code d'accès personnel :</p>
    <h3 class="alert alert-success py-3">{{ $code }}</h3>
    <p>Conservez-le précieusement pour vous connecter à votre espace.</p>
    <a href="{{ route('eleves.connexion.form') }}" class="btn btn-primary">Se connecter</a>
</div>
</body>
</html>
