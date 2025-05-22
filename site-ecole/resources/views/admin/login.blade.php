@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2>Connexion Administrateur</h2>
    <form action="{{ route('admin.login.post') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Code</label>
            <input type="password" name="code" class="form-control" required>
        </div>
        <button class="btn btn-primary">Connexion</button>
    </form>
</div>
@endsection
