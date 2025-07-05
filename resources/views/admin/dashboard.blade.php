@extends('layouts.app')

@section('content')
<div class="container py-5">

  {{-- Titre --}}
  <div class="text-center mb-5">
    <h1 class="text-primary fw-bold">Tableau de bord administrateur</h1>
  </div>

  {{-- Bloc Statistiques --}}
  <div class="row mb-5">
    <div class="col-md-4 mb-3">
      <div class="card text-white bg-success shadow">
        <div class="card-body text-center">
          <h5>Total Produits</h5>
          <p class="display-5 fw-bold">{{ $totalProduits }}</p>
        </div>
      </div>
    </div>
    <div class="col-md-4 mb-3">
      <div class="card text-white bg-info shadow">
        <div class="card-body text-center">
          <h5>Total Utilisateurs</h5>
          <p class="display-5 fw-bold">{{ $totalUtilisateurs }}</p>
        </div>
      </div>
    </div>
    <div class="col-md-4 mb-3">
      <div class="card text-white shadow" style="background: linear-gradient(to right, #9c27b0, #673ab7);">
        <div class="card-body text-center">
          <h5>Total Commandes</h5>
          <p class="display-5 fw-bold">{{ $totalCommandes }}</p>
        </div>
      </div>
    </div>
  </div>

  {{-- Zone d’actions divisée en deux colonnes --}}
  <div class="row mb-5">
    <div class="col-md-6 mb-4">
      <div class="card shadow border-0">
        <div class="card-header bg-primary text-white fw-bold">
          Actions rapides
        </div>
        <div class="card-body">
          <ul class="list-unstyled">
            <li><a class="btn btn-link" href="{{ route('admin.dashboard') }}">Tableau de bord</a></li>
            <li><a class="btn btn-link" href="{{ route('admin.produits') }}">Voir produits</a></li>
            <li><a class="btn btn-link" href="{{ route('admin.categories.index') }}">Voir catégories</a></li>
            <li><a class="btn btn-link" href="{{ route('admin.commandes.index') }}">Voir commandes</a></li>
            <hr>
            <li><button class="btn btn-outline-secondary w-100 mb-2" data-bs-toggle="modal" data-bs-target="#dateModal">Commandes par date</button></li>
            <li><button class="btn btn-outline-secondary w-100 mb-2" data-bs-toggle="modal" data-bs-target="#dateModalsegment">Commandes par segment/date</button></li>
            <li><a class="btn btn-link" href="{{ route('admin.utilisateurs.commandes') }}">Utilisateurs par segment</a></li>
            <li><a class="btn btn-link" href="{{ route('admin.clients.segment.role') }}">Utilisateurs par rôle</a></li>
            <li><a class="btn btn-link" href="{{ route('admin.historique.index') }}">Historique commandes</a></li>
             <li><a class="btn btn-link" href="{{ route('admin.modals.admin_index') }}"> Liste des utilisateur </a></li>

          </ul>
        </div>
      </div>
    </div>

    <div class="col-md-6 mb-4">
      <div class="card shadow border-0">
        <div class="card-header bg-success text-white fw-bold">
          Ajouter / Gérer
        </div>
        <div class="card-body d-flex flex-column gap-2">
          <button class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#createProduitModal">Ajouter un produit</button>
          <button class="btn btn-outline-info" data-bs-toggle="modal" data-bs-target="#createCategorieModal">Ajouter une catégorie</button>
          <button class="btn btn-outline-dark" data-bs-toggle="modal" data-bs-target="#createAdminModal">Créer un administrateur</button>
          <button class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#addHistoriqueModal">Ajouter à l’historique</button>
          <a class="btn btn-outline-warning" href="{{ route('admin.parrainages.index') }}">Voir parrainages</a>
        </div>
      </div>
    </div>
  </div>

  {{-- Modals inclus --}}
  @include('admin.modals.produit-create')
  @include('admin.modals.categories-create')
  @include('admin.modals.admin-create')
  @include('admin.modals.commandes-par-date')
  @include('admin.modals.commandes-segment-par-date')
  @include('admin.modals.historiques-create')

</div>
@endsection
