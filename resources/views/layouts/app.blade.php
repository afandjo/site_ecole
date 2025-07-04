<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Site École</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> {{-- Important pour le responsive --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Bootstrap Icons -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        /* Ajout d’un peu d’espacement pour les petits écrans */
        .container {
            padding-bottom: 60px;
        }

        table {
            font-size: 0.9rem;
        }

        input, select, textarea, button {
            font-size: 1rem;
        }
    </style>
</head>
<body>

{{-- Navbar --}}
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('eleves.step1') }}">Site École</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav ms-auto">
    <li class="nav-item">
        <a class="nav-link" href="{{ route('eleves.step1') }}">Inscription</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('eleves.connexion.form') }}">Connexion</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.enseignants') }}">Enseignants</a>
    </li>

</ul>

        </div>
    </div>
</nav>

{{-- Contenu --}}
<div class="container mt-4">
    @yield('content')
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
