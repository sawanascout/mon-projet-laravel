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

      



    <!-- Modal -->
    <div class="modal fade" id="dateModal" tabindex="-1" aria-labelledby="dateModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <form action="{{ route('admin.commandes.dates') }}" method="POST">
                @csrf
                <div class="modal-header">
                <h5 class="modal-title" id="dateModalLabel">Filtrer les commandes par date</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                </div>
                <div class="modal-body">
                <div class="mb-3">
                    <label for="start_date" class="form-label">Date de début</label>
                    <input type="date" name="start_date" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="end_date" class="form-label">Date de fin</label>
                    <input type="date" name="end_date" class="form-control" required>
                </div>
                </div>
                <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Filtrer</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                </div>
            </form>
            </div>
        </div>
    </div>
      <div class="modal fade" id="dateModalsegment" tabindex="-1" aria-labelledby="dateModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <form action="{{ route('admin.commandes.segments') }}" method="POST">
                @csrf
                <div class="modal-header">
                <h5 class="modal-title" id="dateModalLabel">Filtrer les commandes par date et par segment</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                </div>
                <div class="modal-body">
                <div class="mb-3">
                    <label for="start_date" class="form-label">Date de début</label>
                    <input type="date" name="start_date" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="end_date" class="form-label">Date de fin</label>
                    <input type="date" name="end_date" class="form-control" required>
                </div>
                <div class="mb-3">
                    <select name="segment" required>
                        <option value="" > segment</option>
                        <option value="homme" >Homme</option>
                        <option value="femme" >Femme</option>
                        <option value="jeune_homme" >Jeune homme (≤ 30 ans)</option>
                        <option value="jeune_femme" >Jeune femme (≤ 30 ans)</option>
                    </select>
                </div>
                </div>
                <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Filtrer</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                </div>
            </form>
            </div>
        </div>
    </div>
    <!-- Modal -->
<div class="modal fade" id="createAdminModal" tabindex="-1" aria-labelledby="createAdminModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form action="{{ route('admin.admins.storeAdmin') }}" method="POST">
      @csrf
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="createAdminModalLabel">Créer un nouvel admin</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
        </div>
        <div class="modal-body">

          <div class="mb-3">
            <label for="name" class="form-label">Nom</label>
            <input type="text" class="form-control" id="name" name="name" required>
          </div>

          <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" required>
          </div>

       <select name="segment" required>
        <option value="" disabled {{ old('segment') ? '' : 'selected' }}>Choisissez votre segment</option>
        <option value="homme" {{ old('segment') == 'homme' ? 'selected' : '' }}>Homme</option>
        <option value="femme" {{ old('segment') == 'femme' ? 'selected' : '' }}>Femme</option>
        <option value="jeune_homme" {{ old('segment') == 'jeune_homme' ? 'selected' : '' }}>Jeune homme (≤ 30 ans)</option>
        <option value="jeune_femme" {{ old('segment') == 'jeune_femme' ? 'selected' : '' }}>Jeune femme (≤ 30 ans)</option>
    </select>

          <div class="mb-3">
            <label for="telephone" class="form-label">Téléphone</label>
            <input type="text" class="form-control" id="telephone" name="telephone" required>
          </div>

          <div class="mb-3">
            <label for="password" class="form-label">Mot de passe</label>
            <input type="password" class="form-control" id="password" name="password" required>
          </div>

          <div class="mb-3">
            <label for="password_confirmation" class="form-label">Confirmer le mot de passe</label>
            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
          <button type="submit" class="btn btn-primary">Créer</button>
        </div>
      </div>
    </form>
  </div>
  <div class="modal fade" id="createCategorieModal" tabindex="-1" aria-labelledby="createCategorieModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form action="{{ route('admin.categories.store') }}" method="POST">
      @csrf
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="createCategorieModalLabel">Ajouter une catégorie</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label for="nom_categorie" class="form-label">Nom de la catégorie</label>
            <input type="text" class="form-control" id="nom_categorie" name="nom" required>
          </div>
          <!-- Ajoute d'autres champs si besoin -->
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
          <button type="submit" class="btn btn-primary">Ajouter</button>
        </div>
      </div>
    </form>
  </div>
</div>
<div class="modal fade" id="createProduitModal" tabindex="-1" aria-labelledby="createProduitModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form action="{{ route('admin.produits.store') }}" method="POST">
      @csrf
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="createProduitModalLabel">Ajouter un produit</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label for="nom" class="form-label">Nom du produit</label>
            <input type="text" class="form-control" id="nom" name="nom" required>
          </div>
          <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" name="description" rows="3"></textarea>
          </div>
          <div class="mb-3">
            <label for="prix" class="form-label">Prix</label>
            <input type="number" step="0.01" class="form-control" id="prix" name="prix" required>
          </div>
          <!-- Ajoute d'autres champs nécessaires -->
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
          <button type="submit" class="btn btn-primary">Ajouter</button>
        </div>
      </div>
    </form>
  </div>
</div>

</div>



</div>
@endsection
