@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Modifier l'élève</h2>
    <form method="POST" action="{{ route('admin.eleves.update', $eleve->id) }}">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Nom</label>
            <input type="text" name="nom" value="{{ $eleve->nom }}" class="form-control">
        </div>

        <div class="mb-3">
            <label>Prénom</label>
            <input type="text" name="prenom" value="{{ $eleve->prenom }}" class="form-control">
        </div>

        <!-- Ajoute les autres champs ici -->

        <button type="submit" class="btn btn-primary">Enregistrer</button>
    </form>
</div>
@endsection
