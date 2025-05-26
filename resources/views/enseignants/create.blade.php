@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2>Inscription Enseignant</h2>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form method="POST" action="{{ route('enseignants.store') }}">
        @csrf
        <input name="nom" class="form-control mb-2" placeholder="Nom" required>
        <input name="prenoms" class="form-control mb-2" placeholder="Prénoms" required>
        <input name="email" class="form-control mb-2" type="email" placeholder="Email" required>
        <input name="matiere" class="form-control mb-2" placeholder="Matière" required>
        <input name="telephone" class="form-control mb-2" placeholder="Téléphone" required>
        <button class="btn btn-success">Enregistrer</button>
        <a href="{{ route('enseignants.login') }}" class="btn btn-primary">Connexion</a>
    </form>
</div>
@endsection
