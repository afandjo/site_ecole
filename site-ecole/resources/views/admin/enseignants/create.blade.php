@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Ajouter un Enseignant</h2>
    <form method="POST" action="{{ route('admin.enseignants.store') }}">
        @csrf

        <div class="form-group">
            <label>Nom</label>
            <input type="text" name="nom" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Prénoms</label>
            <input type="text" name="prenoms" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Matière</label>
            <input type="text" name="matiere" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Téléphone</label>
            <input type="text" name="telephone" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-success">Enregistrer</button>
    </form>
</div>
@endsection
