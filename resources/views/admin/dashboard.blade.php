@extends('layouts.app')

@section('content')



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
</div>
@include('admin.modals.produit-create')
@include('admin.modals.categories-create')
@include('admin.modals.admin-create')
@include('admin.modals.commandes-par-date')
@include('admin.modals.commandes-segment-par-date')




</div>
@endsection
