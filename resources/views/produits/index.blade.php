@extends('layouts.app')

@section('content')
<div class="container mt-4">

  <!-- Menu déroulant -->
  <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
  <div>
    <label for="filtreCategorie" class="form-label me-2">Catégorie :</label>
    <select id="filtreCategorie" class="form-select d-inline-block w-auto">
      <option value="all">Toutes les catégories</option>
      @foreach($categories as $categorie)
      <option value="categorie-{{ $categorie->id }}">{{ $categorie->nom }}</option>
      @endforeach
    </select>
  </div>

  <form action="{{ route('produits.rechercher') }}" method="GET" class="d-flex">
    <input type="text" name="nom" class="form-control me-2" placeholder="Rechercher un produit" value="{{ request('nom') }}">
    <button type="submit" class="btn btn-primary">Rechercher</button>
  </form>
</div>

    @if(request('nom'))
    <h4>Résultats pour "{{ request('nom') }}" :</h4>
    <div class="row">
        @forelse($produits as $produit)
<div class="col-md-4 mb-4">
  <div class="card h-100 shadow-sm position-relative">
    @if($produit->ancien_prix)
    <span class="badge bg-danger position-absolute top-0 end-0 m-2">Promo</span>
    @endif
    @if($produit->photo)
    <img src="{{ asset('storage/' . $produit->photo) }}" class="card-img-top" alt="{{ $produit->nom }}" style="height: 200px; object-fit: cover;">
    @endif
    <div class="card-body">
      <h5 class="card-title">{{ $produit->nom }}</h5>
      <p>{{ Str::limit($produit->description, 100) }}</p>
      <p>
        @if($produit->ancien_prix)
        <span class="text-muted text-decoration-line-through me-2">{{ $produit->ancien_prix }} CFA</span>
        @endif
        <strong>{{ $produit->prix }} CFA</strong>
      </p>
    </div>
    <div class="card-footer d-flex justify-content-between">
      <button class="btn btn-sm btn-success"
        onclick="handleAddToCart({{ $produit->id }})">Ajouter au panier</button>
    </div>
  </div>
</div>

<!-- Modal identique à celui déjà en place, à copier si nécessaire -->

@empty
  <p>Aucun produit trouvé.</p>
@endforelse

    </div>
@else
    {{-- ton affichage par catégories ici --}}
@endif


  <!-- Affichage des catégories et de leurs produits -->
  @foreach($categories as $categorie)
  <div class="categorie-section mb-5" data-categorie="categorie-{{ $categorie->id }}">
    <h3 class="mt-4">{{ $categorie->nom }}</h3>
    <div class="row">
      @forelse($categorie->produits as $produit)
      <div class="col-md-4 mb-4">
          <div class="card h-100 shadow-sm position-relative">
        @if($produit->ancien_prix)
            <span class="badge bg-danger position-absolute top-0 end-0 m-2">Promo</span>
        @endif
          @if($produit->photo)
          <img src="{{ asset('storage/' . $produit->photo) }}" class="card-img-top" alt="{{ $produit->nom }}" style="height: 200px; object-fit: cover;">
          @endif
          <div class="card-body">
            <h5 class="card-title">{{ $produit->nom }}</h5>
            <p>{{ Str::limit($produit->description, 100) }}</p>
            <p>
              @if($produit->ancien_prix)
                <span class="text-muted text-decoration-line-through me-2">{{ $produit->ancien_prix }} CFA</span>
              @endif
              <strong>{{ $produit->prix }} CFA</strong>
            </p>

          </div>
          <div class="card-footer d-flex justify-content-between">
            <button class="btn btn-sm btn-success"
    onclick="handleAddToCart({{ $produit->id }})">
    Ajouter au panier
</button>



          </div>
        </div>
      </div>

      <!-- Modal Ajouter au panier -->
      <div class="modal fade" id="ajouterPanierModal{{ $produit->id }}" tabindex="-1" aria-labelledby="ajouterPanierModalLabel{{ $produit->id }}" aria-hidden="true">
        <div class="modal-dialog">
          <form action="{{ route('client.panier.ajouter', $produit->id) }}" method="POST">
            @csrf
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="ajouterPanierModalLabel{{ $produit->id }}">Ajouter au panier : {{ $produit->nom }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
              </div>
              <div class="modal-body">
                <div class="mb-3">
                  <label class="form-label">Couleur</label>
                  <input type="text" name="couleur" class="form-control" required>
                </div>
                <div class="mb-3">
                  <label class="form-label">Taille</label>
                  <input type="text" name="taille" class="form-control" required>
                </div>
                <div class="mb-3">
                  <label class="form-label">Quantité</label>
                  <input type="number" name="quantite" class="form-control" value="1" min="1" max="1000" required>
                </div>
              </div>
              <div class="modal-footer">
                <button type="submit" class="btn btn-success">Ajouter</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
              </div>
            </div>
          </form>
        </div>
      </div>

      @empty
      <p class="text-muted">Aucun produit dans cette catégorie.</p>
      @endforelse
    </div>
  </div>
  @endforeach

</div>

<!-- JS pour filtrer les catégories -->
<script>
  document.getElementById('filtreCategorie').addEventListener('change', function () {
    const selected = this.value;
    const sections = document.querySelectorAll('.categorie-section');

    sections.forEach(section => {
      if (selected === 'all' || section.dataset.categorie === selected) {
        section.style.display = 'block';
      } else {
        section.style.display = 'none';
      }
    });
  });
</script>
<script>
function handleAddToCart(produitId) {
  @if(Auth::check() && Auth::user()->role === 'client')
    const modalId = '#ajouterPanierModal' + produitId;
    const modal = new bootstrap.Modal(document.querySelector(modalId));
    modal.show();
  @else
    window.location.href = "{{ route('auth.login.form') }}";
  @endif
}
</script>


@endsection
