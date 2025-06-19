@extends('layouts.app')
@vite(['resources/css/app.css', 'resources/js/app.js'])

@section('content')
<div class="container mx-auto px-4 py-6">

  <h1 class="text-3xl font-bold mb-6 text-[color:var(--main-color)]">Tableau de bord administrateur</h1>

  {{-- Statistiques --}}
  <div class="row g-4 mb-6">
  <div class="col-md-4">
    <div class="card shadow-sm border-0 text-white" style="background: linear-gradient(to right, #4caf50, #2e7d32);">
      <div class="card-body text-center">
        <h5 class="card-title">Total Produits</h5>
        <p class="display-4 fw-bold">{{ $totalProduits }}</p>
      </div>
    </div>
  </div>
  <div class="col-md-4">
    <div class="card shadow-sm border-0 text-white" style="background: linear-gradient(to right, #00bcd4, #1976d2);">
      <div class="card-body text-center">
        <h5 class="card-title">Total Utilisateurs</h5>
        <p class="display-4 fw-bold">{{ $totalUtilisateurs }}</p>
      </div>
    </div>
  </div>
  <div class="col-md-4">
    <div class="card shadow-sm border-0 text-white" style="background: linear-gradient(to right, #9c27b0, #673ab7);">
      <div class="card-body text-center">
        <h5 class="card-title">Total Commandes</h5>
        <p class="display-4 fw-bold">{{ $totalCommandes }}</p>
      </div>
    </div>
  </div>
</div>


  {{-- Menu Actions --}}
  <div class="mb-6">
    <div class="dropdown">
      <button class="btn btn-custom btn-mauve dropdown-toggle" type="button" id="actionsMenu" data-bs-toggle="dropdown" aria-expanded="false">
        Actions rapides
      </button>
      <ul class="dropdown-menu" aria-labelledby="actionsMenu">
        <li><a class="dropdown-item" href="{{ route('admin.dashboard') }}">Tableau de bord</a></li>
        <li><a class="dropdown-item" href="{{ route('admin.produits') }}">Voir produits</a></li>
        <li><a class="dropdown-item" href="{{ route('admin.categories.index') }}">Voir catégories</a></li>
        <li><a class="dropdown-item" href="{{ route('admin.commandes.index') }}">Voir commandes</a></li>
        <li><hr class="dropdown-divider"></li>
        <li class="dropdown-header">Filtres & Actions</li>
        <li>
          <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#dateModal">Commandes par date</button>
        </li>
        <li>
          <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#dateModalsegment">Commandes par segment par date</button>
        </li>
        <li><a class="dropdown-item" href="{{ route('admin.utilisateurs.commandes') }}">Utilisateurs avec commandes par segment</a></li>
        <li><a class="dropdown-item" href="{{ route('admin.clients.segment.role') }}">Utilisateurs par segment et rôle</a></li>
        <li><a class="dropdown-item" href="{{ route('admin.historique.index') }}">Historique des commandes</a></li>
      </ul>
    </div>
  </div>

  {{-- Boutons d’ajout --}}
  <div class="mb-6 d-flex flex-wrap gap-3">
    <button class="btn btn-custom btn-mauve" data-bs-toggle="modal" data-bs-target="#createProduitModal">
      Ajouter un produit
    </button>
    <button class="btn btn-custom btn-mauve" data-bs-toggle="modal" data-bs-target="#createCategorieModal">
      Ajouter une catégorie
    </button>
    <button class="btn btn-custom btn-mauve" data-bs-toggle="modal" data-bs-target="#createAdminModal">
      Créer un nouvel administrateur
    </button>
    <button class="btn btn-custom btn-gradient-violet" data-bs-toggle="modal" data-bs-target="#addHistoriqueModal">
      Ajouter une commande à l'historique
    </button>
 <a class="btn btn-custom btn-gradient-violet" href="{{ route('admin.parrainages.index') }}">Voir parrainages</a>
  </div>

  {{-- Inclusion des modals --}}
  @include('admin.modals.produit-create')
  @include('admin.modals.categories-create')
  @include('admin.modals.admin-create')
  @include('admin.modals.commandes-par-date')
  @include('admin.modals.commandes-segment-par-date')
  @include('admin.modals.historiques-create')

</div>
@endsection
