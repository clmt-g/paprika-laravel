@extends('layouts.app') <!-- extend the app.blade.php layout -->

@section('title', 'Paprika - Accueil') <!-- title -->

@section('content') <!-- define the content section -->
    <section id="dashboard" class="fade-in">
        <h2 class="mb-4"><i class="bi bi-speedometer2"></i> Tableau de bord</h2>

        <div class="row g-4">
            <div class="col-md-4">
                <div class="card text-center shadow-sm p-3 border-start border-danger border-4">
                    <div class="card-body">
                        <i class="bi bi-building display-5 text-danger"></i>
                        <h5 class="mt-2">Casernes actives</h5>
                        <h3>{{ $nbCasernes }}</h3>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card text-center shadow-sm p-3 border-start border-danger border-4">
                    <div class="card-body">
                        <i class="bi bi-person-fill display-5 text-danger"></i>
                        <h5 class="mt-2">Pompiers disponibles</h5>
                        <h3>{{ $nbPompiers }}</h3>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card text-center shadow-sm p-3 border-start border-danger border-4">
                    <div class="card-body">
                        <i class="bi bi-alarm display-5 text-danger"></i>
                        <h5 class="mt-2">Alertes récentes</h5>
                        <h3>2</h3>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-5 text-center">
            <button id="refreshBtn" class="btn btn-danger">
                <i class="bi bi-arrow-repeat"></i> Actualiser les données
            </button>
            <p class="mt-3 text-muted" id="refreshMsg"></p>
        </div>
    </section>
@endsection

@push('scripts') <!-- push the scripts to the scripts stack -->
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            document.querySelector("#dashboard").classList.add("fade-in");
        });

        document.getElementById("refreshBtn").addEventListener("click", () => {
            const msg = document.getElementById("refreshMsg");
            msg.textContent = "Mise à jour des données en cours...";
            msg.style.color = "gray";

            setTimeout(() => {
                msg.textContent = "✅ Données actualisées avec succès !";
                msg.style.color = "green";
            }, 1500);
        });
    </script>
@endpush
