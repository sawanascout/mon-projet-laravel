@extends('layouts.app')

@section('content')
<div class="container py-5">

  <h1 class="mb-4 text-center text-primary">Tableau de bord administrateur</h1>

  {{-- Statistiques --}}
  <div class="row mb-5">
    <div class="col-md-4">
      <div class="card text-white bg-success">
        <div class="card-body text-center">
          <h5 class="card-title">Total Produits</h5>
          <p class="display-4 fw-bold">{{ $totalProduits }}</p>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card text-white bg-info">
        <div class="card-body text-center">
          <h5 class="card-title">Total Utilisateurs</h5>
          <p class="display-4 fw-bold">{{ $totalUtilisateurs }}</p>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card text-white bg-purple" style="background: linear-gradient(to right, #9c27b0, #673ab7);">
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
    <button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
      Actions rapides
    </button>
    <ul class="dropdown-menu">
      <li><a class="dropdown-item" href="{{ route('admin.dashboard') }}">Tableau de bord</a></li>
      <li><a class="dropdown-item" href="{{ route('admin.produits') }}">Voir produits</a></li>
      <li><a class="dropdown-item" href="{{ route('admin.categories.index') }}">Voir catégories</a></li>
      <li><a class="dropdown-item" href="{{ route('admin.commandes.index') }}">Voir commandes</a></li>
      <li><hr class="dropdown-divider"></li>
      <li class="dropdown-header">Filtres & Actions</li>
      <li>
        <a href="#" class="dropdown-item open-modal" data-bs-toggle="modal" data-bs-target="#dateModal">Commandes par date</a>
      </li>
      <li>
        <a href="#" class="dropdown-item open-modal" data-bs-toggle="modal" data-bs-target="#dateModalsegment">Commandes segment/date</a>
      </li>
      <li><a class="dropdown-item" href="{{ route('admin.utilisateurs.commandes') }}">Utilisateurs par segment</a></li>
      <li><a class="dropdown-item" href="{{ route('admin.clients.segment.role') }}">Utilisateurs par rôle</a></li>
      <li><a class="dropdown-item" href="{{ route('admin.historique.index') }}">Historique</a></li>
    </ul>
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
