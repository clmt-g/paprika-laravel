@extends('layouts.app')

@section('title', 'Paprika - pompiers')

@section('content')
    {{-- Messages flash --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="bi bi-exclamation-triangle-fill me-2"></i>
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="fade-in">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2><i class="bi bi-fire text-danger"></i> Liste des pompiers</h2>
            <a href="{{ route('pompiers.create') }}" class="btn btn-danger">
                <i class="bi bi-plus-circle"></i> Ajouter un pompier
            </a>
        </div>

        <div class="input-group mb-3 w-50">
            <span class="input-group-text bg-danger text-white"><i class="bi bi-search"></i></span>
            <input type="text" id="searchPompiers" class="form-control" placeholder="Rechercher un pompier...">
        </div>

        <div class="card shadow-sm">
            <div class="card-body p-0">
                <table class="table table-hover align-middle mb-0">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Matricule</th>
                        <th>Prénom</th>
                        <th>Nom</th>
                        <th>Chef d'agré</th>
                        <th>Date de naissance</th>
                        <th>Caserne</th>
                        <th>Effectif</th>
                        <th>Grade</th>
                        <th>Responsable</th>
                        <th class="text-center">Actions</th>
                    </tr>
                    </thead>
                    <tbody id="tablePompiers">
                    @foreach($pompiers as $pompier)
                        <tr>
                            <td><span class="badge bg-secondary">{{ $compteur++ }}</span></td>
                            <td>{{ $pompier->Matricule }}</td>
                            <td>{{ $pompier->Prenom }}</td>
                            <td>{{ $pompier->Nom }}</td>
                            @if($pompier->ChefAgret == 'O')
                                <td>Oui</td>
                            @elseif($pompier->ChefAgret == 'N')
                                <td>Non</td>
                            @endif
                            <td>{{ $pompier->DateNaissance }}</td>
                            <td>
                                <a href="/caserne/show/detail/{{ $pompier->caserne->Ville }}"
                                   class="text-decoration-none text-danger fw-bold">
                                    <i class="bi bi-geo-alt-fill"></i>
                                    {{ $pompier->caserne->Ville }}
                                </a>
                            </td>
                            <td>{{ count($pompier->caserne->pompiers) }}</td>
                            <td><span class="badge bg-info">{{ $pompier->grade->NomGrade }}</span></td>
                            <td>
                                <a href="#" class="text-decoration-none text-danger fw-bold">
                                    <i class="bi bi-shield-fill-check"></i>
                                    {{ $pompier->responsable->Prenom }} {{ $pompier->responsable->Nom }}
                                </a>
                            </td>
                            <td class="text-center">
                                <div class="btn-group btn-group-sm">
                                    <a href="{{ route('pompiers.detail', $pompier->Matricule) }}" class="btn btn-outline-primary" title="Détails">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="{{ route('pompiers.update', $pompier->Matricule) }}" class="btn btn-outline-warning" title="Modifier">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <a href="#" class="btn btn-outline-danger" title="Supprimer" onclick="loadDeleteModal('/pompiers/delete/{{ $pompier->Matricule }}')">
                                        <i class="bi bi-trash"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        const search = document.getElementById('searchPompiers');
        const rows = document.querySelectorAll('#tablePompiers tr');

        search.addEventListener('keyup', () => {
            const val = search.value.toLowerCase();
            rows.forEach(r => {
                r.style.display = r.textContent.toLowerCase().includes(val) ? '' : 'none';
            });
        });

        function loadDeleteModal(url) {
            window.history.pushState({}, '', url);

            fetch(url)
                .then(response => response.text())
                .then(html => {
                    let container = document.createElement('div');
                    container.innerHTML = html;
                    document.body.appendChild(container);

                    let modal = new bootstrap.Modal(document.querySelector('.modal'));
                    modal.show();

                    document.querySelector('.modal').addEventListener('hidden.bs.modal', function() {
                        window.history.back();
                        this.parentElement.remove();
                    });
                });
        }
        // Auto-dismiss les alertes après 3 secondes
        document.addEventListener('DOMContentLoaded', function() {
            const alerts = document.querySelectorAll('.alert');

            alerts.forEach(alert => {
                setTimeout(() => {
                    // Utilise Bootstrap pour fermer proprement l'alerte
                    const bsAlert = bootstrap.Alert.getOrCreateInstance(alert);
                    bsAlert.close();
                }, 3000); // 3000ms = 3 secondes
            });
        });
    </script>
@endpush

@push('styles')
    <style>
        .form-control:focus {
            border-color: var(--rouge-paprika);
            box-shadow: 0 0 0 0.2rem rgba(178, 34, 34, 0.25);
        }
        thead {
            background-color: var(--rouge-paprika);
            color: white;
        }
        tbody tr:hover {
            background-color: #fff3f3;
            cursor: pointer;
        }
    </style>
@endpush
