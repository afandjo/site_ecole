@extends('layouts.app')

@section('content')
    <h2>Inscription Élève - Étape 2</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('eleves.step2.post') }}">
        @csrf

        @if ($classe === '6ème')
            <div class="mb-3">
                <label for="etablissement_prevenance" class="form-label">Établissement de provenance</label>
                <input type="text" name="etablissement_prevenance" id="etablissement_prevenance" value="{{ old('etablissement_prevenance') }}" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="num_table" class="form-label">Numéro de table au CEPD</label>
                <input type="text" name="num_table" id="num_table" value="{{ old('num_table') }}" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="moyenne_cepd" class="form-label">Moyenne obtenue au CEPD</label>
                <input type="number" step="0.01" name="moyenne_cepd" id="moyenne_cepd" value="{{ old('moyenne_cepd') }}" class="form-control" required>
            </div>
        @else
            <div class="mb-3">
                <label for="etablissement_prevenance" class="form-label">Établissement de provenance</label>
                <input type="text" name="etablissement_prevenance" id="etablissement_prevenance" value="{{ old('etablissement_prevenance') }}" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="moyenne_t1" class="form-label">Moyenne du 1er trimestre</label>
                <input type="number" step="0.01" name="moyenne_t1" id="moyenne_t1" value="{{ old('moyenne_t1') }}" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="moyenne_t2" class="form-label">Moyenne du 2ème trimestre</label>
                <input type="number" step="0.01" name="moyenne_t2" id="moyenne_t2" value="{{ old('moyenne_t2') }}" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="moyenne_t3" class="form-label">Moyenne du 3ème trimestre</label>
                <input type="number" step="0.01" name="moyenne_t3" id="moyenne_t3" value="{{ old('moyenne_t3') }}" class="form-control" required>
            </div>
        @endif

        <button type="submit" class="btn btn-primary">Terminer l'inscription</button>
    </form>
@endsection
