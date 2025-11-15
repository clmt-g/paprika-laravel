@extends('layouts.form')

@section('titile', 'Paprika - update')

@section('content')
    <div class="card p-4 fade-in">
        <div class="text-center">
            <h2 class="fw-bold text-danger mb-0">Modifier le pompier {{ $pompier->Prenom }} {{ $pompier->Nom }}</h2>
            <hr>
        </div>

        <form method="POST" action="{{ route('pompiers.do_update', $pompier->Matricule) }}" class="px-3">

            @csrf

            <div class="row">
                <div class="col-md-6">
                    <label for="matricule">Matricule</label>
                    <input type="text" id="matricule" name="matricule" class="form-control" value="{{ $pompier->Matricule }}" readonly>

                    <label for="prenom">Prénom</label>
                    <input type="text" id="prenom" name="prenom" class="form-control" value="{{ $pompier->Prenom }}" required>

                    <label for="chefAgret">Chef d'agrès</label>
                    <select id="chefAgret" name="chefAgret" class="form-select" required>
                        <option value="O" {{ $pompier->ChefAgret == 'O' ? 'selected' : '' }}>Oui</option>
                        <option value="N" {{ $pompier->ChefAgret == 'N' ? 'selected' : '' }}>Non</option>
                    </select>

                    <label for="numCaserne">Caserne</label>
                    <select id="numCaserne" name="numCaserne" class="form-select" required>
                        @foreach($casernes as $cas)
                            <option value="{{ $cas->NumCaserne }}"
                                {{ isset($pompier) && $pompier->caserne->NumCaserne == $cas->NumCaserne ? 'selected' : '' }}
                            >
                                {{ $cas->Ville }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6">
                    <label for="nom">Nom</label>
                    <input type="text" id="nom" name="nom" class="form-control" value="{{ $pompier->Nom }}" required>

                    <label for="dateNaissance">Date de naissance</label>
                    <input type="date" id="dateNaissance" name="dateNaissance" class="form-control" value="{{ $pompier->DateNaissance }}" required>

                    <label for="codeGrade">Code grade</label>
                    <select id="codeGrade" name="codeGrade" class="form-control" required>
                        <option value="">-- Choisir un grade --</option>
                        @foreach($grades as $grade)
                            <option value="{{ $grade->CodeGrade }}"
                                {{ isset($pompier) && $pompier->grade->CodeGrade == $grade->CodeGrade ? 'selected' : '' }}
                            >
                                {{ $grade->NomGrade }}
                            </option>
                        @endforeach
                    </select>

                    <label for="matriculeRespo">Matricule du responsable</label>
                    <select id="matriculeRespo" name="matriculeRespo" class="form-control">
                        <option value="">-- Aucun responsable --</option>
                        @foreach($pompiers as $p)
                            <option value="{{ $p->Matricule }}"
                                {{ $p->Matricule == $pompier->MatriculeRespo ? 'selected' : '' }}>
                                {{ $p->Matricule }} | {{ $p->Prenom }} {{ $p->Nom }}
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
                    <i class="bi bi-pencil"></i> Enregistrer les modifications
                </button>
            </div>
        </form>
    </div>
@endsection
