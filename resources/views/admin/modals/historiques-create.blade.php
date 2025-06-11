<!-- Modal -->
<div class="modal fade" id="addHistoriqueModal" tabindex="-1" aria-labelledby="addHistoriqueLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form action="{{ route('admin.historique.store') }}" method="POST">
      @csrf
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addHistoriqueLabel">Nouvelle commande</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label for="Numcommande" class="form-label">Numéro de commande</label>
            <input type="text" class="form-control" name="Numcommande" required>
          </div>
          <div class="mb-3">
            <label for="NbrProduits" class="form-label">Nombre de produits</label>
            <input type="number" class="form-control" name="NbrProduits" required>
          </div>
          <div class="mb-3">
            <label for="NbrCategories" class="form-label">Nombre de catégories</label>
            <input type="number" class="form-control" name="NbrCategories" required>
          </div>
          <div class="mb-3">
            <label for="prix" class="form-label">Prix total</label>
            <input type="number" step="0.01" class="form-control" name="prix" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
          <button type="submit" class="btn btn-success">Ajouter</button>
        </div>
      </div>
    </form>
  </div>
</div>
