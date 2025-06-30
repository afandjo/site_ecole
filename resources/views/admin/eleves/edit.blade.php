@extends('layouts.app')

@section('content')
@if ($errors->any())
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6" role="alert">
        <ul class="list-disc list-inside">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="max-w-md mx-auto bg-white shadow-md rounded p-6">
    <h2 class="text-2xl font-bold mb-6 text-center">Modifier l'élève</h2>

    <form action="{{ route('admin.eleves.update', $eleve->id) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label class="block text-gray-700 font-semibold mb-1" for="nom">Nom :</label>
            <input
                type="text"
                name="nom"
                id="nom"
                value="{{ $eleve->nom }}"
                class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
            >
        </div>

        <div>
            <label class="block text-gray-700 font-semibold mb-1" for="prenom">Prénom :</label>
            <input
                type="text"
                name="prenom"
                id="prenom"
                value="{{ $eleve->prenom }}"
                class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
            >
        </div>

        <div>
            <label class="block text-gray-700 font-semibold mb-1" for="date_naissance">Date de naissance :</label>
            <input
                type="date"
                name="date_naissance"
                id="date_naissance"
                value="{{ $eleve->date_naissance }}"
                class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
            >
        </div>

        <div>
            <label class="block text-gray-700 font-semibold mb-1" for="lieu_naissance">Lieu de naissance :</label>
            <input
                type="text"
                name="lieu_naissance"
                id="lieu_naissance"
                value="{{ $eleve->lieu_naissance }}"
                class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
            >
        </div>

        <div>
            <label class="block text-gray-700 font-semibold mb-1" for="age">Âge :</label>
            <input
                type="number"
                name="age"
                id="age"
                value="{{ $eleve->age }}"
                class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
            >
        </div>

        <div>
            <label class="block text-gray-700 font-semibold mb-1" for="classe">Classe :</label>
            <input
                type="text"
                name="classe"
                id="classe"
                value="{{ $eleve->classe }}"
                class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
            >
        </div>

        <div>
            <label class="block text-gray-700 font-semibold mb-1" for="etablissement_prevenance">Établissement de provenance :</label>
            <input
                type="text"
                name="etablissement_prevenance"
                id="etablissement_prevenance"
                value="{{ $eleve->etablissement_prevenance }}"
                class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
            >
        </div>

        <button
            type="submit"
            class="w-full bg-blue-600 text-white font-bold py-2 rounded hover:bg-blue-700 transition-colors"
        >
            Mettre à jour
        </button>
    </form>
</div>
@endsection
