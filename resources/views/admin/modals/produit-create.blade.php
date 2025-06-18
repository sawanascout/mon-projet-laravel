<div class="modal fade" id="createProduitModal" tabindex="-1" aria-labelledby="createProduitModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form action="{{ route('admin.produits.store') }}" method="POST" enctype="multipart/form-data">
      @csrf
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="createProduitModalLabel">Ajouter un produit</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label for="nom" class="form-label">Nom</label>
            <input type="text" class="form-control" id="nom" name="nom" required>
          </div>

          <div class="mb-3">
            <label for="prix" class="form-label">Prix</label>
            <input type="number" step="0.01" class="form-control" id="prix" name="prix" required>
          </div>

          <div class="mb-3">
            <label for="ancien_prix" class="form-label">Ancien prix</label>
            <input type="number" step="0.01" class="form-control" id="ancien_prix" name="ancien_prix">
          </div>

          <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" name="description" rows="3"></textarea>
          </div>

          <div class="mb-3">
            <label for="category_id" class="form-label">Catégorie</label>
            <select class="form-control" id="category_id" name="category_id" required>
              @foreach($categories as $categorie)
                <option value="{{ $categorie->id }}">{{ $categorie->category_name }}</option>
              @endforeach
            </select>
          </div>

          <div class="mb-3">
        <label for="photo" class="form-label">Photo</label>
        <input type="file" class="form-control" id="photo" name="photo" accept="image/*">
    </div>

          <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="disponible" name="disponible" checked>
            <label class="form-check-label" for="disponible">Disponible</label>
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
          <button type="submit" class="btn btn-primary">Ajouter</button>
        </div>
      </div>
    </form>
  </div>
</div>
