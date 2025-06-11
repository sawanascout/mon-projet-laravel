@extends('layouts.app')

@section('content')
@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
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
<div class="container mt-4">
    <h1 class="mb-4">Tableau de bord administrateur</h1>
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card text-white bg-success mb-3">
                <div class="card-body">
                    <h5 class="card-title">Total Produits</h5>
                    <p class="card-text">{{ $totalProduits }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-info mb-3">
                <div class="card-body">
                    <h5 class="card-title">Total Utilisateurs</h5>
                    <p class="card-text">{{ $totalUtilisateurs }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-success mb-3">
                <div class="card-body">
                    <h5 class="card-title">Total Commandes</h5>
                    <p class="card-text">{{ $totalCommandes }}</p>
                </div>
            </div>
        </div>
    </div>
<div class="mb-4">
  <div class="dropdown">
    <button class=" bg-info mb-3 dropdown-toggle" type="button" id="menuActions" data-bs-toggle="dropdown" aria-expanded="false">
      Actions
    </button>
    <ul class="dropdown-menu" aria-labelledby="menuActions">
      <li class="dropdown-header">Navigation rapide</li>
      <li>
        <a class="dropdown-item btn btn-purple text-white" href="{{ route('admin.dashboard') }}">
          Tableau de bord
        </a>
      </li>
      <li>
        <a class="dropdown-item btn btn-purple text-white" href="{{ route('admin.produits') }}">
          Voir produits
        </a>
      </li>
      <li>
        <a class="dropdown-item btn btn-purple text-white" href="{{ route('admin.categories.index') }}">
          Voir catégories
        </a>
      </li>
      <li>
        <a class="dropdown-item btn btn-purple text-white" href="{{ route('admin.commandes.index') }}">
          Voir commandes
        </a>
      </li>
      <li><hr class="dropdown-divider"></li>
      <li class="dropdown-header">Filtres & Actions</li>
      <li>
        <button class="dropdown-item btn btn-purple text-white" type="button" data-bs-toggle="modal" data-bs-target="#dateModal">
          Commandes par date
        </button>
      </li>
      <li>
        <button class="dropdown-item btn btn-purple text-white" type="button" data-bs-toggle="modal" data-bs-target="#dateModalsegment">
          Commandes par segment par date
        </button>
      </li>
      <li>
        <a class="dropdown-item btn btn-purple text-white" href="{{ route('admin.utilisateurs.commandes') }}">
          Utilisateurs avec commandes par segment
        </a>
      </li>
      <li>
        <a class="dropdown-item btn btn-purple text-white" href="{{ route('admin.clients.segment.role') }}">
          Utilisateurs par segment et rôle
        </a>
        <a class="dropdown-item btn btn-purple text-white" href="{{ route('admin.historique.index') }}">
          Historique des commandes passées
        </a>
      </li>
      <li><hr class="dropdown-divider"></li>
    </ul>
  </div>
</div>
 <div class="mb-4">
    <button type="button" class="btn btn-mauve text-white me-2" data-bs-toggle="modal" data-bs-target="#createProduitModal">
        Ajouter un produit
    </button>
    <button type="button" class="btn btn-mauve text-white" data-bs-toggle="modal" data-bs-target="#createCategorieModal">
        Ajouter une catégorie
    </button>
     <button type="button" class="btn btn-mauve text-white" data-bs-toggle="modal" data-bs-target="#createAdminModal">
        Creer Nouveau Administrateur
    </button>
    
<button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addHistoriqueModal">
    Ajouter une commande à l'historique
</button>
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
                                <input type="text" class="form-control" value="{{ $admin->name }}" id="nomAdmin" disabled>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Numéro de téléphone</label>
                                <input type="text" class="form-control" value="{{ $admin->telephone }}" id="telephoneadmin" disabled>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Adresse email</label>
                                <input type="email" class="form-control" value="{{ $admin->email }}" id="emailadmin" disabled>
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

</div>
@include('admin.modals.produit-create')
@include('admin.modals.categories-create')
@include('admin.modals.admin-create')
@include('admin.modals.commandes-par-date')
@include('admin.modals.commandes-segment-par-date')
@include('admin.modals.historiques-create')




</div>
@endsection
