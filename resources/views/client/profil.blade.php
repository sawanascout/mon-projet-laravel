@extends('layouts.app')

@section('content')
<div class="container">
    {{-- En-tête avec titre et bouton paramètres --}}
   <div class="d-flex align-items-center">
    {{-- Bouton Paramètres --}}
    <button class="btn btn-primary rounded-circle ms-2" 
            style="width: 40px; height: 40px; padding: 0;"
            data-bs-toggle="modal" data-bs-target="#parametresModal"
            title="Paramètres">
        <i class="bi bi-gear-fill"></i>
    </button>

    {{-- Bouton Déconnexion --}}
    <form action="{{ route('auth.logout') }}" method="POST" class="ms-2">
        @csrf
        <button type="submit" class="btn btn-outline-danger" style="height: 40px;" title="Déconnexion">
            <i class="bi bi-box-arrow-right"></i>
        </button>
    </form>
</div>


    {{-- Modal Paramètres --}}
    <div class="modal fade" id="parametresModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">
                        <i class="bi bi-gear-fill me-2"></i>Paramètres
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-4">
                        <h6 class="border-bottom pb-2">
                            <i class="bi bi-person-circle me-2"></i>Informations personnelles
                        </h6>
                        <form id="infoForm">
                            <div class="mb-3">
                                <label class="form-label">Nom complet</label>
                                <input type="text" class="form-control" value="{{ $client->name }}" id="nomClient" disabled>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Numéro de téléphone</label>
                                <input type="text" class="form-control" value="{{ $client->telephone }}" id="telephoneClient" disabled>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Adresse email</label>
                                <input type="email" class="form-control" value="{{ $client->email }}" id="emailClient" disabled>
                            </div>
                            <button type="button" id="editInfo" class="btn btn-outline-primary">
                                <i class="bi bi-pencil me-1"></i>Modifier
                            </button>
                            <button type="submit" id="saveInfo" class="btn btn-primary d-none">
                                <i class="bi bi-check-circle me-1"></i>Enregistrer
                            </button>
                        </form>
                    </div>

                    <div class="mb-4">
                        <h6 class="border-bottom pb-2">
                            <i class="bi bi-shield-lock me-2"></i>Sécurité
                        </h6>
                        <a href="#" id="changePassword" class="btn btn-outline-danger d-block text-start">
                            <i class="bi bi-key me-1"></i>Changer le mot de passe
                        </a>
                    </div>

                    <div>
                        <h6 class="border-bottom pb-2">
                            <i class="bi bi-bell-fill me-2"></i>Notifications
                        </h6>
                        <div class="form-check form-switch mb-2">
                            <input class="form-check-input" type="checkbox" id="notifCommandes" checked>
                            <label class="form-check-label" for="notifCommandes">Notifications de commandes</label>
                        </div>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="notifPromos" checked>
                            <label class="form-check-label" for="notifPromos">Offres promotionnelles</label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        <i class="bi bi-x-circle me-1"></i>Fermer
                    </button>
                </div>
            </div>
        </div>
    </div>

    {{-- Boutons de navigation --}}
    <div class="d-flex gap-2 mb-4 flex-wrap">
        <a href="{{ route('client.panier-index') }}" class="btn btn-primary">
            <i class="bi bi-cart"></i> Mon Panier
        </a>
        <a href="{{ route('client.commandes') }}" class="btn btn-primary">
            <i class="bi bi-receipt"></i> Mes Commandes
        </a>
        <a href="{{ route('parrainage.index') }}" class="btn btn-outline-primary">
            <i class="bi bi-gift"></i> Parrainage
        </a>
    </div>

    {{-- Section Historique des commandes --}}
    <div class="card">
        <div class="card-header bg-primary text-white">
            <i class="bi bi-list-check"></i> Historique des commandes
        </div>
        <div class="card-body">
            @if ($commandes->isEmpty())
                <div class="alert alert-info mb-0">
                    <i class="bi bi-info-circle"></i> Vous n'avez passé aucune commande pour le moment.
                </div>
            @else
                {{-- Contenu des commandes... --}}
            @endif
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Gestion de l'édition des informations
    document.getElementById('editInfo').addEventListener('click', function() {
        document.getElementById('nomClient').disabled = false;
        document.getElementById('telephoneClient').disabled = false;
        document.getElementById('emailClient').disabled = false;
        this.classList.add('d-none');
        document.getElementById('saveInfo').classList.remove('d-none');
    });

    // Animation du bouton paramètres
    const btnParametres = document.querySelector('[data-bs-target="#parametresModal"]');
    btnParametres.addEventListener('mouseenter', function() {
        this.style.transform = 'rotate(30deg)';
    });
    btnParametres.addEventListener('mouseleave', function() {
        this.style.transform = 'rotate(0)';
    });
});
</script>

<style>
    /* Animation pour le bouton Paramètres */
    [data-bs-target="#parametresModal"] {
        transition: transform 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    /* Style pour le modal */
    @media (min-width: 992px) {
        .modal-dialog {
            max-width: 400px;
            margin: 0 0 0 auto;
            height: 100vh;
        }
        .modal-content {
            height: 100%;
            border-radius: 0;
        }
    }
</style>
@endsection