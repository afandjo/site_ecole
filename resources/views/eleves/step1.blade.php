@extends('layouts.app')

@section('content')
    <h2>Inscription Élève - Étape 1</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if ($errors->has('existe'))
        <div class="alert alert-warning">
            {{ $errors->first('existe') }}
        </div>
    @endif

    <form method="POST" action="{{ route('eleves.step1.post') }}">
        @csrf
        <div class="mb-3">
            <label for="nom" class="form-label">Nom</label>
            <input type="text" name="nom" id="nom" value="{{ old('nom') }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="prenom" class="form-label">Prénom</label>
            <input type="text" name="prenom" id="prenom" value="{{ old('prenom') }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="date_naissance" class="form-label">Date de naissance</label>
            <input type="date" name="date_naissance" id="date_naissance" value="{{ old('date_naissance') }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="lieu_naissance" class="form-label">Lieu de naissance</label>
            <input type="text" name="lieu_naissance" id="lieu_naissance" value="{{ old('lieu_naissance') }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="age" class="form-label">Âge</label>
            <input type="number" name="age" id="age" value="{{ old('age') }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="classe" class="form-label">Classe</label>
            <select name="classe" id="classe" class="form-select" required>
                <option value="">-- Choisir une classe --</option>
                <option value="6ème" {{ old('classe') == '6ème' ? 'selected' : '' }}>6ème</option>
                <option value="5ème" {{ old('classe') == '5ème' ? 'selected' : '' }}>5ème</option>
                <option value="4ème" {{ old('classe') == '4ème' ? 'selected' : '' }}>4ème</option>
                <option value="3ème" {{ old('classe') == '3ème' ? 'selected' : '' }}>3ème</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Suivant</button>
    </form>
@endsection
