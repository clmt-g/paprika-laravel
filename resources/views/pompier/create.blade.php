@extends('layouts.form')

@section('title', 'Paprika - create')

@section('content')
    <div class="card p-4 fade-in">
        <div class="text-center">
            <h2 class="fw-bold text-danger mb-0">Créer un nouveau Pompier</h2>
            <hr>
        </div>

        <form class="px-3" method="POST" action="{{ route('pompiers.do_create') }}">

            @csrf

            <div class="row">
                <div class="col-md-6">
                    <label for="nom">Nom</label>
                    <input type="text" id="nom" name="nom" class="form-control" required>

                    <label for="prenom">Prénom</label>
                    <input type="text" id="prenom" name="prenom" class="form-control" required>

                    <label for="chefAgret">Chef d'agrès</label>
                    <select id="chefAgret" name="chefAgret" class="form-select" required>
                        <option value="N">Non</option>
                        <option value="O">Oui</option>
                    </select>

                    <label for="numCaserne">Caserne</label>
                    <select id="numCaserne" name="numCaserne" class="form-select" required>
                        <option value="">-- Choisir une caserne --</option>
                        @foreach($casernes as $caserne)
                            <option value="{{ $caserne->NumCaserne }}">{{ $caserne->Ville }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6">
                    <label for="dateNaissance">Date de naissance</label>
                    <input type="date" id="dateNaissance" name="dateNaissance" class="form-control" required>

                    <label for="codeGrade">Code grade</label>
                    <select id="codeGrade" name="codeGrade" class="form-control" required>
                        <option value="">-- Choisir un grade --</option>
                        @foreach($grades as $grade)
                            <option value="{{ $grade->CodeGrade }}">{{ $grade->NomGrade }}</option>
                        @endforeach
                    </select>

                    <label for="matriculeRespo">Matricule du responsable</label>
                    <select id="matriculeRespo" name="matriculeRespo" class="form-control" required>
                        <option value="">-- Choisir un résponsable --</option>
                        @foreach($pompiers as $pompier)
                            <option value="{{ $pompier->Matricule }}">
                                {{ $pompier->Matricule }} | {{ $pompier->Prenom }} {{ $pompier->Nom }}}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="text-center mt-4">
                <a href="{{ route('pompiers') }}" class="btn btn-secondary me-2">
                    <i class="bi bi-arrow-left"></i> Retour à la liste
                </a>
                <button type="submit" class="btn btn-danger">
                    <i class="bi bi-pencil"></i> Créer ce pompier
                </button>
            </div>
        </form>
    </div>
@endsection
