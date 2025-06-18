<!-- Modal -->
<div class="modal fade" id="editModal-{{ $produit->id }}" tabindex="-1" aria-labelledby="editModalLabel-{{ $produit->id }}" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form action="{{ route('admin.produits.update', $produit->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="modal-header">
          <h5 class="modal-title" id="editModalLabel-{{ $produit->id }}">Modifier le produit</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
        </div>
        <div class="modal-body">

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="mb-3">
                <label>Nom :</label>
                <input type="text" name="nom" class="form-control" value="{{ old('nom', $produit->nom) }}" required>
            </div>

            <div class="mb-3">
                <label>Prix :</label>
                <input type="number" step="0.01" name="prix" class="form-control" value="{{ old('prix', $produit->prix) }}" required>
            </div>

            <div class="mb-3">
                <label>Ancien prix :</label>
                <input type="number" step="0.01" name="ancien_prix" class="form-control" value="{{ old('ancien_prix', $produit->ancien_prix) }}">
            </div>

            <div class="mb-3">
                <label>Description :</label>
                <textarea name="description" class="form-control">{{ old('description', $produit->description) }}</textarea>
            </div>

            <div class="mb-3">
                <label>Catégorie :</label>
                <select name="category_id" class="form-select" required>
                    @foreach($categories as $categorie)
                        <option value="{{ $categorie->id }}" {{ old('category_id', $produit->category_id) == $categorie->id ? 'selected' : '' }}>
                            {{ $categorie->category_name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label>Photo actuelle :</label><br>
                @if($produit->photo)
                    <img src="{{ asset('storage/' . $produit->photo) }}" alt="Photo produit" style="max-width: 150px;">
                @else
                    Pas de photo
                @endif
            </div>

            <div class="mb-3">
                <label>Changer la photo :</label>
                <input type="file" name="photo" class="form-control" accept="image/*">
            </div>

            <div class="mb-3">
                <label>Disponible :</label>
                <select name="disponible" class="form-select" required>
                    <option value="1" {{ old('disponible', $produit->disponible) == 1 ? 'selected' : '' }}>Oui</option>
                    <option value="0" {{ old('disponible', $produit->disponible) == 0 ? 'selected' : '' }}>Non</option>
                </select>
            </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
          <button type="submit" class="btn btn-primary">Mettre à jour</button>
        </div>
      </form>
    </div>
  </div>
</div>
