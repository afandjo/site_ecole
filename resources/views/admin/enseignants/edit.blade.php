@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Modifier Enseignant</h2>
    <form method="POST" action="{{ route('admin.enseignants.update', $enseignant->id) }}">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label>Nom</label>
            <input type="text" name="nom" value="{{ $enseignant->nom }}" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Prénoms</label>
            <input type="text" name="prenoms" value="{{ $enseignant->prenoms }}" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" value="{{ $enseignant->email }}" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Matière</label>
            <input type="text" name="matiere" value="{{ $enseignant->matiere }}" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Téléphone</label>
            <input type="text" name="telephone" value="{{ $enseignant->telephone }}" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Mettre à jour</button>
    </form>
</div>
@endsection
