@extends('layouts.admin')

@section('content')
<h1>Liste des Catégories</h1>
@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<table class="table">
    <thead>
        <tr>
            <th>Nom</th>
            <th>Produits</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
    @foreach($categories as $category)
        <tr>
            <td>{{ $category->nom }}</td>
            <td>{{ $category->produits->count() }}</td>
            <td>
                <button type="button" class="btn btn-info text-white" data-bs-toggle="modal" data-bs-target="#editCategorieModal{{ $category->id }}">
                    Modifier
                </button>

                <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" class="d-inline" onsubmit="return confirm('Confirmer la suppression ?');">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-sm">Supprimer</button>
                </form>
            </td>
        </tr>

        <!-- Modal placé ici, à l’intérieur de la boucle -->
        <div class="modal fade" id="editCategorieModal{{ $category->id }}" tabindex="-1" aria-labelledby="editCategorieModalLabel{{ $category->id }}" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <form action="{{ route('admin.categories.update', $category) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="modal-header">
                  <h5 class="modal-title" id="editCategorieModalLabel{{ $category->id }}">Modifier la Catégorie</h5>
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

                  <div class="form-group">
                    <label for="nom">Nom de la catégorie</label>
                    <input type="text" name="nom" class="form-control" value="{{ old('nom', $category->nom) }}" required>
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

    @endforeach
</tbody>

</table>


@endsection
