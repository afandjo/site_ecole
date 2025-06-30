@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Validation des étapes des élèves</h2>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fermer"></button>
        </div>
    @endif

    @foreach($elevesParClasse as $classe => $eleves)
        <h4 class="mt-4">Classe : {{ $classe }}</h4>

        <div class="table-responsive">
            <table class="table table-bordered align-middle">
                <thead class="table-primary">
                    <tr>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Inscription</th>
                        <th>1ère Tranche</th>
                        <th>2ème Tranche</th>
                        <th>3ème Tranche</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($eleves as $eleve)
                        <tr>
                            <td>{{ $eleve->nom }}</td>
                            <td>{{ $eleve->prenom }}</td>

                            @foreach(['inscription_validee', 'tranche1_validee', 'tranche2_validee', 'tranche3_validee'] as $etape)
                                <td>
                                    @if($eleve->$etape)
                                        <span class="badge bg-success">Validée</span>
                                    @else
                                        <form method="POST" action="{{ route('admin.valider.etape', [$eleve->id, $etape]) }}">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-outline-success">Valider</button>
                                        </form>
                                    @endif
                                </td>
                            @endforeach
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endforeach
</div>
@endsection
