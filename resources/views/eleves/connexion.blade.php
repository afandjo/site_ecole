<!DOCTYPE html>
<html>
<head>
    <title>Connexion Élève</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h2>Connexion Élève</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('eleves.connexion') }}">
        @csrf
        <div class="mb-3">
            <label for="code_acces" class="form-label">Code d'accès</label>
            <input type="text" name="code_acces" id="code_acces" class="form-control" value="{{ old('code_acces') }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Se connecter</button>
    </form>
</div>
</body>
</html>
