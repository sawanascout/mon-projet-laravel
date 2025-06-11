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
            <label for="nom" class="form-label">Nom de la catégorie</label>
            <input type="text" class="form-control" id="nom" name="nom" required>
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
