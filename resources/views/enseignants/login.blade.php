@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2>Connexion Enseignant</h2>

    @if ($errors->has('login'))
        <div class="alert alert-danger">{{ $errors->first('login') }}</div>
    @endif

    <form method="POST" action="{{ route('enseignants.auth') }}">
        @csrf
        <input name="email" class="form-control mb-2" type="email" placeholder="Email" required>
        <input name="code" class="form-control mb-2" type="text" placeholder="Code" required>
        <button class="btn btn-primary">Connexion</button>
    </form>
</div>
@endsection
