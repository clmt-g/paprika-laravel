@extends('layouts/form')

@section('title', 'Paprika - Detail')

@section('content')
    <div class="card p-4 fade-in">
        <div class="text-center">
            <h2 class="fw-bold text-danger mb-0">Détails du pompier</h2>
            <hr>
        </div>

        <form class="px-3">
            <div class="row">
                <div class="col-md-6">
                    <label for="matricule">Matricule</label>
                    <input type="text" id="matricule" class="form-control" value="{{ $pompier->Matricule }}" disabled>

                    <label for="prenom">Prénom</label>
                    <input type="text" id="prenom" name="prenom" class="form-control" value="{{ $pompier->Prenom }}" disabled>

                    <label for="chefAgret">Chef d'agrès</label>
                    <select id="chefAgret" class="form-select" disabled>
                        <option value="O" {{ $pompier->ChefAgret == 'O' ? 'selected' : '' }}>Oui</option>
                        <option value="N" {{ $pompier->ChefAgret == 'N' ? 'selected' : '' }}>Non</option>
                    </select>
                    <input type="hidden" name="chefAgret" value="{{ $pompier->ChefAgret }}">

                    <label for="numCaserne">Caserne</label>
                    <a href="/caserne/show/detail/{{ $pompier->NumCaserne }}" class="caserne-link">
                        {{ $pompier->caserne->Ville }}
                    </a>
                </div>

                <div class="col-md-6">
                    <label for="nom">Nom</label>
                    <input type="text" id="nom" name="nom" class="form-control" value="{{ $pompier->Nom }}" disabled>

                    <label for="dateNaissance">Date de naissance</label>
                    <input type="date" id="dateNaissance" class="form-control" value="{{ $pompier->DateNaissance }}" disabled>

                    <label for="codeGrade">Code grade</label>
                    <input type="text" id="codeGrade" class="form-control" value="{{ $pompier->grade->NomGrade }}" disabled>

                    <label for="matriculeRespo">Matricule du responsable</label>
                    <input type="text" id="matriculeRespo" class="form-control" value="{{ $pompier->responsable->Prenom }} {{ $pompier->responsable->Nom }}" disabled>
                </div>
            </div>

            <div class="text-center mt-4">
                <a href="{{ route('pompiers') }}" class="btn btn-secondary me-2">
                    <i class="bi bi-arrow-left"></i> Retour à la liste
                </a>
                <a href="#" class="btn btn-danger">
                    <i class="bi bi-pencil"></i> Modifier ce pompier
                </a>
            </div>
        </form>
    </div>
@endsection
